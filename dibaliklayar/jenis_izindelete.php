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
$jenis_izin_delete = new jenis_izin_delete();

// Run the page
$jenis_izin_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jenis_izin_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fjenis_izindelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fjenis_izindelete = currentForm = new ew.Form("fjenis_izindelete", "delete");
	loadjs.done("fjenis_izindelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $jenis_izin_delete->showPageHeader(); ?>
<?php
$jenis_izin_delete->showMessage();
?>
<form name="fjenis_izindelete" id="fjenis_izindelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jenis_izin">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($jenis_izin_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($jenis_izin_delete->id_jenis_izin->Visible) { // id_jenis_izin ?>
		<th class="<?php echo $jenis_izin_delete->id_jenis_izin->headerCellClass() ?>"><span id="elh_jenis_izin_id_jenis_izin" class="jenis_izin_id_jenis_izin"><?php echo $jenis_izin_delete->id_jenis_izin->caption() ?></span></th>
<?php } ?>
<?php if ($jenis_izin_delete->jenis_izin->Visible) { // jenis_izin ?>
		<th class="<?php echo $jenis_izin_delete->jenis_izin->headerCellClass() ?>"><span id="elh_jenis_izin_jenis_izin" class="jenis_izin_jenis_izin"><?php echo $jenis_izin_delete->jenis_izin->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$jenis_izin_delete->RecordCount = 0;
$i = 0;
while (!$jenis_izin_delete->Recordset->EOF) {
	$jenis_izin_delete->RecordCount++;
	$jenis_izin_delete->RowCount++;

	// Set row properties
	$jenis_izin->resetAttributes();
	$jenis_izin->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$jenis_izin_delete->loadRowValues($jenis_izin_delete->Recordset);

	// Render row
	$jenis_izin_delete->renderRow();
?>
	<tr <?php echo $jenis_izin->rowAttributes() ?>>
<?php if ($jenis_izin_delete->id_jenis_izin->Visible) { // id_jenis_izin ?>
		<td <?php echo $jenis_izin_delete->id_jenis_izin->cellAttributes() ?>>
<span id="el<?php echo $jenis_izin_delete->RowCount ?>_jenis_izin_id_jenis_izin" class="jenis_izin_id_jenis_izin">
<span<?php echo $jenis_izin_delete->id_jenis_izin->viewAttributes() ?>><?php echo $jenis_izin_delete->id_jenis_izin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jenis_izin_delete->jenis_izin->Visible) { // jenis_izin ?>
		<td <?php echo $jenis_izin_delete->jenis_izin->cellAttributes() ?>>
<span id="el<?php echo $jenis_izin_delete->RowCount ?>_jenis_izin_jenis_izin" class="jenis_izin_jenis_izin">
<span<?php echo $jenis_izin_delete->jenis_izin->viewAttributes() ?>><?php echo $jenis_izin_delete->jenis_izin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$jenis_izin_delete->Recordset->moveNext();
}
$jenis_izin_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $jenis_izin_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$jenis_izin_delete->showPageFooter();
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
$jenis_izin_delete->terminate();
?>