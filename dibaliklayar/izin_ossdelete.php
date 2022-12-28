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
$izin_oss_delete = new izin_oss_delete();

// Run the page
$izin_oss_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$izin_oss_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fizin_ossdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fizin_ossdelete = currentForm = new ew.Form("fizin_ossdelete", "delete");
	loadjs.done("fizin_ossdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $izin_oss_delete->showPageHeader(); ?>
<?php
$izin_oss_delete->showMessage();
?>
<form name="fizin_ossdelete" id="fizin_ossdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="izin_oss">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($izin_oss_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($izin_oss_delete->id_izin_oss->Visible) { // id_izin_oss ?>
		<th class="<?php echo $izin_oss_delete->id_izin_oss->headerCellClass() ?>"><span id="elh_izin_oss_id_izin_oss" class="izin_oss_id_izin_oss"><?php echo $izin_oss_delete->id_izin_oss->caption() ?></span></th>
<?php } ?>
<?php if ($izin_oss_delete->NIB->Visible) { // NIB ?>
		<th class="<?php echo $izin_oss_delete->NIB->headerCellClass() ?>"><span id="elh_izin_oss_NIB" class="izin_oss_NIB"><?php echo $izin_oss_delete->NIB->caption() ?></span></th>
<?php } ?>
<?php if ($izin_oss_delete->jenis_pelaku_usaha->Visible) { // jenis_pelaku_usaha ?>
		<th class="<?php echo $izin_oss_delete->jenis_pelaku_usaha->headerCellClass() ?>"><span id="elh_izin_oss_jenis_pelaku_usaha" class="izin_oss_jenis_pelaku_usaha"><?php echo $izin_oss_delete->jenis_pelaku_usaha->caption() ?></span></th>
<?php } ?>
<?php if ($izin_oss_delete->nama_pelaku_usaha->Visible) { // nama_pelaku_usaha ?>
		<th class="<?php echo $izin_oss_delete->nama_pelaku_usaha->headerCellClass() ?>"><span id="elh_izin_oss_nama_pelaku_usaha" class="izin_oss_nama_pelaku_usaha"><?php echo $izin_oss_delete->nama_pelaku_usaha->caption() ?></span></th>
<?php } ?>
<?php if ($izin_oss_delete->id_jbu->Visible) { // id_jbu ?>
		<th class="<?php echo $izin_oss_delete->id_jbu->headerCellClass() ?>"><span id="elh_izin_oss_id_jbu" class="izin_oss_id_jbu"><?php echo $izin_oss_delete->id_jbu->caption() ?></span></th>
<?php } ?>
<?php if ($izin_oss_delete->id_pm->Visible) { // id_pm ?>
		<th class="<?php echo $izin_oss_delete->id_pm->headerCellClass() ?>"><span id="elh_izin_oss_id_pm" class="izin_oss_id_pm"><?php echo $izin_oss_delete->id_pm->caption() ?></span></th>
<?php } ?>
<?php if ($izin_oss_delete->id_kecamatan->Visible) { // id_kecamatan ?>
		<th class="<?php echo $izin_oss_delete->id_kecamatan->headerCellClass() ?>"><span id="elh_izin_oss_id_kecamatan" class="izin_oss_id_kecamatan"><?php echo $izin_oss_delete->id_kecamatan->caption() ?></span></th>
<?php } ?>
<?php if ($izin_oss_delete->kode_kbli->Visible) { // kode_kbli ?>
		<th class="<?php echo $izin_oss_delete->kode_kbli->headerCellClass() ?>"><span id="elh_izin_oss_kode_kbli" class="izin_oss_kode_kbli"><?php echo $izin_oss_delete->kode_kbli->caption() ?></span></th>
<?php } ?>
<?php if ($izin_oss_delete->id_skala_usaha->Visible) { // id_skala_usaha ?>
		<th class="<?php echo $izin_oss_delete->id_skala_usaha->headerCellClass() ?>"><span id="elh_izin_oss_id_skala_usaha" class="izin_oss_id_skala_usaha"><?php echo $izin_oss_delete->id_skala_usaha->caption() ?></span></th>
<?php } ?>
<?php if ($izin_oss_delete->sysdate->Visible) { // sysdate ?>
		<th class="<?php echo $izin_oss_delete->sysdate->headerCellClass() ?>"><span id="elh_izin_oss_sysdate" class="izin_oss_sysdate"><?php echo $izin_oss_delete->sysdate->caption() ?></span></th>
<?php } ?>
<?php if ($izin_oss_delete->id_user->Visible) { // id_user ?>
		<th class="<?php echo $izin_oss_delete->id_user->headerCellClass() ?>"><span id="elh_izin_oss_id_user" class="izin_oss_id_user"><?php echo $izin_oss_delete->id_user->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$izin_oss_delete->RecordCount = 0;
$i = 0;
while (!$izin_oss_delete->Recordset->EOF) {
	$izin_oss_delete->RecordCount++;
	$izin_oss_delete->RowCount++;

	// Set row properties
	$izin_oss->resetAttributes();
	$izin_oss->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$izin_oss_delete->loadRowValues($izin_oss_delete->Recordset);

	// Render row
	$izin_oss_delete->renderRow();
?>
	<tr <?php echo $izin_oss->rowAttributes() ?>>
<?php if ($izin_oss_delete->id_izin_oss->Visible) { // id_izin_oss ?>
		<td <?php echo $izin_oss_delete->id_izin_oss->cellAttributes() ?>>
<span id="el<?php echo $izin_oss_delete->RowCount ?>_izin_oss_id_izin_oss" class="izin_oss_id_izin_oss">
<span<?php echo $izin_oss_delete->id_izin_oss->viewAttributes() ?>><?php echo $izin_oss_delete->id_izin_oss->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($izin_oss_delete->NIB->Visible) { // NIB ?>
		<td <?php echo $izin_oss_delete->NIB->cellAttributes() ?>>
<span id="el<?php echo $izin_oss_delete->RowCount ?>_izin_oss_NIB" class="izin_oss_NIB">
<span<?php echo $izin_oss_delete->NIB->viewAttributes() ?>><?php echo $izin_oss_delete->NIB->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($izin_oss_delete->jenis_pelaku_usaha->Visible) { // jenis_pelaku_usaha ?>
		<td <?php echo $izin_oss_delete->jenis_pelaku_usaha->cellAttributes() ?>>
<span id="el<?php echo $izin_oss_delete->RowCount ?>_izin_oss_jenis_pelaku_usaha" class="izin_oss_jenis_pelaku_usaha">
<span<?php echo $izin_oss_delete->jenis_pelaku_usaha->viewAttributes() ?>><?php echo $izin_oss_delete->jenis_pelaku_usaha->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($izin_oss_delete->nama_pelaku_usaha->Visible) { // nama_pelaku_usaha ?>
		<td <?php echo $izin_oss_delete->nama_pelaku_usaha->cellAttributes() ?>>
<span id="el<?php echo $izin_oss_delete->RowCount ?>_izin_oss_nama_pelaku_usaha" class="izin_oss_nama_pelaku_usaha">
<span<?php echo $izin_oss_delete->nama_pelaku_usaha->viewAttributes() ?>><?php echo $izin_oss_delete->nama_pelaku_usaha->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($izin_oss_delete->id_jbu->Visible) { // id_jbu ?>
		<td <?php echo $izin_oss_delete->id_jbu->cellAttributes() ?>>
<span id="el<?php echo $izin_oss_delete->RowCount ?>_izin_oss_id_jbu" class="izin_oss_id_jbu">
<span<?php echo $izin_oss_delete->id_jbu->viewAttributes() ?>><?php echo $izin_oss_delete->id_jbu->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($izin_oss_delete->id_pm->Visible) { // id_pm ?>
		<td <?php echo $izin_oss_delete->id_pm->cellAttributes() ?>>
<span id="el<?php echo $izin_oss_delete->RowCount ?>_izin_oss_id_pm" class="izin_oss_id_pm">
<span<?php echo $izin_oss_delete->id_pm->viewAttributes() ?>><?php echo $izin_oss_delete->id_pm->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($izin_oss_delete->id_kecamatan->Visible) { // id_kecamatan ?>
		<td <?php echo $izin_oss_delete->id_kecamatan->cellAttributes() ?>>
<span id="el<?php echo $izin_oss_delete->RowCount ?>_izin_oss_id_kecamatan" class="izin_oss_id_kecamatan">
<span<?php echo $izin_oss_delete->id_kecamatan->viewAttributes() ?>><?php echo $izin_oss_delete->id_kecamatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($izin_oss_delete->kode_kbli->Visible) { // kode_kbli ?>
		<td <?php echo $izin_oss_delete->kode_kbli->cellAttributes() ?>>
<span id="el<?php echo $izin_oss_delete->RowCount ?>_izin_oss_kode_kbli" class="izin_oss_kode_kbli">
<span<?php echo $izin_oss_delete->kode_kbli->viewAttributes() ?>><?php echo $izin_oss_delete->kode_kbli->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($izin_oss_delete->id_skala_usaha->Visible) { // id_skala_usaha ?>
		<td <?php echo $izin_oss_delete->id_skala_usaha->cellAttributes() ?>>
<span id="el<?php echo $izin_oss_delete->RowCount ?>_izin_oss_id_skala_usaha" class="izin_oss_id_skala_usaha">
<span<?php echo $izin_oss_delete->id_skala_usaha->viewAttributes() ?>><?php echo $izin_oss_delete->id_skala_usaha->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($izin_oss_delete->sysdate->Visible) { // sysdate ?>
		<td <?php echo $izin_oss_delete->sysdate->cellAttributes() ?>>
<span id="el<?php echo $izin_oss_delete->RowCount ?>_izin_oss_sysdate" class="izin_oss_sysdate">
<span<?php echo $izin_oss_delete->sysdate->viewAttributes() ?>><?php echo $izin_oss_delete->sysdate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($izin_oss_delete->id_user->Visible) { // id_user ?>
		<td <?php echo $izin_oss_delete->id_user->cellAttributes() ?>>
<span id="el<?php echo $izin_oss_delete->RowCount ?>_izin_oss_id_user" class="izin_oss_id_user">
<span<?php echo $izin_oss_delete->id_user->viewAttributes() ?>><?php echo $izin_oss_delete->id_user->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$izin_oss_delete->Recordset->moveNext();
}
$izin_oss_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $izin_oss_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$izin_oss_delete->showPageFooter();
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
$izin_oss_delete->terminate();
?>