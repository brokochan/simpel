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
$jenis_badan_usaha_list = new jenis_badan_usaha_list();

// Run the page
$jenis_badan_usaha_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jenis_badan_usaha_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$jenis_badan_usaha_list->isExport()) { ?>
<script>
var fjenis_badan_usahalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fjenis_badan_usahalist = currentForm = new ew.Form("fjenis_badan_usahalist", "list");
	fjenis_badan_usahalist.formKeyCountName = '<?php echo $jenis_badan_usaha_list->FormKeyCountName ?>';
	loadjs.done("fjenis_badan_usahalist");
});
var fjenis_badan_usahalistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fjenis_badan_usahalistsrch = currentSearchForm = new ew.Form("fjenis_badan_usahalistsrch");

	// Dynamic selection lists
	// Filters

	fjenis_badan_usahalistsrch.filterList = <?php echo $jenis_badan_usaha_list->getFilterList() ?>;
	loadjs.done("fjenis_badan_usahalistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$jenis_badan_usaha_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($jenis_badan_usaha_list->TotalRecords > 0 && $jenis_badan_usaha_list->ExportOptions->visible()) { ?>
<?php $jenis_badan_usaha_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($jenis_badan_usaha_list->ImportOptions->visible()) { ?>
<?php $jenis_badan_usaha_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($jenis_badan_usaha_list->SearchOptions->visible()) { ?>
<?php $jenis_badan_usaha_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($jenis_badan_usaha_list->FilterOptions->visible()) { ?>
<?php $jenis_badan_usaha_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$jenis_badan_usaha_list->renderOtherOptions();
?>
<?php if (!$jenis_badan_usaha_list->isExport() && !$jenis_badan_usaha->CurrentAction) { ?>
<form name="fjenis_badan_usahalistsrch" id="fjenis_badan_usahalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fjenis_badan_usahalistsrch-search-panel" class="<?php echo $jenis_badan_usaha_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="jenis_badan_usaha">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $jenis_badan_usaha_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($jenis_badan_usaha_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($jenis_badan_usaha_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $jenis_badan_usaha_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($jenis_badan_usaha_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($jenis_badan_usaha_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($jenis_badan_usaha_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($jenis_badan_usaha_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $jenis_badan_usaha_list->showPageHeader(); ?>
<?php
$jenis_badan_usaha_list->showMessage();
?>
<?php if ($jenis_badan_usaha_list->TotalRecords > 0 || $jenis_badan_usaha->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($jenis_badan_usaha_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> jenis_badan_usaha">
<form name="fjenis_badan_usahalist" id="fjenis_badan_usahalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jenis_badan_usaha">
<div id="gmp_jenis_badan_usaha" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($jenis_badan_usaha_list->TotalRecords > 0 || $jenis_badan_usaha_list->isGridEdit()) { ?>
<table id="tbl_jenis_badan_usahalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$jenis_badan_usaha->RowType = ROWTYPE_HEADER;

// Render list options
$jenis_badan_usaha_list->renderListOptions();

// Render list options (header, left)
$jenis_badan_usaha_list->ListOptions->render("header", "left");
?>
<?php if ($jenis_badan_usaha_list->id_jbu->Visible) { // id_jbu ?>
	<?php if ($jenis_badan_usaha_list->SortUrl($jenis_badan_usaha_list->id_jbu) == "") { ?>
		<th data-name="id_jbu" class="<?php echo $jenis_badan_usaha_list->id_jbu->headerCellClass() ?>"><div id="elh_jenis_badan_usaha_id_jbu" class="jenis_badan_usaha_id_jbu"><div class="ew-table-header-caption"><?php echo $jenis_badan_usaha_list->id_jbu->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_jbu" class="<?php echo $jenis_badan_usaha_list->id_jbu->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jenis_badan_usaha_list->SortUrl($jenis_badan_usaha_list->id_jbu) ?>', 1);"><div id="elh_jenis_badan_usaha_id_jbu" class="jenis_badan_usaha_id_jbu">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jenis_badan_usaha_list->id_jbu->caption() ?></span><span class="ew-table-header-sort"><?php if ($jenis_badan_usaha_list->id_jbu->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jenis_badan_usaha_list->id_jbu->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($jenis_badan_usaha_list->jenis_perusahaan->Visible) { // jenis_perusahaan ?>
	<?php if ($jenis_badan_usaha_list->SortUrl($jenis_badan_usaha_list->jenis_perusahaan) == "") { ?>
		<th data-name="jenis_perusahaan" class="<?php echo $jenis_badan_usaha_list->jenis_perusahaan->headerCellClass() ?>"><div id="elh_jenis_badan_usaha_jenis_perusahaan" class="jenis_badan_usaha_jenis_perusahaan"><div class="ew-table-header-caption"><?php echo $jenis_badan_usaha_list->jenis_perusahaan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis_perusahaan" class="<?php echo $jenis_badan_usaha_list->jenis_perusahaan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jenis_badan_usaha_list->SortUrl($jenis_badan_usaha_list->jenis_perusahaan) ?>', 1);"><div id="elh_jenis_badan_usaha_jenis_perusahaan" class="jenis_badan_usaha_jenis_perusahaan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jenis_badan_usaha_list->jenis_perusahaan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($jenis_badan_usaha_list->jenis_perusahaan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jenis_badan_usaha_list->jenis_perusahaan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$jenis_badan_usaha_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($jenis_badan_usaha_list->ExportAll && $jenis_badan_usaha_list->isExport()) {
	$jenis_badan_usaha_list->StopRecord = $jenis_badan_usaha_list->TotalRecords;
} else {

	// Set the last record to display
	if ($jenis_badan_usaha_list->TotalRecords > $jenis_badan_usaha_list->StartRecord + $jenis_badan_usaha_list->DisplayRecords - 1)
		$jenis_badan_usaha_list->StopRecord = $jenis_badan_usaha_list->StartRecord + $jenis_badan_usaha_list->DisplayRecords - 1;
	else
		$jenis_badan_usaha_list->StopRecord = $jenis_badan_usaha_list->TotalRecords;
}
$jenis_badan_usaha_list->RecordCount = $jenis_badan_usaha_list->StartRecord - 1;
if ($jenis_badan_usaha_list->Recordset && !$jenis_badan_usaha_list->Recordset->EOF) {
	$jenis_badan_usaha_list->Recordset->moveFirst();
	$selectLimit = $jenis_badan_usaha_list->UseSelectLimit;
	if (!$selectLimit && $jenis_badan_usaha_list->StartRecord > 1)
		$jenis_badan_usaha_list->Recordset->move($jenis_badan_usaha_list->StartRecord - 1);
} elseif (!$jenis_badan_usaha->AllowAddDeleteRow && $jenis_badan_usaha_list->StopRecord == 0) {
	$jenis_badan_usaha_list->StopRecord = $jenis_badan_usaha->GridAddRowCount;
}

// Initialize aggregate
$jenis_badan_usaha->RowType = ROWTYPE_AGGREGATEINIT;
$jenis_badan_usaha->resetAttributes();
$jenis_badan_usaha_list->renderRow();
while ($jenis_badan_usaha_list->RecordCount < $jenis_badan_usaha_list->StopRecord) {
	$jenis_badan_usaha_list->RecordCount++;
	if ($jenis_badan_usaha_list->RecordCount >= $jenis_badan_usaha_list->StartRecord) {
		$jenis_badan_usaha_list->RowCount++;

		// Set up key count
		$jenis_badan_usaha_list->KeyCount = $jenis_badan_usaha_list->RowIndex;

		// Init row class and style
		$jenis_badan_usaha->resetAttributes();
		$jenis_badan_usaha->CssClass = "";
		if ($jenis_badan_usaha_list->isGridAdd()) {
		} else {
			$jenis_badan_usaha_list->loadRowValues($jenis_badan_usaha_list->Recordset); // Load row values
		}
		$jenis_badan_usaha->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$jenis_badan_usaha->RowAttrs->merge(["data-rowindex" => $jenis_badan_usaha_list->RowCount, "id" => "r" . $jenis_badan_usaha_list->RowCount . "_jenis_badan_usaha", "data-rowtype" => $jenis_badan_usaha->RowType]);

		// Render row
		$jenis_badan_usaha_list->renderRow();

		// Render list options
		$jenis_badan_usaha_list->renderListOptions();
?>
	<tr <?php echo $jenis_badan_usaha->rowAttributes() ?>>
<?php

// Render list options (body, left)
$jenis_badan_usaha_list->ListOptions->render("body", "left", $jenis_badan_usaha_list->RowCount);
?>
	<?php if ($jenis_badan_usaha_list->id_jbu->Visible) { // id_jbu ?>
		<td data-name="id_jbu" <?php echo $jenis_badan_usaha_list->id_jbu->cellAttributes() ?>>
<span id="el<?php echo $jenis_badan_usaha_list->RowCount ?>_jenis_badan_usaha_id_jbu">
<span<?php echo $jenis_badan_usaha_list->id_jbu->viewAttributes() ?>><?php echo $jenis_badan_usaha_list->id_jbu->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($jenis_badan_usaha_list->jenis_perusahaan->Visible) { // jenis_perusahaan ?>
		<td data-name="jenis_perusahaan" <?php echo $jenis_badan_usaha_list->jenis_perusahaan->cellAttributes() ?>>
<span id="el<?php echo $jenis_badan_usaha_list->RowCount ?>_jenis_badan_usaha_jenis_perusahaan">
<span<?php echo $jenis_badan_usaha_list->jenis_perusahaan->viewAttributes() ?>><?php echo $jenis_badan_usaha_list->jenis_perusahaan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$jenis_badan_usaha_list->ListOptions->render("body", "right", $jenis_badan_usaha_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$jenis_badan_usaha_list->isGridAdd())
		$jenis_badan_usaha_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$jenis_badan_usaha->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($jenis_badan_usaha_list->Recordset)
	$jenis_badan_usaha_list->Recordset->Close();
?>
<?php if (!$jenis_badan_usaha_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$jenis_badan_usaha_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $jenis_badan_usaha_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $jenis_badan_usaha_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($jenis_badan_usaha_list->TotalRecords == 0 && !$jenis_badan_usaha->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $jenis_badan_usaha_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$jenis_badan_usaha_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$jenis_badan_usaha_list->isExport()) { ?>
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
$jenis_badan_usaha_list->terminate();
?>