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
$jenis_badan_usaha_delete = new jenis_badan_usaha_delete();

// Run the page
$jenis_badan_usaha_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jenis_badan_usaha_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fjenis_badan_usahadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fjenis_badan_usahadelete = currentForm = new ew.Form("fjenis_badan_usahadelete", "delete");
	loadjs.done("fjenis_badan_usahadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $jenis_badan_usaha_delete->showPageHeader(); ?>
<?php
$jenis_badan_usaha_delete->showMessage();
?>
<form name="fjenis_badan_usahadelete" id="fjenis_badan_usahadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jenis_badan_usaha">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($jenis_badan_usaha_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($jenis_badan_usaha_delete->id_jbu->Visible) { // id_jbu ?>
		<th class="<?php echo $jenis_badan_usaha_delete->id_jbu->headerCellClass() ?>"><span id="elh_jenis_badan_usaha_id_jbu" class="jenis_badan_usaha_id_jbu"><?php echo $jenis_badan_usaha_delete->id_jbu->caption() ?></span></th>
<?php } ?>
<?php if ($jenis_badan_usaha_delete->jenis_perusahaan->Visible) { // jenis_perusahaan ?>
		<th class="<?php echo $jenis_badan_usaha_delete->jenis_perusahaan->headerCellClass() ?>"><span id="elh_jenis_badan_usaha_jenis_perusahaan" class="jenis_badan_usaha_jenis_perusahaan"><?php echo $jenis_badan_usaha_delete->jenis_perusahaan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$jenis_badan_usaha_delete->RecordCount = 0;
$i = 0;
while (!$jenis_badan_usaha_delete->Recordset->EOF) {
	$jenis_badan_usaha_delete->RecordCount++;
	$jenis_badan_usaha_delete->RowCount++;

	// Set row properties
	$jenis_badan_usaha->resetAttributes();
	$jenis_badan_usaha->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$jenis_badan_usaha_delete->loadRowValues($jenis_badan_usaha_delete->Recordset);

	// Render row
	$jenis_badan_usaha_delete->renderRow();
?>
	<tr <?php echo $jenis_badan_usaha->rowAttributes() ?>>
<?php if ($jenis_badan_usaha_delete->id_jbu->Visible) { // id_jbu ?>
		<td <?php echo $jenis_badan_usaha_delete->id_jbu->cellAttributes() ?>>
<span id="el<?php echo $jenis_badan_usaha_delete->RowCount ?>_jenis_badan_usaha_id_jbu" class="jenis_badan_usaha_id_jbu">
<span<?php echo $jenis_badan_usaha_delete->id_jbu->viewAttributes() ?>><?php echo $jenis_badan_usaha_delete->id_jbu->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jenis_badan_usaha_delete->jenis_perusahaan->Visible) { // jenis_perusahaan ?>
		<td <?php echo $jenis_badan_usaha_delete->jenis_perusahaan->cellAttributes() ?>>
<span id="el<?php echo $jenis_badan_usaha_delete->RowCount ?>_jenis_badan_usaha_jenis_perusahaan" class="jenis_badan_usaha_jenis_perusahaan">
<span<?php echo $jenis_badan_usaha_delete->jenis_perusahaan->viewAttributes() ?>><?php echo $jenis_badan_usaha_delete->jenis_perusahaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$jenis_badan_usaha_delete->Recordset->moveNext();
}
$jenis_badan_usaha_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $jenis_badan_usaha_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$jenis_badan_usaha_delete->showPageFooter();
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
$jenis_badan_usaha_delete->terminate();
?>