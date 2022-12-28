<?php
namespace PHPMaker2020\simpel;

/**
 * Page class
 */
class izin_non_oss_edit extends izin_non_oss
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{EC8FDD2A-6757-4E22-9B89-2E852912498C}";

	// Table name
	public $TableName = 'izin_non_oss';

	// Page object name
	public $PageObjName = "izin_non_oss_edit";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (izin_non_oss)
		if (!isset($GLOBALS["izin_non_oss"]) || get_class($GLOBALS["izin_non_oss"]) == PROJECT_NAMESPACE . "izin_non_oss") {
			$GLOBALS["izin_non_oss"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["izin_non_oss"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'izin_non_oss');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $izin_non_oss;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($izin_non_oss);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "izin_non_ossview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									"fn=" . Encrypt($fld->physicalUploadPath() . $val)));
								$row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
										Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
										"fn=" . Encrypt($fld->physicalUploadPath() . $file)));
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['id_izin_non_oss'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->id_izin_non_oss->Visible = FALSE;
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!ValidApiRequest())
			return FALSE;
		$this->setupApiSecurity();

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Param("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API security
	public function setupApiSecurity()
	{
		global $Security;

		// Setup security for API request
	}
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
		} else {
			$Security = new AdvancedSecurity();
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id_izin_non_oss->setVisibility();
		$this->no_izin->setVisibility();
		$this->id_jenis_izin->setVisibility();
		$this->jenis_pemohon->setVisibility();
		$this->nama_pemohon->setVisibility();
		$this->id_jbu->setVisibility();
		$this->id_sektor->setVisibility();
		$this->id_subsektor->setVisibility();
		$this->tanggal_izin->setVisibility();
		$this->alamat_pemohon->setVisibility();
		$this->alamat_perusahaan->setVisibility();
		$this->alamat_proyek->setVisibility();
		$this->detail_izin->setVisibility();
		$this->sysdate->setVisibility();
		$this->id_user->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		// Check modal

		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {

			// Load key values
			$loaded = TRUE;
			if (Get("id_izin_non_oss") !== NULL) {
				$this->id_izin_non_oss->setQueryStringValue(Get("id_izin_non_oss"));
				$this->id_izin_non_oss->setOldValue($this->id_izin_non_oss->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->id_izin_non_oss->setQueryStringValue(Key(0));
				$this->id_izin_non_oss->setOldValue($this->id_izin_non_oss->QueryStringValue);
			} elseif (Post("id_izin_non_oss") !== NULL) {
				$this->id_izin_non_oss->setFormValue(Post("id_izin_non_oss"));
				$this->id_izin_non_oss->setOldValue($this->id_izin_non_oss->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->id_izin_non_oss->setQueryStringValue(Route(2));
				$this->id_izin_non_oss->setOldValue($this->id_izin_non_oss->QueryStringValue);
			} else {
				$loaded = FALSE; // Unable to load key
			}

			// Load record
			if ($loaded)
				$loaded = $this->loadRow();
			if (!$loaded) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate();
				return;
			}
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} else {
			if (Post("action") !== NULL) {
				$this->CurrentAction = Post("action"); // Get action code
				if (!$this->isShow()) // Not reload record, handle as postback
					$postBack = TRUE;

				// Load key from Form
				if ($CurrentForm->hasValue("x_id_izin_non_oss")) {
					$this->id_izin_non_oss->setFormValue($CurrentForm->getValue("x_id_izin_non_oss"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("id_izin_non_oss") !== NULL) {
					$this->id_izin_non_oss->setQueryStringValue(Get("id_izin_non_oss"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->id_izin_non_oss->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->id_izin_non_oss->CurrentValue = NULL;
				}
			}

			// Load current record
			$loaded = $this->loadRow();
		}

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("izin_non_osslist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "izin_non_osslist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'id_izin_non_oss' first before field var 'x_id_izin_non_oss'
		$val = $CurrentForm->hasValue("id_izin_non_oss") ? $CurrentForm->getValue("id_izin_non_oss") : $CurrentForm->getValue("x_id_izin_non_oss");
		if (!$this->id_izin_non_oss->IsDetailKey)
			$this->id_izin_non_oss->setFormValue($val);

		// Check field name 'no_izin' first before field var 'x_no_izin'
		$val = $CurrentForm->hasValue("no_izin") ? $CurrentForm->getValue("no_izin") : $CurrentForm->getValue("x_no_izin");
		if (!$this->no_izin->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->no_izin->Visible = FALSE; // Disable update for API request
			else
				$this->no_izin->setFormValue($val);
		}

		// Check field name 'id_jenis_izin' first before field var 'x_id_jenis_izin'
		$val = $CurrentForm->hasValue("id_jenis_izin") ? $CurrentForm->getValue("id_jenis_izin") : $CurrentForm->getValue("x_id_jenis_izin");
		if (!$this->id_jenis_izin->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_jenis_izin->Visible = FALSE; // Disable update for API request
			else
				$this->id_jenis_izin->setFormValue($val);
		}

		// Check field name 'jenis_pemohon' first before field var 'x_jenis_pemohon'
		$val = $CurrentForm->hasValue("jenis_pemohon") ? $CurrentForm->getValue("jenis_pemohon") : $CurrentForm->getValue("x_jenis_pemohon");
		if (!$this->jenis_pemohon->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jenis_pemohon->Visible = FALSE; // Disable update for API request
			else
				$this->jenis_pemohon->setFormValue($val);
		}

		// Check field name 'nama_pemohon' first before field var 'x_nama_pemohon'
		$val = $CurrentForm->hasValue("nama_pemohon") ? $CurrentForm->getValue("nama_pemohon") : $CurrentForm->getValue("x_nama_pemohon");
		if (!$this->nama_pemohon->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nama_pemohon->Visible = FALSE; // Disable update for API request
			else
				$this->nama_pemohon->setFormValue($val);
		}

		// Check field name 'id_jbu' first before field var 'x_id_jbu'
		$val = $CurrentForm->hasValue("id_jbu") ? $CurrentForm->getValue("id_jbu") : $CurrentForm->getValue("x_id_jbu");
		if (!$this->id_jbu->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_jbu->Visible = FALSE; // Disable update for API request
			else
				$this->id_jbu->setFormValue($val);
		}

		// Check field name 'id_sektor' first before field var 'x_id_sektor'
		$val = $CurrentForm->hasValue("id_sektor") ? $CurrentForm->getValue("id_sektor") : $CurrentForm->getValue("x_id_sektor");
		if (!$this->id_sektor->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_sektor->Visible = FALSE; // Disable update for API request
			else
				$this->id_sektor->setFormValue($val);
		}

		// Check field name 'id_subsektor' first before field var 'x_id_subsektor'
		$val = $CurrentForm->hasValue("id_subsektor") ? $CurrentForm->getValue("id_subsektor") : $CurrentForm->getValue("x_id_subsektor");
		if (!$this->id_subsektor->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_subsektor->Visible = FALSE; // Disable update for API request
			else
				$this->id_subsektor->setFormValue($val);
		}

		// Check field name 'tanggal_izin' first before field var 'x_tanggal_izin'
		$val = $CurrentForm->hasValue("tanggal_izin") ? $CurrentForm->getValue("tanggal_izin") : $CurrentForm->getValue("x_tanggal_izin");
		if (!$this->tanggal_izin->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tanggal_izin->Visible = FALSE; // Disable update for API request
			else
				$this->tanggal_izin->setFormValue($val);
			$this->tanggal_izin->CurrentValue = UnFormatDateTime($this->tanggal_izin->CurrentValue, 0);
		}

		// Check field name 'alamat_pemohon' first before field var 'x_alamat_pemohon'
		$val = $CurrentForm->hasValue("alamat_pemohon") ? $CurrentForm->getValue("alamat_pemohon") : $CurrentForm->getValue("x_alamat_pemohon");
		if (!$this->alamat_pemohon->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->alamat_pemohon->Visible = FALSE; // Disable update for API request
			else
				$this->alamat_pemohon->setFormValue($val);
		}

		// Check field name 'alamat_perusahaan' first before field var 'x_alamat_perusahaan'
		$val = $CurrentForm->hasValue("alamat_perusahaan") ? $CurrentForm->getValue("alamat_perusahaan") : $CurrentForm->getValue("x_alamat_perusahaan");
		if (!$this->alamat_perusahaan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->alamat_perusahaan->Visible = FALSE; // Disable update for API request
			else
				$this->alamat_perusahaan->setFormValue($val);
		}

		// Check field name 'alamat_proyek' first before field var 'x_alamat_proyek'
		$val = $CurrentForm->hasValue("alamat_proyek") ? $CurrentForm->getValue("alamat_proyek") : $CurrentForm->getValue("x_alamat_proyek");
		if (!$this->alamat_proyek->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->alamat_proyek->Visible = FALSE; // Disable update for API request
			else
				$this->alamat_proyek->setFormValue($val);
		}

		// Check field name 'detail_izin' first before field var 'x_detail_izin'
		$val = $CurrentForm->hasValue("detail_izin") ? $CurrentForm->getValue("detail_izin") : $CurrentForm->getValue("x_detail_izin");
		if (!$this->detail_izin->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->detail_izin->Visible = FALSE; // Disable update for API request
			else
				$this->detail_izin->setFormValue($val);
		}

		// Check field name 'sysdate' first before field var 'x_sysdate'
		$val = $CurrentForm->hasValue("sysdate") ? $CurrentForm->getValue("sysdate") : $CurrentForm->getValue("x_sysdate");
		if (!$this->sysdate->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->sysdate->Visible = FALSE; // Disable update for API request
			else
				$this->sysdate->setFormValue($val);
			$this->sysdate->CurrentValue = UnFormatDateTime($this->sysdate->CurrentValue, 0);
		}

		// Check field name 'id_user' first before field var 'x_id_user'
		$val = $CurrentForm->hasValue("id_user") ? $CurrentForm->getValue("id_user") : $CurrentForm->getValue("x_id_user");
		if (!$this->id_user->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_user->Visible = FALSE; // Disable update for API request
			else
				$this->id_user->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id_izin_non_oss->CurrentValue = $this->id_izin_non_oss->FormValue;
		$this->no_izin->CurrentValue = $this->no_izin->FormValue;
		$this->id_jenis_izin->CurrentValue = $this->id_jenis_izin->FormValue;
		$this->jenis_pemohon->CurrentValue = $this->jenis_pemohon->FormValue;
		$this->nama_pemohon->CurrentValue = $this->nama_pemohon->FormValue;
		$this->id_jbu->CurrentValue = $this->id_jbu->FormValue;
		$this->id_sektor->CurrentValue = $this->id_sektor->FormValue;
		$this->id_subsektor->CurrentValue = $this->id_subsektor->FormValue;
		$this->tanggal_izin->CurrentValue = $this->tanggal_izin->FormValue;
		$this->tanggal_izin->CurrentValue = UnFormatDateTime($this->tanggal_izin->CurrentValue, 0);
		$this->alamat_pemohon->CurrentValue = $this->alamat_pemohon->FormValue;
		$this->alamat_perusahaan->CurrentValue = $this->alamat_perusahaan->FormValue;
		$this->alamat_proyek->CurrentValue = $this->alamat_proyek->FormValue;
		$this->detail_izin->CurrentValue = $this->detail_izin->FormValue;
		$this->sysdate->CurrentValue = $this->sysdate->FormValue;
		$this->sysdate->CurrentValue = UnFormatDateTime($this->sysdate->CurrentValue, 0);
		$this->id_user->CurrentValue = $this->id_user->FormValue;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->id_izin_non_oss->setDbValue($row['id_izin_non_oss']);
		$this->no_izin->setDbValue($row['no_izin']);
		$this->id_jenis_izin->setDbValue($row['id_jenis_izin']);
		$this->jenis_pemohon->setDbValue($row['jenis_pemohon']);
		$this->nama_pemohon->setDbValue($row['nama_pemohon']);
		$this->id_jbu->setDbValue($row['id_jbu']);
		$this->id_sektor->setDbValue($row['id_sektor']);
		$this->id_subsektor->setDbValue($row['id_subsektor']);
		$this->tanggal_izin->setDbValue($row['tanggal_izin']);
		$this->alamat_pemohon->setDbValue($row['alamat_pemohon']);
		$this->alamat_perusahaan->setDbValue($row['alamat_perusahaan']);
		$this->alamat_proyek->setDbValue($row['alamat_proyek']);
		$this->detail_izin->setDbValue($row['detail_izin']);
		$this->sysdate->setDbValue($row['sysdate']);
		$this->id_user->setDbValue($row['id_user']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id_izin_non_oss'] = NULL;
		$row['no_izin'] = NULL;
		$row['id_jenis_izin'] = NULL;
		$row['jenis_pemohon'] = NULL;
		$row['nama_pemohon'] = NULL;
		$row['id_jbu'] = NULL;
		$row['id_sektor'] = NULL;
		$row['id_subsektor'] = NULL;
		$row['tanggal_izin'] = NULL;
		$row['alamat_pemohon'] = NULL;
		$row['alamat_perusahaan'] = NULL;
		$row['alamat_proyek'] = NULL;
		$row['detail_izin'] = NULL;
		$row['sysdate'] = NULL;
		$row['id_user'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id_izin_non_oss")) != "")
			$this->id_izin_non_oss->OldValue = $this->getKey("id_izin_non_oss"); // id_izin_non_oss
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id_izin_non_oss
		// no_izin
		// id_jenis_izin
		// jenis_pemohon
		// nama_pemohon
		// id_jbu
		// id_sektor
		// id_subsektor
		// tanggal_izin
		// alamat_pemohon
		// alamat_perusahaan
		// alamat_proyek
		// detail_izin
		// sysdate
		// id_user

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_izin_non_oss
			$this->id_izin_non_oss->ViewValue = $this->id_izin_non_oss->CurrentValue;
			$this->id_izin_non_oss->ViewCustomAttributes = "";

			// no_izin
			$this->no_izin->ViewValue = $this->no_izin->CurrentValue;
			$this->no_izin->ViewCustomAttributes = "";

			// id_jenis_izin
			$this->id_jenis_izin->ViewValue = $this->id_jenis_izin->CurrentValue;
			$this->id_jenis_izin->ViewValue = FormatNumber($this->id_jenis_izin->ViewValue, 0, -2, -2, -2);
			$this->id_jenis_izin->ViewCustomAttributes = "";

			// jenis_pemohon
			$this->jenis_pemohon->ViewValue = $this->jenis_pemohon->CurrentValue;
			$this->jenis_pemohon->ViewCustomAttributes = "";

			// nama_pemohon
			$this->nama_pemohon->ViewValue = $this->nama_pemohon->CurrentValue;
			$this->nama_pemohon->ViewCustomAttributes = "";

			// id_jbu
			$this->id_jbu->ViewValue = $this->id_jbu->CurrentValue;
			$this->id_jbu->ViewValue = FormatNumber($this->id_jbu->ViewValue, 0, -2, -2, -2);
			$this->id_jbu->ViewCustomAttributes = "";

			// id_sektor
			$this->id_sektor->ViewValue = $this->id_sektor->CurrentValue;
			$this->id_sektor->ViewValue = FormatNumber($this->id_sektor->ViewValue, 0, -2, -2, -2);
			$this->id_sektor->ViewCustomAttributes = "";

			// id_subsektor
			$this->id_subsektor->ViewValue = $this->id_subsektor->CurrentValue;
			$this->id_subsektor->ViewValue = FormatNumber($this->id_subsektor->ViewValue, 0, -2, -2, -2);
			$this->id_subsektor->ViewCustomAttributes = "";

			// tanggal_izin
			$this->tanggal_izin->ViewValue = $this->tanggal_izin->CurrentValue;
			$this->tanggal_izin->ViewValue = FormatDateTime($this->tanggal_izin->ViewValue, 0);
			$this->tanggal_izin->ViewCustomAttributes = "";

			// alamat_pemohon
			$this->alamat_pemohon->ViewValue = $this->alamat_pemohon->CurrentValue;
			$this->alamat_pemohon->ViewCustomAttributes = "";

			// alamat_perusahaan
			$this->alamat_perusahaan->ViewValue = $this->alamat_perusahaan->CurrentValue;
			$this->alamat_perusahaan->ViewCustomAttributes = "";

			// alamat_proyek
			$this->alamat_proyek->ViewValue = $this->alamat_proyek->CurrentValue;
			$this->alamat_proyek->ViewCustomAttributes = "";

			// detail_izin
			$this->detail_izin->ViewValue = $this->detail_izin->CurrentValue;
			$this->detail_izin->ViewCustomAttributes = "";

			// sysdate
			$this->sysdate->ViewValue = $this->sysdate->CurrentValue;
			$this->sysdate->ViewValue = FormatDateTime($this->sysdate->ViewValue, 0);
			$this->sysdate->ViewCustomAttributes = "";

			// id_user
			$this->id_user->ViewValue = $this->id_user->CurrentValue;
			$this->id_user->ViewValue = FormatNumber($this->id_user->ViewValue, 0, -2, -2, -2);
			$this->id_user->ViewCustomAttributes = "";

			// id_izin_non_oss
			$this->id_izin_non_oss->LinkCustomAttributes = "";
			$this->id_izin_non_oss->HrefValue = "";
			$this->id_izin_non_oss->TooltipValue = "";

			// no_izin
			$this->no_izin->LinkCustomAttributes = "";
			$this->no_izin->HrefValue = "";
			$this->no_izin->TooltipValue = "";

			// id_jenis_izin
			$this->id_jenis_izin->LinkCustomAttributes = "";
			$this->id_jenis_izin->HrefValue = "";
			$this->id_jenis_izin->TooltipValue = "";

			// jenis_pemohon
			$this->jenis_pemohon->LinkCustomAttributes = "";
			$this->jenis_pemohon->HrefValue = "";
			$this->jenis_pemohon->TooltipValue = "";

			// nama_pemohon
			$this->nama_pemohon->LinkCustomAttributes = "";
			$this->nama_pemohon->HrefValue = "";
			$this->nama_pemohon->TooltipValue = "";

			// id_jbu
			$this->id_jbu->LinkCustomAttributes = "";
			$this->id_jbu->HrefValue = "";
			$this->id_jbu->TooltipValue = "";

			// id_sektor
			$this->id_sektor->LinkCustomAttributes = "";
			$this->id_sektor->HrefValue = "";
			$this->id_sektor->TooltipValue = "";

			// id_subsektor
			$this->id_subsektor->LinkCustomAttributes = "";
			$this->id_subsektor->HrefValue = "";
			$this->id_subsektor->TooltipValue = "";

			// tanggal_izin
			$this->tanggal_izin->LinkCustomAttributes = "";
			$this->tanggal_izin->HrefValue = "";
			$this->tanggal_izin->TooltipValue = "";

			// alamat_pemohon
			$this->alamat_pemohon->LinkCustomAttributes = "";
			$this->alamat_pemohon->HrefValue = "";
			$this->alamat_pemohon->TooltipValue = "";

			// alamat_perusahaan
			$this->alamat_perusahaan->LinkCustomAttributes = "";
			$this->alamat_perusahaan->HrefValue = "";
			$this->alamat_perusahaan->TooltipValue = "";

			// alamat_proyek
			$this->alamat_proyek->LinkCustomAttributes = "";
			$this->alamat_proyek->HrefValue = "";
			$this->alamat_proyek->TooltipValue = "";

			// detail_izin
			$this->detail_izin->LinkCustomAttributes = "";
			$this->detail_izin->HrefValue = "";
			$this->detail_izin->TooltipValue = "";

			// sysdate
			$this->sysdate->LinkCustomAttributes = "";
			$this->sysdate->HrefValue = "";
			$this->sysdate->TooltipValue = "";

			// id_user
			$this->id_user->LinkCustomAttributes = "";
			$this->id_user->HrefValue = "";
			$this->id_user->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// id_izin_non_oss
			$this->id_izin_non_oss->EditAttrs["class"] = "form-control";
			$this->id_izin_non_oss->EditCustomAttributes = "";
			$this->id_izin_non_oss->EditValue = $this->id_izin_non_oss->CurrentValue;
			$this->id_izin_non_oss->ViewCustomAttributes = "";

			// no_izin
			$this->no_izin->EditAttrs["class"] = "form-control";
			$this->no_izin->EditCustomAttributes = "";
			if (!$this->no_izin->Raw)
				$this->no_izin->CurrentValue = HtmlDecode($this->no_izin->CurrentValue);
			$this->no_izin->EditValue = HtmlEncode($this->no_izin->CurrentValue);
			$this->no_izin->PlaceHolder = RemoveHtml($this->no_izin->caption());

			// id_jenis_izin
			$this->id_jenis_izin->EditAttrs["class"] = "form-control";
			$this->id_jenis_izin->EditCustomAttributes = "";
			$this->id_jenis_izin->EditValue = HtmlEncode($this->id_jenis_izin->CurrentValue);
			$this->id_jenis_izin->PlaceHolder = RemoveHtml($this->id_jenis_izin->caption());

			// jenis_pemohon
			$this->jenis_pemohon->EditAttrs["class"] = "form-control";
			$this->jenis_pemohon->EditCustomAttributes = "";
			if (!$this->jenis_pemohon->Raw)
				$this->jenis_pemohon->CurrentValue = HtmlDecode($this->jenis_pemohon->CurrentValue);
			$this->jenis_pemohon->EditValue = HtmlEncode($this->jenis_pemohon->CurrentValue);
			$this->jenis_pemohon->PlaceHolder = RemoveHtml($this->jenis_pemohon->caption());

			// nama_pemohon
			$this->nama_pemohon->EditAttrs["class"] = "form-control";
			$this->nama_pemohon->EditCustomAttributes = "";
			if (!$this->nama_pemohon->Raw)
				$this->nama_pemohon->CurrentValue = HtmlDecode($this->nama_pemohon->CurrentValue);
			$this->nama_pemohon->EditValue = HtmlEncode($this->nama_pemohon->CurrentValue);
			$this->nama_pemohon->PlaceHolder = RemoveHtml($this->nama_pemohon->caption());

			// id_jbu
			$this->id_jbu->EditAttrs["class"] = "form-control";
			$this->id_jbu->EditCustomAttributes = "";
			$this->id_jbu->EditValue = HtmlEncode($this->id_jbu->CurrentValue);
			$this->id_jbu->PlaceHolder = RemoveHtml($this->id_jbu->caption());

			// id_sektor
			$this->id_sektor->EditAttrs["class"] = "form-control";
			$this->id_sektor->EditCustomAttributes = "";
			$this->id_sektor->EditValue = HtmlEncode($this->id_sektor->CurrentValue);
			$this->id_sektor->PlaceHolder = RemoveHtml($this->id_sektor->caption());

			// id_subsektor
			$this->id_subsektor->EditAttrs["class"] = "form-control";
			$this->id_subsektor->EditCustomAttributes = "";
			$this->id_subsektor->EditValue = HtmlEncode($this->id_subsektor->CurrentValue);
			$this->id_subsektor->PlaceHolder = RemoveHtml($this->id_subsektor->caption());

			// tanggal_izin
			$this->tanggal_izin->EditAttrs["class"] = "form-control";
			$this->tanggal_izin->EditCustomAttributes = "";
			$this->tanggal_izin->EditValue = HtmlEncode(FormatDateTime($this->tanggal_izin->CurrentValue, 8));
			$this->tanggal_izin->PlaceHolder = RemoveHtml($this->tanggal_izin->caption());

			// alamat_pemohon
			$this->alamat_pemohon->EditAttrs["class"] = "form-control";
			$this->alamat_pemohon->EditCustomAttributes = "";
			$this->alamat_pemohon->EditValue = HtmlEncode($this->alamat_pemohon->CurrentValue);
			$this->alamat_pemohon->PlaceHolder = RemoveHtml($this->alamat_pemohon->caption());

			// alamat_perusahaan
			$this->alamat_perusahaan->EditAttrs["class"] = "form-control";
			$this->alamat_perusahaan->EditCustomAttributes = "";
			$this->alamat_perusahaan->EditValue = HtmlEncode($this->alamat_perusahaan->CurrentValue);
			$this->alamat_perusahaan->PlaceHolder = RemoveHtml($this->alamat_perusahaan->caption());

			// alamat_proyek
			$this->alamat_proyek->EditAttrs["class"] = "form-control";
			$this->alamat_proyek->EditCustomAttributes = "";
			$this->alamat_proyek->EditValue = HtmlEncode($this->alamat_proyek->CurrentValue);
			$this->alamat_proyek->PlaceHolder = RemoveHtml($this->alamat_proyek->caption());

			// detail_izin
			$this->detail_izin->EditAttrs["class"] = "form-control";
			$this->detail_izin->EditCustomAttributes = "";
			$this->detail_izin->EditValue = HtmlEncode($this->detail_izin->CurrentValue);
			$this->detail_izin->PlaceHolder = RemoveHtml($this->detail_izin->caption());

			// sysdate
			$this->sysdate->EditAttrs["class"] = "form-control";
			$this->sysdate->EditCustomAttributes = "";
			$this->sysdate->EditValue = HtmlEncode(FormatDateTime($this->sysdate->CurrentValue, 8));
			$this->sysdate->PlaceHolder = RemoveHtml($this->sysdate->caption());

			// id_user
			$this->id_user->EditAttrs["class"] = "form-control";
			$this->id_user->EditCustomAttributes = "";
			$this->id_user->EditValue = HtmlEncode($this->id_user->CurrentValue);
			$this->id_user->PlaceHolder = RemoveHtml($this->id_user->caption());

			// Edit refer script
			// id_izin_non_oss

			$this->id_izin_non_oss->LinkCustomAttributes = "";
			$this->id_izin_non_oss->HrefValue = "";

			// no_izin
			$this->no_izin->LinkCustomAttributes = "";
			$this->no_izin->HrefValue = "";

			// id_jenis_izin
			$this->id_jenis_izin->LinkCustomAttributes = "";
			$this->id_jenis_izin->HrefValue = "";

			// jenis_pemohon
			$this->jenis_pemohon->LinkCustomAttributes = "";
			$this->jenis_pemohon->HrefValue = "";

			// nama_pemohon
			$this->nama_pemohon->LinkCustomAttributes = "";
			$this->nama_pemohon->HrefValue = "";

			// id_jbu
			$this->id_jbu->LinkCustomAttributes = "";
			$this->id_jbu->HrefValue = "";

			// id_sektor
			$this->id_sektor->LinkCustomAttributes = "";
			$this->id_sektor->HrefValue = "";

			// id_subsektor
			$this->id_subsektor->LinkCustomAttributes = "";
			$this->id_subsektor->HrefValue = "";

			// tanggal_izin
			$this->tanggal_izin->LinkCustomAttributes = "";
			$this->tanggal_izin->HrefValue = "";

			// alamat_pemohon
			$this->alamat_pemohon->LinkCustomAttributes = "";
			$this->alamat_pemohon->HrefValue = "";

			// alamat_perusahaan
			$this->alamat_perusahaan->LinkCustomAttributes = "";
			$this->alamat_perusahaan->HrefValue = "";

			// alamat_proyek
			$this->alamat_proyek->LinkCustomAttributes = "";
			$this->alamat_proyek->HrefValue = "";

			// detail_izin
			$this->detail_izin->LinkCustomAttributes = "";
			$this->detail_izin->HrefValue = "";

			// sysdate
			$this->sysdate->LinkCustomAttributes = "";
			$this->sysdate->HrefValue = "";

			// id_user
			$this->id_user->LinkCustomAttributes = "";
			$this->id_user->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->id_izin_non_oss->Required) {
			if (!$this->id_izin_non_oss->IsDetailKey && $this->id_izin_non_oss->FormValue != NULL && $this->id_izin_non_oss->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_izin_non_oss->caption(), $this->id_izin_non_oss->RequiredErrorMessage));
			}
		}
		if ($this->no_izin->Required) {
			if (!$this->no_izin->IsDetailKey && $this->no_izin->FormValue != NULL && $this->no_izin->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->no_izin->caption(), $this->no_izin->RequiredErrorMessage));
			}
		}
		if ($this->id_jenis_izin->Required) {
			if (!$this->id_jenis_izin->IsDetailKey && $this->id_jenis_izin->FormValue != NULL && $this->id_jenis_izin->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_jenis_izin->caption(), $this->id_jenis_izin->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id_jenis_izin->FormValue)) {
			AddMessage($FormError, $this->id_jenis_izin->errorMessage());
		}
		if ($this->jenis_pemohon->Required) {
			if (!$this->jenis_pemohon->IsDetailKey && $this->jenis_pemohon->FormValue != NULL && $this->jenis_pemohon->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jenis_pemohon->caption(), $this->jenis_pemohon->RequiredErrorMessage));
			}
		}
		if ($this->nama_pemohon->Required) {
			if (!$this->nama_pemohon->IsDetailKey && $this->nama_pemohon->FormValue != NULL && $this->nama_pemohon->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nama_pemohon->caption(), $this->nama_pemohon->RequiredErrorMessage));
			}
		}
		if ($this->id_jbu->Required) {
			if (!$this->id_jbu->IsDetailKey && $this->id_jbu->FormValue != NULL && $this->id_jbu->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_jbu->caption(), $this->id_jbu->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id_jbu->FormValue)) {
			AddMessage($FormError, $this->id_jbu->errorMessage());
		}
		if ($this->id_sektor->Required) {
			if (!$this->id_sektor->IsDetailKey && $this->id_sektor->FormValue != NULL && $this->id_sektor->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_sektor->caption(), $this->id_sektor->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id_sektor->FormValue)) {
			AddMessage($FormError, $this->id_sektor->errorMessage());
		}
		if ($this->id_subsektor->Required) {
			if (!$this->id_subsektor->IsDetailKey && $this->id_subsektor->FormValue != NULL && $this->id_subsektor->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_subsektor->caption(), $this->id_subsektor->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id_subsektor->FormValue)) {
			AddMessage($FormError, $this->id_subsektor->errorMessage());
		}
		if ($this->tanggal_izin->Required) {
			if (!$this->tanggal_izin->IsDetailKey && $this->tanggal_izin->FormValue != NULL && $this->tanggal_izin->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tanggal_izin->caption(), $this->tanggal_izin->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tanggal_izin->FormValue)) {
			AddMessage($FormError, $this->tanggal_izin->errorMessage());
		}
		if ($this->alamat_pemohon->Required) {
			if (!$this->alamat_pemohon->IsDetailKey && $this->alamat_pemohon->FormValue != NULL && $this->alamat_pemohon->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->alamat_pemohon->caption(), $this->alamat_pemohon->RequiredErrorMessage));
			}
		}
		if ($this->alamat_perusahaan->Required) {
			if (!$this->alamat_perusahaan->IsDetailKey && $this->alamat_perusahaan->FormValue != NULL && $this->alamat_perusahaan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->alamat_perusahaan->caption(), $this->alamat_perusahaan->RequiredErrorMessage));
			}
		}
		if ($this->alamat_proyek->Required) {
			if (!$this->alamat_proyek->IsDetailKey && $this->alamat_proyek->FormValue != NULL && $this->alamat_proyek->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->alamat_proyek->caption(), $this->alamat_proyek->RequiredErrorMessage));
			}
		}
		if ($this->detail_izin->Required) {
			if (!$this->detail_izin->IsDetailKey && $this->detail_izin->FormValue != NULL && $this->detail_izin->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->detail_izin->caption(), $this->detail_izin->RequiredErrorMessage));
			}
		}
		if ($this->sysdate->Required) {
			if (!$this->sysdate->IsDetailKey && $this->sysdate->FormValue != NULL && $this->sysdate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sysdate->caption(), $this->sysdate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->sysdate->FormValue)) {
			AddMessage($FormError, $this->sysdate->errorMessage());
		}
		if ($this->id_user->Required) {
			if (!$this->id_user->IsDetailKey && $this->id_user->FormValue != NULL && $this->id_user->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_user->caption(), $this->id_user->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id_user->FormValue)) {
			AddMessage($FormError, $this->id_user->errorMessage());
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$oldKeyFilter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($oldKeyFilter);
		$conn = $this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// no_izin
			$this->no_izin->setDbValueDef($rsnew, $this->no_izin->CurrentValue, "", $this->no_izin->ReadOnly);

			// id_jenis_izin
			$this->id_jenis_izin->setDbValueDef($rsnew, $this->id_jenis_izin->CurrentValue, 0, $this->id_jenis_izin->ReadOnly);

			// jenis_pemohon
			$this->jenis_pemohon->setDbValueDef($rsnew, $this->jenis_pemohon->CurrentValue, "", $this->jenis_pemohon->ReadOnly);

			// nama_pemohon
			$this->nama_pemohon->setDbValueDef($rsnew, $this->nama_pemohon->CurrentValue, "", $this->nama_pemohon->ReadOnly);

			// id_jbu
			$this->id_jbu->setDbValueDef($rsnew, $this->id_jbu->CurrentValue, NULL, $this->id_jbu->ReadOnly);

			// id_sektor
			$this->id_sektor->setDbValueDef($rsnew, $this->id_sektor->CurrentValue, 0, $this->id_sektor->ReadOnly);

			// id_subsektor
			$this->id_subsektor->setDbValueDef($rsnew, $this->id_subsektor->CurrentValue, 0, $this->id_subsektor->ReadOnly);

			// tanggal_izin
			$this->tanggal_izin->setDbValueDef($rsnew, UnFormatDateTime($this->tanggal_izin->CurrentValue, 0), CurrentDate(), $this->tanggal_izin->ReadOnly);

			// alamat_pemohon
			$this->alamat_pemohon->setDbValueDef($rsnew, $this->alamat_pemohon->CurrentValue, "", $this->alamat_pemohon->ReadOnly);

			// alamat_perusahaan
			$this->alamat_perusahaan->setDbValueDef($rsnew, $this->alamat_perusahaan->CurrentValue, "", $this->alamat_perusahaan->ReadOnly);

			// alamat_proyek
			$this->alamat_proyek->setDbValueDef($rsnew, $this->alamat_proyek->CurrentValue, "", $this->alamat_proyek->ReadOnly);

			// detail_izin
			$this->detail_izin->setDbValueDef($rsnew, $this->detail_izin->CurrentValue, "", $this->detail_izin->ReadOnly);

			// sysdate
			$this->sysdate->setDbValueDef($rsnew, UnFormatDateTime($this->sysdate->CurrentValue, 0), CurrentDate(), $this->sysdate->ReadOnly);

			// id_user
			$this->id_user->setDbValueDef($rsnew, $this->id_user->CurrentValue, 0, $this->id_user->ReadOnly);

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);

			// Check for duplicate key when key changed
			if ($updateRow) {
				$newKeyFilter = $this->getRecordFilter($rsnew);
				if ($newKeyFilter != $oldKeyFilter) {
					$rsChk = $this->loadRs($newKeyFilter);
					if ($rsChk && !$rsChk->EOF) {
						$keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
						$this->setFailureMessage($keyErrMsg);
						$rsChk->close();
						$updateRow = FALSE;
					}
				}
			}
			if ($updateRow) {
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = "";
				if ($editRow) {
				}
			} else {
				if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage != "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Clean upload path if any
		if ($editRow) {
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("izin_non_osslist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($pageNo !== NULL) { // Check for "pageno" parameter first
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			} elseif ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>