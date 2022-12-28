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
$hak_akses_delete = new hak_akses_delete();

// Run the page
$hak_akses_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$hak_akses_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fhak_aksesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fhak_aksesdelete = currentForm = new ew.Form("fhak_aksesdelete", "delete");
	loadjs.done("fhak_aksesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $hak_akses_delete->showPageHeader(); ?>
<?php
$hak_akses_delete->showMessage();
?>
<form name="fhak_aksesdelete" id="fhak_aksesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="hak_akses">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($hak_akses_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($hak_akses_delete->id_hak_akses->Visible) { // id_hak_akses ?>
		<th class="<?php echo $hak_akses_delete->id_hak_akses->headerCellClass() ?>"><span id="elh_hak_akses_id_hak_akses" class="hak_akses_id_hak_akses"><?php echo $hak_akses_delete->id_hak_akses->caption() ?></span></th>
<?php } ?>
<?php if ($hak_akses_delete->hak_akses->Visible) { // hak_akses ?>
		<th class="<?php echo $hak_akses_delete->hak_akses->headerCellClass() ?>"><span id="elh_hak_akses_hak_akses" class="hak_akses_hak_akses"><?php echo $hak_akses_delete->hak_akses->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$hak_akses_delete->RecordCount = 0;
$i = 0;
while (!$hak_akses_delete->Recordset->EOF) {
	$hak_akses_delete->RecordCount++;
	$hak_akses_delete->RowCount++;

	// Set row properties
	$hak_akses->resetAttributes();
	$hak_akses->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$hak_akses_delete->loadRowValues($hak_akses_delete->Recordset);

	// Render row
	$hak_akses_delete->renderRow();
?>
	<tr <?php echo $hak_akses->rowAttributes() ?>>
<?php if ($hak_akses_delete->id_hak_akses->Visible) { // id_hak_akses ?>
		<td <?php echo $hak_akses_delete->id_hak_akses->cellAttributes() ?>>
<span id="el<?php echo $hak_akses_delete->RowCount ?>_hak_akses_id_hak_akses" class="hak_akses_id_hak_akses">
<span<?php echo $hak_akses_delete->id_hak_akses->viewAttributes() ?>><?php echo $hak_akses_delete->id_hak_akses->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($hak_akses_delete->hak_akses->Visible) { // hak_akses ?>
		<td <?php echo $hak_akses_delete->hak_akses->cellAttributes() ?>>
<span id="el<?php echo $hak_akses_delete->RowCount ?>_hak_akses_hak_akses" class="hak_akses_hak_akses">
<span<?php echo $hak_akses_delete->hak_akses->viewAttributes() ?>><?php echo $hak_akses_delete->hak_akses->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$hak_akses_delete->Recordset->moveNext();
}
$hak_akses_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $hak_akses_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$hak_akses_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$hak_akses_delete->terminate();
?>