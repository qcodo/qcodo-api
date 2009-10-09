<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the File class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of File objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this FileListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class FileListFormBase extends QForm {
		protected $dtgFile;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colDirectoryId;
		protected $colPath;
		protected $colDeprecatedMajorVersion;
		protected $colDeprecatedMinorVersion;
		protected $colDeprecatedBuild;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgFile_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::File()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::File()->Id, false)));
			$this->colDirectoryId = new QDataGridColumn(QApplication::Translate('Directory Id'), '<?= $_FORM->dtgFile_Directory_Render($_ITEM); ?>');
			$this->colPath = new QDataGridColumn(QApplication::Translate('Path'), '<?= QString::Truncate($_ITEM->Path, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::File()->Path), 'ReverseOrderByClause' => QQ::OrderBy(QQN::File()->Path, false)));
			$this->colDeprecatedMajorVersion = new QDataGridColumn(QApplication::Translate('Deprecated Major Version'), '<?= $_ITEM->DeprecatedMajorVersion; ?>', array('OrderByClause' => QQ::OrderBy(QQN::File()->DeprecatedMajorVersion), 'ReverseOrderByClause' => QQ::OrderBy(QQN::File()->DeprecatedMajorVersion, false)));
			$this->colDeprecatedMinorVersion = new QDataGridColumn(QApplication::Translate('Deprecated Minor Version'), '<?= $_ITEM->DeprecatedMinorVersion; ?>', array('OrderByClause' => QQ::OrderBy(QQN::File()->DeprecatedMinorVersion), 'ReverseOrderByClause' => QQ::OrderBy(QQN::File()->DeprecatedMinorVersion, false)));
			$this->colDeprecatedBuild = new QDataGridColumn(QApplication::Translate('Deprecated Build'), '<?= $_ITEM->DeprecatedBuild; ?>', array('OrderByClause' => QQ::OrderBy(QQN::File()->DeprecatedBuild), 'ReverseOrderByClause' => QQ::OrderBy(QQN::File()->DeprecatedBuild, false)));

			// Setup DataGrid
			$this->dtgFile = new QDataGrid($this);
			$this->dtgFile->CellSpacing = 0;
			$this->dtgFile->CellPadding = 4;
			$this->dtgFile->BorderStyle = QBorderStyle::Solid;
			$this->dtgFile->BorderWidth = 1;
			$this->dtgFile->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgFile->Paginator = new QPaginator($this->dtgFile);
			$this->dtgFile->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgFile->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgFile->SetDataBinder('dtgFile_Bind');

			$this->dtgFile->AddColumn($this->colEditLinkColumn);
			$this->dtgFile->AddColumn($this->colId);
			$this->dtgFile->AddColumn($this->colDirectoryId);
			$this->dtgFile->AddColumn($this->colPath);
			$this->dtgFile->AddColumn($this->colDeprecatedMajorVersion);
			$this->dtgFile->AddColumn($this->colDeprecatedMinorVersion);
			$this->dtgFile->AddColumn($this->colDeprecatedBuild);
		}
		
		public function dtgFile_EditLinkColumn_Render(File $objFile) {
			return sprintf('<a href="file_edit.php?intId=%s">%s</a>',
				$objFile->Id, 
				QApplication::Translate('Edit'));
		}

		public function dtgFile_Directory_Render(File $objFile) {
			if (!is_null($objFile->Directory))
				return $objFile->Directory->__toString();
			else
				return null;
		}


		protected function dtgFile_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgFile->TotalItemCount = File::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgFile->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgFile->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgFile->DataSource = File::LoadAll($objClauses);
		}
	}
?>