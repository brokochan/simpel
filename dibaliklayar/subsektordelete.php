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
$subsektor_delete = new subsektor_delete();

// Run the page
$subsektor_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$subsektor_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsubsektordelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fsubsektordelete = currentForm = new ew.Form("fsubsektordelete", "delete");
	loadjs.done("fsubsektordelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $subsektor_delete->showPageHeader(); ?>
<?php
$subsektor_delete->showMessage();
?>
<form name="fsubsektordelete" id="fsubsektordelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="subsektor">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($subsektor_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($subsektor_delete->id_subsektor->Visible) { // id_subsektor ?>
		<th class="<?php echo $subsektor_delete->id_subsektor->headerCellClass() ?>"><span id="elh_subsektor_id_subsektor" class="subsektor_id_subsektor"><?php echo $subsektor_delete->id_subsektor->caption() ?></span></th>
<?php } ?>
<?php if ($subsektor_delete->subsektor->Visible) { // subsektor ?>
		<th class="<?php echo $subsektor_delete->subsektor->headerCellClass() ?>"><span id="elh_subsektor_subsektor" class="subsektor_subsektor"><?php echo $subsektor_delete->subsektor->caption() ?></span></th>
<?php } ?>
<?php if ($subsektor_delete->id_sektor->Visible) { // id_sektor ?>
		<th class="<?php echo $subsektor_delete->id_sektor->headerCellClass() ?>"><span id="elh_subsektor_id_sektor" class="subsektor_id_sektor"><?php echo $subsektor_delete->id_sektor->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$subsektor_delete->RecordCount = 0;
$i = 0;
while (!$subsektor_delete->Recordset->EOF) {
	$subsektor_delete->RecordCount++;
	$subsektor_delete->RowCount++;

	// Set row properties
	$subsektor->resetAttributes();
	$subsektor->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$subsektor_delete->loadRowValues($subsektor_delete->Recordset);

	// Render row
	$subsektor_delete->renderRow();
?>
	<tr <?php echo $subsektor->rowAttributes() ?>>
<?php if ($subsektor_delete->id_subsektor->Visible) { // id_subsektor ?>
		<td <?php echo $subsektor_delete->id_subsektor->cellAttributes() ?>>
<span id="el<?php echo $subsektor_delete->RowCount ?>_subsektor_id_subsektor" class="subsektor_id_subsektor">
<span<?php echo $subsektor_delete->id_subsektor->viewAttributes() ?>><?php echo $subsektor_delete->id_subsektor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($subsektor_delete->subsektor->Visible) { // subsektor ?>
		<td <?php echo $subsektor_delete->subsektor->cellAttributes() ?>>
<span id="el<?php echo $subsektor_delete->RowCount ?>_subsektor_subsektor" class="subsektor_subsektor">
<span<?php echo $subsektor_delete->subsektor->viewAttributes() ?>><?php echo $subsektor_delete->subsektor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($subsektor_delete->id_sektor->Visible) { // id_sektor ?>
		<td <?php echo $subsektor_delete->id_sektor->cellAttributes() ?>>
<span id="el<?php echo $subsektor_delete->RowCount ?>_subsektor_id_sektor" class="subsektor_id_sektor">
<span<?php echo $subsektor_delete->id_sektor->viewAttributes() ?>><?php echo $subsektor_delete->id_sektor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$subsektor_delete->Recordset->moveNext();
}
$subsektor_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $subsektor_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$subsektor_delete->showPageFooter();
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
$subsektor_delete->terminate();
?>