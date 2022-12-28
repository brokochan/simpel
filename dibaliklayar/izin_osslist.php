<?php
namespace PHPMaker2020\simpel;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$izin_oss_list = new izin_oss_list();

// Run the page
$izin_oss_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$izin_oss_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$izin_oss_list->isExport()) { ?>
<script>
var fizin_osslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fizin_osslist = currentForm = new ew.Form("fizin_osslist", "list");
	fizin_osslist.formKeyCountName = '<?php echo $izin_oss_list->FormKeyCountName ?>';
	loadjs.done("fizin_osslist");
});
var fizin_osslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fizin_osslistsrch = currentSearchForm = new ew.Form("fizin_osslistsrch");

	// Dynamic selection lists
	// Filters

	fizin_osslistsrch.filterList = <?php echo $izin_oss_list->getFilterList() ?>;
	loadjs.done("fizin_osslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$izin_oss_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($izin_oss_list->TotalRecords > 0 && $izin_oss_list->ExportOptions->visible()) { ?>
<?php $izin_oss_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($izin_oss_list->ImportOptions->visible()) { ?>
<?php $izin_oss_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($izin_oss_list->SearchOptions->visible()) { ?>
<?php $izin_oss_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($izin_oss_list->FilterOptions->visible()) { ?>
<?php $izin_oss_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$izin_oss_list->renderOtherOptions();
?>
<?php if (!$izin_oss_list->isExport() && !$izin_oss->CurrentAction) { ?>
<form name="fizin_osslistsrch" id="fizin_osslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fizin_osslistsrch-search-panel" class="<?php echo $izin_oss_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="izin_oss">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $izin_oss_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($izin_oss_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($izin_oss_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $izin_oss_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($izin_oss_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($izin_oss_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($izin_oss_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($izin_oss_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $izin_oss_list->showPageHeader(); ?>
<?php
$izin_oss_list->showMessage();
?>
<?php if ($izin_oss_list->TotalRecords > 0 || $izin_oss->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($izin_oss_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> izin_oss">
<form name="fizin_osslist" id="fizin_osslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="izin_oss">
<div id="gmp_izin_oss" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($izin_oss_list->TotalRecords > 0 || $izin_oss_list->isGridEdit()) { ?>
<table id="tbl_izin_osslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$izin_oss->RowType = ROWTYPE_HEADER;

// Render list options
$izin_oss_list->renderListOptions();

// Render list options (header, left)
$izin_oss_list->ListOptions->render("header", "left");
?>
<?php if ($izin_oss_list->id_izin_oss->Visible) { // id_izin_oss ?>
	<?php if ($izin_oss_list->SortUrl($izin_oss_list->id_izin_oss) == "") { ?>
		<th data-name="id_izin_oss" class="<?php echo $izin_oss_list->id_izin_oss->headerCellClass() ?>"><div id="elh_izin_oss_id_izin_oss" class="izin_oss_id_izin_oss"><div class="ew-table-header-caption"><?php echo $izin_oss_list->id_izin_oss->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_izin_oss" class="<?php echo $izin_oss_list->id_izin_oss->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $izin_oss_list->SortUrl($izin_oss_list->id_izin_oss) ?>', 1);"><div id="elh_izin_oss_id_izin_oss" class="izin_oss_id_izin_oss">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $izin_oss_list->id_izin_oss->caption() ?></span><span class="ew-table-header-sort"><?php if ($izin_oss_list->id_izin_oss->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($izin_oss_list->id_izin_oss->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($izin_oss_list->NIB->Visible) { // NIB ?>
	<?php if ($izin_oss_list->SortUrl($izin_oss_list->NIB) == "") { ?>
		<th data-name="NIB" class="<?php echo $izin_oss_list->NIB->headerCellClass() ?>"><div id="elh_izin_oss_NIB" class="izin_oss_NIB"><div class="ew-table-header-caption"><?php echo $izin_oss_list->NIB->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NIB" class="<?php echo $izin_oss_list->NIB->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $izin_oss_list->SortUrl($izin_oss_list->NIB) ?>', 1);"><div id="elh_izin_oss_NIB" class="izin_oss_NIB">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $izin_oss_list->NIB->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($izin_oss_list->NIB->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($izin_oss_list->NIB->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($izin_oss_list->jenis_pelaku_usaha->Visible) { // jenis_pelaku_usaha ?>
	<?php if ($izin_oss_list->SortUrl($izin_oss_list->jenis_pelaku_usaha) == "") { ?>
		<th data-name="jenis_pelaku_usaha" class="<?php echo $izin_oss_list->jenis_pelaku_usaha->headerCellClass() ?>"><div id="elh_izin_oss_jenis_pelaku_usaha" class="izin_oss_jenis_pelaku_usaha"><div class="ew-table-header-caption"><?php echo $izin_oss_list->jenis_pelaku_usaha->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis_pelaku_usaha" class="<?php echo $izin_oss_list->jenis_pelaku_usaha->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $izin_oss_list->SortUrl($izin_oss_list->jenis_pelaku_usaha) ?>', 1);"><div id="elh_izin_oss_jenis_pelaku_usaha" class="izin_oss_jenis_pelaku_usaha">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $izin_oss_list->jenis_pelaku_usaha->caption() ?></span><span class="ew-table-header-sort"><?php if ($izin_oss_list->jenis_pelaku_usaha->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($izin_oss_list->jenis_pelaku_usaha->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($izin_oss_list->nama_pelaku_usaha->Visible) { // nama_pelaku_usaha ?>
	<?php if ($izin_oss_list->SortUrl($izin_oss_list->nama_pelaku_usaha) == "") { ?>
		<th data-name="nama_pelaku_usaha" class="<?php echo $izin_oss_list->nama_pelaku_usaha->headerCellClass() ?>"><div id="elh_izin_oss_nama_pelaku_usaha" class="izin_oss_nama_pelaku_usaha"><div class="ew-table-header-caption"><?php echo $izin_oss_list->nama_pelaku_usaha->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_pelaku_usaha" class="<?php echo $izin_oss_list->nama_pelaku_usaha->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $izin_oss_list->SortUrl($izin_oss_list->nama_pelaku_usaha) ?>', 1);"><div id="elh_izin_oss_nama_pelaku_usaha" class="izin_oss_nama_pelaku_usaha">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $izin_oss_list->nama_pelaku_usaha->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($izin_oss_list->nama_pelaku_usaha->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($izin_oss_list->nama_pelaku_usaha->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($izin_oss_list->id_jbu->Visible) { // id_jbu ?>
	<?php if ($izin_oss_list->SortUrl($izin_oss_list->id_jbu) == "") { ?>
		<th data-name="id_jbu" class="<?php echo $izin_oss_list->id_jbu->headerCellClass() ?>"><div id="elh_izin_oss_id_jbu" class="izin_oss_id_jbu"><div class="ew-table-header-caption"><?php echo $izin_oss_list->id_jbu->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_jbu" class="<?php echo $izin_oss_list->id_jbu->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $izin_oss_list->SortUrl($izin_oss_list->id_jbu) ?>', 1);"><div id="elh_izin_oss_id_jbu" class="izin_oss_id_jbu">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $izin_oss_list->id_jbu->caption() ?></span><span class="ew-table-header-sort"><?php if ($izin_oss_list->id_jbu->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($izin_oss_list->id_jbu->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($izin_oss_list->id_pm->Visible) { // id_pm ?>
	<?php if ($izin_oss_list->SortUrl($izin_oss_list->id_pm) == "") { ?>
		<th data-name="id_pm" class="<?php echo $izin_oss_list->id_pm->headerCellClass() ?>"><div id="elh_izin_oss_id_pm" class="izin_oss_id_pm"><div class="ew-table-header-caption"><?php echo $izin_oss_list->id_pm->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_pm" class="<?php echo $izin_oss_list->id_pm->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $izin_oss_list->SortUrl($izin_oss_list->id_pm) ?>', 1);"><div id="elh_izin_oss_id_pm" class="izin_oss_id_pm">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $izin_oss_list->id_pm->caption() ?></span><span class="ew-table-header-sort"><?php if ($izin_oss_list->id_pm->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($izin_oss_list->id_pm->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($izin_oss_list->id_kecamatan->Visible) { // id_kecamatan ?>
	<?php if ($izin_oss_list->SortUrl($izin_oss_list->id_kecamatan) == "") { ?>
		<th data-name="id_kecamatan" class="<?php echo $izin_oss_list->id_kecamatan->headerCellClass() ?>"><div id="elh_izin_oss_id_kecamatan" class="izin_oss_id_kecamatan"><div class="ew-table-header-caption"><?php echo $izin_oss_list->id_kecamatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_kecamatan" class="<?php echo $izin_oss_list->id_kecamatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $izin_oss_list->SortUrl($izin_oss_list->id_kecamatan) ?>', 1);"><div id="elh_izin_oss_id_kecamatan" class="izin_oss_id_kecamatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $izin_oss_list->id_kecamatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($izin_oss_list->id_kecamatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($izin_oss_list->id_kecamatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($izin_oss_list->kode_kbli->Visible) { // kode_kbli ?>
	<?php if ($izin_oss_list->SortUrl($izin_oss_list->kode_kbli) == "") { ?>
		<th data-name="kode_kbli" class="<?php echo $izin_oss_list->kode_kbli->headerCellClass() ?>"><div id="elh_izin_oss_kode_kbli" class="izin_oss_kode_kbli"><div class="ew-table-header-caption"><?php echo $izin_oss_list->kode_kbli->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_kbli" class="<?php echo $izin_oss_list->kode_kbli->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $izin_oss_list->SortUrl($izin_oss_list->kode_kbli) ?>', 1);"><div id="elh_izin_oss_kode_kbli" class="izin_oss_kode_kbli">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $izin_oss_list->kode_kbli->caption() ?></span><span class="ew-table-header-sort"><?php if ($izin_oss_list->kode_kbli->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($izin_oss_list->kode_kbli->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($izin_oss_list->id_skala_usaha->Visible) { // id_skala_usaha ?>
	<?php if ($izin_oss_list->SortUrl($izin_oss_list->id_skala_usaha) == "") { ?>
		<th data-name="id_skala_usaha" class="<?php echo $izin_oss_list->id_skala_usaha->headerCellClass() ?>"><div id="elh_izin_oss_id_skala_usaha" class="izin_oss_id_skala_usaha"><div class="ew-table-header-caption"><?php echo $izin_oss_list->id_skala_usaha->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_skala_usaha" class="<?php echo $izin_oss_list->id_skala_usaha->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $izin_oss_list->SortUrl($izin_oss_list->id_skala_usaha) ?>', 1);"><div id="elh_izin_oss_id_skala_usaha" class="izin_oss_id_skala_usaha">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $izin_oss_list->id_skala_usaha->caption() ?></span><span class="ew-table-header-sort"><?php if ($izin_oss_list->id_skala_usaha->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($izin_oss_list->id_skala_usaha->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($izin_oss_list->sysdate->Visible) { // sysdate ?>
	<?php if ($izin_oss_list->SortUrl($izin_oss_list->sysdate) == "") { ?>
		<th data-name="sysdate" class="<?php echo $izin_oss_list->sysdate->headerCellClass() ?>"><div id="elh_izin_oss_sysdate" class="izin_oss_sysdate"><div class="ew-table-header-caption"><?php echo $izin_oss_list->sysdate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sysdate" class="<?php echo $izin_oss_list->sysdate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $izin_oss_list->SortUrl($izin_oss_list->sysdate) ?>', 1);"><div id="elh_izin_oss_sysdate" class="izin_oss_sysdate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $izin_oss_list->sysdate->caption() ?></span><span class="ew-table-header-sort"><?php if ($izin_oss_list->sysdate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($izin_oss_list->sysdate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($izin_oss_list->id_user->Visible) { // id_user ?>
	<?php if ($izin_oss_list->SortUrl($izin_oss_list->id_user) == "") { ?>
		<th data-name="id_user" class="<?php echo $izin_oss_list->id_user->headerCellClass() ?>"><div id="elh_izin_oss_id_user" class="izin_oss_id_user"><div class="ew-table-header-caption"><?php echo $izin_oss_list->id_user->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_user" class="<?php echo $izin_oss_list->id_user->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $izin_oss_list->SortUrl($izin_oss_list->id_user) ?>', 1);"><div id="elh_izin_oss_id_user" class="izin_oss_id_user">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $izin_oss_list->id_user->caption() ?></span><span class="ew-table-header-sort"><?php if ($izin_oss_list->id_user->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($izin_oss_list->id_user->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$izin_oss_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($izin_oss_list->ExportAll && $izin_oss_list->isExport()) {
	$izin_oss_list->StopRecord = $izin_oss_list->TotalRecords;
} else {

	// Set the last record to display
	if ($izin_oss_list->TotalRecords > $izin_oss_list->StartRecord + $izin_oss_list->DisplayRecords - 1)
		$izin_oss_list->StopRecord = $izin_oss_list->StartRecord + $izin_oss_list->DisplayRecords - 1;
	else
		$izin_oss_list->StopRecord = $izin_oss_list->TotalRecords;
}
$izin_oss_list->RecordCount = $izin_oss_list->StartRecord - 1;
if ($izin_oss_list->Recordset && !$izin_oss_list->Recordset->EOF) {
	$izin_oss_list->Recordset->moveFirst();
	$selectLimit = $izin_oss_list->UseSelectLimit;
	if (!$selectLimit && $izin_oss_list->StartRecord > 1)
		$izin_oss_list->Recordset->move($izin_oss_list->StartRecord - 1);
} elseif (!$izin_oss->AllowAddDeleteRow && $izin_oss_list->StopRecord == 0) {
	$izin_oss_list->StopRecord = $izin_oss->GridAddRowCount;
}

// Initialize aggregate
$izin_oss->RowType = ROWTYPE_AGGREGATEINIT;
$izin_oss->resetAttributes();
$izin_oss_list->renderRow();
while ($izin_oss_list->RecordCount < $izin_oss_list->StopRecord) {
	$izin_oss_list->RecordCount++;
	if ($izin_oss_list->RecordCount >= $izin_oss_list->StartRecord) {
		$izin_oss_list->RowCount++;

		// Set up key count
		$izin_oss_list->KeyCount = $izin_oss_list->RowIndex;

		// Init row class and style
		$izin_oss->resetAttributes();
		$izin_oss->CssClass = "";
		if ($izin_oss_list->isGridAdd()) {
		} else {
			$izin_oss_list->loadRowValues($izin_oss_list->Recordset); // Load row values
		}
		$izin_oss->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$izin_oss->RowAttrs->merge(["data-rowindex" => $izin_oss_list->RowCount, "id" => "r" . $izin_oss_list->RowCount . "_izin_oss", "data-rowtype" => $izin_oss->RowType]);

		// Render row
		$izin_oss_list->renderRow();

		// Render list options
		$izin_oss_list->renderListOptions();
?>
	<tr <?php echo $izin_oss->rowAttributes() ?>>
<?php

// Render list options (body, left)
$izin_oss_list->ListOptions->render("body", "left", $izin_oss_list->RowCount);
?>
	<?php if ($izin_oss_list->id_izin_oss->Visible) { // id_izin_oss ?>
		<td data-name="id_izin_oss" <?php echo $izin_oss_list->id_izin_oss->cellAttributes() ?>>
<span id="el<?php echo $izin_oss_list->RowCount ?>_izin_oss_id_izin_oss">
<span<?php echo $izin_oss_list->id_izin_oss->viewAttributes() ?>><?php echo $izin_oss_list->id_izin_oss->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($izin_oss_list->NIB->Visible) { // NIB ?>
		<td data-name="NIB" <?php echo $izin_oss_list->NIB->cellAttributes() ?>>
<span id="el<?php echo $izin_oss_list->RowCount ?>_izin_oss_NIB">
<span<?php echo $izin_oss_list->NIB->viewAttributes() ?>><?php echo $izin_oss_list->NIB->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($izin_oss_list->jenis_pelaku_usaha->Visible) { // jenis_pelaku_usaha ?>
		<td data-name="jenis_pelaku_usaha" <?php echo $izin_oss_list->jenis_pelaku_usaha->cellAttributes() ?>>
<span id="el<?php echo $izin_oss_list->RowCount ?>_izin_oss_jenis_pelaku_usaha">
<span<?php echo $izin_oss_list->jenis_pelaku_usaha->viewAttributes() ?>><?php echo $izin_oss_list->jenis_pelaku_usaha->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($izin_oss_list->nama_pelaku_usaha->Visible) { // nama_pelaku_usaha ?>
		<td data-name="nama_pelaku_usaha" <?php echo $izin_oss_list->nama_pelaku_usaha->cellAttributes() ?>>
<span id="el<?php echo $izin_oss_list->RowCount ?>_izin_oss_nama_pelaku_usaha">
<span<?php echo $izin_oss_list->nama_pelaku_usaha->viewAttributes() ?>><?php echo $izin_oss_list->nama_pelaku_usaha->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($izin_oss_list->id_jbu->Visible) { // id_jbu ?>
		<td data-name="id_jbu" <?php echo $izin_oss_list->id_jbu->cellAttributes() ?>>
<span id="el<?php echo $izin_oss_list->RowCount ?>_izin_oss_id_jbu">
<span<?php echo $izin_oss_list->id_jbu->viewAttributes() ?>><?php echo $izin_oss_list->id_jbu->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($izin_oss_list->id_pm->Visible) { // id_pm ?>
		<td data-name="id_pm" <?php echo $izin_oss_list->id_pm->cellAttributes() ?>>
<span id="el<?php echo $izin_oss_list->RowCount ?>_izin_oss_id_pm">
<span<?php echo $izin_oss_list->id_pm->viewAttributes() ?>><?php echo $izin_oss_list->id_pm->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($izin_oss_list->id_kecamatan->Visible) { // id_kecamatan ?>
		<td data-name="id_kecamatan" <?php echo $izin_oss_list->id_kecamatan->cellAttributes() ?>>
<span id="el<?php echo $izin_oss_list->RowCount ?>_izin_oss_id_kecamatan">
<span<?php echo $izin_oss_list->id_kecamatan->viewAttributes() ?>><?php echo $izin_oss_list->id_kecamatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($izin_oss_list->kode_kbli->Visible) { // kode_kbli ?>
		<td data-name="kode_kbli" <?php echo $izin_oss_list->kode_kbli->cellAttributes() ?>>
<span id="el<?php echo $izin_oss_list->RowCount ?>_izin_oss_kode_kbli">
<span<?php echo $izin_oss_list->kode_kbli->viewAttributes() ?>><?php echo $izin_oss_list->kode_kbli->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($izin_oss_list->id_skala_usaha->Visible) { // id_skala_usaha ?>
		<td data-name="id_skala_usaha" <?php echo $izin_oss_list->id_skala_usaha->cellAttributes() ?>>
<span id="el<?php echo $izin_oss_list->RowCount ?>_izin_oss_id_skala_usaha">
<span<?php echo $izin_oss_list->id_skala_usaha->viewAttributes() ?>><?php echo $izin_oss_list->id_skala_usaha->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($izin_oss_list->sysdate->Visible) { // sysdate ?>
		<td data-name="sysdate" <?php echo $izin_oss_list->sysdate->cellAttributes() ?>>
<span id="el<?php echo $izin_oss_list->RowCount ?>_izin_oss_sysdate">
<span<?php echo $izin_oss_list->sysdate->viewAttributes() ?>><?php echo $izin_oss_list->sysdate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($izin_oss_list->id_user->Visible) { // id_user ?>
		<td data-name="id_user" <?php echo $izin_oss_list->id_user->cellAttributes() ?>>
<span id="el<?php echo $izin_oss_list->RowCount ?>_izin_oss_id_user">
<span<?php echo $izin_oss_list->id_user->viewAttributes() ?>><?php echo $izin_oss_list->id_user->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$izin_oss_list->ListOptions->render("body", "right", $izin_oss_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$izin_oss_list->isGridAdd())
		$izin_oss_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$izin_oss->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($izin_oss_list->Recordset)
	$izin_oss_list->Recordset->Close();
?>
<?php if (!$izin_oss_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$izin_oss_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $izin_oss_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $izin_oss_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($izin_oss_list->TotalRecords == 0 && !$izin_oss->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $izin_oss_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$izin_oss_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$izin_oss_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$izin_oss_list->terminate();
?>