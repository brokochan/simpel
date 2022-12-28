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
$sektor_list = new sektor_list();

// Run the page
$sektor_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sektor_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$sektor_list->isExport()) { ?>
<script>
var fsektorlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fsektorlist = currentForm = new ew.Form("fsektorlist", "list");
	fsektorlist.formKeyCountName = '<?php echo $sektor_list->FormKeyCountName ?>';
	loadjs.done("fsektorlist");
});
var fsektorlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fsektorlistsrch = currentSearchForm = new ew.Form("fsektorlistsrch");

	// Dynamic selection lists
	// Filters

	fsektorlistsrch.filterList = <?php echo $sektor_list->getFilterList() ?>;
	loadjs.done("fsektorlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$sektor_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($sektor_list->TotalRecords > 0 && $sektor_list->ExportOptions->visible()) { ?>
<?php $sektor_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($sektor_list->ImportOptions->visible()) { ?>
<?php $sektor_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($sektor_list->SearchOptions->visible()) { ?>
<?php $sektor_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($sektor_list->FilterOptions->visible()) { ?>
<?php $sektor_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$sektor_list->renderOtherOptions();
?>
<?php if (!$sektor_list->isExport() && !$sektor->CurrentAction) { ?>
<form name="fsektorlistsrch" id="fsektorlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsektorlistsrch-search-panel" class="<?php echo $sektor_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="sektor">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $sektor_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($sektor_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($sektor_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $sektor_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($sektor_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($sektor_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($sektor_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($sektor_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $sektor_list->showPageHeader(); ?>
<?php
$sektor_list->showMessage();
?>
<?php if ($sektor_list->TotalRecords > 0 || $sektor->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($sektor_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> sektor">
<form name="fsektorlist" id="fsektorlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sektor">
<div id="gmp_sektor" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($sektor_list->TotalRecords > 0 || $sektor_list->isGridEdit()) { ?>
<table id="tbl_sektorlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$sektor->RowType = ROWTYPE_HEADER;

// Render list options
$sektor_list->renderListOptions();

// Render list options (header, left)
$sektor_list->ListOptions->render("header", "left");
?>
<?php if ($sektor_list->id_sektor->Visible) { // id_sektor ?>
	<?php if ($sektor_list->SortUrl($sektor_list->id_sektor) == "") { ?>
		<th data-name="id_sektor" class="<?php echo $sektor_list->id_sektor->headerCellClass() ?>"><div id="elh_sektor_id_sektor" class="sektor_id_sektor"><div class="ew-table-header-caption"><?php echo $sektor_list->id_sektor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_sektor" class="<?php echo $sektor_list->id_sektor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sektor_list->SortUrl($sektor_list->id_sektor) ?>', 1);"><div id="elh_sektor_id_sektor" class="sektor_id_sektor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sektor_list->id_sektor->caption() ?></span><span class="ew-table-header-sort"><?php if ($sektor_list->id_sektor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sektor_list->id_sektor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sektor_list->sektor->Visible) { // sektor ?>
	<?php if ($sektor_list->SortUrl($sektor_list->sektor) == "") { ?>
		<th data-name="sektor" class="<?php echo $sektor_list->sektor->headerCellClass() ?>"><div id="elh_sektor_sektor" class="sektor_sektor"><div class="ew-table-header-caption"><?php echo $sektor_list->sektor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sektor" class="<?php echo $sektor_list->sektor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sektor_list->SortUrl($sektor_list->sektor) ?>', 1);"><div id="elh_sektor_sektor" class="sektor_sektor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sektor_list->sektor->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($sektor_list->sektor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sektor_list->sektor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$sektor_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($sektor_list->ExportAll && $sektor_list->isExport()) {
	$sektor_list->StopRecord = $sektor_list->TotalRecords;
} else {

	// Set the last record to display
	if ($sektor_list->TotalRecords > $sektor_list->StartRecord + $sektor_list->DisplayRecords - 1)
		$sektor_list->StopRecord = $sektor_list->StartRecord + $sektor_list->DisplayRecords - 1;
	else
		$sektor_list->StopRecord = $sektor_list->TotalRecords;
}
$sektor_list->RecordCount = $sektor_list->StartRecord - 1;
if ($sektor_list->Recordset && !$sektor_list->Recordset->EOF) {
	$sektor_list->Recordset->moveFirst();
	$selectLimit = $sektor_list->UseSelectLimit;
	if (!$selectLimit && $sektor_list->StartRecord > 1)
		$sektor_list->Recordset->move($sektor_list->StartRecord - 1);
} elseif (!$sektor->AllowAddDeleteRow && $sektor_list->StopRecord == 0) {
	$sektor_list->StopRecord = $sektor->GridAddRowCount;
}

// Initialize aggregate
$sektor->RowType = ROWTYPE_AGGREGATEINIT;
$sektor->resetAttributes();
$sektor_list->renderRow();
while ($sektor_list->RecordCount < $sektor_list->StopRecord) {
	$sektor_list->RecordCount++;
	if ($sektor_list->RecordCount >= $sektor_list->StartRecord) {
		$sektor_list->RowCount++;

		// Set up key count
		$sektor_list->KeyCount = $sektor_list->RowIndex;

		// Init row class and style
		$sektor->resetAttributes();
		$sektor->CssClass = "";
		if ($sektor_list->isGridAdd()) {
		} else {
			$sektor_list->loadRowValues($sektor_list->Recordset); // Load row values
		}
		$sektor->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$sektor->RowAttrs->merge(["data-rowindex" => $sektor_list->RowCount, "id" => "r" . $sektor_list->RowCount . "_sektor", "data-rowtype" => $sektor->RowType]);

		// Render row
		$sektor_list->renderRow();

		// Render list options
		$sektor_list->renderListOptions();
?>
	<tr <?php echo $sektor->rowAttributes() ?>>
<?php

// Render list options (body, left)
$sektor_list->ListOptions->render("body", "left", $sektor_list->RowCount);
?>
	<?php if ($sektor_list->id_sektor->Visible) { // id_sektor ?>
		<td data-name="id_sektor" <?php echo $sektor_list->id_sektor->cellAttributes() ?>>
<span id="el<?php echo $sektor_list->RowCount ?>_sektor_id_sektor">
<span<?php echo $sektor_list->id_sektor->viewAttributes() ?>><?php echo $sektor_list->id_sektor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sektor_list->sektor->Visible) { // sektor ?>
		<td data-name="sektor" <?php echo $sektor_list->sektor->cellAttributes() ?>>
<span id="el<?php echo $sektor_list->RowCount ?>_sektor_sektor">
<span<?php echo $sektor_list->sektor->viewAttributes() ?>><?php echo $sektor_list->sektor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$sektor_list->ListOptions->render("body", "right", $sektor_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$sektor_list->isGridAdd())
		$sektor_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$sektor->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($sektor_list->Recordset)
	$sektor_list->Recordset->Close();
?>
<?php if (!$sektor_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$sektor_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $sektor_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $sektor_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($sektor_list->TotalRecords == 0 && !$sektor->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $sektor_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$sektor_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$sektor_list->isExport()) { ?>
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
$sektor_list->terminate();
?>