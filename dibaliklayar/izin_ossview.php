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
$izin_oss_view = new izin_oss_view();

// Run the page
$izin_oss_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$izin_oss_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$izin_oss_view->isExport()) { ?>
<script>
var fizin_ossview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fizin_ossview = currentForm = new ew.Form("fizin_ossview", "view");
	loadjs.done("fizin_ossview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$izin_oss_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $izin_oss_view->ExportOptions->render("body") ?>
<?php $izin_oss_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $izin_oss_view->showPageHeader(); ?>
<?php
$izin_oss_view->showMessage();
?>
<form name="fizin_ossview" id="fizin_ossview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="izin_oss">
<input type="hidden" name="modal" value="<?php echo (int)$izin_oss_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($izin_oss_view->id_izin_oss->Visible) { // id_izin_oss ?>
	<tr id="r_id_izin_oss">
		<td class="<?php echo $izin_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_oss_id_izin_oss"><?php echo $izin_oss_view->id_izin_oss->caption() ?></span></td>
		<td data-name="id_izin_oss" <?php echo $izin_oss_view->id_izin_oss->cellAttributes() ?>>
<span id="el_izin_oss_id_izin_oss">
<span<?php echo $izin_oss_view->id_izin_oss->viewAttributes() ?>><?php echo $izin_oss_view->id_izin_oss->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($izin_oss_view->NIB->Visible) { // NIB ?>
	<tr id="r_NIB">
		<td class="<?php echo $izin_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_oss_NIB"><?php echo $izin_oss_view->NIB->caption() ?></span></td>
		<td data-name="NIB" <?php echo $izin_oss_view->NIB->cellAttributes() ?>>
<span id="el_izin_oss_NIB">
<span<?php echo $izin_oss_view->NIB->viewAttributes() ?>><?php echo $izin_oss_view->NIB->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($izin_oss_view->jenis_pelaku_usaha->Visible) { // jenis_pelaku_usaha ?>
	<tr id="r_jenis_pelaku_usaha">
		<td class="<?php echo $izin_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_oss_jenis_pelaku_usaha"><?php echo $izin_oss_view->jenis_pelaku_usaha->caption() ?></span></td>
		<td data-name="jenis_pelaku_usaha" <?php echo $izin_oss_view->jenis_pelaku_usaha->cellAttributes() ?>>
<span id="el_izin_oss_jenis_pelaku_usaha">
<span<?php echo $izin_oss_view->jenis_pelaku_usaha->viewAttributes() ?>><?php echo $izin_oss_view->jenis_pelaku_usaha->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($izin_oss_view->nama_pelaku_usaha->Visible) { // nama_pelaku_usaha ?>
	<tr id="r_nama_pelaku_usaha">
		<td class="<?php echo $izin_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_oss_nama_pelaku_usaha"><?php echo $izin_oss_view->nama_pelaku_usaha->caption() ?></span></td>
		<td data-name="nama_pelaku_usaha" <?php echo $izin_oss_view->nama_pelaku_usaha->cellAttributes() ?>>
<span id="el_izin_oss_nama_pelaku_usaha">
<span<?php echo $izin_oss_view->nama_pelaku_usaha->viewAttributes() ?>><?php echo $izin_oss_view->nama_pelaku_usaha->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($izin_oss_view->id_jbu->Visible) { // id_jbu ?>
	<tr id="r_id_jbu">
		<td class="<?php echo $izin_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_oss_id_jbu"><?php echo $izin_oss_view->id_jbu->caption() ?></span></td>
		<td data-name="id_jbu" <?php echo $izin_oss_view->id_jbu->cellAttributes() ?>>
<span id="el_izin_oss_id_jbu">
<span<?php echo $izin_oss_view->id_jbu->viewAttributes() ?>><?php echo $izin_oss_view->id_jbu->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($izin_oss_view->id_pm->Visible) { // id_pm ?>
	<tr id="r_id_pm">
		<td class="<?php echo $izin_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_oss_id_pm"><?php echo $izin_oss_view->id_pm->caption() ?></span></td>
		<td data-name="id_pm" <?php echo $izin_oss_view->id_pm->cellAttributes() ?>>
<span id="el_izin_oss_id_pm">
<span<?php echo $izin_oss_view->id_pm->viewAttributes() ?>><?php echo $izin_oss_view->id_pm->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($izin_oss_view->id_kecamatan->Visible) { // id_kecamatan ?>
	<tr id="r_id_kecamatan">
		<td class="<?php echo $izin_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_oss_id_kecamatan"><?php echo $izin_oss_view->id_kecamatan->caption() ?></span></td>
		<td data-name="id_kecamatan" <?php echo $izin_oss_view->id_kecamatan->cellAttributes() ?>>
<span id="el_izin_oss_id_kecamatan">
<span<?php echo $izin_oss_view->id_kecamatan->viewAttributes() ?>><?php echo $izin_oss_view->id_kecamatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($izin_oss_view->kode_kbli->Visible) { // kode_kbli ?>
	<tr id="r_kode_kbli">
		<td class="<?php echo $izin_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_oss_kode_kbli"><?php echo $izin_oss_view->kode_kbli->caption() ?></span></td>
		<td data-name="kode_kbli" <?php echo $izin_oss_view->kode_kbli->cellAttributes() ?>>
<span id="el_izin_oss_kode_kbli">
<span<?php echo $izin_oss_view->kode_kbli->viewAttributes() ?>><?php echo $izin_oss_view->kode_kbli->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($izin_oss_view->id_skala_usaha->Visible) { // id_skala_usaha ?>
	<tr id="r_id_skala_usaha">
		<td class="<?php echo $izin_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_oss_id_skala_usaha"><?php echo $izin_oss_view->id_skala_usaha->caption() ?></span></td>
		<td data-name="id_skala_usaha" <?php echo $izin_oss_view->id_skala_usaha->cellAttributes() ?>>
<span id="el_izin_oss_id_skala_usaha">
<span<?php echo $izin_oss_view->id_skala_usaha->viewAttributes() ?>><?php echo $izin_oss_view->id_skala_usaha->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($izin_oss_view->sysdate->Visible) { // sysdate ?>
	<tr id="r_sysdate">
		<td class="<?php echo $izin_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_oss_sysdate"><?php echo $izin_oss_view->sysdate->caption() ?></span></td>
		<td data-name="sysdate" <?php echo $izin_oss_view->sysdate->cellAttributes() ?>>
<span id="el_izin_oss_sysdate">
<span<?php echo $izin_oss_view->sysdate->viewAttributes() ?>><?php echo $izin_oss_view->sysdate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($izin_oss_view->id_user->Visible) { // id_user ?>
	<tr id="r_id_user">
		<td class="<?php echo $izin_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_oss_id_user"><?php echo $izin_oss_view->id_user->caption() ?></span></td>
		<td data-name="id_user" <?php echo $izin_oss_view->id_user->cellAttributes() ?>>
<span id="el_izin_oss_id_user">
<span<?php echo $izin_oss_view->id_user->viewAttributes() ?>><?php echo $izin_oss_view->id_user->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$izin_oss_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$izin_oss_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$izin_oss_view->terminate();
?>