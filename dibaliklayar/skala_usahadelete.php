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
$skala_usaha_delete = new skala_usaha_delete();

// Run the page
$skala_usaha_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$skala_usaha_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fskala_usahadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fskala_usahadelete = currentForm = new ew.Form("fskala_usahadelete", "delete");
	loadjs.done("fskala_usahadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $skala_usaha_delete->showPageHeader(); ?>
<?php
$skala_usaha_delete->showMessage();
?>
<form name="fskala_usahadelete" id="fskala_usahadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="skala_usaha">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($skala_usaha_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($skala_usaha_delete->id_skala_usaha->Visible) { // id_skala_usaha ?>
		<th class="<?php echo $skala_usaha_delete->id_skala_usaha->headerCellClass() ?>"><span id="elh_skala_usaha_id_skala_usaha" class="skala_usaha_id_skala_usaha"><?php echo $skala_usaha_delete->id_skala_usaha->caption() ?></span></th>
<?php } ?>
<?php if ($skala_usaha_delete->skala_usaha->Visible) { // skala_usaha ?>
		<th class="<?php echo $skala_usaha_delete->skala_usaha->headerCellClass() ?>"><span id="elh_skala_usaha_skala_usaha" class="skala_usaha_skala_usaha"><?php echo $skala_usaha_delete->skala_usaha->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$skala_usaha_delete->RecordCount = 0;
$i = 0;
while (!$skala_usaha_delete->Recordset->EOF) {
	$skala_usaha_delete->RecordCount++;
	$skala_usaha_delete->RowCount++;

	// Set row properties
	$skala_usaha->resetAttributes();
	$skala_usaha->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$skala_usaha_delete->loadRowValues($skala_usaha_delete->Recordset);

	// Render row
	$skala_usaha_delete->renderRow();
?>
	<tr <?php echo $skala_usaha->rowAttributes() ?>>
<?php if ($skala_usaha_delete->id_skala_usaha->Visible) { // id_skala_usaha ?>
		<td <?php echo $skala_usaha_delete->id_skala_usaha->cellAttributes() ?>>
<span id="el<?php echo $skala_usaha_delete->RowCount ?>_skala_usaha_id_skala_usaha" class="skala_usaha_id_skala_usaha">
<span<?php echo $skala_usaha_delete->id_skala_usaha->viewAttributes() ?>><?php echo $skala_usaha_delete->id_skala_usaha->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($skala_usaha_delete->skala_usaha->Visible) { // skala_usaha ?>
		<td <?php echo $skala_usaha_delete->skala_usaha->cellAttributes() ?>>
<span id="el<?php echo $skala_usaha_delete->RowCount ?>_skala_usaha_skala_usaha" class="skala_usaha_skala_usaha">
<span<?php echo $skala_usaha_delete->skala_usaha->viewAttributes() ?>><?php echo $skala_usaha_delete->skala_usaha->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$skala_usaha_delete->Recordset->moveNext();
}
$skala_usaha_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $skala_usaha_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$skala_usaha_delete->showPageFooter();
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
$skala_usaha_delete->terminate();
?>