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
$subsektor_list = new subsektor_list();

// Run the page
$subsektor_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$subsektor_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$subsektor_list->isExport()) { ?>
<script>
var fsubsektorlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fsubsektorlist = currentForm = new ew.Form("fsubsektorlist", "list");
	fsubsektorlist.formKeyCountName = '<?php echo $subsektor_list->FormKeyCountName ?>';
	loadjs.done("fsubsektorlist");
});
var fsubsektorlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fsubsektorlistsrch = currentSearchForm = new ew.Form("fsubsektorlistsrch");

	// Dynamic selection lists
	// Filters

	fsubsektorlistsrch.filterList = <?php echo $subsektor_list->getFilterList() ?>;
	loadjs.done("fsubsektorlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$subsektor_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($subsektor_list->TotalRecords > 0 && $subsektor_list->ExportOptions->visible()) { ?>
<?php $subsektor_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($subsektor_list->ImportOptions->visible()) { ?>
<?php $subsektor_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($subsektor_list->SearchOptions->visible()) { ?>
<?php $subsektor_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($subsektor_list->FilterOptions->visible()) { ?>
<?php $subsektor_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$subsektor_list->renderOtherOptions();
?>
<?php if (!$subsektor_list->isExport() && !$subsektor->CurrentAction) { ?>
<form name="fsubsektorlistsrch" id="fsubsektorlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsubsektorlistsrch-search-panel" class="<?php echo $subsektor_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="subsektor">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $subsektor_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($subsektor_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($subsektor_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $subsektor_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($subsektor_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($subsektor_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($subsektor_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($subsektor_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $subsektor_list->showPageHeader(); ?>
<?php
$subsektor_list->showMessage();
?>
<?php if ($subsektor_list->TotalRecords > 0 || $subsektor->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($subsektor_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> subsektor">
<form name="fsubsektorlist" id="fsubsektorlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="subsektor">
<div id="gmp_subsektor" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($subsektor_list->TotalRecords > 0 || $subsektor_list->isGridEdit()) { ?>
<table id="tbl_subsektorlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$subsektor->RowType = ROWTYPE_HEADER;

// Render list options
$subsektor_list->renderListOptions();

// Render list options (header, left)
$subsektor_list->ListOptions->render("header", "left");
?>
<?php if ($subsektor_list->id_subsektor->Visible) { // id_subsektor ?>
	<?php if ($subsektor_list->SortUrl($subsektor_list->id_subsektor) == "") { ?>
		<th data-name="id_subsektor" class="<?php echo $subsektor_list->id_subsektor->headerCellClass() ?>"><div id="elh_subsektor_id_subsektor" class="subsektor_id_subsektor"><div class="ew-table-header-caption"><?php echo $subsektor_list->id_subsektor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_subsektor" class="<?php echo $subsektor_list->id_subsektor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $subsektor_list->SortUrl($subsektor_list->id_subsektor) ?>', 1);"><div id="elh_subsektor_id_subsektor" class="subsektor_id_subsektor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $subsektor_list->id_subsektor->caption() ?></span><span class="ew-table-header-sort"><?php if ($subsektor_list->id_subsektor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($subsektor_list->id_subsektor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($subsektor_list->subsektor->Visible) { // subsektor ?>
	<?php if ($subsektor_list->SortUrl($subsektor_list->subsektor) == "") { ?>
		<th data-name="subsektor" class="<?php echo $subsektor_list->subsektor->headerCellClass() ?>"><div id="elh_subsektor_subsektor" class="subsektor_subsektor"><div class="ew-table-header-caption"><?php echo $subsektor_list->subsektor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="subsektor" class="<?php echo $subsektor_list->subsektor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $subsektor_list->SortUrl($subsektor_list->subsektor) ?>', 1);"><div id="elh_subsektor_subsektor" class="subsektor_subsektor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $subsektor_list->subsektor->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($subsektor_list->subsektor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($subsektor_list->subsektor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($subsektor_list->id_sektor->Visible) { // id_sektor ?>
	<?php if ($subsektor_list->SortUrl($subsektor_list->id_sektor) == "") { ?>
		<th data-name="id_sektor" class="<?php echo $subsektor_list->id_sektor->headerCellClass() ?>"><div id="elh_subsektor_id_sektor" class="subsektor_id_sektor"><div class="ew-table-header-caption"><?php echo $subsektor_list->id_sektor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_sektor" class="<?php echo $subsektor_list->id_sektor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $subsektor_list->SortUrl($subsektor_list->id_sektor) ?>', 1);"><div id="elh_subsektor_id_sektor" class="subsektor_id_sektor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $subsektor_list->id_sektor->caption() ?></span><span class="ew-table-header-sort"><?php if ($subsektor_list->id_sektor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($subsektor_list->id_sektor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$subsektor_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($subsektor_list->ExportAll && $subsektor_list->isExport()) {
	$subsektor_list->StopRecord = $subsektor_list->TotalRecords;
} else {

	// Set the last record to display
	if ($subsektor_list->TotalRecords > $subsektor_list->StartRecord + $subsektor_list->DisplayRecords - 1)
		$subsektor_list->StopRecord = $subsektor_list->StartRecord + $subsektor_list->DisplayRecords - 1;
	else
		$subsektor_list->StopRecord = $subsektor_list->TotalRecords;
}
$subsektor_list->RecordCount = $subsektor_list->StartRecord - 1;
if ($subsektor_list->Recordset && !$subsektor_list->Recordset->EOF) {
	$subsektor_list->Recordset->moveFirst();
	$selectLimit = $subsektor_list->UseSelectLimit;
	if (!$selectLimit && $subsektor_list->StartRecord > 1)
		$subsektor_list->Recordset->move($subsektor_list->StartRecord - 1);
} elseif (!$subsektor->AllowAddDeleteRow && $subsektor_list->StopRecord == 0) {
	$subsektor_list->StopRecord = $subsektor->GridAddRowCount;
}

// Initialize aggregate
$subsektor->RowType = ROWTYPE_AGGREGATEINIT;
$subsektor->resetAttributes();
$subsektor_list->renderRow();
while ($subsektor_list->RecordCount < $subsektor_list->StopRecord) {
	$subsektor_list->RecordCount++;
	if ($subsektor_list->RecordCount >= $subsektor_list->StartRecord) {
		$subsektor_list->RowCount++;

		// Set up key count
		$subsektor_list->KeyCount = $subsektor_list->RowIndex;

		// Init row class and style
		$subsektor->resetAttributes();
		$subsektor->CssClass = "";
		if ($subsektor_list->isGridAdd()) {
		} else {
			$subsektor_list->loadRowValues($subsektor_list->Recordset); // Load row values
		}
		$subsektor->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$subsektor->RowAttrs->merge(["data-rowindex" => $subsektor_list->RowCount, "id" => "r" . $subsektor_list->RowCount . "_subsektor", "data-rowtype" => $subsektor->RowType]);

		// Render row
		$subsektor_list->renderRow();

		// Render list options
		$subsektor_list->renderListOptions();
?>
	<tr <?php echo $subsektor->rowAttributes() ?>>
<?php

// Render list options (body, left)
$subsektor_list->ListOptions->render("body", "left", $subsektor_list->RowCount);
?>
	<?php if ($subsektor_list->id_subsektor->Visible) { // id_subsektor ?>
		<td data-name="id_subsektor" <?php echo $subsektor_list->id_subsektor->cellAttributes() ?>>
<span id="el<?php echo $subsektor_list->RowCount ?>_subsektor_id_subsektor">
<span<?php echo $subsektor_list->id_subsektor->viewAttributes() ?>><?php echo $subsektor_list->id_subsektor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($subsektor_list->subsektor->Visible) { // subsektor ?>
		<td data-name="subsektor" <?php echo $subsektor_list->subsektor->cellAttributes() ?>>
<span id="el<?php echo $subsektor_list->RowCount ?>_subsektor_subsektor">
<span<?php echo $subsektor_list->subsektor->viewAttributes() ?>><?php echo $subsektor_list->subsektor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($subsektor_list->id_sektor->Visible) { // id_sektor ?>
		<td data-name="id_sektor" <?php echo $subsektor_list->id_sektor->cellAttributes() ?>>
<span id="el<?php echo $subsektor_list->RowCount ?>_subsektor_id_sektor">
<span<?php echo $subsektor_list->id_sektor->viewAttributes() ?>><?php echo $subsektor_list->id_sektor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$subsektor_list->ListOptions->render("body", "right", $subsektor_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$subsektor_list->isGridAdd())
		$subsektor_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$subsektor->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($subsektor_list->Recordset)
	$subsektor_list->Recordset->Close();
?>
<?php if (!$subsektor_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$subsektor_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $subsektor_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $subsektor_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($subsektor_list->TotalRecords == 0 && !$subsektor->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $subsektor_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$subsektor_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$subsektor_list->isExport()) { ?>
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
$subsektor_list->terminate();
?>