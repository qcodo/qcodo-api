<?php
	class QBuildMaker extends QBaseClass {
		protected $intMajor;
		protected $intMinor;
		protected $intBuild;
		protected $blnStable;

		protected $strRoot;
		protected $strTemp;
		protected $strVersion;
		protected $strVersionFilename;

		protected $strXml;

		protected $objDirectoryTokens;

		const BuildRoot = '/var/qcodo_builds';
		const ManifestPath = '/includes/qcodo/_core/manifest/manifest.xml';
		const GitUrl = 'git://github.com/qcodo/qcodo.git';

		public static function StripQuotes($strText) {
			if (((QString::FirstCharacter($strText) == '"') && (QString::LastCharacter($strText)  == '"')) ||
				((QString::FirstCharacter($strText) == "'") && (QString::LastCharacter($strText)  == "'"))) {
				return substr($strText, 1, strlen($strText) - 2);
			}

			return $strText;
		}

		public static function StripDollar($strText) {
			if (QString::FirstCharacter($strText) == '$')
				return substr($strText, 1);
			else
				return $strText;
		}

		public function __construct($intMajor, $intMinor, $intBuild, $blnStable) {
			$this->intMajor = $intMajor;
			$this->intMinor = $intMinor;
			$this->intBuild = $intBuild;
			$this->blnStable = $blnStable;

			$this->strTemp = sprintf('%s/qcodo-temp', QBuildMaker::BuildRoot);
			$this->strRoot = sprintf('%s/qcodo-%s.%s.%s', QBuildMaker::BuildRoot, $intMajor, $intMinor, $intBuild);
			$this->strVersion = sprintf('%s.%s.%s', $intMajor, $intMinor, $intBuild);

			$objDirectoryArray = DirectoryToken::LoadAllUsingOrderBy('length(path) DESC');
			foreach ($objDirectoryArray as $objDirectory) {
				$this->objDirectoryTokens[$objDirectory->Token] = $objDirectory;
			}

			if ($this->blnStable)
				$this->strVersionFilename = '/STABLE';
			else
				$this->strVersionFilename = '/DEVELOPMENT';

			// Erase Previous Temp 
			if (file_exists($this->strTemp))
				print shell_exec("rm -r -f $this->strTemp");

			// Get the Latest Build and Remove any GIT-related stuff
			print shell_exec('cd ' . QBuildMaker::BuildRoot . '; git clone ' . QBuildMaker::GitUrl);
			print shell_exec('cd ' . QBuildMaker::BuildRoot . '/qcodo; rm -r -f .git');
			print shell_exec('cd ' . QBuildMaker::BuildRoot . '/qcodo; rm -r -f .gitignore');

			// Move to Temp Location
			rename(QBuildMaker::BuildRoot . '/qcodo', $this->strTemp);

			// Check/Validate Version Number
			$strQcodoInc = file_get_contents($this->strTemp . '/includes/qcodo/_core/qcodo.inc.php');
			$strQcodoIncLines = explode("\n", $strQcodoInc);
			$blnFound = false;
			foreach ($strQcodoIncLines as $strLine) {
				if (!$blnFound)
					if (strpos($strLine, 'QCODO_VERSION') !== false) {
						$strLine = trim($strLine);
						$blnFound = true;
						if (strpos($strLine, $this->strVersion) === false) {
							print("Error: Attempting to build Qcodo Version $this->strVersion\r\n");
							print("Code is reporting Qcodo Version: $strLine\r\n");
							if (file_exists($this->strTemp))
								print shell_exec("rm -r -f $this->strTemp");
							exit();
						}
					}
			}

			if (!$blnFound) {
				print("Error: Attempting to build Qcodo Version $strVersion\r\n");
				print("Code does not report a Qcodo Version\r\n");
				if (file_exists($this->strTemp))
					print shell_exec("rm -r -f $this->strTemp");
				exit();
			}
			
			// Erase Previous Builds
			if (file_exists($this->strRoot))
				print shell_exec("rm -r -f $this->strRoot");
			if (file_exists($this->strRoot . '.zip'))
				print shell_exec("rm -r -f $this->strRoot.zip");
			if (file_exists($this->strRoot . '.tar.gz'))
				print shell_exec("rm -r -f $this->strRoot.tar.gz");
			if (file_exists(QBuildMaker::BuildRoot . $this->strVersionFilename))
				print shell_exec("rm -r -f " . QBuildMaker::BuildRoot . $this->strVersionFilename);

			// Fix up the folder path
			rename($this->strTemp, $this->strRoot);

			// Go Ahead and Process Everything
			$this->blnFileProcessedArray = array();
			$this->strXml = sprintf("<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n<!-- Generated by the Qcodo Build Maker and Qcodo Updater Utility -->\r\n<!-- Do NOT delete or modify ANYTHING in this file.  Doing so will break the Qcodo Updater service. -->\r\n<manifest>\r\n<version>%s</version>\r\n<major>%s</major>\r\n<minor>%s</minor>\r\n<build>%s</build>\r\n<type>%s</type>\r\n<files>\r\n",
				$this->strVersion, $this->intMajor, $this->intMinor, $this->intBuild, ($this->blnStable) ? 'Stable' : 'Development');
			$this->ProcessFolder($this->strRoot);
			$this->Deprecate();

			$this->strXml .= "</files>\r\n<directories>\r\n";
			foreach ($this->objDirectoryTokens as $objDirectory)
				$this->strXml .= sprintf("<directory token=\"%s\" coreFlag=\"%s\" relativeFlag=\"%s\"/>\r\n",
					$objDirectory->Token, ($objDirectory->CoreFlag) ? 1 : 0, ($objDirectory->RelativeFlag) ? 1 : 0);
			$this->strXml .= "</directories>\r\n</manifest>";
			file_put_contents($this->strRoot . QBuildMaker::ManifestPath , $this->strXml);

			// Finally, Package It All
			shell_exec(sprintf('cd %s; tar -cf qcodo-%s.tar qcodo-%s; gzip qcodo-%s.tar; zip -r qcodo-%s.zip qcodo-%s',
				QBuildMaker::BuildRoot, $this->strVersion, $this->strVersion, $this->strVersion,
				$this->strVersion, $this->strVersion));

			shell_exec('echo ' . $this->strVersion . ' > ' . QBuildMaker::BuildRoot . $this->strVersionFilename);
		}

		protected $blnFileProcessedArray;

		protected function ProcessFolder($strFolder) {
			$strLabel =  substr($strFolder, strlen($this->strRoot) + 1);
			if (!$strLabel)
				$strLabel = 'root';
			print('Processing ' . $strLabel . ' [');
			$strFileArray = array();
			$strFolderArray = array();

			// Iterate through all subfolders and files in this folder
			// Be sure not to process anything with CVS, or ds_store
			$objDirectory = opendir($strFolder);
			while ($strName = readdir($objDirectory))
				if (($strName != '.') && ($strName != '..') &&
					($strName != 'SVN') && ($strName != '.svnignore') &&
					($strName != 'CVS') && ($strName != '.cvsignore') &&
					(strtolower($strName) != '.ds_store')) {
					$strFullPath = $strFolder . '/' . $strName;
					if (is_dir($strFullPath))
						array_push($strFolderArray, $strFullPath);
					else
						array_push($strFileArray, $strFullPath);
				}

			$intFileCount = count($strFileArray);
			for ($intFileIndex = 0; $intFileIndex < $intFileCount; $intFileIndex++)
				print(' ');
			print(']');
			for ($intFileIndex = 0; $intFileIndex <= $intFileCount; $intFileIndex++)
				print(chr(8));

			foreach ($strFileArray as $strFile) {
				print('X');
				$strMd5 = md5_file($strFile);
				$strFullPath = $strFile;
				$strFile = (substr($strFile, strlen($this->strRoot) + 1));

				// Process all files other than the root _README.txt and LICENSE.txt
				if (($strFile != '_README.txt') &&
					($strFile != '_LICENSE.txt')) {

					$intDirectoryId = null;
					$objFileDirectory = null;
					foreach ($this->objDirectoryTokens as $objDirectory) {
						if (!$intDirectoryId) {
							if (strpos($strFile, $objDirectory->Path) === 0) {
								$intDirectoryId = $objDirectory->Id;
								$objFileDirectory = $objDirectory;
								$strFile = substr($strFile, strlen($objDirectory->Path));
							}
						}
					}

					if (!$intDirectoryId) {
						var_dump($this->objDirectoryTokens);
						exit("FATAL ERROR: No DirectoryToken resolution for " . $strFile . "\r\n");
					}

					$objFile = File::LoadByDirectoryIdPath($intDirectoryId, $strFile);
					if (!$objFile) {
						$objFile = new File();
						$objFile->Path = $strFile;
						$objFile->DirectoryId = $intDirectoryId;
					} else {
						$objFile->DeprecatedMajorVersion = null;
						$objFile->DeprecatedMinorVersion = null;
						$objFile->DeprecatedBuild = null;
					}
					$objFile->Save();

					$this->blnFileProcessedArray['id' . $objFile->Id] = true;
					$this->strXml .= sprintf("<file directoryToken=\"%s\" path=\"%s\" md5=\"%s\"/>\r\n",
						$objFileDirectory->Token, $strFile, $strMd5);

					if ((substr($strFile, strlen($strFile) - 4) == '.php') && (strpos($strFullPath, '/assets/') === false)) {
						switch ($objFileDirectory->Token) {
							case '__INCLUDES__':
							case '__QCODO__':
							case '__QCODO_CORE__':
								$objParser = new QScriptParser($strFullPath);
								$objResult = $objParser->ParseTokens();

								// Iterate through the Class Definitions
								foreach ($objResult->ClassArray as $objParserClass) {
									if ($objParserClass->Extends) {
										$objParentClass = QcodoClass::RestoreByName($objParserClass->Extends, $this->strVersion, null);
									} else {
										$objParentClass = null;
									}

									// TO DO
									// if ($strImplements) {
									// }

									$objClass = QcodoClass::RestoreByName($objParserClass->Name, $this->strVersion, $objFile);
									$objClass->AbstractFlag = $objParserClass->Abstract;
									$objClass->ParentQcodoClass = $objParentClass;
									$objClass->Save();

									// Class Constants
									$strConstantArray = array();
									foreach ($objParserClass->ConstantArray as $objParserConstant) {
										$objConstant = QcodoConstant::RestoreByNameForClass($objParserConstant->Name, $objClass->Id, $this->strVersion, $objFile);
//										$strValue = QBuildMaker::StripQuotes($objParserConstant->Value);
										$strValue = $objParserConstant->Value;
										$objConstant->Variable->DefaultValue = $strValue;
										$objConstant->Variable->Save();
										$strConstantArray[$objParserConstant->Name] = true;
									}
									
									// Class Constants (Deprecate)
									foreach ($objClass->GetQcodoConstantArray(QQ::Clause(QQ::Expand(QQN::QcodoConstant()->Variable))) as $objConstant) {
										if (!array_key_exists($objConstant->Variable->Name, $strConstantArray)) {
											$objConstant->Variable->LastVersion = $this->strVersion;
											$objConstant->Variable->Save();
										}
									}
									
									// Class Variables
									$strVariableArray = array();
									foreach ($objParserClass->VariableArray as $objParserVariable) {
										$strName = QBuildMaker::StripDollar($objParserVariable->Name);
//										$strValue = QBuildMaker::StripQuotes($objParserVariable->DefaultValue);
										$strValue = $objParserVariable->DefaultValue;

										$objClassVariable = ClassVariable::RestoreByNameForClass($strName, $objClass->Id, $this->strVersion);
										$objClassVariable->Variable->DefaultValue = $strValue;
										$objClassVariable->Variable->Save();

										$objClassVariable->StaticFlag = $objParserVariable->Static;
										switch(strtolower($objParserVariable->Visibility)) {
											case 'public':
												$objClassVariable->ProtectionTypeId = ProtectionType::_Public;
												break;
											case 'protected':
												$objClassVariable->ProtectionTypeId = ProtectionType::_Protected;
												break;
											case 'private':
												$objClassVariable->ProtectionTypeId = ProtectionType::_Private;
												break;
											default:
												throw new Exception('Unknown Protection Type');
										}
										$objClassVariable->Save();
										$strVariableArray[$strName] = true;
									}

									// Class Variables (deprecate)
									foreach ($objClass->GetClassVariableArray(QQ::Clause(QQ::Expand(QQN::ClassVariable()->Variable))) as $objClassVariable) {
										if (!array_key_exists($objClassVariable->Variable->Name, $strVariableArray)) {
											$objClassVariable->Variable->LastVersion = $this->strVersion;
											$objClassVariable->Variable->Save();
										}
									}

									// Class Methods
									$strMethodArray = array();
									foreach ($objParserClass->MethodArray as $objParserFunction) {
										$objOperation = Operation::RestoreByNameForClass($objParserFunction->Name, $objClass->Id, $this->strVersion, $objFile);

										$objOperation->StaticFlag = $objParserFunction->Static;
										$objOperation->FinalFlag = $objParserFunction->Final;
										$objOperation->AbstractFlag = $objParserFunction->Abstract;
										switch(strtolower($objParserFunction->Visibility)) {
											case 'public':
												$objOperation->ProtectionTypeId = ProtectionType::_Public;
												break;
											case 'protected':
												$objOperation->ProtectionTypeId = ProtectionType::_Protected;
												break;
											case 'private':
												$objOperation->ProtectionTypeId = ProtectionType::_Private;
												break;
											default:
												throw new Exception('Unknown Protection Type');
										}
										$objOperation->Save();
										$strMethodArray[$objParserFunction->Name] = true;

										// Figure Out the Parameters
										$objParserParameterArray = array();
										foreach ($objParserFunction->ParameterArray as $objParserParameter) {
											$strName = QBuildMaker::StripDollar($objParserParameter->Name);
											$objParserParameterArray[$strName] = $objParserParameter;
										}

										$objParameterArray = Parameter::RestoreParameterArrayByNameForOperation(array_keys($objParserParameterArray), $objOperation->Id, $this->strVersion);
										foreach ($objParameterArray as $objParameter) {
											$objParserParameter = $objParserParameterArray[$objParameter->Variable->Name];
											$objParameter->ReferenceFlag = $objParserParameter->Reference;
											$objParameter->Save();
											
											$objParameter->Variable->DefaultValue = $objParserParameter->DefaultValue;
											$objParameter->Variable->Save();
										}
									}

									// Class Methods (deprecate)
									foreach ($objClass->GetOperationArray() as $objOperation) {
										if (!array_key_exists($objOperation->Name, $strMethodArray)) {
											$objOperation->LastVersion = $this->strVersion;
											$objOperation->Save();
										}
									}

									// Class Properties
									$strPropertyArray = array();
									foreach ($objParserClass->PropertyArray as $objParserProperty) {
										$strName = QBuildMaker::StripQuotes($objParserProperty->Name);
										if (($strName != 'ttf') && ($strName != 'pfb') && ($strName != 'afm')) {
											$objProperty = ClassProperty::RestoreByNameForClass($strName, $objClass->Id, $this->strVersion);
											if (($objParserProperty->Read) && (!$objParserProperty->Write)) {
												$objProperty->ReadOnlyFlag = true;
												$objProperty->WriteOnlyFlag = false;
											} else if ((!$objParserProperty->Read) && ($objParserProperty->Write)) {
												$objProperty->ReadOnlyFlag = false;
												$objProperty->WriteOnlyFlag = true;
											} else {
												$objProperty->ReadOnlyFlag = false;
												$objProperty->WriteOnlyFlag = false;
											}
											$objProperty->Save();

											$strPropertyArray[$strName] = true;
										}
									}

									// Class Properties (deprecate)
									foreach ($objClass->GetClassPropertyArray() as $objProperty) {
										if (!array_key_exists($objProperty->Variable->Name, $strPropertyArray)) {
											$objProperty->Variable->LastVersion = $this->strVersion;
											$objProperty->Save();
										}
									}
								}

								// Iterate through the Interfaces
								// TODO

								// Iterate through the Global Functions
								foreach ($objResult->FunctionArray as $objParserFunction) {
									$objOperation = Operation::RestoreByNameForClass($objParserFunction->Name, null, $this->strVersion, $objFile);

									// Figure Out the Parameters
									$objParserParameterArray = array();
									foreach ($objParserFunction->ParameterArray as $objParserParameter) {
										$strName = QBuildMaker::StripDollar($objParserParameter->Name);
										$objParserParameterArray[$strName] = $objParserParameter;
									}

									$objParameterArray = Parameter::RestoreParameterArrayByNameForOperation(array_keys($objParserParameterArray), $objOperation->Id, $this->strVersion);
									foreach ($objParameterArray as $objParameter) {
										$objParserParameter = $objParserParameterArray[$objParameter->Variable->Name];
										$objParameter->ReferenceFlag = $objParserParameter->Reference;
										$objParameter->Save();
										
										$objParameter->Variable->DefaultValue = $objParserParameter->DefaultValue;
										$objParameter->Variable->Save();
									}
								}

								// Iterate through the Global Constants
								foreach ($objResult->ConstantArray as $objParserConstant) {
									$objConstant = QcodoConstant::RestoreByNameForClass($objParserConstant->Name, null, $this->strVersion, $objFile);
									// $strValue = QBuildMaker::StripQuotes($objParserConstant->Value);
									$strValue = $objParserConstant->Value;
									$objConstant->Variable->DefaultValue = $strValue;
									$objConstant->Variable->Save();
								}

								// Iterate through the Global Variables
								// NOT SUPPORTED
								break;
						}
					}
				}
			}

			print("] Done.\r\n");
			foreach ($strFolderArray as $strFolder) {
				$this->ProcessFolder($strFolder);
			}
		}
		
		protected function Deprecate() {
			$objFileArray = File::LoadAll();
			foreach ($objFileArray as $objFile) {
				if (array_key_exists('id' . $objFile->Id, $this->blnFileProcessedArray) &&
					$this->blnFileProcessedArray['id' . $objFile->Id]) {
				} else {
					if (is_null($objFile->DeprecatedBuild)) {
						$objFile->DeprecatedMajorVersion = $this->intMajor;
						$objFile->DeprecatedMinorVersion = $this->intMinor;
						$objFile->DeprecatedBuild = $this->intBuild;
						$objFile->Save();
					}
				}
			}
		}
	}
?>