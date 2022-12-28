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
$izin_non_oss_list = new izin_non_oss_list();

// Run the page
$izin_non_oss_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$izin_non_oss_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$izin_non_oss_list->isExport()) { ?>
<script>
var fizin_non_osslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fizin_non_osslist = currentForm = new ew.Form("fizin_non_osslist", "list");
	fizin_non_osslist.formKeyCountName = '<?php echo $izin_non_oss_list->FormKeyCountName ?>';
	loadjs.done("fizin_non_osslist");
});
var fizin_non_osslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fizin_non_osslistsrch = currentSearchForm = new ew.Form("fizin_non_osslistsrch");

	// Dynamic selection lists
	// Filters

	fizin_non_osslistsrch.filterList = <?php echo $izin_non_oss_list->getFilterList() ?>;
	loadjs.done("fizin_non_osslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$izin_non_oss_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($izin_non_oss_list->TotalRecords > 0 && $izin_non_oss_list->ExportOptions->visible()) { ?>
<?php $izin_non_oss_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($izin_non_oss_list->ImportOptions->visible()) { ?>
<?php $izin_non_oss_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($izin_non_oss_list->SearchOptions->visible()) { ?>
<?php $izin_non_oss_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($izin_non_oss_list->FilterOptions->visible()) { ?>
<?php $izin_non_oss_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$izin_non_oss_list->renderOtherOptions();
?>
<?php if (!$izin_non_oss_list->isExport() && !$izin_non_oss->CurrentAction) { ?>
<form name="fizin_non_osslistsrch" id="fizin_non_osslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fizin_non_osslistsrch-search-panel" class="<?php echo $izin_non_oss_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="izin_non_oss">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $izin_non_oss_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($izin_non_oss_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($izin_non_oss_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $izin_non_oss_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($izin_non_oss_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($izin_non_oss_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($izin_non_oss_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($izin_non_oss_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $izin_non_oss_list->showPageHeader(); ?>
<?php
$izin_non_oss_list->showMessage();
?>
<?php if ($izin_non_oss_list->TotalRecords > 0 || $izin_non_oss->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($izin_non_oss_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> izin_non_oss">
<form name="fizin_non_osslist" id="fizin_non_osslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="izin_non_oss">
<div id="gmp_izin_non_oss" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($izin_non_oss_list->TotalRecords > 0 || $izin_non_oss_list->isGridEdit()) { ?>
<table id="tbl_izin_non_osslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$izin_non_oss->RowType = ROWTYPE_HEADER;

// Render list options
$izin_non_oss_list->renderListOptions();

// Render list options (header, left)
$izin_non_oss_list->ListOptions->render("header", "left");
?>
<?php if ($izin_non_oss_list->id_izin_non_oss->Visible) { // id_izin_non_oss ?>
	<?php if ($izin_non_oss_list->SortUrl($izin_non_oss_list->id_izin_non_oss) == "") { ?>
		<th data-name="id_izin_non_oss" class="<?php echo $izin_non_oss_list->id_izin_non_oss->headerCellClass() ?>"><div id="elh_izin_non_oss_id_izin_non_oss" class="izin_non_oss_id_izin_non_oss"><div class="ew-table-header-caption"><?php echo $izin_non_oss_list->id_izin_non_oss->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_izin_non_oss" class="<?php echo $izin_non_oss_list->id_izin_non_oss->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $izin_non_oss_list->SortUrl($izin_non_oss_list->id_izin_non_oss) ?>', 1);"><div id="elh_izin_non_oss_id_izin_non_oss" class="izin_non_oss_id_izin_non_oss">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $izin_non_oss_list->id_izin_non_oss->caption() ?></span><span class="ew-table-header-sort"><?php if ($izin_non_oss_list->id_izin_non_oss->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($izin_non_oss_list->id_izin_non_oss->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($izin_non_oss_list->no_izin->Visible) { // no_izin ?>
	<?php if ($izin_non_oss_list->SortUrl($izin_non_oss_list->no_izin) == "") { ?>
		<th data-name="no_izin" class="<?php echo $izin_non_oss_list->no_izin->headerCellClass() ?>"><div id="elh_izin_non_oss_no_izin" class="izin_non_oss_no_izin"><div class="ew-table-header-caption"><?php echo $izin_non_oss_list->no_izin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="no_izin" class="<?php echo $izin_non_oss_list->no_izin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $izin_non_oss_list->SortUrl($izin_non_oss_list->no_izin) ?>', 1);"><div id="elh_izin_non_oss_no_izin" class="izin_non_oss_no_izin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $izin_non_oss_list->no_izin->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($izin_non_oss_list->no_izin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($izin_non_oss_list->no_izin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($izin_non_oss_list->id_jenis_izin->Visible) { // id_jenis_izin ?>
	<?php if ($izin_non_oss_list->SortUrl($izin_non_oss_list->id_jenis_izin) == "") { ?>
		<th data-name="id_jenis_izin" class="<?php echo $izin_non_oss_list->id_jenis_izin->headerCellClass() ?>"><div id="elh_izin_non_oss_id_jenis_izin" class="izin_non_oss_id_jenis_izin"><div class="ew-table-header-caption"><?php echo $izin_non_oss_list->id_jenis_izin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_jenis_izin" class="<?php echo $izin_non_oss_list->id_jenis_izin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $izin_non_oss_list->SortUrl($izin_non_oss_list->id_jenis_izin) ?>', 1);"><div id="elh_izin_non_oss_id_jenis_izin" class="izin_non_oss_id_jenis_izin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $izin_non_oss_list->id_jenis_izin->caption() ?></span><span class="ew-table-header-sort"><?php if ($izin_non_oss_list->id_jenis_izin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($izin_non_oss_list->id_jenis_izin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($izin_non_oss_list->jenis_pemohon->Visible) { // jenis_pemohon ?>
	<?php if ($izin_non_oss_list->SortUrl($izin_non_oss_list->jenis_pemohon) == "") { ?>
		<th data-name="jenis_pemohon" class="<?php echo $izin_non_oss_list->jenis_pemohon->headerCellClass() ?>"><div id="elh_izin_non_oss_jenis_pemohon" class="izin_non_oss_jenis_pemohon"><div class="ew-table-header-caption"><?php echo $izin_non_oss_list->jenis_pemohon->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis_pemohon" class="<?php echo $izin_non_oss_list->jenis_pemohon->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $izin_non_oss_list->SortUrl($izin_non_oss_list->jenis_pemohon) ?>', 1);"><div id="elh_izin_non_oss_jenis_pemohon" class="izin_non_oss_jenis_pemohon">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $izin_non_oss_list->jenis_pemohon->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($izin_non_oss_list->jenis_pemohon->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($izin_non_oss_list->jenis_pemohon->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($izin_non_oss_list->nama_pemohon->Visible) { // nama_pemohon ?>
	<?php if ($izin_non_oss_list->SortUrl($izin_non_oss_list->nama_pemohon) == "") { ?>
		<th data-name="nama_pemohon" class="<?php echo $izin_non_oss_list->nama_pemohon->headerCellClass() ?>"><div id="elh_izin_non_oss_nama_pemohon" class="izin_non_oss_nama_pemohon"><div class="ew-table-header-caption"><?php echo $izin_non_oss_list->nama_pemohon->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_pemohon" class="<?php echo $izin_non_oss_list->nama_pemohon->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $izin_non_oss_list->SortUrl($izin_non_oss_list->nama_pemohon) ?>', 1);"><div id="elh_izin_non_oss_nama_pemohon" class="izin_non_oss_nama_pemohon">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $izin_non_oss_list->nama_pemohon->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($izin_non_oss_list->nama_pemohon->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($izin_non_oss_list->nama_pemohon->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($izin_non_oss_list->id_jbu->Visible) { // id_jbu ?>
	<?php if ($izin_non_oss_list->SortUrl($izin_non_oss_list->id_jbu) == "") { ?>
		<th data-name="id_jbu" class="<?php echo $izin_non_oss_list->id_jbu->headerCellClass() ?>"><div id="elh_izin_non_oss_id_jbu" class="izin_non_oss_id_jbu"><div class="ew-table-header-caption"><?php echo $izin_non_oss_list->id_jbu->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_jbu" class="<?php echo $izin_non_oss_list->id_jbu->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $izin_non_oss_list->SortUrl($izin_non_oss_list->id_jbu) ?>', 1);"><div id="elh_izin_non_oss_id_jbu" class="izin_non_oss_id_jbu">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $izin_non_oss_list->id_jbu->caption() ?></span><span class="ew-table-header-sort"><?php if ($izin_non_oss_list->id_jbu->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($izin_non_oss_list->id_jbu->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($izin_non_oss_list->id_sektor->Visible) { // id_sektor ?>
	<?php if ($izin_non_oss_list->SortUrl($izin_non_oss_list->id_sektor) == "") { ?>
		<th data-name="id_sektor" class="<?php echo $izin_non_oss_list->id_sektor->headerCellClass() ?>"><div id="elh_izin_non_oss_id_sektor" class="izin_non_oss_id_sektor"><div class="ew-table-header-caption"><?php echo $izin_non_oss_list->id_sektor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_sektor" class="<?php echo $izin_non_oss_list->id_sektor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $izin_non_oss_list->SortUrl($izin_non_oss_list->id_sektor) ?>', 1);"><div id="elh_izin_non_oss_id_sektor" class="izin_non_oss_id_sektor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $izin_non_oss_list->id_sektor->caption() ?></span><span class="ew-table-header-sort"><?php if ($izin_non_oss_list->id_sektor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($izin_non_oss_list->id_sektor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($izin_non_oss_list->id_subsektor->Visible) { // id_subsektor ?>
	<?php if ($izin_non_oss_list->SortUrl($izin_non_oss_list->id_subsektor) == "") { ?>
		<th data-name="id_subsektor" class="<?php echo $izin_non_oss_list->id_subsektor->headerCellClass() ?>"><div id="elh_izin_non_oss_id_subsektor" class="izin_non_oss_id_subsektor"><div class="ew-table-header-caption"><?php echo $izin_non_oss_list->id_subsektor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_subsektor" class="<?php echo $izin_non_oss_list->id_subsektor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $izin_non_oss_list->SortUrl($izin_non_oss_list->id_subsektor) ?>', 1);"><div id="elh_izin_non_oss_id_subsektor" class="izin_non_oss_id_subsektor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $izin_non_oss_list->id_subsektor->caption() ?></span><span class="ew-table-header-sort"><?php if ($izin_non_oss_list->id_subsektor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($izin_non_oss_list->id_subsektor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($izin_non_oss_list->tanggal_izin->Visible) { // tanggal_izin ?>
	<?php if ($izin_non_oss_list->SortUrl($izin_non_oss_list->tanggal_izin) == "") { ?>
		<th data-name="tanggal_izin" class="<?php echo $izin_non_oss_list->tanggal_izin->headerCellClass() ?>"><div id="elh_izin_non_oss_tanggal_izin" class="izin_non_oss_tanggal_izin"><div class="ew-table-header-caption"><?php echo $izin_non_oss_list->tanggal_izin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tanggal_izin" class="<?php echo $izin_non_oss_list->tanggal_izin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $izin_non_oss_list->SortUrl($izin_non_oss_list->tanggal_izin) ?>', 1);"><div id="elh_izin_non_oss_tanggal_izin" class="izin_non_oss_tanggal_izin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $izin_non_oss_list->tanggal_izin->caption() ?></span><span class="ew-table-header-sort"><?php if ($izin_non_oss_list->tanggal_izin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($izin_non_oss_list->tanggal_izin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($izin_non_oss_list->sysdate->Visible) { // sysdate ?>
	<?php if ($izin_non_oss_list->SortUrl($izin_non_oss_list->sysdate) == "") { ?>
		<th data-name="sysdate" class="<?php echo $izin_non_oss_list->sysdate->headerCellClass() ?>"><div id="elh_izin_non_oss_sysdate" class="izin_non_oss_sysdate"><div class="ew-table-header-caption"><?php echo $izin_non_oss_list->sysdate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sysdate" class="<?php echo $izin_non_oss_list->sysdate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $izin_non_oss_list->SortUrl($izin_non_oss_list->sysdate) ?>', 1);"><div id="elh_izin_non_oss_sysdate" class="izin_non_oss_sysdate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $izin_non_oss_list->sysdate->caption() ?></span><span class="ew-table-header-sort"><?php if ($izin_non_oss_list->sysdate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($izin_non_oss_list->sysdate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($izin_non_oss_list->id_user->Visible) { // id_user ?>
	<?php if ($izin_non_oss_list->SortUrl($izin_non_oss_list->id_user) == "") { ?>
		<th data-name="id_user" class="<?php echo $izin_non_oss_list->id_user->headerCellClass() ?>"><div id="elh_izin_non_oss_id_user" class="izin_non_oss_id_user"><div class="ew-table-header-caption"><?php echo $izin_non_oss_list->id_user->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_user" class="<?php echo $izin_non_oss_list->id_user->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $izin_non_oss_list->SortUrl($izin_non_oss_list->id_user) ?>', 1);"><div id="elh_izin_non_oss_id_user" class="izin_non_oss_id_user">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $izin_non_oss_list->id_user->caption() ?></span><span class="ew-table-header-sort"><?php if ($izin_non_oss_list->id_user->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($izin_non_oss_list->id_user->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$izin_non_oss_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($izin_non_oss_list->ExportAll && $izin_non_oss_list->isExport()) {
	$izin_non_oss_list->StopRecord = $izin_non_oss_list->TotalRecords;
} else {

	// Set the last record to display
	if ($izin_non_oss_list->TotalRecords > $izin_non_oss_list->StartRecord + $izin_non_oss_list->DisplayRecords - 1)
		$izin_non_oss_list->StopRecord = $izin_non_oss_list->StartRecord + $izin_non_oss_list->DisplayRecords - 1;
	else
		$izin_non_oss_list->StopRecord = $izin_non_oss_list->TotalRecords;
}
$izin_non_oss_list->RecordCount = $izin_non_oss_list->StartRecord - 1;
if ($izin_non_oss_list->Recordset && !$izin_non_oss_list->Recordset->EOF) {
	$izin_non_oss_list->Recordset->moveFirst();
	$selectLimit = $izin_non_oss_list->UseSelectLimit;
	if (!$selectLimit && $izin_non_oss_list->StartRecord > 1)
		$izin_non_oss_list->Recordset->move($izin_non_oss_list->StartRecord - 1);
} elseif (!$izin_non_oss->AllowAddDeleteRow && $izin_non_oss_list->StopRecord == 0) {
	$izin_non_oss_list->StopRecord = $izin_non_oss->GridAddRowCount;
}

// Initialize aggregate
$izin_non_oss->RowType = ROWTYPE_AGGREGATEINIT;
$izin_non_oss->resetAttributes();
$izin_non_oss_list->renderRow();
while ($izin_non_oss_list->RecordCount < $izin_non_oss_list->StopRecord) {
	$izin_non_oss_list->RecordCount++;
	if ($izin_non_oss_list->RecordCount >= $izin_non_oss_list->StartRecord) {
		$izin_non_oss_list->RowCount++;

		// Set up key count
		$izin_non_oss_list->KeyCount = $izin_non_oss_list->RowIndex;

		// Init row class and style
		$izin_non_oss->resetAttributes();
		$izin_non_oss->CssClass = "";
		if ($izin_non_oss_list->isGridAdd()) {
		} else {
			$izin_non_oss_list->loadRowValues($izin_non_oss_list->Recordset); // Load row values
		}
		$izin_non_oss->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$izin_non_oss->RowAttrs->merge(["data-rowindex" => $izin_non_oss_list->RowCount, "id" => "r" . $izin_non_oss_list->RowCount . "_izin_non_oss", "data-rowtype" => $izin_non_oss->RowType]);

		// Render row
		$izin_non_oss_list->renderRow();

		// Render list options
		$izin_non_oss_list->renderListOptions();
?>
	<tr <?php echo $izin_non_oss->rowAttributes() ?>>
<?php

// Render list options (body, left)
$izin_non_oss_list->ListOptions->render("body", "left", $izin_non_oss_list->RowCount);
?>
	<?php if ($izin_non_oss_list->id_izin_non_oss->Visible) { // id_izin_non_oss ?>
		<td data-name="id_izin_non_oss" <?php echo $izin_non_oss_list->id_izin_non_oss->cellAttributes() ?>>
<span id="el<?php echo $izin_non_oss_list->RowCount ?>_izin_non_oss_id_izin_non_oss">
<span<?php echo $izin_non_oss_list->id_izin_non_oss->viewAttributes() ?>><?php echo $izin_non_oss_list->id_izin_non_oss->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($izin_non_oss_list->no_izin->Visible) { // no_izin ?>
		<td data-name="no_izin" <?php echo $izin_non_oss_list->no_izin->cellAttributes() ?>>
<span id="el<?php echo $izin_non_oss_list->RowCount ?>_izin_non_oss_no_izin">
<span<?php echo $izin_non_oss_list->no_izin->viewAttributes() ?>><?php echo $izin_non_oss_list->no_izin->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($izin_non_oss_list->id_jenis_izin->Visible) { // id_jenis_izin ?>
		<td data-name="id_jenis_izin" <?php echo $izin_non_oss_list->id_jenis_izin->cellAttributes() ?>>
<span id="el<?php echo $izin_non_oss_list->RowCount ?>_izin_non_oss_id_jenis_izin">
<span<?php echo $izin_non_oss_list->id_jenis_izin->viewAttributes() ?>><?php echo $izin_non_oss_list->id_jenis_izin->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($izin_non_oss_list->jenis_pemohon->Visible) { // jenis_pemohon ?>
		<td data-name="jenis_pemohon" <?php echo $izin_non_oss_list->jenis_pemohon->cellAttributes() ?>>
<span id="el<?php echo $izin_non_oss_list->RowCount ?>_izin_non_oss_jenis_pemohon">
<span<?php echo $izin_non_oss_list->jenis_pemohon->viewAttributes() ?>><?php echo $izin_non_oss_list->jenis_pemohon->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($izin_non_oss_list->nama_pemohon->Visible) { // nama_pemohon ?>
		<td data-name="nama_pemohon" <?php echo $izin_non_oss_list->nama_pemohon->cellAttributes() ?>>
<span id="el<?php echo $izin_non_oss_list->RowCount ?>_izin_non_oss_nama_pemohon">
<span<?php echo $izin_non_oss_list->nama_pemohon->viewAttributes() ?>><?php echo $izin_non_oss_list->nama_pemohon->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($izin_non_oss_list->id_jbu->Visible) { // id_jbu ?>
		<td data-name="id_jbu" <?php echo $izin_non_oss_list->id_jbu->cellAttributes() ?>>
<span id="el<?php echo $izin_non_oss_list->RowCount ?>_izin_non_oss_id_jbu">
<span<?php echo $izin_non_oss_list->id_jbu->viewAttributes() ?>><?php echo $izin_non_oss_list->id_jbu->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($izin_non_oss_list->id_sektor->Visible) { // id_sektor ?>
		<td data-name="id_sektor" <?php echo $izin_non_oss_list->id_sektor->cellAttributes() ?>>
<span id="el<?php echo $izin_non_oss_list->RowCount ?>_izin_non_oss_id_sektor">
<span<?php echo $izin_non_oss_list->id_sektor->viewAttributes() ?>><?php echo $izin_non_oss_list->id_sektor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($izin_non_oss_list->id_subsektor->Visible) { // id_subsektor ?>
		<td data-name="id_subsektor" <?php echo $izin_non_oss_list->id_subsektor->cellAttributes() ?>>
<span id="el<?php echo $izin_non_oss_list->RowCount ?>_izin_non_oss_id_subsektor">
<span<?php echo $izin_non_oss_list->id_subsektor->viewAttributes() ?>><?php echo $izin_non_oss_list->id_subsektor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($izin_non_oss_list->tanggal_izin->Visible) { // tanggal_izin ?>
		<td data-name="tanggal_izin" <?php echo $izin_non_oss_list->tanggal_izin->cellAttributes() ?>>
<span id="el<?php echo $izin_non_oss_list->RowCount ?>_izin_non_oss_tanggal_izin">
<span<?php echo $izin_non_oss_list->tanggal_izin->viewAttributes() ?>><?php echo $izin_non_oss_list->tanggal_izin->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($izin_non_oss_list->sysdate->Visible) { // sysdate ?>
		<td data-name="sysdate" <?php echo $izin_non_oss_list->sysdate->cellAttributes() ?>>
<span id="el<?php echo $izin_non_oss_list->RowCount ?>_izin_non_oss_sysdate">
<span<?php echo $izin_non_oss_list->sysdate->viewAttributes() ?>><?php echo $izin_non_oss_list->sysdate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($izin_non_oss_list->id_user->Visible) { // id_user ?>
		<td data-name="id_user" <?php echo $izin_non_oss_list->id_user->cellAttributes() ?>>
<span id="el<?php echo $izin_non_oss_list->RowCount ?>_izin_non_oss_id_user">
<span<?php echo $izin_non_oss_list->id_user->viewAttributes() ?>><?php echo $izin_non_oss_list->id_user->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$izin_non_oss_list->ListOptions->render("body", "right", $izin_non_oss_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$izin_non_oss_list->isGridAdd())
		$izin_non_oss_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$izin_non_oss->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($izin_non_oss_list->Recordset)
	$izin_non_oss_list->Recordset->Close();
?>
<?php if (!$izin_non_oss_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$izin_non_oss_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $izin_non_oss_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $izin_non_oss_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($izin_non_oss_list->TotalRecords == 0 && !$izin_non_oss->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $izin_non_oss_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$izin_non_oss_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$izin_non_oss_list->isExport()) { ?>
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
$izin_non_oss_list->terminate();
?>