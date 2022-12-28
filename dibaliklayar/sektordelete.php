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
$sektor_delete = new sektor_delete();

// Run the page
$sektor_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sektor_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsektordelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fsektordelete = currentForm = new ew.Form("fsektordelete", "delete");
	loadjs.done("fsektordelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $sektor_delete->showPageHeader(); ?>
<?php
$sektor_delete->showMessage();
?>
<form name="fsektordelete" id="fsektordelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sektor">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($sektor_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($sektor_delete->id_sektor->Visible) { // id_sektor ?>
		<th class="<?php echo $sektor_delete->id_sektor->headerCellClass() ?>"><span id="elh_sektor_id_sektor" class="sektor_id_sektor"><?php echo $sektor_delete->id_sektor->caption() ?></span></th>
<?php } ?>
<?php if ($sektor_delete->sektor->Visible) { // sektor ?>
		<th class="<?php echo $sektor_delete->sektor->headerCellClass() ?>"><span id="elh_sektor_sektor" class="sektor_sektor"><?php echo $sektor_delete->sektor->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$sektor_delete->RecordCount = 0;
$i = 0;
while (!$sektor_delete->Recordset->EOF) {
	$sektor_delete->RecordCount++;
	$sektor_delete->RowCount++;

	// Set row properties
	$sektor->resetAttributes();
	$sektor->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$sektor_delete->loadRowValues($sektor_delete->Recordset);

	// Render row
	$sektor_delete->renderRow();
?>
	<tr <?php echo $sektor->rowAttributes() ?>>
<?php if ($sektor_delete->id_sektor->Visible) { // id_sektor ?>
		<td <?php echo $sektor_delete->id_sektor->cellAttributes() ?>>
<span id="el<?php echo $sektor_delete->RowCount ?>_sektor_id_sektor" class="sektor_id_sektor">
<span<?php echo $sektor_delete->id_sektor->viewAttributes() ?>><?php echo $sektor_delete->id_sektor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sektor_delete->sektor->Visible) { // sektor ?>
		<td <?php echo $sektor_delete->sektor->cellAttributes() ?>>
<span id="el<?php echo $sektor_delete->RowCount ?>_sektor_sektor" class="sektor_sektor">
<span<?php echo $sektor_delete->sektor->viewAttributes() ?>><?php echo $sektor_delete->sektor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$sektor_delete->Recordset->moveNext();
}
$sektor_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $sektor_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$sektor_delete->showPageFooter();
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
$sektor_delete->terminate();
?>