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
$kecamatan_list = new kecamatan_list();

// Run the page
$kecamatan_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kecamatan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$kecamatan_list->isExport()) { ?>
<script>
var fkecamatanlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fkecamatanlist = currentForm = new ew.Form("fkecamatanlist", "list");
	fkecamatanlist.formKeyCountName = '<?php echo $kecamatan_list->FormKeyCountName ?>';
	loadjs.done("fkecamatanlist");
});
var fkecamatanlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fkecamatanlistsrch = currentSearchForm = new ew.Form("fkecamatanlistsrch");

	// Dynamic selection lists
	// Filters

	fkecamatanlistsrch.filterList = <?php echo $kecamatan_list->getFilterList() ?>;
	loadjs.done("fkecamatanlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$kecamatan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($kecamatan_list->TotalRecords > 0 && $kecamatan_list->ExportOptions->visible()) { ?>
<?php $kecamatan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($kecamatan_list->ImportOptions->visible()) { ?>
<?php $kecamatan_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($kecamatan_list->SearchOptions->visible()) { ?>
<?php $kecamatan_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($kecamatan_list->FilterOptions->visible()) { ?>
<?php $kecamatan_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$kecamatan_list->renderOtherOptions();
?>
<?php if (!$kecamatan_list->isExport() && !$kecamatan->CurrentAction) { ?>
<form name="fkecamatanlistsrch" id="fkecamatanlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fkecamatanlistsrch-search-panel" class="<?php echo $kecamatan_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="kecamatan">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $kecamatan_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($kecamatan_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($kecamatan_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $kecamatan_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($kecamatan_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($kecamatan_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($kecamatan_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($kecamatan_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $kecamatan_list->showPageHeader(); ?>
<?php
$kecamatan_list->showMessage();
?>
<?php if ($kecamatan_list->TotalRecords > 0 || $kecamatan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($kecamatan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> kecamatan">
<form name="fkecamatanlist" id="fkecamatanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kecamatan">
<div id="gmp_kecamatan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($kecamatan_list->TotalRecords > 0 || $kecamatan_list->isGridEdit()) { ?>
<table id="tbl_kecamatanlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$kecamatan->RowType = ROWTYPE_HEADER;

// Render list options
$kecamatan_list->renderListOptions();

// Render list options (header, left)
$kecamatan_list->ListOptions->render("header", "left");
?>
<?php if ($kecamatan_list->id_kecamatan->Visible) { // id_kecamatan ?>
	<?php if ($kecamatan_list->SortUrl($kecamatan_list->id_kecamatan) == "") { ?>
		<th data-name="id_kecamatan" class="<?php echo $kecamatan_list->id_kecamatan->headerCellClass() ?>"><div id="elh_kecamatan_id_kecamatan" class="kecamatan_id_kecamatan"><div class="ew-table-header-caption"><?php echo $kecamatan_list->id_kecamatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_kecamatan" class="<?php echo $kecamatan_list->id_kecamatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kecamatan_list->SortUrl($kecamatan_list->id_kecamatan) ?>', 1);"><div id="elh_kecamatan_id_kecamatan" class="kecamatan_id_kecamatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kecamatan_list->id_kecamatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($kecamatan_list->id_kecamatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kecamatan_list->id_kecamatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kecamatan_list->kecamatan->Visible) { // kecamatan ?>
	<?php if ($kecamatan_list->SortUrl($kecamatan_list->kecamatan) == "") { ?>
		<th data-name="kecamatan" class="<?php echo $kecamatan_list->kecamatan->headerCellClass() ?>"><div id="elh_kecamatan_kecamatan" class="kecamatan_kecamatan"><div class="ew-table-header-caption"><?php echo $kecamatan_list->kecamatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kecamatan" class="<?php echo $kecamatan_list->kecamatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kecamatan_list->SortUrl($kecamatan_list->kecamatan) ?>', 1);"><div id="elh_kecamatan_kecamatan" class="kecamatan_kecamatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kecamatan_list->kecamatan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($kecamatan_list->kecamatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kecamatan_list->kecamatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kecamatan_list->kodepos->Visible) { // kodepos ?>
	<?php if ($kecamatan_list->SortUrl($kecamatan_list->kodepos) == "") { ?>
		<th data-name="kodepos" class="<?php echo $kecamatan_list->kodepos->headerCellClass() ?>"><div id="elh_kecamatan_kodepos" class="kecamatan_kodepos"><div class="ew-table-header-caption"><?php echo $kecamatan_list->kodepos->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kodepos" class="<?php echo $kecamatan_list->kodepos->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kecamatan_list->SortUrl($kecamatan_list->kodepos) ?>', 1);"><div id="elh_kecamatan_kodepos" class="kecamatan_kodepos">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kecamatan_list->kodepos->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($kecamatan_list->kodepos->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kecamatan_list->kodepos->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$kecamatan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($kecamatan_list->ExportAll && $kecamatan_list->isExport()) {
	$kecamatan_list->StopRecord = $kecamatan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($kecamatan_list->TotalRecords > $kecamatan_list->StartRecord + $kecamatan_list->DisplayRecords - 1)
		$kecamatan_list->StopRecord = $kecamatan_list->StartRecord + $kecamatan_list->DisplayRecords - 1;
	else
		$kecamatan_list->StopRecord = $kecamatan_list->TotalRecords;
}
$kecamatan_list->RecordCount = $kecamatan_list->StartRecord - 1;
if ($kecamatan_list->Recordset && !$kecamatan_list->Recordset->EOF) {
	$kecamatan_list->Recordset->moveFirst();
	$selectLimit = $kecamatan_list->UseSelectLimit;
	if (!$selectLimit && $kecamatan_list->StartRecord > 1)
		$kecamatan_list->Recordset->move($kecamatan_list->StartRecord - 1);
} elseif (!$kecamatan->AllowAddDeleteRow && $kecamatan_list->StopRecord == 0) {
	$kecamatan_list->StopRecord = $kecamatan->GridAddRowCount;
}

// Initialize aggregate
$kecamatan->RowType = ROWTYPE_AGGREGATEINIT;
$kecamatan->resetAttributes();
$kecamatan_list->renderRow();
while ($kecamatan_list->RecordCount < $kecamatan_list->StopRecord) {
	$kecamatan_list->RecordCount++;
	if ($kecamatan_list->RecordCount >= $kecamatan_list->StartRecord) {
		$kecamatan_list->RowCount++;

		// Set up key count
		$kecamatan_list->KeyCount = $kecamatan_list->RowIndex;

		// Init row class and style
		$kecamatan->resetAttributes();
		$kecamatan->CssClass = "";
		if ($kecamatan_list->isGridAdd()) {
		} else {
			$kecamatan_list->loadRowValues($kecamatan_list->Recordset); // Load row values
		}
		$kecamatan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$kecamatan->RowAttrs->merge(["data-rowindex" => $kecamatan_list->RowCount, "id" => "r" . $kecamatan_list->RowCount . "_kecamatan", "data-rowtype" => $kecamatan->RowType]);

		// Render row
		$kecamatan_list->renderRow();

		// Render list options
		$kecamatan_list->renderListOptions();
?>
	<tr <?php echo $kecamatan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$kecamatan_list->ListOptions->render("body", "left", $kecamatan_list->RowCount);
?>
	<?php if ($kecamatan_list->id_kecamatan->Visible) { // id_kecamatan ?>
		<td data-name="id_kecamatan" <?php echo $kecamatan_list->id_kecamatan->cellAttributes() ?>>
<span id="el<?php echo $kecamatan_list->RowCount ?>_kecamatan_id_kecamatan">
<span<?php echo $kecamatan_list->id_kecamatan->viewAttributes() ?>><?php echo $kecamatan_list->id_kecamatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kecamatan_list->kecamatan->Visible) { // kecamatan ?>
		<td data-name="kecamatan" <?php echo $kecamatan_list->kecamatan->cellAttributes() ?>>
<span id="el<?php echo $kecamatan_list->RowCount ?>_kecamatan_kecamatan">
<span<?php echo $kecamatan_list->kecamatan->viewAttributes() ?>><?php echo $kecamatan_list->kecamatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kecamatan_list->kodepos->Visible) { // kodepos ?>
		<td data-name="kodepos" <?php echo $kecamatan_list->kodepos->cellAttributes() ?>>
<span id="el<?php echo $kecamatan_list->RowCount ?>_kecamatan_kodepos">
<span<?php echo $kecamatan_list->kodepos->viewAttributes() ?>><?php echo $kecamatan_list->kodepos->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$kecamatan_list->ListOptions->render("body", "right", $kecamatan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$kecamatan_list->isGridAdd())
		$kecamatan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$kecamatan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($kecamatan_list->Recordset)
	$kecamatan_list->Recordset->Close();
?>
<?php if (!$kecamatan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$kecamatan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $kecamatan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $kecamatan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($kecamatan_list->TotalRecords == 0 && !$kecamatan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $kecamatan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$kecamatan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$kecamatan_list->isExport()) { ?>
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
$kecamatan_list->terminate();
?>