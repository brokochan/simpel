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
$jenis_izin_list = new jenis_izin_list();

// Run the page
$jenis_izin_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jenis_izin_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$jenis_izin_list->isExport()) { ?>
<script>
var fjenis_izinlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fjenis_izinlist = currentForm = new ew.Form("fjenis_izinlist", "list");
	fjenis_izinlist.formKeyCountName = '<?php echo $jenis_izin_list->FormKeyCountName ?>';
	loadjs.done("fjenis_izinlist");
});
var fjenis_izinlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fjenis_izinlistsrch = currentSearchForm = new ew.Form("fjenis_izinlistsrch");

	// Dynamic selection lists
	// Filters

	fjenis_izinlistsrch.filterList = <?php echo $jenis_izin_list->getFilterList() ?>;
	loadjs.done("fjenis_izinlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$jenis_izin_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($jenis_izin_list->TotalRecords > 0 && $jenis_izin_list->ExportOptions->visible()) { ?>
<?php $jenis_izin_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($jenis_izin_list->ImportOptions->visible()) { ?>
<?php $jenis_izin_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($jenis_izin_list->SearchOptions->visible()) { ?>
<?php $jenis_izin_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($jenis_izin_list->FilterOptions->visible()) { ?>
<?php $jenis_izin_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$jenis_izin_list->renderOtherOptions();
?>
<?php if (!$jenis_izin_list->isExport() && !$jenis_izin->CurrentAction) { ?>
<form name="fjenis_izinlistsrch" id="fjenis_izinlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fjenis_izinlistsrch-search-panel" class="<?php echo $jenis_izin_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="jenis_izin">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $jenis_izin_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($jenis_izin_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($jenis_izin_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $jenis_izin_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($jenis_izin_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($jenis_izin_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($jenis_izin_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($jenis_izin_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $jenis_izin_list->showPageHeader(); ?>
<?php
$jenis_izin_list->showMessage();
?>
<?php if ($jenis_izin_list->TotalRecords > 0 || $jenis_izin->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($jenis_izin_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> jenis_izin">
<form name="fjenis_izinlist" id="fjenis_izinlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jenis_izin">
<div id="gmp_jenis_izin" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($jenis_izin_list->TotalRecords > 0 || $jenis_izin_list->isGridEdit()) { ?>
<table id="tbl_jenis_izinlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$jenis_izin->RowType = ROWTYPE_HEADER;

// Render list options
$jenis_izin_list->renderListOptions();

// Render list options (header, left)
$jenis_izin_list->ListOptions->render("header", "left");
?>
<?php if ($jenis_izin_list->id_jenis_izin->Visible) { // id_jenis_izin ?>
	<?php if ($jenis_izin_list->SortUrl($jenis_izin_list->id_jenis_izin) == "") { ?>
		<th data-name="id_jenis_izin" class="<?php echo $jenis_izin_list->id_jenis_izin->headerCellClass() ?>"><div id="elh_jenis_izin_id_jenis_izin" class="jenis_izin_id_jenis_izin"><div class="ew-table-header-caption"><?php echo $jenis_izin_list->id_jenis_izin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_jenis_izin" class="<?php echo $jenis_izin_list->id_jenis_izin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jenis_izin_list->SortUrl($jenis_izin_list->id_jenis_izin) ?>', 1);"><div id="elh_jenis_izin_id_jenis_izin" class="jenis_izin_id_jenis_izin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jenis_izin_list->id_jenis_izin->caption() ?></span><span class="ew-table-header-sort"><?php if ($jenis_izin_list->id_jenis_izin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jenis_izin_list->id_jenis_izin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($jenis_izin_list->jenis_izin->Visible) { // jenis_izin ?>
	<?php if ($jenis_izin_list->SortUrl($jenis_izin_list->jenis_izin) == "") { ?>
		<th data-name="jenis_izin" class="<?php echo $jenis_izin_list->jenis_izin->headerCellClass() ?>"><div id="elh_jenis_izin_jenis_izin" class="jenis_izin_jenis_izin"><div class="ew-table-header-caption"><?php echo $jenis_izin_list->jenis_izin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis_izin" class="<?php echo $jenis_izin_list->jenis_izin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jenis_izin_list->SortUrl($jenis_izin_list->jenis_izin) ?>', 1);"><div id="elh_jenis_izin_jenis_izin" class="jenis_izin_jenis_izin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jenis_izin_list->jenis_izin->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($jenis_izin_list->jenis_izin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jenis_izin_list->jenis_izin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$jenis_izin_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($jenis_izin_list->ExportAll && $jenis_izin_list->isExport()) {
	$jenis_izin_list->StopRecord = $jenis_izin_list->TotalRecords;
} else {

	// Set the last record to display
	if ($jenis_izin_list->TotalRecords > $jenis_izin_list->StartRecord + $jenis_izin_list->DisplayRecords - 1)
		$jenis_izin_list->StopRecord = $jenis_izin_list->StartRecord + $jenis_izin_list->DisplayRecords - 1;
	else
		$jenis_izin_list->StopRecord = $jenis_izin_list->TotalRecords;
}
$jenis_izin_list->RecordCount = $jenis_izin_list->StartRecord - 1;
if ($jenis_izin_list->Recordset && !$jenis_izin_list->Recordset->EOF) {
	$jenis_izin_list->Recordset->moveFirst();
	$selectLimit = $jenis_izin_list->UseSelectLimit;
	if (!$selectLimit && $jenis_izin_list->StartRecord > 1)
		$jenis_izin_list->Recordset->move($jenis_izin_list->StartRecord - 1);
} elseif (!$jenis_izin->AllowAddDeleteRow && $jenis_izin_list->StopRecord == 0) {
	$jenis_izin_list->StopRecord = $jenis_izin->GridAddRowCount;
}

// Initialize aggregate
$jenis_izin->RowType = ROWTYPE_AGGREGATEINIT;
$jenis_izin->resetAttributes();
$jenis_izin_list->renderRow();
while ($jenis_izin_list->RecordCount < $jenis_izin_list->StopRecord) {
	$jenis_izin_list->RecordCount++;
	if ($jenis_izin_list->RecordCount >= $jenis_izin_list->StartRecord) {
		$jenis_izin_list->RowCount++;

		// Set up key count
		$jenis_izin_list->KeyCount = $jenis_izin_list->RowIndex;

		// Init row class and style
		$jenis_izin->resetAttributes();
		$jenis_izin->CssClass = "";
		if ($jenis_izin_list->isGridAdd()) {
		} else {
			$jenis_izin_list->loadRowValues($jenis_izin_list->Recordset); // Load row values
		}
		$jenis_izin->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$jenis_izin->RowAttrs->merge(["data-rowindex" => $jenis_izin_list->RowCount, "id" => "r" . $jenis_izin_list->RowCount . "_jenis_izin", "data-rowtype" => $jenis_izin->RowType]);

		// Render row
		$jenis_izin_list->renderRow();

		// Render list options
		$jenis_izin_list->renderListOptions();
?>
	<tr <?php echo $jenis_izin->rowAttributes() ?>>
<?php

// Render list options (body, left)
$jenis_izin_list->ListOptions->render("body", "left", $jenis_izin_list->RowCount);
?>
	<?php if ($jenis_izin_list->id_jenis_izin->Visible) { // id_jenis_izin ?>
		<td data-name="id_jenis_izin" <?php echo $jenis_izin_list->id_jenis_izin->cellAttributes() ?>>
<span id="el<?php echo $jenis_izin_list->RowCount ?>_jenis_izin_id_jenis_izin">
<span<?php echo $jenis_izin_list->id_jenis_izin->viewAttributes() ?>><?php echo $jenis_izin_list->id_jenis_izin->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($jenis_izin_list->jenis_izin->Visible) { // jenis_izin ?>
		<td data-name="jenis_izin" <?php echo $jenis_izin_list->jenis_izin->cellAttributes() ?>>
<span id="el<?php echo $jenis_izin_list->RowCount ?>_jenis_izin_jenis_izin">
<span<?php echo $jenis_izin_list->jenis_izin->viewAttributes() ?>><?php echo $jenis_izin_list->jenis_izin->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$jenis_izin_list->ListOptions->render("body", "right", $jenis_izin_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$jenis_izin_list->isGridAdd())
		$jenis_izin_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$jenis_izin->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($jenis_izin_list->Recordset)
	$jenis_izin_list->Recordset->Close();
?>
<?php if (!$jenis_izin_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$jenis_izin_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $jenis_izin_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $jenis_izin_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($jenis_izin_list->TotalRecords == 0 && !$jenis_izin->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $jenis_izin_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$jenis_izin_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$jenis_izin_list->isExport()) { ?>
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
$jenis_izin_list->terminate();
?>