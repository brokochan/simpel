<?php
namespace PHPMaker2020\simpel;

/**
 * Page class
 */
class izin_oss_edit extends izin_oss
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{EC8FDD2A-6757-4E22-9B89-2E852912498C}";

	// Table name
	public $TableName = 'izin_oss';

	// Page object name
	public $PageObjName = "izin_oss_edit";

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

		// Table object (izin_oss)
		if (!isset($GLOBALS["izin_oss"]) || get_class($GLOBALS["izin_oss"]) == PROJECT_NAMESPACE . "izin_oss") {
			$GLOBALS["izin_oss"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["izin_oss"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'izin_oss');

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
		global $izin_oss;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($izin_oss);
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
					if ($pageName == "izin_ossview.php")
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
			$key .= @$ar['id_izin_oss'];
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
			$this->id_izin_oss->Visible = FALSE;
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
		$this->id_izin_oss->setVisibility();
		$this->NIB->setVisibility();
		$this->jenis_pelaku_usaha->setVisibility();
		$this->nama_pelaku_usaha->setVisibility();
		$this->id_jbu->setVisibility();
		$this->id_pm->setVisibility();
		$this->id_kecamatan->setVisibility();
		$this->kode_kbli->setVisibility();
		$this->id_skala_usaha->setVisibility();
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
		$this->setupLookupOptions($this->id_jbu);
		$this->setupLookupOptions($this->id_pm);
		$this->setupLookupOptions($this->id_kecamatan);
		$this->setupLookupOptions($this->kode_kbli);
		$this->setupLookupOptions($this->id_skala_usaha);

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
			if (Get("id_izin_oss") !== NULL) {
				$this->id_izin_oss->setQueryStringValue(Get("id_izin_oss"));
				$this->id_izin_oss->setOldValue($this->id_izin_oss->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->id_izin_oss->setQueryStringValue(Key(0));
				$this->id_izin_oss->setOldValue($this->id_izin_oss->QueryStringValue);
			} elseif (Post("id_izin_oss") !== NULL) {
				$this->id_izin_oss->setFormValue(Post("id_izin_oss"));
				$this->id_izin_oss->setOldValue($this->id_izin_oss->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->id_izin_oss->setQueryStringValue(Route(2));
				$this->id_izin_oss->setOldValue($this->id_izin_oss->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_id_izin_oss")) {
					$this->id_izin_oss->setFormValue($CurrentForm->getValue("x_id_izin_oss"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("id_izin_oss") !== NULL) {
					$this->id_izin_oss->setQueryStringValue(Get("id_izin_oss"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->id_izin_oss->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->id_izin_oss->CurrentValue = NULL;
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
					$this->terminate("izin_osslist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "izin_osslist.php")
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

		// Check field name 'id_izin_oss' first before field var 'x_id_izin_oss'
		$val = $CurrentForm->hasValue("id_izin_oss") ? $CurrentForm->getValue("id_izin_oss") : $CurrentForm->getValue("x_id_izin_oss");
		if (!$this->id_izin_oss->IsDetailKey)
			$this->id_izin_oss->setFormValue($val);

		// Check field name 'NIB' first before field var 'x_NIB'
		$val = $CurrentForm->hasValue("NIB") ? $CurrentForm->getValue("NIB") : $CurrentForm->getValue("x_NIB");
		if (!$this->NIB->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->NIB->Visible = FALSE; // Disable update for API request
			else
				$this->NIB->setFormValue($val);
		}

		// Check field name 'jenis_pelaku_usaha' first before field var 'x_jenis_pelaku_usaha'
		$val = $CurrentForm->hasValue("jenis_pelaku_usaha") ? $CurrentForm->getValue("jenis_pelaku_usaha") : $CurrentForm->getValue("x_jenis_pelaku_usaha");
		if (!$this->jenis_pelaku_usaha->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jenis_pelaku_usaha->Visible = FALSE; // Disable update for API request
			else
				$this->jenis_pelaku_usaha->setFormValue($val);
		}

		// Check field name 'nama_pelaku_usaha' first before field var 'x_nama_pelaku_usaha'
		$val = $CurrentForm->hasValue("nama_pelaku_usaha") ? $CurrentForm->getValue("nama_pelaku_usaha") : $CurrentForm->getValue("x_nama_pelaku_usaha");
		if (!$this->nama_pelaku_usaha->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nama_pelaku_usaha->Visible = FALSE; // Disable update for API request
			else
				$this->nama_pelaku_usaha->setFormValue($val);
		}

		// Check field name 'id_jbu' first before field var 'x_id_jbu'
		$val = $CurrentForm->hasValue("id_jbu") ? $CurrentForm->getValue("id_jbu") : $CurrentForm->getValue("x_id_jbu");
		if (!$this->id_jbu->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_jbu->Visible = FALSE; // Disable update for API request
			else
				$this->id_jbu->setFormValue($val);
		}

		// Check field name 'id_pm' first before field var 'x_id_pm'
		$val = $CurrentForm->hasValue("id_pm") ? $CurrentForm->getValue("id_pm") : $CurrentForm->getValue("x_id_pm");
		if (!$this->id_pm->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_pm->Visible = FALSE; // Disable update for API request
			else
				$this->id_pm->setFormValue($val);
		}

		// Check field name 'id_kecamatan' first before field var 'x_id_kecamatan'
		$val = $CurrentForm->hasValue("id_kecamatan") ? $CurrentForm->getValue("id_kecamatan") : $CurrentForm->getValue("x_id_kecamatan");
		if (!$this->id_kecamatan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_kecamatan->Visible = FALSE; // Disable update for API request
			else
				$this->id_kecamatan->setFormValue($val);
		}

		// Check field name 'kode_kbli' first before field var 'x_kode_kbli'
		$val = $CurrentForm->hasValue("kode_kbli") ? $CurrentForm->getValue("kode_kbli") : $CurrentForm->getValue("x_kode_kbli");
		if (!$this->kode_kbli->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->kode_kbli->Visible = FALSE; // Disable update for API request
			else
				$this->kode_kbli->setFormValue($val);
		}

		// Check field name 'id_skala_usaha' first before field var 'x_id_skala_usaha'
		$val = $CurrentForm->hasValue("id_skala_usaha") ? $CurrentForm->getValue("id_skala_usaha") : $CurrentForm->getValue("x_id_skala_usaha");
		if (!$this->id_skala_usaha->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_skala_usaha->Visible = FALSE; // Disable update for API request
			else
				$this->id_skala_usaha->setFormValue($val);
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
		$this->id_izin_oss->CurrentValue = $this->id_izin_oss->FormValue;
		$this->NIB->CurrentValue = $this->NIB->FormValue;
		$this->jenis_pelaku_usaha->CurrentValue = $this->jenis_pelaku_usaha->FormValue;
		$this->nama_pelaku_usaha->CurrentValue = $this->nama_pelaku_usaha->FormValue;
		$this->id_jbu->CurrentValue = $this->id_jbu->FormValue;
		$this->id_pm->CurrentValue = $this->id_pm->FormValue;
		$this->id_kecamatan->CurrentValue = $this->id_kecamatan->FormValue;
		$this->kode_kbli->CurrentValue = $this->kode_kbli->FormValue;
		$this->id_skala_usaha->CurrentValue = $this->id_skala_usaha->FormValue;
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
		$this->id_izin_oss->setDbValue($row['id_izin_oss']);
		$this->NIB->setDbValue($row['NIB']);
		$this->jenis_pelaku_usaha->setDbValue($row['jenis_pelaku_usaha']);
		$this->nama_pelaku_usaha->setDbValue($row['nama_pelaku_usaha']);
		$this->id_jbu->setDbValue($row['id_jbu']);
		$this->id_pm->setDbValue($row['id_pm']);
		$this->id_kecamatan->setDbValue($row['id_kecamatan']);
		$this->kode_kbli->setDbValue($row['kode_kbli']);
		$this->id_skala_usaha->setDbValue($row['id_skala_usaha']);
		$this->sysdate->setDbValue($row['sysdate']);
		$this->id_user->setDbValue($row['id_user']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id_izin_oss'] = NULL;
		$row['NIB'] = NULL;
		$row['jenis_pelaku_usaha'] = NULL;
		$row['nama_pelaku_usaha'] = NULL;
		$row['id_jbu'] = NULL;
		$row['id_pm'] = NULL;
		$row['id_kecamatan'] = NULL;
		$row['kode_kbli'] = NULL;
		$row['id_skala_usaha'] = NULL;
		$row['sysdate'] = NULL;
		$row['id_user'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id_izin_oss")) != "")
			$this->id_izin_oss->OldValue = $this->getKey("id_izin_oss"); // id_izin_oss
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
		// id_izin_oss
		// NIB
		// jenis_pelaku_usaha
		// nama_pelaku_usaha
		// id_jbu
		// id_pm
		// id_kecamatan
		// kode_kbli
		// id_skala_usaha
		// sysdate
		// id_user

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_izin_oss
			$this->id_izin_oss->ViewValue = $this->id_izin_oss->CurrentValue;
			$this->id_izin_oss->ViewCustomAttributes = "";

			// NIB
			$this->NIB->ViewValue = $this->NIB->CurrentValue;
			$this->NIB->ViewCustomAttributes = "";

			// jenis_pelaku_usaha
			if (strval($this->jenis_pelaku_usaha->CurrentValue) != "") {
				$this->jenis_pelaku_usaha->ViewValue = $this->jenis_pelaku_usaha->optionCaption($this->jenis_pelaku_usaha->CurrentValue);
			} else {
				$this->jenis_pelaku_usaha->ViewValue = NULL;
			}
			$this->jenis_pelaku_usaha->ViewCustomAttributes = "";

			// nama_pelaku_usaha
			$this->nama_pelaku_usaha->ViewValue = $this->nama_pelaku_usaha->CurrentValue;
			$this->nama_pelaku_usaha->ViewCustomAttributes = "";

			// id_jbu
			$curVal = strval($this->id_jbu->CurrentValue);
			if ($curVal != "") {
				$this->id_jbu->ViewValue = $this->id_jbu->lookupCacheOption($curVal);
				if ($this->id_jbu->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_jbu`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_jbu->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_jbu->ViewValue = $this->id_jbu->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_jbu->ViewValue = $this->id_jbu->CurrentValue;
					}
				}
			} else {
				$this->id_jbu->ViewValue = NULL;
			}
			$this->id_jbu->ViewCustomAttributes = "";

			// id_pm
			$curVal = strval($this->id_pm->CurrentValue);
			if ($curVal != "") {
				$this->id_pm->ViewValue = $this->id_pm->lookupCacheOption($curVal);
				if ($this->id_pm->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_pm`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_pm->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_pm->ViewValue = $this->id_pm->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_pm->ViewValue = $this->id_pm->CurrentValue;
					}
				}
			} else {
				$this->id_pm->ViewValue = NULL;
			}
			$this->id_pm->ViewCustomAttributes = "";

			// id_kecamatan
			$curVal = strval($this->id_kecamatan->CurrentValue);
			if ($curVal != "") {
				$this->id_kecamatan->ViewValue = $this->id_kecamatan->lookupCacheOption($curVal);
				if ($this->id_kecamatan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_kecamatan`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_kecamatan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_kecamatan->ViewValue = $this->id_kecamatan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_kecamatan->ViewValue = $this->id_kecamatan->CurrentValue;
					}
				}
			} else {
				$this->id_kecamatan->ViewValue = NULL;
			}
			$this->id_kecamatan->ViewCustomAttributes = "";

			// kode_kbli
			$curVal = strval($this->kode_kbli->CurrentValue);
			if ($curVal != "") {
				$this->kode_kbli->ViewValue = $this->kode_kbli->lookupCacheOption($curVal);
				if ($this->kode_kbli->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`kode_kbli`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kode_kbli->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$arwrk[3] = $rswrk->fields('df3');
						$this->kode_kbli->ViewValue = $this->kode_kbli->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kode_kbli->ViewValue = $this->kode_kbli->CurrentValue;
					}
				}
			} else {
				$this->kode_kbli->ViewValue = NULL;
			}
			$this->kode_kbli->ViewCustomAttributes = "";

			// id_skala_usaha
			$curVal = strval($this->id_skala_usaha->CurrentValue);
			if ($curVal != "") {
				$this->id_skala_usaha->ViewValue = $this->id_skala_usaha->lookupCacheOption($curVal);
				if ($this->id_skala_usaha->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_skala_usaha`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_skala_usaha->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_skala_usaha->ViewValue = $this->id_skala_usaha->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_skala_usaha->ViewValue = $this->id_skala_usaha->CurrentValue;
					}
				}
			} else {
				$this->id_skala_usaha->ViewValue = NULL;
			}
			$this->id_skala_usaha->ViewCustomAttributes = "";

			// sysdate
			$this->sysdate->ViewValue = $this->sysdate->CurrentValue;
			$this->sysdate->ViewValue = FormatDateTime($this->sysdate->ViewValue, 0);
			$this->sysdate->ViewCustomAttributes = "";

			// id_user
			$this->id_user->ViewValue = $this->id_user->CurrentValue;
			$this->id_user->ViewValue = FormatNumber($this->id_user->ViewValue, 0, -2, -2, -2);
			$this->id_user->ViewCustomAttributes = "";

			// id_izin_oss
			$this->id_izin_oss->LinkCustomAttributes = "";
			$this->id_izin_oss->HrefValue = "";
			$this->id_izin_oss->TooltipValue = "";

			// NIB
			$this->NIB->LinkCustomAttributes = "";
			$this->NIB->HrefValue = "";
			$this->NIB->TooltipValue = "";

			// jenis_pelaku_usaha
			$this->jenis_pelaku_usaha->LinkCustomAttributes = "";
			$this->jenis_pelaku_usaha->HrefValue = "";
			$this->jenis_pelaku_usaha->TooltipValue = "";

			// nama_pelaku_usaha
			$this->nama_pelaku_usaha->LinkCustomAttributes = "";
			$this->nama_pelaku_usaha->HrefValue = "";
			$this->nama_pelaku_usaha->TooltipValue = "";

			// id_jbu
			$this->id_jbu->LinkCustomAttributes = "";
			$this->id_jbu->HrefValue = "";
			$this->id_jbu->TooltipValue = "";

			// id_pm
			$this->id_pm->LinkCustomAttributes = "";
			$this->id_pm->HrefValue = "";
			$this->id_pm->TooltipValue = "";

			// id_kecamatan
			$this->id_kecamatan->LinkCustomAttributes = "";
			$this->id_kecamatan->HrefValue = "";
			$this->id_kecamatan->TooltipValue = "";

			// kode_kbli
			$this->kode_kbli->LinkCustomAttributes = "";
			$this->kode_kbli->HrefValue = "";
			$this->kode_kbli->TooltipValue = "";

			// id_skala_usaha
			$this->id_skala_usaha->LinkCustomAttributes = "";
			$this->id_skala_usaha->HrefValue = "";
			$this->id_skala_usaha->TooltipValue = "";

			// sysdate
			$this->sysdate->LinkCustomAttributes = "";
			$this->sysdate->HrefValue = "";
			$this->sysdate->TooltipValue = "";

			// id_user
			$this->id_user->LinkCustomAttributes = "";
			$this->id_user->HrefValue = "";
			$this->id_user->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// id_izin_oss
			$this->id_izin_oss->EditAttrs["class"] = "form-control";
			$this->id_izin_oss->EditCustomAttributes = "";
			$this->id_izin_oss->EditValue = $this->id_izin_oss->CurrentValue;
			$this->id_izin_oss->ViewCustomAttributes = "";

			// NIB
			$this->NIB->EditAttrs["class"] = "form-control";
			$this->NIB->EditCustomAttributes = "";
			if (!$this->NIB->Raw)
				$this->NIB->CurrentValue = HtmlDecode($this->NIB->CurrentValue);
			$this->NIB->EditValue = HtmlEncode($this->NIB->CurrentValue);
			$this->NIB->PlaceHolder = RemoveHtml($this->NIB->caption());

			// jenis_pelaku_usaha
			$this->jenis_pelaku_usaha->EditCustomAttributes = "";
			$this->jenis_pelaku_usaha->EditValue = $this->jenis_pelaku_usaha->options(FALSE);

			// nama_pelaku_usaha
			$this->nama_pelaku_usaha->EditAttrs["class"] = "form-control";
			$this->nama_pelaku_usaha->EditCustomAttributes = "";
			if (!$this->nama_pelaku_usaha->Raw)
				$this->nama_pelaku_usaha->CurrentValue = HtmlDecode($this->nama_pelaku_usaha->CurrentValue);
			$this->nama_pelaku_usaha->EditValue = HtmlEncode($this->nama_pelaku_usaha->CurrentValue);
			$this->nama_pelaku_usaha->PlaceHolder = RemoveHtml($this->nama_pelaku_usaha->caption());

			// id_jbu
			$this->id_jbu->EditAttrs["class"] = "form-control";
			$this->id_jbu->EditCustomAttributes = "";
			$curVal = trim(strval($this->id_jbu->CurrentValue));
			if ($curVal != "")
				$this->id_jbu->ViewValue = $this->id_jbu->lookupCacheOption($curVal);
			else
				$this->id_jbu->ViewValue = $this->id_jbu->Lookup !== NULL && is_array($this->id_jbu->Lookup->Options) ? $curVal : NULL;
			if ($this->id_jbu->ViewValue !== NULL) { // Load from cache
				$this->id_jbu->EditValue = array_values($this->id_jbu->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_jbu`" . SearchString("=", $this->id_jbu->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->id_jbu->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->id_jbu->EditValue = $arwrk;
			}

			// id_pm
			$this->id_pm->EditAttrs["class"] = "form-control";
			$this->id_pm->EditCustomAttributes = "";
			$curVal = trim(strval($this->id_pm->CurrentValue));
			if ($curVal != "")
				$this->id_pm->ViewValue = $this->id_pm->lookupCacheOption($curVal);
			else
				$this->id_pm->ViewValue = $this->id_pm->Lookup !== NULL && is_array($this->id_pm->Lookup->Options) ? $curVal : NULL;
			if ($this->id_pm->ViewValue !== NULL) { // Load from cache
				$this->id_pm->EditValue = array_values($this->id_pm->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_pm`" . SearchString("=", $this->id_pm->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->id_pm->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->id_pm->EditValue = $arwrk;
			}

			// id_kecamatan
			$this->id_kecamatan->EditAttrs["class"] = "form-control";
			$this->id_kecamatan->EditCustomAttributes = "";
			$curVal = trim(strval($this->id_kecamatan->CurrentValue));
			if ($curVal != "")
				$this->id_kecamatan->ViewValue = $this->id_kecamatan->lookupCacheOption($curVal);
			else
				$this->id_kecamatan->ViewValue = $this->id_kecamatan->Lookup !== NULL && is_array($this->id_kecamatan->Lookup->Options) ? $curVal : NULL;
			if ($this->id_kecamatan->ViewValue !== NULL) { // Load from cache
				$this->id_kecamatan->EditValue = array_values($this->id_kecamatan->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_kecamatan`" . SearchString("=", $this->id_kecamatan->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->id_kecamatan->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->id_kecamatan->EditValue = $arwrk;
			}

			// kode_kbli
			$this->kode_kbli->EditAttrs["class"] = "form-control";
			$this->kode_kbli->EditCustomAttributes = "";
			$curVal = trim(strval($this->kode_kbli->CurrentValue));
			if ($curVal != "")
				$this->kode_kbli->ViewValue = $this->kode_kbli->lookupCacheOption($curVal);
			else
				$this->kode_kbli->ViewValue = $this->kode_kbli->Lookup !== NULL && is_array($this->kode_kbli->Lookup->Options) ? $curVal : NULL;
			if ($this->kode_kbli->ViewValue !== NULL) { // Load from cache
				$this->kode_kbli->EditValue = array_values($this->kode_kbli->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`kode_kbli`" . SearchString("=", $this->kode_kbli->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kode_kbli->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kode_kbli->EditValue = $arwrk;
			}

			// id_skala_usaha
			$this->id_skala_usaha->EditAttrs["class"] = "form-control";
			$this->id_skala_usaha->EditCustomAttributes = "";
			$curVal = trim(strval($this->id_skala_usaha->CurrentValue));
			if ($curVal != "")
				$this->id_skala_usaha->ViewValue = $this->id_skala_usaha->lookupCacheOption($curVal);
			else
				$this->id_skala_usaha->ViewValue = $this->id_skala_usaha->Lookup !== NULL && is_array($this->id_skala_usaha->Lookup->Options) ? $curVal : NULL;
			if ($this->id_skala_usaha->ViewValue !== NULL) { // Load from cache
				$this->id_skala_usaha->EditValue = array_values($this->id_skala_usaha->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_skala_usaha`" . SearchString("=", $this->id_skala_usaha->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->id_skala_usaha->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->id_skala_usaha->EditValue = $arwrk;
			}

			// sysdate
			// id_user
			// Edit refer script
			// id_izin_oss

			$this->id_izin_oss->LinkCustomAttributes = "";
			$this->id_izin_oss->HrefValue = "";

			// NIB
			$this->NIB->LinkCustomAttributes = "";
			$this->NIB->HrefValue = "";

			// jenis_pelaku_usaha
			$this->jenis_pelaku_usaha->LinkCustomAttributes = "";
			$this->jenis_pelaku_usaha->HrefValue = "";

			// nama_pelaku_usaha
			$this->nama_pelaku_usaha->LinkCustomAttributes = "";
			$this->nama_pelaku_usaha->HrefValue = "";

			// id_jbu
			$this->id_jbu->LinkCustomAttributes = "";
			$this->id_jbu->HrefValue = "";

			// id_pm
			$this->id_pm->LinkCustomAttributes = "";
			$this->id_pm->HrefValue = "";

			// id_kecamatan
			$this->id_kecamatan->LinkCustomAttributes = "";
			$this->id_kecamatan->HrefValue = "";

			// kode_kbli
			$this->kode_kbli->LinkCustomAttributes = "";
			$this->kode_kbli->HrefValue = "";

			// id_skala_usaha
			$this->id_skala_usaha->LinkCustomAttributes = "";
			$this->id_skala_usaha->HrefValue = "";

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
		if ($this->id_izin_oss->Required) {
			if (!$this->id_izin_oss->IsDetailKey && $this->id_izin_oss->FormValue != NULL && $this->id_izin_oss->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_izin_oss->caption(), $this->id_izin_oss->RequiredErrorMessage));
			}
		}
		if ($this->NIB->Required) {
			if (!$this->NIB->IsDetailKey && $this->NIB->FormValue != NULL && $this->NIB->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NIB->caption(), $this->NIB->RequiredErrorMessage));
			}
		}
		if ($this->jenis_pelaku_usaha->Required) {
			if ($this->jenis_pelaku_usaha->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jenis_pelaku_usaha->caption(), $this->jenis_pelaku_usaha->RequiredErrorMessage));
			}
		}
		if ($this->nama_pelaku_usaha->Required) {
			if (!$this->nama_pelaku_usaha->IsDetailKey && $this->nama_pelaku_usaha->FormValue != NULL && $this->nama_pelaku_usaha->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nama_pelaku_usaha->caption(), $this->nama_pelaku_usaha->RequiredErrorMessage));
			}
		}
		if ($this->id_jbu->Required) {
			if (!$this->id_jbu->IsDetailKey && $this->id_jbu->FormValue != NULL && $this->id_jbu->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_jbu->caption(), $this->id_jbu->RequiredErrorMessage));
			}
		}
		if ($this->id_pm->Required) {
			if (!$this->id_pm->IsDetailKey && $this->id_pm->FormValue != NULL && $this->id_pm->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_pm->caption(), $this->id_pm->RequiredErrorMessage));
			}
		}
		if ($this->id_kecamatan->Required) {
			if (!$this->id_kecamatan->IsDetailKey && $this->id_kecamatan->FormValue != NULL && $this->id_kecamatan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_kecamatan->caption(), $this->id_kecamatan->RequiredErrorMessage));
			}
		}
		if ($this->kode_kbli->Required) {
			if (!$this->kode_kbli->IsDetailKey && $this->kode_kbli->FormValue != NULL && $this->kode_kbli->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kode_kbli->caption(), $this->kode_kbli->RequiredErrorMessage));
			}
		}
		if ($this->id_skala_usaha->Required) {
			if (!$this->id_skala_usaha->IsDetailKey && $this->id_skala_usaha->FormValue != NULL && $this->id_skala_usaha->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_skala_usaha->caption(), $this->id_skala_usaha->RequiredErrorMessage));
			}
		}
		if ($this->sysdate->Required) {
			if (!$this->sysdate->IsDetailKey && $this->sysdate->FormValue != NULL && $this->sysdate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sysdate->caption(), $this->sysdate->RequiredErrorMessage));
			}
		}
		if ($this->id_user->Required) {
			if (!$this->id_user->IsDetailKey && $this->id_user->FormValue != NULL && $this->id_user->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_user->caption(), $this->id_user->RequiredErrorMessage));
			}
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

			// NIB
			$this->NIB->setDbValueDef($rsnew, $this->NIB->CurrentValue, "", $this->NIB->ReadOnly);

			// jenis_pelaku_usaha
			$this->jenis_pelaku_usaha->setDbValueDef($rsnew, $this->jenis_pelaku_usaha->CurrentValue, "", $this->jenis_pelaku_usaha->ReadOnly);

			// nama_pelaku_usaha
			$this->nama_pelaku_usaha->setDbValueDef($rsnew, $this->nama_pelaku_usaha->CurrentValue, "", $this->nama_pelaku_usaha->ReadOnly);

			// id_jbu
			$this->id_jbu->setDbValueDef($rsnew, $this->id_jbu->CurrentValue, NULL, $this->id_jbu->ReadOnly);

			// id_pm
			$this->id_pm->setDbValueDef($rsnew, $this->id_pm->CurrentValue, 0, $this->id_pm->ReadOnly);

			// id_kecamatan
			$this->id_kecamatan->setDbValueDef($rsnew, $this->id_kecamatan->CurrentValue, 0, $this->id_kecamatan->ReadOnly);

			// kode_kbli
			$this->kode_kbli->setDbValueDef($rsnew, $this->kode_kbli->CurrentValue, 0, $this->kode_kbli->ReadOnly);

			// id_skala_usaha
			$this->id_skala_usaha->setDbValueDef($rsnew, $this->id_skala_usaha->CurrentValue, 0, $this->id_skala_usaha->ReadOnly);

			// sysdate
			$this->sysdate->CurrentValue = CurrentDate();
			$this->sysdate->setDbValueDef($rsnew, $this->sysdate->CurrentValue, CurrentDate());

			// id_user
			$this->id_user->CurrentValue = CurrentUserID();
			$this->id_user->setDbValueDef($rsnew, $this->id_user->CurrentValue, 0);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("izin_osslist.php"), "", $this->TableVar, TRUE);
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
				case "x_jenis_pelaku_usaha":
					break;
				case "x_id_jbu":
					break;
				case "x_id_pm":
					break;
				case "x_id_kecamatan":
					break;
				case "x_kode_kbli":
					break;
				case "x_id_skala_usaha":
					break;
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
						case "x_id_jbu":
							break;
						case "x_id_pm":
							break;
						case "x_id_kecamatan":
							break;
						case "x_kode_kbli":
							break;
						case "x_id_skala_usaha":
							break;
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