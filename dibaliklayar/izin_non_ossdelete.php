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
$izin_non_oss_delete = new izin_non_oss_delete();

// Run the page
$izin_non_oss_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$izin_non_oss_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fizin_non_ossdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fizin_non_ossdelete = currentForm = new ew.Form("fizin_non_ossdelete", "delete");
	loadjs.done("fizin_non_ossdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $izin_non_oss_delete->showPageHeader(); ?>
<?php
$izin_non_oss_delete->showMessage();
?>
<form name="fizin_non_ossdelete" id="fizin_non_ossdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="izin_non_oss">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($izin_non_oss_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($izin_non_oss_delete->id_izin_non_oss->Visible) { // id_izin_non_oss ?>
		<th class="<?php echo $izin_non_oss_delete->id_izin_non_oss->headerCellClass() ?>"><span id="elh_izin_non_oss_id_izin_non_oss" class="izin_non_oss_id_izin_non_oss"><?php echo $izin_non_oss_delete->id_izin_non_oss->caption() ?></span></th>
<?php } ?>
<?php if ($izin_non_oss_delete->no_izin->Visible) { // no_izin ?>
		<th class="<?php echo $izin_non_oss_delete->no_izin->headerCellClass() ?>"><span id="elh_izin_non_oss_no_izin" class="izin_non_oss_no_izin"><?php echo $izin_non_oss_delete->no_izin->caption() ?></span></th>
<?php } ?>
<?php if ($izin_non_oss_delete->id_jenis_izin->Visible) { // id_jenis_izin ?>
		<th class="<?php echo $izin_non_oss_delete->id_jenis_izin->headerCellClass() ?>"><span id="elh_izin_non_oss_id_jenis_izin" class="izin_non_oss_id_jenis_izin"><?php echo $izin_non_oss_delete->id_jenis_izin->caption() ?></span></th>
<?php } ?>
<?php if ($izin_non_oss_delete->jenis_pemohon->Visible) { // jenis_pemohon ?>
		<th class="<?php echo $izin_non_oss_delete->jenis_pemohon->headerCellClass() ?>"><span id="elh_izin_non_oss_jenis_pemohon" class="izin_non_oss_jenis_pemohon"><?php echo $izin_non_oss_delete->jenis_pemohon->caption() ?></span></th>
<?php } ?>
<?php if ($izin_non_oss_delete->nama_pemohon->Visible) { // nama_pemohon ?>
		<th class="<?php echo $izin_non_oss_delete->nama_pemohon->headerCellClass() ?>"><span id="elh_izin_non_oss_nama_pemohon" class="izin_non_oss_nama_pemohon"><?php echo $izin_non_oss_delete->nama_pemohon->caption() ?></span></th>
<?php } ?>
<?php if ($izin_non_oss_delete->id_jbu->Visible) { // id_jbu ?>
		<th class="<?php echo $izin_non_oss_delete->id_jbu->headerCellClass() ?>"><span id="elh_izin_non_oss_id_jbu" class="izin_non_oss_id_jbu"><?php echo $izin_non_oss_delete->id_jbu->caption() ?></span></th>
<?php } ?>
<?php if ($izin_non_oss_delete->id_sektor->Visible) { // id_sektor ?>
		<th class="<?php echo $izin_non_oss_delete->id_sektor->headerCellClass() ?>"><span id="elh_izin_non_oss_id_sektor" class="izin_non_oss_id_sektor"><?php echo $izin_non_oss_delete->id_sektor->caption() ?></span></th>
<?php } ?>
<?php if ($izin_non_oss_delete->id_subsektor->Visible) { // id_subsektor ?>
		<th class="<?php echo $izin_non_oss_delete->id_subsektor->headerCellClass() ?>"><span id="elh_izin_non_oss_id_subsektor" class="izin_non_oss_id_subsektor"><?php echo $izin_non_oss_delete->id_subsektor->caption() ?></span></th>
<?php } ?>
<?php if ($izin_non_oss_delete->tanggal_izin->Visible) { // tanggal_izin ?>
		<th class="<?php echo $izin_non_oss_delete->tanggal_izin->headerCellClass() ?>"><span id="elh_izin_non_oss_tanggal_izin" class="izin_non_oss_tanggal_izin"><?php echo $izin_non_oss_delete->tanggal_izin->caption() ?></span></th>
<?php } ?>
<?php if ($izin_non_oss_delete->sysdate->Visible) { // sysdate ?>
		<th class="<?php echo $izin_non_oss_delete->sysdate->headerCellClass() ?>"><span id="elh_izin_non_oss_sysdate" class="izin_non_oss_sysdate"><?php echo $izin_non_oss_delete->sysdate->caption() ?></span></th>
<?php } ?>
<?php if ($izin_non_oss_delete->id_user->Visible) { // id_user ?>
		<th class="<?php echo $izin_non_oss_delete->id_user->headerCellClass() ?>"><span id="elh_izin_non_oss_id_user" class="izin_non_oss_id_user"><?php echo $izin_non_oss_delete->id_user->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$izin_non_oss_delete->RecordCount = 0;
$i = 0;
while (!$izin_non_oss_delete->Recordset->EOF) {
	$izin_non_oss_delete->RecordCount++;
	$izin_non_oss_delete->RowCount++;

	// Set row properties
	$izin_non_oss->resetAttributes();
	$izin_non_oss->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$izin_non_oss_delete->loadRowValues($izin_non_oss_delete->Recordset);

	// Render row
	$izin_non_oss_delete->renderRow();
?>
	<tr <?php echo $izin_non_oss->rowAttributes() ?>>
<?php if ($izin_non_oss_delete->id_izin_non_oss->Visible) { // id_izin_non_oss ?>
		<td <?php echo $izin_non_oss_delete->id_izin_non_oss->cellAttributes() ?>>
<span id="el<?php echo $izin_non_oss_delete->RowCount ?>_izin_non_oss_id_izin_non_oss" class="izin_non_oss_id_izin_non_oss">
<span<?php echo $izin_non_oss_delete->id_izin_non_oss->viewAttributes() ?>><?php echo $izin_non_oss_delete->id_izin_non_oss->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($izin_non_oss_delete->no_izin->Visible) { // no_izin ?>
		<td <?php echo $izin_non_oss_delete->no_izin->cellAttributes() ?>>
<span id="el<?php echo $izin_non_oss_delete->RowCount ?>_izin_non_oss_no_izin" class="izin_non_oss_no_izin">
<span<?php echo $izin_non_oss_delete->no_izin->viewAttributes() ?>><?php echo $izin_non_oss_delete->no_izin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($izin_non_oss_delete->id_jenis_izin->Visible) { // id_jenis_izin ?>
		<td <?php echo $izin_non_oss_delete->id_jenis_izin->cellAttributes() ?>>
<span id="el<?php echo $izin_non_oss_delete->RowCount ?>_izin_non_oss_id_jenis_izin" class="izin_non_oss_id_jenis_izin">
<span<?php echo $izin_non_oss_delete->id_jenis_izin->viewAttributes() ?>><?php echo $izin_non_oss_delete->id_jenis_izin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($izin_non_oss_delete->jenis_pemohon->Visible) { // jenis_pemohon ?>
		<td <?php echo $izin_non_oss_delete->jenis_pemohon->cellAttributes() ?>>
<span id="el<?php echo $izin_non_oss_delete->RowCount ?>_izin_non_oss_jenis_pemohon" class="izin_non_oss_jenis_pemohon">
<span<?php echo $izin_non_oss_delete->jenis_pemohon->viewAttributes() ?>><?php echo $izin_non_oss_delete->jenis_pemohon->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($izin_non_oss_delete->nama_pemohon->Visible) { // nama_pemohon ?>
		<td <?php echo $izin_non_oss_delete->nama_pemohon->cellAttributes() ?>>
<span id="el<?php echo $izin_non_oss_delete->RowCount ?>_izin_non_oss_nama_pemohon" class="izin_non_oss_nama_pemohon">
<span<?php echo $izin_non_oss_delete->nama_pemohon->viewAttributes() ?>><?php echo $izin_non_oss_delete->nama_pemohon->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($izin_non_oss_delete->id_jbu->Visible) { // id_jbu ?>
		<td <?php echo $izin_non_oss_delete->id_jbu->cellAttributes() ?>>
<span id="el<?php echo $izin_non_oss_delete->RowCount ?>_izin_non_oss_id_jbu" class="izin_non_oss_id_jbu">
<span<?php echo $izin_non_oss_delete->id_jbu->viewAttributes() ?>><?php echo $izin_non_oss_delete->id_jbu->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($izin_non_oss_delete->id_sektor->Visible) { // id_sektor ?>
		<td <?php echo $izin_non_oss_delete->id_sektor->cellAttributes() ?>>
<span id="el<?php echo $izin_non_oss_delete->RowCount ?>_izin_non_oss_id_sektor" class="izin_non_oss_id_sektor">
<span<?php echo $izin_non_oss_delete->id_sektor->viewAttributes() ?>><?php echo $izin_non_oss_delete->id_sektor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($izin_non_oss_delete->id_subsektor->Visible) { // id_subsektor ?>
		<td <?php echo $izin_non_oss_delete->id_subsektor->cellAttributes() ?>>
<span id="el<?php echo $izin_non_oss_delete->RowCount ?>_izin_non_oss_id_subsektor" class="izin_non_oss_id_subsektor">
<span<?php echo $izin_non_oss_delete->id_subsektor->viewAttributes() ?>><?php echo $izin_non_oss_delete->id_subsektor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($izin_non_oss_delete->tanggal_izin->Visible) { // tanggal_izin ?>
		<td <?php echo $izin_non_oss_delete->tanggal_izin->cellAttributes() ?>>
<span id="el<?php echo $izin_non_oss_delete->RowCount ?>_izin_non_oss_tanggal_izin" class="izin_non_oss_tanggal_izin">
<span<?php echo $izin_non_oss_delete->tanggal_izin->viewAttributes() ?>><?php echo $izin_non_oss_delete->tanggal_izin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($izin_non_oss_delete->sysdate->Visible) { // sysdate ?>
		<td <?php echo $izin_non_oss_delete->sysdate->cellAttributes() ?>>
<span id="el<?php echo $izin_non_oss_delete->RowCount ?>_izin_non_oss_sysdate" class="izin_non_oss_sysdate">
<span<?php echo $izin_non_oss_delete->sysdate->viewAttributes() ?>><?php echo $izin_non_oss_delete->sysdate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($izin_non_oss_delete->id_user->Visible) { // id_user ?>
		<td <?php echo $izin_non_oss_delete->id_user->cellAttributes() ?>>
<span id="el<?php echo $izin_non_oss_delete->RowCount ?>_izin_non_oss_id_user" class="izin_non_oss_id_user">
<span<?php echo $izin_non_oss_delete->id_user->viewAttributes() ?>><?php echo $izin_non_oss_delete->id_user->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$izin_non_oss_delete->Recordset->moveNext();
}
$izin_non_oss_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $izin_non_oss_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$izin_non_oss_delete->showPageFooter();
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
$izin_non_oss_delete->terminate();
?>