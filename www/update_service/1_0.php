<?php
	require('../../includes/prepend.inc.php');
//	require('QBuildMaker.inc');

	class UpdateService extends QSoapService {
		/**
		 * Gets the Manifest XML Document for the specified release
		 *
		 * @param integer $intMajorVersion
		 * @param integer $intMinorVersion
		 * @param integer $intBuild
		 * @return string XML Document containing Manifest data
		 */
		public function GetManifest($intMajorVersion, $intMinorVersion, $intBuild) {
			if ((string) $intMajorVersion == 's') {
				$strVersion = trim(file_get_contents(QBuildMaker::BuildRoot . '/STABLE'));
			} else if ((string) $intMajorVersion == 'd') {
				$strVersion = trim(file_get_contents(QBuildMaker::BuildRoot . '/DEVELOPMENT'));
			} else
				$strVersion = sprintf('%s.%s.%s', $intMajorVersion, $intMinorVersion, $intBuild);
			$strManifestFile = sprintf('%s/qcodo-%s%s', QBuildMaker::BuildRoot, $strVersion, QBuildMaker::ManifestPath);

			if (file_exists($strManifestFile))
				return file_get_contents($strManifestFile);
			else
				throw new Exception('Could not find manifest.xml for Qcodo Version ' . $strVersion);
		}

		/**
		 * Returns a FileState integer for the given path and specified release.
		 * A value of 0 means the file has never existed.
		 * A value of 1 means the file is current/active for the specified release
		 * A value of -1 means the file is deprecated as of the specified release
		 *
		 * @param integer $intMajorVersion
		 * @param integer $intMinorVersion
		 * @param integer $intBuild
		 * @param string $strPath
		 * @param string $strToken
		 * @return integer
		 */
		public function GetFileState($intMajorVersion, $intMinorVersion, $intBuild, $strPath, $strToken) {
			$objDirectory = DirectoryToken::LoadByToken(trim(strtoupper($strToken)));
			if (!$objDirectory)
				throw new Exception('Directory Token does not exist: ' . $strToken);
			$strVersion = sprintf('%s.%s.%s', $intMajorVersion, $intMinorVersion, $intBuild);
			$objFile = File::LoadByDirectoryIdPath($objDirectory->Id, trim(strtolower($strPath)));
			if (!$objFile)
				return 0;
			if (is_null($objFile->MajorVersion))
				return 1;
			if ($objFile->DeprecatedMajorVersion < $intMajorVersion)
				return -1;
			if ($objFile->DeprecatedMajorVersion == $intMajorVersion) {
				if ($objFile->DeprecatedMinorVersion < $intMinorVersion)
					return -1;
				if ($objFile->DeprecatedMinorVersion == $intMinorVersion) {
					if ($objFile->DeprecatedBuild <= $intBuild)
						return -1;
				}
			}

			return 1;
		}

		/**
		 * Returns the file given the file path and specified release
		 *
		 * @param integer $intMajorVersion
		 * @param integer $intMinorVersion
		 * @param integer $intBuild
		 * @param string $strPath
		 * @param string $strToken
		 * @param bool $blnGzCompress
		 * @return string Base64-encoded file and associated data
		 */
		public function GetFile($intMajorVersion, $intMinorVersion, $intBuild, $strPath, $strToken, $blnGzCompress) {
			$objDirectory = DirectoryToken::LoadByToken(trim(strtoupper($strToken)));
			if (!$objDirectory)
				throw new Exception('Directory Token does not exist: ' . $strToken);
			$strVersion = sprintf('%s.%s.%s', $intMajorVersion, $intMinorVersion, $intBuild);
			$strFile = sprintf('%s/qcodo-%s/%s%s', QBuildMaker::BuildRoot, $strVersion, $objDirectory->Path, $strPath);
			if (file_exists($strFile) && is_file($strFile)) {
				$strText = file_get_contents($strFile);
				$intOriginalLength = strlen($strText);
				if ($blnGzCompress)
					$strText = gzcompress($strText, 9);
				$strText = base64_encode($strText);
				$intPointer = 0;
				$intLength = strlen($strText);
				$strOutput = '';
				while ($intPointer < $intLength) {
					$strOutput .= substr($strText, $intPointer, 80) . "\r\n";
					$intPointer += 80;
				}

				$strOutput = trim($strOutput);

				$strToReturn = sprintf("OK\r\n%s\r\n%s\r\n%s\r\n%s\r\n%s", $strPath, $strToken, $intOriginalLength, strlen($strOutput), $strOutput);
				return $strToReturn;
			} else
				throw new Exception('File Not Found: Could not find "' . $strPath . '" in "' . $strToken . '" for Qcodo Version ' . $strVersion);
		}
	}

	if (QApplication::PathInfo(0)) {
		$objService = new UpdateService('UpdateService', null);
		
		$intMajorVersion = QApplication::QueryString('mav');
		if (($intMajorVersion != 's') && ($intMajorVersion != 'd'))
			$intMajorVersion = QType::Cast($intMajorVersion, QType::Integer);
		$intMinorVersion = QType::Cast(QApplication::QueryString('miv'), QType::Integer);
		$intBuild = QType::Cast(QApplication::QueryString('bld'), QType::Integer);
		$strPath = QApplication::QueryString('pth');
		$strToken = QApplication::QueryString('tok');
		$blnGzCompress = QApplication::QueryString('cmp');
		switch (QApplication::PathInfo(0)) {
			case 'GetManifest':
				header('Content-Type: text/xml');
				print($objService->GetManifest($intMajorVersion, $intMinorVersion, $intBuild));
				break;
			case 'GetFileState':
				print($objService->GetFileState($intMajorVersion, $intMinorVersion, $intBuild, $strPath, $strToken));
				break;
			case 'GetFile':
				print($objService->GetFile($intMajorVersion, $intMinorVersion, $intBuild, $strPath, $strToken, $blnGzCompress));
				break;
		}
	} else
		UpdateService::Run('UpdateService');
?>