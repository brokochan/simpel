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
$kbli_list = new kbli_list();

// Run the page
$kbli_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kbli_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$kbli_list->isExport()) { ?>
<script>
var fkblilist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fkblilist = currentForm = new ew.Form("fkblilist", "list");
	fkblilist.formKeyCountName = '<?php echo $kbli_list->FormKeyCountName ?>';
	loadjs.done("fkblilist");
});
var fkblilistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fkblilistsrch = currentSearchForm = new ew.Form("fkblilistsrch");

	// Dynamic selection lists
	// Filters

	fkblilistsrch.filterList = <?php echo $kbli_list->getFilterList() ?>;
	loadjs.done("fkblilistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$kbli_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($kbli_list->TotalRecords > 0 && $kbli_list->ExportOptions->visible()) { ?>
<?php $kbli_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($kbli_list->ImportOptions->visible()) { ?>
<?php $kbli_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($kbli_list->SearchOptions->visible()) { ?>
<?php $kbli_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($kbli_list->FilterOptions->visible()) { ?>
<?php $kbli_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$kbli_list->renderOtherOptions();
?>
<?php if (!$kbli_list->isExport() && !$kbli->CurrentAction) { ?>
<form name="fkblilistsrch" id="fkblilistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fkblilistsrch-search-panel" class="<?php echo $kbli_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="kbli">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $kbli_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($kbli_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($kbli_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $kbli_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($kbli_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($kbli_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($kbli_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($kbli_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $kbli_list->showPageHeader(); ?>
<?php
$kbli_list->showMessage();
?>
<?php if ($kbli_list->TotalRecords > 0 || $kbli->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($kbli_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> kbli">
<form name="fkblilist" id="fkblilist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kbli">
<div id="gmp_kbli" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($kbli_list->TotalRecords > 0 || $kbli_list->isGridEdit()) { ?>
<table id="tbl_kblilist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$kbli->RowType = ROWTYPE_HEADER;

// Render list options
$kbli_list->renderListOptions();

// Render list options (header, left)
$kbli_list->ListOptions->render("header", "left");
?>
<?php if ($kbli_list->kode_kbli->Visible) { // kode_kbli ?>
	<?php if ($kbli_list->SortUrl($kbli_list->kode_kbli) == "") { ?>
		<th data-name="kode_kbli" class="<?php echo $kbli_list->kode_kbli->headerCellClass() ?>"><div id="elh_kbli_kode_kbli" class="kbli_kode_kbli"><div class="ew-table-header-caption"><?php echo $kbli_list->kode_kbli->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_kbli" class="<?php echo $kbli_list->kode_kbli->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kbli_list->SortUrl($kbli_list->kode_kbli) ?>', 1);"><div id="elh_kbli_kode_kbli" class="kbli_kode_kbli">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kbli_list->kode_kbli->caption() ?></span><span class="ew-table-header-sort"><?php if ($kbli_list->kode_kbli->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kbli_list->kode_kbli->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kbli_list->judul_kbli->Visible) { // judul_kbli ?>
	<?php if ($kbli_list->SortUrl($kbli_list->judul_kbli) == "") { ?>
		<th data-name="judul_kbli" class="<?php echo $kbli_list->judul_kbli->headerCellClass() ?>"><div id="elh_kbli_judul_kbli" class="kbli_judul_kbli"><div class="ew-table-header-caption"><?php echo $kbli_list->judul_kbli->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="judul_kbli" class="<?php echo $kbli_list->judul_kbli->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kbli_list->SortUrl($kbli_list->judul_kbli) ?>', 1);"><div id="elh_kbli_judul_kbli" class="kbli_judul_kbli">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kbli_list->judul_kbli->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($kbli_list->judul_kbli->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kbli_list->judul_kbli->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kbli_list->tahun_kbli->Visible) { // tahun_kbli ?>
	<?php if ($kbli_list->SortUrl($kbli_list->tahun_kbli) == "") { ?>
		<th data-name="tahun_kbli" class="<?php echo $kbli_list->tahun_kbli->headerCellClass() ?>"><div id="elh_kbli_tahun_kbli" class="kbli_tahun_kbli"><div class="ew-table-header-caption"><?php echo $kbli_list->tahun_kbli->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun_kbli" class="<?php echo $kbli_list->tahun_kbli->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kbli_list->SortUrl($kbli_list->tahun_kbli) ?>', 1);"><div id="elh_kbli_tahun_kbli" class="kbli_tahun_kbli">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kbli_list->tahun_kbli->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($kbli_list->tahun_kbli->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kbli_list->tahun_kbli->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$kbli_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($kbli_list->ExportAll && $kbli_list->isExport()) {
	$kbli_list->StopRecord = $kbli_list->TotalRecords;
} else {

	// Set the last record to display
	if ($kbli_list->TotalRecords > $kbli_list->StartRecord + $kbli_list->DisplayRecords - 1)
		$kbli_list->StopRecord = $kbli_list->StartRecord + $kbli_list->DisplayRecords - 1;
	else
		$kbli_list->StopRecord = $kbli_list->TotalRecords;
}
$kbli_list->RecordCount = $kbli_list->StartRecord - 1;
if ($kbli_list->Recordset && !$kbli_list->Recordset->EOF) {
	$kbli_list->Recordset->moveFirst();
	$selectLimit = $kbli_list->UseSelectLimit;
	if (!$selectLimit && $kbli_list->StartRecord > 1)
		$kbli_list->Recordset->move($kbli_list->StartRecord - 1);
} elseif (!$kbli->AllowAddDeleteRow && $kbli_list->StopRecord == 0) {
	$kbli_list->StopRecord = $kbli->GridAddRowCount;
}

// Initialize aggregate
$kbli->RowType = ROWTYPE_AGGREGATEINIT;
$kbli->resetAttributes();
$kbli_list->renderRow();
while ($kbli_list->RecordCount < $kbli_list->StopRecord) {
	$kbli_list->RecordCount++;
	if ($kbli_list->RecordCount >= $kbli_list->StartRecord) {
		$kbli_list->RowCount++;

		// Set up key count
		$kbli_list->KeyCount = $kbli_list->RowIndex;

		// Init row class and style
		$kbli->resetAttributes();
		$kbli->CssClass = "";
		if ($kbli_list->isGridAdd()) {
		} else {
			$kbli_list->loadRowValues($kbli_list->Recordset); // Load row values
		}
		$kbli->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$kbli->RowAttrs->merge(["data-rowindex" => $kbli_list->RowCount, "id" => "r" . $kbli_list->RowCount . "_kbli", "data-rowtype" => $kbli->RowType]);

		// Render row
		$kbli_list->renderRow();

		// Render list options
		$kbli_list->renderListOptions();
?>
	<tr <?php echo $kbli->rowAttributes() ?>>
<?php

// Render list options (body, left)
$kbli_list->ListOptions->render("body", "left", $kbli_list->RowCount);
?>
	<?php if ($kbli_list->kode_kbli->Visible) { // kode_kbli ?>
		<td data-name="kode_kbli" <?php echo $kbli_list->kode_kbli->cellAttributes() ?>>
<span id="el<?php echo $kbli_list->RowCount ?>_kbli_kode_kbli">
<span<?php echo $kbli_list->kode_kbli->viewAttributes() ?>><?php echo $kbli_list->kode_kbli->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kbli_list->judul_kbli->Visible) { // judul_kbli ?>
		<td data-name="judul_kbli" <?php echo $kbli_list->judul_kbli->cellAttributes() ?>>
<span id="el<?php echo $kbli_list->RowCount ?>_kbli_judul_kbli">
<span<?php echo $kbli_list->judul_kbli->viewAttributes() ?>><?php echo $kbli_list->judul_kbli->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kbli_list->tahun_kbli->Visible) { // tahun_kbli ?>
		<td data-name="tahun_kbli" <?php echo $kbli_list->tahun_kbli->cellAttributes() ?>>
<span id="el<?php echo $kbli_list->RowCount ?>_kbli_tahun_kbli">
<span<?php echo $kbli_list->tahun_kbli->viewAttributes() ?>><?php echo $kbli_list->tahun_kbli->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$kbli_list->ListOptions->render("body", "right", $kbli_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$kbli_list->isGridAdd())
		$kbli_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$kbli->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($kbli_list->Recordset)
	$kbli_list->Recordset->Close();
?>
<?php if (!$kbli_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$kbli_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $kbli_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $kbli_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($kbli_list->TotalRecords == 0 && !$kbli->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $kbli_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$kbli_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$kbli_list->isExport()) { ?>
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
$kbli_list->terminate();
?>