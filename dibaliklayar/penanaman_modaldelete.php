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
$penanaman_modal_delete = new penanaman_modal_delete();

// Run the page
$penanaman_modal_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penanaman_modal_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpenanaman_modaldelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpenanaman_modaldelete = currentForm = new ew.Form("fpenanaman_modaldelete", "delete");
	loadjs.done("fpenanaman_modaldelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $penanaman_modal_delete->showPageHeader(); ?>
<?php
$penanaman_modal_delete->showMessage();
?>
<form name="fpenanaman_modaldelete" id="fpenanaman_modaldelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penanaman_modal">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($penanaman_modal_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($penanaman_modal_delete->id_pm->Visible) { // id_pm ?>
		<th class="<?php echo $penanaman_modal_delete->id_pm->headerCellClass() ?>"><span id="elh_penanaman_modal_id_pm" class="penanaman_modal_id_pm"><?php echo $penanaman_modal_delete->id_pm->caption() ?></span></th>
<?php } ?>
<?php if ($penanaman_modal_delete->penanaman_modal->Visible) { // penanaman_modal ?>
		<th class="<?php echo $penanaman_modal_delete->penanaman_modal->headerCellClass() ?>"><span id="elh_penanaman_modal_penanaman_modal" class="penanaman_modal_penanaman_modal"><?php echo $penanaman_modal_delete->penanaman_modal->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$penanaman_modal_delete->RecordCount = 0;
$i = 0;
while (!$penanaman_modal_delete->Recordset->EOF) {
	$penanaman_modal_delete->RecordCount++;
	$penanaman_modal_delete->RowCount++;

	// Set row properties
	$penanaman_modal->resetAttributes();
	$penanaman_modal->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$penanaman_modal_delete->loadRowValues($penanaman_modal_delete->Recordset);

	// Render row
	$penanaman_modal_delete->renderRow();
?>
	<tr <?php echo $penanaman_modal->rowAttributes() ?>>
<?php if ($penanaman_modal_delete->id_pm->Visible) { // id_pm ?>
		<td <?php echo $penanaman_modal_delete->id_pm->cellAttributes() ?>>
<span id="el<?php echo $penanaman_modal_delete->RowCount ?>_penanaman_modal_id_pm" class="penanaman_modal_id_pm">
<span<?php echo $penanaman_modal_delete->id_pm->viewAttributes() ?>><?php echo $penanaman_modal_delete->id_pm->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penanaman_modal_delete->penanaman_modal->Visible) { // penanaman_modal ?>
		<td <?php echo $penanaman_modal_delete->penanaman_modal->cellAttributes() ?>>
<span id="el<?php echo $penanaman_modal_delete->RowCount ?>_penanaman_modal_penanaman_modal" class="penanaman_modal_penanaman_modal">
<span<?php echo $penanaman_modal_delete->penanaman_modal->viewAttributes() ?>><?php echo $penanaman_modal_delete->penanaman_modal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$penanaman_modal_delete->Recordset->moveNext();
}
$penanaman_modal_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $penanaman_modal_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$penanaman_modal_delete->showPageFooter();
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
$penanaman_modal_delete->terminate();
?>