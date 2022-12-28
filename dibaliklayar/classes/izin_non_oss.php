<?php namespace PHPMaker2020\simpel; ?>
<?php

/**
 * Table class for izin_non_oss
 */
class izin_non_oss extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $id_izin_non_oss;
	public $no_izin;
	public $id_jenis_izin;
	public $jenis_pemohon;
	public $nama_pemohon;
	public $id_jbu;
	public $id_sektor;
	public $id_subsektor;
	public $tanggal_izin;
	public $alamat_pemohon;
	public $alamat_perusahaan;
	public $alamat_proyek;
	public $detail_izin;
	public $sysdate;
	public $id_user;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'izin_non_oss';
		$this->TableName = 'izin_non_oss';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`izin_non_oss`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// id_izin_non_oss
		$this->id_izin_non_oss = new DbField('izin_non_oss', 'izin_non_oss', 'x_id_izin_non_oss', 'id_izin_non_oss', '`id_izin_non_oss`', '`id_izin_non_oss`', 3, 11, -1, FALSE, '`id_izin_non_oss`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_izin_non_oss->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_izin_non_oss->IsPrimaryKey = TRUE; // Primary key field
		$this->id_izin_non_oss->Sortable = TRUE; // Allow sort
		$this->id_izin_non_oss->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_izin_non_oss'] = &$this->id_izin_non_oss;

		// no_izin
		$this->no_izin = new DbField('izin_non_oss', 'izin_non_oss', 'x_no_izin', 'no_izin', '`no_izin`', '`no_izin`', 200, 32, -1, FALSE, '`no_izin`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->no_izin->Nullable = FALSE; // NOT NULL field
		$this->no_izin->Required = TRUE; // Required field
		$this->no_izin->Sortable = TRUE; // Allow sort
		$this->fields['no_izin'] = &$this->no_izin;

		// id_jenis_izin
		$this->id_jenis_izin = new DbField('izin_non_oss', 'izin_non_oss', 'x_id_jenis_izin', 'id_jenis_izin', '`id_jenis_izin`', '`id_jenis_izin`', 3, 11, -1, FALSE, '`id_jenis_izin`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_jenis_izin->Nullable = FALSE; // NOT NULL field
		$this->id_jenis_izin->Required = TRUE; // Required field
		$this->id_jenis_izin->Sortable = TRUE; // Allow sort
		$this->id_jenis_izin->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_jenis_izin'] = &$this->id_jenis_izin;

		// jenis_pemohon
		$this->jenis_pemohon = new DbField('izin_non_oss', 'izin_non_oss', 'x_jenis_pemohon', 'jenis_pemohon', '`jenis_pemohon`', '`jenis_pemohon`', 200, 32, -1, FALSE, '`jenis_pemohon`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jenis_pemohon->Nullable = FALSE; // NOT NULL field
		$this->jenis_pemohon->Required = TRUE; // Required field
		$this->jenis_pemohon->Sortable = TRUE; // Allow sort
		$this->fields['jenis_pemohon'] = &$this->jenis_pemohon;

		// nama_pemohon
		$this->nama_pemohon = new DbField('izin_non_oss', 'izin_non_oss', 'x_nama_pemohon', 'nama_pemohon', '`nama_pemohon`', '`nama_pemohon`', 200, 32, -1, FALSE, '`nama_pemohon`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_pemohon->Nullable = FALSE; // NOT NULL field
		$this->nama_pemohon->Required = TRUE; // Required field
		$this->nama_pemohon->Sortable = TRUE; // Allow sort
		$this->fields['nama_pemohon'] = &$this->nama_pemohon;

		// id_jbu
		$this->id_jbu = new DbField('izin_non_oss', 'izin_non_oss', 'x_id_jbu', 'id_jbu', '`id_jbu`', '`id_jbu`', 3, 11, -1, FALSE, '`id_jbu`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_jbu->Sortable = TRUE; // Allow sort
		$this->id_jbu->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_jbu'] = &$this->id_jbu;

		// id_sektor
		$this->id_sektor = new DbField('izin_non_oss', 'izin_non_oss', 'x_id_sektor', 'id_sektor', '`id_sektor`', '`id_sektor`', 3, 11, -1, FALSE, '`id_sektor`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_sektor->Nullable = FALSE; // NOT NULL field
		$this->id_sektor->Required = TRUE; // Required field
		$this->id_sektor->Sortable = TRUE; // Allow sort
		$this->id_sektor->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_sektor'] = &$this->id_sektor;

		// id_subsektor
		$this->id_subsektor = new DbField('izin_non_oss', 'izin_non_oss', 'x_id_subsektor', 'id_subsektor', '`id_subsektor`', '`id_subsektor`', 3, 11, -1, FALSE, '`id_subsektor`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_subsektor->Nullable = FALSE; // NOT NULL field
		$this->id_subsektor->Required = TRUE; // Required field
		$this->id_subsektor->Sortable = TRUE; // Allow sort
		$this->id_subsektor->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_subsektor'] = &$this->id_subsektor;

		// tanggal_izin
		$this->tanggal_izin = new DbField('izin_non_oss', 'izin_non_oss', 'x_tanggal_izin', 'tanggal_izin', '`tanggal_izin`', CastDateFieldForLike("`tanggal_izin`", 0, "DB"), 133, 10, 0, FALSE, '`tanggal_izin`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tanggal_izin->Nullable = FALSE; // NOT NULL field
		$this->tanggal_izin->Required = TRUE; // Required field
		$this->tanggal_izin->Sortable = TRUE; // Allow sort
		$this->tanggal_izin->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tanggal_izin'] = &$this->tanggal_izin;

		// alamat_pemohon
		$this->alamat_pemohon = new DbField('izin_non_oss', 'izin_non_oss', 'x_alamat_pemohon', 'alamat_pemohon', '`alamat_pemohon`', '`alamat_pemohon`', 201, 65535, -1, FALSE, '`alamat_pemohon`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->alamat_pemohon->Nullable = FALSE; // NOT NULL field
		$this->alamat_pemohon->Required = TRUE; // Required field
		$this->alamat_pemohon->Sortable = TRUE; // Allow sort
		$this->fields['alamat_pemohon'] = &$this->alamat_pemohon;

		// alamat_perusahaan
		$this->alamat_perusahaan = new DbField('izin_non_oss', 'izin_non_oss', 'x_alamat_perusahaan', 'alamat_perusahaan', '`alamat_perusahaan`', '`alamat_perusahaan`', 201, 65535, -1, FALSE, '`alamat_perusahaan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->alamat_perusahaan->Nullable = FALSE; // NOT NULL field
		$this->alamat_perusahaan->Required = TRUE; // Required field
		$this->alamat_perusahaan->Sortable = TRUE; // Allow sort
		$this->fields['alamat_perusahaan'] = &$this->alamat_perusahaan;

		// alamat_proyek
		$this->alamat_proyek = new DbField('izin_non_oss', 'izin_non_oss', 'x_alamat_proyek', 'alamat_proyek', '`alamat_proyek`', '`alamat_proyek`', 201, 65535, -1, FALSE, '`alamat_proyek`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->alamat_proyek->Nullable = FALSE; // NOT NULL field
		$this->alamat_proyek->Required = TRUE; // Required field
		$this->alamat_proyek->Sortable = TRUE; // Allow sort
		$this->fields['alamat_proyek'] = &$this->alamat_proyek;

		// detail_izin
		$this->detail_izin = new DbField('izin_non_oss', 'izin_non_oss', 'x_detail_izin', 'detail_izin', '`detail_izin`', '`detail_izin`', 201, 65535, -1, FALSE, '`detail_izin`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->detail_izin->Nullable = FALSE; // NOT NULL field
		$this->detail_izin->Required = TRUE; // Required field
		$this->detail_izin->Sortable = TRUE; // Allow sort
		$this->fields['detail_izin'] = &$this->detail_izin;

		// sysdate
		$this->sysdate = new DbField('izin_non_oss', 'izin_non_oss', 'x_sysdate', 'sysdate', '`sysdate`', CastDateFieldForLike("`sysdate`", 0, "DB"), 133, 10, 0, FALSE, '`sysdate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sysdate->Nullable = FALSE; // NOT NULL field
		$this->sysdate->Required = TRUE; // Required field
		$this->sysdate->Sortable = TRUE; // Allow sort
		$this->sysdate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['sysdate'] = &$this->sysdate;

		// id_user
		$this->id_user = new DbField('izin_non_oss', 'izin_non_oss', 'x_id_user', 'id_user', '`id_user`', '`id_user`', 3, 11, -1, FALSE, '`id_user`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_user->Nullable = FALSE; // NOT NULL field
		$this->id_user->Required = TRUE; // Required field
		$this->id_user->Sortable = TRUE; // Allow sort
		$this->id_user->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_user'] = &$this->id_user;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`izin_non_oss`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving != "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter, $id = "")
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = $this->UserIDAllowSecurity;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			case "lookup":
				return (($allow & 256) == 256);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " (" . $names . ") VALUES (" . $values . ")";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->id_izin_non_oss->setDbValue($conn->insert_ID());
			$rs['id_izin_non_oss'] = $this->id_izin_non_oss->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('id_izin_non_oss', $rs))
				AddFilter($where, QuotedName('id_izin_non_oss', $this->Dbid) . '=' . QuotedValue($rs['id_izin_non_oss'], $this->id_izin_non_oss->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id_izin_non_oss->DbValue = $row['id_izin_non_oss'];
		$this->no_izin->DbValue = $row['no_izin'];
		$this->id_jenis_izin->DbValue = $row['id_jenis_izin'];
		$this->jenis_pemohon->DbValue = $row['jenis_pemohon'];
		$this->nama_pemohon->DbValue = $row['nama_pemohon'];
		$this->id_jbu->DbValue = $row['id_jbu'];
		$this->id_sektor->DbValue = $row['id_sektor'];
		$this->id_subsektor->DbValue = $row['id_subsektor'];
		$this->tanggal_izin->DbValue = $row['tanggal_izin'];
		$this->alamat_pemohon->DbValue = $row['alamat_pemohon'];
		$this->alamat_perusahaan->DbValue = $row['alamat_perusahaan'];
		$this->alamat_proyek->DbValue = $row['alamat_proyek'];
		$this->detail_izin->DbValue = $row['detail_izin'];
		$this->sysdate->DbValue = $row['sysdate'];
		$this->id_user->DbValue = $row['id_user'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id_izin_non_oss` = @id_izin_non_oss@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id_izin_non_oss', $row) ? $row['id_izin_non_oss'] : NULL;
		else
			$val = $this->id_izin_non_oss->OldValue !== NULL ? $this->id_izin_non_oss->OldValue : $this->id_izin_non_oss->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_izin_non_oss@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "izin_non_osslist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "izin_non_ossview.php")
			return $Language->phrase("View");
		elseif ($pageName == "izin_non_ossedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "izin_non_ossadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "izin_non_osslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("izin_non_ossview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("izin_non_ossview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "izin_non_ossadd.php?" . $this->getUrlParm($parm);
		else
			$url = "izin_non_ossadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("izin_non_ossedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("izin_non_ossadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("izin_non_ossdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id_izin_non_oss:" . JsonEncode($this->id_izin_non_oss->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		if ($this->id_izin_non_oss->CurrentValue != NULL) {
			$url .= "id_izin_non_oss=" . urlencode($this->id_izin_non_oss->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, [128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		$arKeys = [];
		$arKey = [];
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("id_izin_non_oss") !== NULL)
				$arKeys[] = Param("id_izin_non_oss");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			if ($setCurrent)
				$this->id_izin_non_oss->CurrentValue = $key;
			else
				$this->id_izin_non_oss->OldValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->id_izin_non_oss->setDbValue($rs->fields('id_izin_non_oss'));
		$this->no_izin->setDbValue($rs->fields('no_izin'));
		$this->id_jenis_izin->setDbValue($rs->fields('id_jenis_izin'));
		$this->jenis_pemohon->setDbValue($rs->fields('jenis_pemohon'));
		$this->nama_pemohon->setDbValue($rs->fields('nama_pemohon'));
		$this->id_jbu->setDbValue($rs->fields('id_jbu'));
		$this->id_sektor->setDbValue($rs->fields('id_sektor'));
		$this->id_subsektor->setDbValue($rs->fields('id_subsektor'));
		$this->tanggal_izin->setDbValue($rs->fields('tanggal_izin'));
		$this->alamat_pemohon->setDbValue($rs->fields('alamat_pemohon'));
		$this->alamat_perusahaan->setDbValue($rs->fields('alamat_perusahaan'));
		$this->alamat_proyek->setDbValue($rs->fields('alamat_proyek'));
		$this->detail_izin->setDbValue($rs->fields('detail_izin'));
		$this->sysdate->setDbValue($rs->fields('sysdate'));
		$this->id_user->setDbValue($rs->fields('id_user'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
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

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

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
		$this->no_izin->EditValue = $this->no_izin->CurrentValue;
		$this->no_izin->PlaceHolder = RemoveHtml($this->no_izin->caption());

		// id_jenis_izin
		$this->id_jenis_izin->EditAttrs["class"] = "form-control";
		$this->id_jenis_izin->EditCustomAttributes = "";
		$this->id_jenis_izin->EditValue = $this->id_jenis_izin->CurrentValue;
		$this->id_jenis_izin->PlaceHolder = RemoveHtml($this->id_jenis_izin->caption());

		// jenis_pemohon
		$this->jenis_pemohon->EditAttrs["class"] = "form-control";
		$this->jenis_pemohon->EditCustomAttributes = "";
		if (!$this->jenis_pemohon->Raw)
			$this->jenis_pemohon->CurrentValue = HtmlDecode($this->jenis_pemohon->CurrentValue);
		$this->jenis_pemohon->EditValue = $this->jenis_pemohon->CurrentValue;
		$this->jenis_pemohon->PlaceHolder = RemoveHtml($this->jenis_pemohon->caption());

		// nama_pemohon
		$this->nama_pemohon->EditAttrs["class"] = "form-control";
		$this->nama_pemohon->EditCustomAttributes = "";
		if (!$this->nama_pemohon->Raw)
			$this->nama_pemohon->CurrentValue = HtmlDecode($this->nama_pemohon->CurrentValue);
		$this->nama_pemohon->EditValue = $this->nama_pemohon->CurrentValue;
		$this->nama_pemohon->PlaceHolder = RemoveHtml($this->nama_pemohon->caption());

		// id_jbu
		$this->id_jbu->EditAttrs["class"] = "form-control";
		$this->id_jbu->EditCustomAttributes = "";
		$this->id_jbu->EditValue = $this->id_jbu->CurrentValue;
		$this->id_jbu->PlaceHolder = RemoveHtml($this->id_jbu->caption());

		// id_sektor
		$this->id_sektor->EditAttrs["class"] = "form-control";
		$this->id_sektor->EditCustomAttributes = "";
		$this->id_sektor->EditValue = $this->id_sektor->CurrentValue;
		$this->id_sektor->PlaceHolder = RemoveHtml($this->id_sektor->caption());

		// id_subsektor
		$this->id_subsektor->EditAttrs["class"] = "form-control";
		$this->id_subsektor->EditCustomAttributes = "";
		$this->id_subsektor->EditValue = $this->id_subsektor->CurrentValue;
		$this->id_subsektor->PlaceHolder = RemoveHtml($this->id_subsektor->caption());

		// tanggal_izin
		$this->tanggal_izin->EditAttrs["class"] = "form-control";
		$this->tanggal_izin->EditCustomAttributes = "";
		$this->tanggal_izin->EditValue = FormatDateTime($this->tanggal_izin->CurrentValue, 8);
		$this->tanggal_izin->PlaceHolder = RemoveHtml($this->tanggal_izin->caption());

		// alamat_pemohon
		$this->alamat_pemohon->EditAttrs["class"] = "form-control";
		$this->alamat_pemohon->EditCustomAttributes = "";
		$this->alamat_pemohon->EditValue = $this->alamat_pemohon->CurrentValue;
		$this->alamat_pemohon->PlaceHolder = RemoveHtml($this->alamat_pemohon->caption());

		// alamat_perusahaan
		$this->alamat_perusahaan->EditAttrs["class"] = "form-control";
		$this->alamat_perusahaan->EditCustomAttributes = "";
		$this->alamat_perusahaan->EditValue = $this->alamat_perusahaan->CurrentValue;
		$this->alamat_perusahaan->PlaceHolder = RemoveHtml($this->alamat_perusahaan->caption());

		// alamat_proyek
		$this->alamat_proyek->EditAttrs["class"] = "form-control";
		$this->alamat_proyek->EditCustomAttributes = "";
		$this->alamat_proyek->EditValue = $this->alamat_proyek->CurrentValue;
		$this->alamat_proyek->PlaceHolder = RemoveHtml($this->alamat_proyek->caption());

		// detail_izin
		$this->detail_izin->EditAttrs["class"] = "form-control";
		$this->detail_izin->EditCustomAttributes = "";
		$this->detail_izin->EditValue = $this->detail_izin->CurrentValue;
		$this->detail_izin->PlaceHolder = RemoveHtml($this->detail_izin->caption());

		// sysdate
		$this->sysdate->EditAttrs["class"] = "form-control";
		$this->sysdate->EditCustomAttributes = "";
		$this->sysdate->EditValue = FormatDateTime($this->sysdate->CurrentValue, 8);
		$this->sysdate->PlaceHolder = RemoveHtml($this->sysdate->caption());

		// id_user
		$this->id_user->EditAttrs["class"] = "form-control";
		$this->id_user->EditCustomAttributes = "";
		$this->id_user->EditValue = $this->id_user->CurrentValue;
		$this->id_user->PlaceHolder = RemoveHtml($this->id_user->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->id_izin_non_oss);
					$doc->exportCaption($this->no_izin);
					$doc->exportCaption($this->id_jenis_izin);
					$doc->exportCaption($this->jenis_pemohon);
					$doc->exportCaption($this->nama_pemohon);
					$doc->exportCaption($this->id_jbu);
					$doc->exportCaption($this->id_sektor);
					$doc->exportCaption($this->id_subsektor);
					$doc->exportCaption($this->tanggal_izin);
					$doc->exportCaption($this->alamat_pemohon);
					$doc->exportCaption($this->alamat_perusahaan);
					$doc->exportCaption($this->alamat_proyek);
					$doc->exportCaption($this->detail_izin);
					$doc->exportCaption($this->sysdate);
					$doc->exportCaption($this->id_user);
				} else {
					$doc->exportCaption($this->id_izin_non_oss);
					$doc->exportCaption($this->no_izin);
					$doc->exportCaption($this->id_jenis_izin);
					$doc->exportCaption($this->jenis_pemohon);
					$doc->exportCaption($this->nama_pemohon);
					$doc->exportCaption($this->id_jbu);
					$doc->exportCaption($this->id_sektor);
					$doc->exportCaption($this->id_subsektor);
					$doc->exportCaption($this->tanggal_izin);
					$doc->exportCaption($this->sysdate);
					$doc->exportCaption($this->id_user);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->id_izin_non_oss);
						$doc->exportField($this->no_izin);
						$doc->exportField($this->id_jenis_izin);
						$doc->exportField($this->jenis_pemohon);
						$doc->exportField($this->nama_pemohon);
						$doc->exportField($this->id_jbu);
						$doc->exportField($this->id_sektor);
						$doc->exportField($this->id_subsektor);
						$doc->exportField($this->tanggal_izin);
						$doc->exportField($this->alamat_pemohon);
						$doc->exportField($this->alamat_perusahaan);
						$doc->exportField($this->alamat_proyek);
						$doc->exportField($this->detail_izin);
						$doc->exportField($this->sysdate);
						$doc->exportField($this->id_user);
					} else {
						$doc->exportField($this->id_izin_non_oss);
						$doc->exportField($this->no_izin);
						$doc->exportField($this->id_jenis_izin);
						$doc->exportField($this->jenis_pemohon);
						$doc->exportField($this->nama_pemohon);
						$doc->exportField($this->id_jbu);
						$doc->exportField($this->id_sektor);
						$doc->exportField($this->id_subsektor);
						$doc->exportField($this->tanggal_izin);
						$doc->exportField($this->sysdate);
						$doc->exportField($this->id_user);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>