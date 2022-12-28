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
$hak_akses_list = new hak_akses_list();

// Run the page
$hak_akses_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$hak_akses_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$hak_akses_list->isExport()) { ?>
<script>
var fhak_akseslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fhak_akseslist = currentForm = new ew.Form("fhak_akseslist", "list");
	fhak_akseslist.formKeyCountName = '<?php echo $hak_akses_list->FormKeyCountName ?>';
	loadjs.done("fhak_akseslist");
});
var fhak_akseslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fhak_akseslistsrch = currentSearchForm = new ew.Form("fhak_akseslistsrch");

	// Dynamic selection lists
	// Filters

	fhak_akseslistsrch.filterList = <?php echo $hak_akses_list->getFilterList() ?>;
	loadjs.done("fhak_akseslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$hak_akses_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($hak_akses_list->TotalRecords > 0 && $hak_akses_list->ExportOptions->visible()) { ?>
<?php $hak_akses_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($hak_akses_list->ImportOptions->visible()) { ?>
<?php $hak_akses_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($hak_akses_list->SearchOptions->visible()) { ?>
<?php $hak_akses_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($hak_akses_list->FilterOptions->visible()) { ?>
<?php $hak_akses_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$hak_akses_list->renderOtherOptions();
?>
<?php if (!$hak_akses_list->isExport() && !$hak_akses->CurrentAction) { ?>
<form name="fhak_akseslistsrch" id="fhak_akseslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fhak_akseslistsrch-search-panel" class="<?php echo $hak_akses_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="hak_akses">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $hak_akses_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($hak_akses_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($hak_akses_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $hak_akses_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($hak_akses_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($hak_akses_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($hak_akses_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($hak_akses_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $hak_akses_list->showPageHeader(); ?>
<?php
$hak_akses_list->showMessage();
?>
<?php if ($hak_akses_list->TotalRecords > 0 || $hak_akses->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($hak_akses_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> hak_akses">
<form name="fhak_akseslist" id="fhak_akseslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="hak_akses">
<div id="gmp_hak_akses" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($hak_akses_list->TotalRecords > 0 || $hak_akses_list->isGridEdit()) { ?>
<table id="tbl_hak_akseslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$hak_akses->RowType = ROWTYPE_HEADER;

// Render list options
$hak_akses_list->renderListOptions();

// Render list options (header, left)
$hak_akses_list->ListOptions->render("header", "left");
?>
<?php if ($hak_akses_list->id_hak_akses->Visible) { // id_hak_akses ?>
	<?php if ($hak_akses_list->SortUrl($hak_akses_list->id_hak_akses) == "") { ?>
		<th data-name="id_hak_akses" class="<?php echo $hak_akses_list->id_hak_akses->headerCellClass() ?>"><div id="elh_hak_akses_id_hak_akses" class="hak_akses_id_hak_akses"><div class="ew-table-header-caption"><?php echo $hak_akses_list->id_hak_akses->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_hak_akses" class="<?php echo $hak_akses_list->id_hak_akses->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $hak_akses_list->SortUrl($hak_akses_list->id_hak_akses) ?>', 1);"><div id="elh_hak_akses_id_hak_akses" class="hak_akses_id_hak_akses">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $hak_akses_list->id_hak_akses->caption() ?></span><span class="ew-table-header-sort"><?php if ($hak_akses_list->id_hak_akses->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($hak_akses_list->id_hak_akses->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($hak_akses_list->hak_akses->Visible) { // hak_akses ?>
	<?php if ($hak_akses_list->SortUrl($hak_akses_list->hak_akses) == "") { ?>
		<th data-name="hak_akses" class="<?php echo $hak_akses_list->hak_akses->headerCellClass() ?>"><div id="elh_hak_akses_hak_akses" class="hak_akses_hak_akses"><div class="ew-table-header-caption"><?php echo $hak_akses_list->hak_akses->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hak_akses" class="<?php echo $hak_akses_list->hak_akses->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $hak_akses_list->SortUrl($hak_akses_list->hak_akses) ?>', 1);"><div id="elh_hak_akses_hak_akses" class="hak_akses_hak_akses">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $hak_akses_list->hak_akses->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($hak_akses_list->hak_akses->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($hak_akses_list->hak_akses->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$hak_akses_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($hak_akses_list->ExportAll && $hak_akses_list->isExport()) {
	$hak_akses_list->StopRecord = $hak_akses_list->TotalRecords;
} else {

	// Set the last record to display
	if ($hak_akses_list->TotalRecords > $hak_akses_list->StartRecord + $hak_akses_list->DisplayRecords - 1)
		$hak_akses_list->StopRecord = $hak_akses_list->StartRecord + $hak_akses_list->DisplayRecords - 1;
	else
		$hak_akses_list->StopRecord = $hak_akses_list->TotalRecords;
}
$hak_akses_list->RecordCount = $hak_akses_list->StartRecord - 1;
if ($hak_akses_list->Recordset && !$hak_akses_list->Recordset->EOF) {
	$hak_akses_list->Recordset->moveFirst();
	$selectLimit = $hak_akses_list->UseSelectLimit;
	if (!$selectLimit && $hak_akses_list->StartRecord > 1)
		$hak_akses_list->Recordset->move($hak_akses_list->StartRecord - 1);
} elseif (!$hak_akses->AllowAddDeleteRow && $hak_akses_list->StopRecord == 0) {
	$hak_akses_list->StopRecord = $hak_akses->GridAddRowCount;
}

// Initialize aggregate
$hak_akses->RowType = ROWTYPE_AGGREGATEINIT;
$hak_akses->resetAttributes();
$hak_akses_list->renderRow();
while ($hak_akses_list->RecordCount < $hak_akses_list->StopRecord) {
	$hak_akses_list->RecordCount++;
	if ($hak_akses_list->RecordCount >= $hak_akses_list->StartRecord) {
		$hak_akses_list->RowCount++;

		// Set up key count
		$hak_akses_list->KeyCount = $hak_akses_list->RowIndex;

		// Init row class and style
		$hak_akses->resetAttributes();
		$hak_akses->CssClass = "";
		if ($hak_akses_list->isGridAdd()) {
		} else {
			$hak_akses_list->loadRowValues($hak_akses_list->Recordset); // Load row values
		}
		$hak_akses->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$hak_akses->RowAttrs->merge(["data-rowindex" => $hak_akses_list->RowCount, "id" => "r" . $hak_akses_list->RowCount . "_hak_akses", "data-rowtype" => $hak_akses->RowType]);

		// Render row
		$hak_akses_list->renderRow();

		// Render list options
		$hak_akses_list->renderListOptions();
?>
	<tr <?php echo $hak_akses->rowAttributes() ?>>
<?php

// Render list options (body, left)
$hak_akses_list->ListOptions->render("body", "left", $hak_akses_list->RowCount);
?>
	<?php if ($hak_akses_list->id_hak_akses->Visible) { // id_hak_akses ?>
		<td data-name="id_hak_akses" <?php echo $hak_akses_list->id_hak_akses->cellAttributes() ?>>
<span id="el<?php echo $hak_akses_list->RowCount ?>_hak_akses_id_hak_akses">
<span<?php echo $hak_akses_list->id_hak_akses->viewAttributes() ?>><?php echo $hak_akses_list->id_hak_akses->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($hak_akses_list->hak_akses->Visible) { // hak_akses ?>
		<td data-name="hak_akses" <?php echo $hak_akses_list->hak_akses->cellAttributes() ?>>
<span id="el<?php echo $hak_akses_list->RowCount ?>_hak_akses_hak_akses">
<span<?php echo $hak_akses_list->hak_akses->viewAttributes() ?>><?php echo $hak_akses_list->hak_akses->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$hak_akses_list->ListOptions->render("body", "right", $hak_akses_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$hak_akses_list->isGridAdd())
		$hak_akses_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$hak_akses->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($hak_akses_list->Recordset)
	$hak_akses_list->Recordset->Close();
?>
<?php if (!$hak_akses_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$hak_akses_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $hak_akses_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $hak_akses_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($hak_akses_list->TotalRecords == 0 && !$hak_akses->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $hak_akses_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$hak_akses_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$hak_akses_list->isExport()) { ?>
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
$hak_akses_list->terminate();
?>