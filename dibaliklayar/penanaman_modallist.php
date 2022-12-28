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
$penanaman_modal_list = new penanaman_modal_list();

// Run the page
$penanaman_modal_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penanaman_modal_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$penanaman_modal_list->isExport()) { ?>
<script>
var fpenanaman_modallist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpenanaman_modallist = currentForm = new ew.Form("fpenanaman_modallist", "list");
	fpenanaman_modallist.formKeyCountName = '<?php echo $penanaman_modal_list->FormKeyCountName ?>';
	loadjs.done("fpenanaman_modallist");
});
var fpenanaman_modallistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpenanaman_modallistsrch = currentSearchForm = new ew.Form("fpenanaman_modallistsrch");

	// Dynamic selection lists
	// Filters

	fpenanaman_modallistsrch.filterList = <?php echo $penanaman_modal_list->getFilterList() ?>;
	loadjs.done("fpenanaman_modallistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$penanaman_modal_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($penanaman_modal_list->TotalRecords > 0 && $penanaman_modal_list->ExportOptions->visible()) { ?>
<?php $penanaman_modal_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($penanaman_modal_list->ImportOptions->visible()) { ?>
<?php $penanaman_modal_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($penanaman_modal_list->SearchOptions->visible()) { ?>
<?php $penanaman_modal_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($penanaman_modal_list->FilterOptions->visible()) { ?>
<?php $penanaman_modal_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$penanaman_modal_list->renderOtherOptions();
?>
<?php if (!$penanaman_modal_list->isExport() && !$penanaman_modal->CurrentAction) { ?>
<form name="fpenanaman_modallistsrch" id="fpenanaman_modallistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpenanaman_modallistsrch-search-panel" class="<?php echo $penanaman_modal_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="penanaman_modal">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $penanaman_modal_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($penanaman_modal_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($penanaman_modal_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $penanaman_modal_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($penanaman_modal_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($penanaman_modal_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($penanaman_modal_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($penanaman_modal_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $penanaman_modal_list->showPageHeader(); ?>
<?php
$penanaman_modal_list->showMessage();
?>
<?php if ($penanaman_modal_list->TotalRecords > 0 || $penanaman_modal->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($penanaman_modal_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> penanaman_modal">
<form name="fpenanaman_modallist" id="fpenanaman_modallist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penanaman_modal">
<div id="gmp_penanaman_modal" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($penanaman_modal_list->TotalRecords > 0 || $penanaman_modal_list->isGridEdit()) { ?>
<table id="tbl_penanaman_modallist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$penanaman_modal->RowType = ROWTYPE_HEADER;

// Render list options
$penanaman_modal_list->renderListOptions();

// Render list options (header, left)
$penanaman_modal_list->ListOptions->render("header", "left");
?>
<?php if ($penanaman_modal_list->id_pm->Visible) { // id_pm ?>
	<?php if ($penanaman_modal_list->SortUrl($penanaman_modal_list->id_pm) == "") { ?>
		<th data-name="id_pm" class="<?php echo $penanaman_modal_list->id_pm->headerCellClass() ?>"><div id="elh_penanaman_modal_id_pm" class="penanaman_modal_id_pm"><div class="ew-table-header-caption"><?php echo $penanaman_modal_list->id_pm->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_pm" class="<?php echo $penanaman_modal_list->id_pm->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penanaman_modal_list->SortUrl($penanaman_modal_list->id_pm) ?>', 1);"><div id="elh_penanaman_modal_id_pm" class="penanaman_modal_id_pm">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penanaman_modal_list->id_pm->caption() ?></span><span class="ew-table-header-sort"><?php if ($penanaman_modal_list->id_pm->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penanaman_modal_list->id_pm->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penanaman_modal_list->penanaman_modal->Visible) { // penanaman_modal ?>
	<?php if ($penanaman_modal_list->SortUrl($penanaman_modal_list->penanaman_modal) == "") { ?>
		<th data-name="penanaman_modal" class="<?php echo $penanaman_modal_list->penanaman_modal->headerCellClass() ?>"><div id="elh_penanaman_modal_penanaman_modal" class="penanaman_modal_penanaman_modal"><div class="ew-table-header-caption"><?php echo $penanaman_modal_list->penanaman_modal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="penanaman_modal" class="<?php echo $penanaman_modal_list->penanaman_modal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penanaman_modal_list->SortUrl($penanaman_modal_list->penanaman_modal) ?>', 1);"><div id="elh_penanaman_modal_penanaman_modal" class="penanaman_modal_penanaman_modal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penanaman_modal_list->penanaman_modal->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($penanaman_modal_list->penanaman_modal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penanaman_modal_list->penanaman_modal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$penanaman_modal_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($penanaman_modal_list->ExportAll && $penanaman_modal_list->isExport()) {
	$penanaman_modal_list->StopRecord = $penanaman_modal_list->TotalRecords;
} else {

	// Set the last record to display
	if ($penanaman_modal_list->TotalRecords > $penanaman_modal_list->StartRecord + $penanaman_modal_list->DisplayRecords - 1)
		$penanaman_modal_list->StopRecord = $penanaman_modal_list->StartRecord + $penanaman_modal_list->DisplayRecords - 1;
	else
		$penanaman_modal_list->StopRecord = $penanaman_modal_list->TotalRecords;
}
$penanaman_modal_list->RecordCount = $penanaman_modal_list->StartRecord - 1;
if ($penanaman_modal_list->Recordset && !$penanaman_modal_list->Recordset->EOF) {
	$penanaman_modal_list->Recordset->moveFirst();
	$selectLimit = $penanaman_modal_list->UseSelectLimit;
	if (!$selectLimit && $penanaman_modal_list->StartRecord > 1)
		$penanaman_modal_list->Recordset->move($penanaman_modal_list->StartRecord - 1);
} elseif (!$penanaman_modal->AllowAddDeleteRow && $penanaman_modal_list->StopRecord == 0) {
	$penanaman_modal_list->StopRecord = $penanaman_modal->GridAddRowCount;
}

// Initialize aggregate
$penanaman_modal->RowType = ROWTYPE_AGGREGATEINIT;
$penanaman_modal->resetAttributes();
$penanaman_modal_list->renderRow();
while ($penanaman_modal_list->RecordCount < $penanaman_modal_list->StopRecord) {
	$penanaman_modal_list->RecordCount++;
	if ($penanaman_modal_list->RecordCount >= $penanaman_modal_list->StartRecord) {
		$penanaman_modal_list->RowCount++;

		// Set up key count
		$penanaman_modal_list->KeyCount = $penanaman_modal_list->RowIndex;

		// Init row class and style
		$penanaman_modal->resetAttributes();
		$penanaman_modal->CssClass = "";
		if ($penanaman_modal_list->isGridAdd()) {
		} else {
			$penanaman_modal_list->loadRowValues($penanaman_modal_list->Recordset); // Load row values
		}
		$penanaman_modal->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$penanaman_modal->RowAttrs->merge(["data-rowindex" => $penanaman_modal_list->RowCount, "id" => "r" . $penanaman_modal_list->RowCount . "_penanaman_modal", "data-rowtype" => $penanaman_modal->RowType]);

		// Render row
		$penanaman_modal_list->renderRow();

		// Render list options
		$penanaman_modal_list->renderListOptions();
?>
	<tr <?php echo $penanaman_modal->rowAttributes() ?>>
<?php

// Render list options (body, left)
$penanaman_modal_list->ListOptions->render("body", "left", $penanaman_modal_list->RowCount);
?>
	<?php if ($penanaman_modal_list->id_pm->Visible) { // id_pm ?>
		<td data-name="id_pm" <?php echo $penanaman_modal_list->id_pm->cellAttributes() ?>>
<span id="el<?php echo $penanaman_modal_list->RowCount ?>_penanaman_modal_id_pm">
<span<?php echo $penanaman_modal_list->id_pm->viewAttributes() ?>><?php echo $penanaman_modal_list->id_pm->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penanaman_modal_list->penanaman_modal->Visible) { // penanaman_modal ?>
		<td data-name="penanaman_modal" <?php echo $penanaman_modal_list->penanaman_modal->cellAttributes() ?>>
<span id="el<?php echo $penanaman_modal_list->RowCount ?>_penanaman_modal_penanaman_modal">
<span<?php echo $penanaman_modal_list->penanaman_modal->viewAttributes() ?>><?php echo $penanaman_modal_list->penanaman_modal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$penanaman_modal_list->ListOptions->render("body", "right", $penanaman_modal_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$penanaman_modal_list->isGridAdd())
		$penanaman_modal_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$penanaman_modal->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($penanaman_modal_list->Recordset)
	$penanaman_modal_list->Recordset->Close();
?>
<?php if (!$penanaman_modal_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$penanaman_modal_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $penanaman_modal_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $penanaman_modal_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($penanaman_modal_list->TotalRecords == 0 && !$penanaman_modal->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $penanaman_modal_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$penanaman_modal_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$penanaman_modal_list->isExport()) { ?>
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
$penanaman_modal_list->terminate();
?>