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
$kecamatan_delete = new kecamatan_delete();

// Run the page
$kecamatan_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kecamatan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkecamatandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fkecamatandelete = currentForm = new ew.Form("fkecamatandelete", "delete");
	loadjs.done("fkecamatandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $kecamatan_delete->showPageHeader(); ?>
<?php
$kecamatan_delete->showMessage();
?>
<form name="fkecamatandelete" id="fkecamatandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kecamatan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($kecamatan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($kecamatan_delete->id_kecamatan->Visible) { // id_kecamatan ?>
		<th class="<?php echo $kecamatan_delete->id_kecamatan->headerCellClass() ?>"><span id="elh_kecamatan_id_kecamatan" class="kecamatan_id_kecamatan"><?php echo $kecamatan_delete->id_kecamatan->caption() ?></span></th>
<?php } ?>
<?php if ($kecamatan_delete->kecamatan->Visible) { // kecamatan ?>
		<th class="<?php echo $kecamatan_delete->kecamatan->headerCellClass() ?>"><span id="elh_kecamatan_kecamatan" class="kecamatan_kecamatan"><?php echo $kecamatan_delete->kecamatan->caption() ?></span></th>
<?php } ?>
<?php if ($kecamatan_delete->kodepos->Visible) { // kodepos ?>
		<th class="<?php echo $kecamatan_delete->kodepos->headerCellClass() ?>"><span id="elh_kecamatan_kodepos" class="kecamatan_kodepos"><?php echo $kecamatan_delete->kodepos->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$kecamatan_delete->RecordCount = 0;
$i = 0;
while (!$kecamatan_delete->Recordset->EOF) {
	$kecamatan_delete->RecordCount++;
	$kecamatan_delete->RowCount++;

	// Set row properties
	$kecamatan->resetAttributes();
	$kecamatan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$kecamatan_delete->loadRowValues($kecamatan_delete->Recordset);

	// Render row
	$kecamatan_delete->renderRow();
?>
	<tr <?php echo $kecamatan->rowAttributes() ?>>
<?php if ($kecamatan_delete->id_kecamatan->Visible) { // id_kecamatan ?>
		<td <?php echo $kecamatan_delete->id_kecamatan->cellAttributes() ?>>
<span id="el<?php echo $kecamatan_delete->RowCount ?>_kecamatan_id_kecamatan" class="kecamatan_id_kecamatan">
<span<?php echo $kecamatan_delete->id_kecamatan->viewAttributes() ?>><?php echo $kecamatan_delete->id_kecamatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kecamatan_delete->kecamatan->Visible) { // kecamatan ?>
		<td <?php echo $kecamatan_delete->kecamatan->cellAttributes() ?>>
<span id="el<?php echo $kecamatan_delete->RowCount ?>_kecamatan_kecamatan" class="kecamatan_kecamatan">
<span<?php echo $kecamatan_delete->kecamatan->viewAttributes() ?>><?php echo $kecamatan_delete->kecamatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kecamatan_delete->kodepos->Visible) { // kodepos ?>
		<td <?php echo $kecamatan_delete->kodepos->cellAttributes() ?>>
<span id="el<?php echo $kecamatan_delete->RowCount ?>_kecamatan_kodepos" class="kecamatan_kodepos">
<span<?php echo $kecamatan_delete->kodepos->viewAttributes() ?>><?php echo $kecamatan_delete->kodepos->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$kecamatan_delete->Recordset->moveNext();
}
$kecamatan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $kecamatan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$kecamatan_delete->showPageFooter();
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
$kecamatan_delete->terminate();
?>