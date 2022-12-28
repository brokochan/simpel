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
$skala_usaha_list = new skala_usaha_list();

// Run the page
$skala_usaha_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$skala_usaha_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$skala_usaha_list->isExport()) { ?>
<script>
var fskala_usahalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fskala_usahalist = currentForm = new ew.Form("fskala_usahalist", "list");
	fskala_usahalist.formKeyCountName = '<?php echo $skala_usaha_list->FormKeyCountName ?>';
	loadjs.done("fskala_usahalist");
});
var fskala_usahalistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fskala_usahalistsrch = currentSearchForm = new ew.Form("fskala_usahalistsrch");

	// Dynamic selection lists
	// Filters

	fskala_usahalistsrch.filterList = <?php echo $skala_usaha_list->getFilterList() ?>;
	loadjs.done("fskala_usahalistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$skala_usaha_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($skala_usaha_list->TotalRecords > 0 && $skala_usaha_list->ExportOptions->visible()) { ?>
<?php $skala_usaha_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($skala_usaha_list->ImportOptions->visible()) { ?>
<?php $skala_usaha_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($skala_usaha_list->SearchOptions->visible()) { ?>
<?php $skala_usaha_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($skala_usaha_list->FilterOptions->visible()) { ?>
<?php $skala_usaha_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$skala_usaha_list->renderOtherOptions();
?>
<?php if (!$skala_usaha_list->isExport() && !$skala_usaha->CurrentAction) { ?>
<form name="fskala_usahalistsrch" id="fskala_usahalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fskala_usahalistsrch-search-panel" class="<?php echo $skala_usaha_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="skala_usaha">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $skala_usaha_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($skala_usaha_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($skala_usaha_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $skala_usaha_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($skala_usaha_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($skala_usaha_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($skala_usaha_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($skala_usaha_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $skala_usaha_list->showPageHeader(); ?>
<?php
$skala_usaha_list->showMessage();
?>
<?php if ($skala_usaha_list->TotalRecords > 0 || $skala_usaha->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($skala_usaha_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> skala_usaha">
<form name="fskala_usahalist" id="fskala_usahalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="skala_usaha">
<div id="gmp_skala_usaha" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($skala_usaha_list->TotalRecords > 0 || $skala_usaha_list->isGridEdit()) { ?>
<table id="tbl_skala_usahalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$skala_usaha->RowType = ROWTYPE_HEADER;

// Render list options
$skala_usaha_list->renderListOptions();

// Render list options (header, left)
$skala_usaha_list->ListOptions->render("header", "left");
?>
<?php if ($skala_usaha_list->id_skala_usaha->Visible) { // id_skala_usaha ?>
	<?php if ($skala_usaha_list->SortUrl($skala_usaha_list->id_skala_usaha) == "") { ?>
		<th data-name="id_skala_usaha" class="<?php echo $skala_usaha_list->id_skala_usaha->headerCellClass() ?>"><div id="elh_skala_usaha_id_skala_usaha" class="skala_usaha_id_skala_usaha"><div class="ew-table-header-caption"><?php echo $skala_usaha_list->id_skala_usaha->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_skala_usaha" class="<?php echo $skala_usaha_list->id_skala_usaha->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $skala_usaha_list->SortUrl($skala_usaha_list->id_skala_usaha) ?>', 1);"><div id="elh_skala_usaha_id_skala_usaha" class="skala_usaha_id_skala_usaha">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $skala_usaha_list->id_skala_usaha->caption() ?></span><span class="ew-table-header-sort"><?php if ($skala_usaha_list->id_skala_usaha->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($skala_usaha_list->id_skala_usaha->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($skala_usaha_list->skala_usaha->Visible) { // skala_usaha ?>
	<?php if ($skala_usaha_list->SortUrl($skala_usaha_list->skala_usaha) == "") { ?>
		<th data-name="skala_usaha" class="<?php echo $skala_usaha_list->skala_usaha->headerCellClass() ?>"><div id="elh_skala_usaha_skala_usaha" class="skala_usaha_skala_usaha"><div class="ew-table-header-caption"><?php echo $skala_usaha_list->skala_usaha->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="skala_usaha" class="<?php echo $skala_usaha_list->skala_usaha->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $skala_usaha_list->SortUrl($skala_usaha_list->skala_usaha) ?>', 1);"><div id="elh_skala_usaha_skala_usaha" class="skala_usaha_skala_usaha">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $skala_usaha_list->skala_usaha->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($skala_usaha_list->skala_usaha->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($skala_usaha_list->skala_usaha->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$skala_usaha_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($skala_usaha_list->ExportAll && $skala_usaha_list->isExport()) {
	$skala_usaha_list->StopRecord = $skala_usaha_list->TotalRecords;
} else {

	// Set the last record to display
	if ($skala_usaha_list->TotalRecords > $skala_usaha_list->StartRecord + $skala_usaha_list->DisplayRecords - 1)
		$skala_usaha_list->StopRecord = $skala_usaha_list->StartRecord + $skala_usaha_list->DisplayRecords - 1;
	else
		$skala_usaha_list->StopRecord = $skala_usaha_list->TotalRecords;
}
$skala_usaha_list->RecordCount = $skala_usaha_list->StartRecord - 1;
if ($skala_usaha_list->Recordset && !$skala_usaha_list->Recordset->EOF) {
	$skala_usaha_list->Recordset->moveFirst();
	$selectLimit = $skala_usaha_list->UseSelectLimit;
	if (!$selectLimit && $skala_usaha_list->StartRecord > 1)
		$skala_usaha_list->Recordset->move($skala_usaha_list->StartRecord - 1);
} elseif (!$skala_usaha->AllowAddDeleteRow && $skala_usaha_list->StopRecord == 0) {
	$skala_usaha_list->StopRecord = $skala_usaha->GridAddRowCount;
}

// Initialize aggregate
$skala_usaha->RowType = ROWTYPE_AGGREGATEINIT;
$skala_usaha->resetAttributes();
$skala_usaha_list->renderRow();
while ($skala_usaha_list->RecordCount < $skala_usaha_list->StopRecord) {
	$skala_usaha_list->RecordCount++;
	if ($skala_usaha_list->RecordCount >= $skala_usaha_list->StartRecord) {
		$skala_usaha_list->RowCount++;

		// Set up key count
		$skala_usaha_list->KeyCount = $skala_usaha_list->RowIndex;

		// Init row class and style
		$skala_usaha->resetAttributes();
		$skala_usaha->CssClass = "";
		if ($skala_usaha_list->isGridAdd()) {
		} else {
			$skala_usaha_list->loadRowValues($skala_usaha_list->Recordset); // Load row values
		}
		$skala_usaha->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$skala_usaha->RowAttrs->merge(["data-rowindex" => $skala_usaha_list->RowCount, "id" => "r" . $skala_usaha_list->RowCount . "_skala_usaha", "data-rowtype" => $skala_usaha->RowType]);

		// Render row
		$skala_usaha_list->renderRow();

		// Render list options
		$skala_usaha_list->renderListOptions();
?>
	<tr <?php echo $skala_usaha->rowAttributes() ?>>
<?php

// Render list options (body, left)
$skala_usaha_list->ListOptions->render("body", "left", $skala_usaha_list->RowCount);
?>
	<?php if ($skala_usaha_list->id_skala_usaha->Visible) { // id_skala_usaha ?>
		<td data-name="id_skala_usaha" <?php echo $skala_usaha_list->id_skala_usaha->cellAttributes() ?>>
<span id="el<?php echo $skala_usaha_list->RowCount ?>_skala_usaha_id_skala_usaha">
<span<?php echo $skala_usaha_list->id_skala_usaha->viewAttributes() ?>><?php echo $skala_usaha_list->id_skala_usaha->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($skala_usaha_list->skala_usaha->Visible) { // skala_usaha ?>
		<td data-name="skala_usaha" <?php echo $skala_usaha_list->skala_usaha->cellAttributes() ?>>
<span id="el<?php echo $skala_usaha_list->RowCount ?>_skala_usaha_skala_usaha">
<span<?php echo $skala_usaha_list->skala_usaha->viewAttributes() ?>><?php echo $skala_usaha_list->skala_usaha->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$skala_usaha_list->ListOptions->render("body", "right", $skala_usaha_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$skala_usaha_list->isGridAdd())
		$skala_usaha_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$skala_usaha->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($skala_usaha_list->Recordset)
	$skala_usaha_list->Recordset->Close();
?>
<?php if (!$skala_usaha_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$skala_usaha_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $skala_usaha_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $skala_usaha_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($skala_usaha_list->TotalRecords == 0 && !$skala_usaha->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $skala_usaha_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$skala_usaha_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$skala_usaha_list->isExport()) { ?>
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
$skala_usaha_list->terminate();
?>