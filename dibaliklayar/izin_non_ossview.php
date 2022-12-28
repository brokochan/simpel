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
$izin_non_oss_view = new izin_non_oss_view();

// Run the page
$izin_non_oss_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$izin_non_oss_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$izin_non_oss_view->isExport()) { ?>
<script>
var fizin_non_ossview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fizin_non_ossview = currentForm = new ew.Form("fizin_non_ossview", "view");
	loadjs.done("fizin_non_ossview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$izin_non_oss_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $izin_non_oss_view->ExportOptions->render("body") ?>
<?php $izin_non_oss_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $izin_non_oss_view->showPageHeader(); ?>
<?php
$izin_non_oss_view->showMessage();
?>
<form name="fizin_non_ossview" id="fizin_non_ossview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="izin_non_oss">
<input type="hidden" name="modal" value="<?php echo (int)$izin_non_oss_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($izin_non_oss_view->id_izin_non_oss->Visible) { // id_izin_non_oss ?>
	<tr id="r_id_izin_non_oss">
		<td class="<?php echo $izin_non_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_non_oss_id_izin_non_oss"><?php echo $izin_non_oss_view->id_izin_non_oss->caption() ?></span></td>
		<td data-name="id_izin_non_oss" <?php echo $izin_non_oss_view->id_izin_non_oss->cellAttributes() ?>>
<span id="el_izin_non_oss_id_izin_non_oss">
<span<?php echo $izin_non_oss_view->id_izin_non_oss->viewAttributes() ?>><?php echo $izin_non_oss_view->id_izin_non_oss->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($izin_non_oss_view->no_izin->Visible) { // no_izin ?>
	<tr id="r_no_izin">
		<td class="<?php echo $izin_non_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_non_oss_no_izin"><?php echo $izin_non_oss_view->no_izin->caption() ?></span></td>
		<td data-name="no_izin" <?php echo $izin_non_oss_view->no_izin->cellAttributes() ?>>
<span id="el_izin_non_oss_no_izin">
<span<?php echo $izin_non_oss_view->no_izin->viewAttributes() ?>><?php echo $izin_non_oss_view->no_izin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($izin_non_oss_view->id_jenis_izin->Visible) { // id_jenis_izin ?>
	<tr id="r_id_jenis_izin">
		<td class="<?php echo $izin_non_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_non_oss_id_jenis_izin"><?php echo $izin_non_oss_view->id_jenis_izin->caption() ?></span></td>
		<td data-name="id_jenis_izin" <?php echo $izin_non_oss_view->id_jenis_izin->cellAttributes() ?>>
<span id="el_izin_non_oss_id_jenis_izin">
<span<?php echo $izin_non_oss_view->id_jenis_izin->viewAttributes() ?>><?php echo $izin_non_oss_view->id_jenis_izin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($izin_non_oss_view->jenis_pemohon->Visible) { // jenis_pemohon ?>
	<tr id="r_jenis_pemohon">
		<td class="<?php echo $izin_non_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_non_oss_jenis_pemohon"><?php echo $izin_non_oss_view->jenis_pemohon->caption() ?></span></td>
		<td data-name="jenis_pemohon" <?php echo $izin_non_oss_view->jenis_pemohon->cellAttributes() ?>>
<span id="el_izin_non_oss_jenis_pemohon">
<span<?php echo $izin_non_oss_view->jenis_pemohon->viewAttributes() ?>><?php echo $izin_non_oss_view->jenis_pemohon->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($izin_non_oss_view->nama_pemohon->Visible) { // nama_pemohon ?>
	<tr id="r_nama_pemohon">
		<td class="<?php echo $izin_non_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_non_oss_nama_pemohon"><?php echo $izin_non_oss_view->nama_pemohon->caption() ?></span></td>
		<td data-name="nama_pemohon" <?php echo $izin_non_oss_view->nama_pemohon->cellAttributes() ?>>
<span id="el_izin_non_oss_nama_pemohon">
<span<?php echo $izin_non_oss_view->nama_pemohon->viewAttributes() ?>><?php echo $izin_non_oss_view->nama_pemohon->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($izin_non_oss_view->id_jbu->Visible) { // id_jbu ?>
	<tr id="r_id_jbu">
		<td class="<?php echo $izin_non_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_non_oss_id_jbu"><?php echo $izin_non_oss_view->id_jbu->caption() ?></span></td>
		<td data-name="id_jbu" <?php echo $izin_non_oss_view->id_jbu->cellAttributes() ?>>
<span id="el_izin_non_oss_id_jbu">
<span<?php echo $izin_non_oss_view->id_jbu->viewAttributes() ?>><?php echo $izin_non_oss_view->id_jbu->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($izin_non_oss_view->id_sektor->Visible) { // id_sektor ?>
	<tr id="r_id_sektor">
		<td class="<?php echo $izin_non_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_non_oss_id_sektor"><?php echo $izin_non_oss_view->id_sektor->caption() ?></span></td>
		<td data-name="id_sektor" <?php echo $izin_non_oss_view->id_sektor->cellAttributes() ?>>
<span id="el_izin_non_oss_id_sektor">
<span<?php echo $izin_non_oss_view->id_sektor->viewAttributes() ?>><?php echo $izin_non_oss_view->id_sektor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($izin_non_oss_view->id_subsektor->Visible) { // id_subsektor ?>
	<tr id="r_id_subsektor">
		<td class="<?php echo $izin_non_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_non_oss_id_subsektor"><?php echo $izin_non_oss_view->id_subsektor->caption() ?></span></td>
		<td data-name="id_subsektor" <?php echo $izin_non_oss_view->id_subsektor->cellAttributes() ?>>
<span id="el_izin_non_oss_id_subsektor">
<span<?php echo $izin_non_oss_view->id_subsektor->viewAttributes() ?>><?php echo $izin_non_oss_view->id_subsektor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($izin_non_oss_view->tanggal_izin->Visible) { // tanggal_izin ?>
	<tr id="r_tanggal_izin">
		<td class="<?php echo $izin_non_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_non_oss_tanggal_izin"><?php echo $izin_non_oss_view->tanggal_izin->caption() ?></span></td>
		<td data-name="tanggal_izin" <?php echo $izin_non_oss_view->tanggal_izin->cellAttributes() ?>>
<span id="el_izin_non_oss_tanggal_izin">
<span<?php echo $izin_non_oss_view->tanggal_izin->viewAttributes() ?>><?php echo $izin_non_oss_view->tanggal_izin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($izin_non_oss_view->alamat_pemohon->Visible) { // alamat_pemohon ?>
	<tr id="r_alamat_pemohon">
		<td class="<?php echo $izin_non_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_non_oss_alamat_pemohon"><?php echo $izin_non_oss_view->alamat_pemohon->caption() ?></span></td>
		<td data-name="alamat_pemohon" <?php echo $izin_non_oss_view->alamat_pemohon->cellAttributes() ?>>
<span id="el_izin_non_oss_alamat_pemohon">
<span<?php echo $izin_non_oss_view->alamat_pemohon->viewAttributes() ?>><?php echo $izin_non_oss_view->alamat_pemohon->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($izin_non_oss_view->alamat_perusahaan->Visible) { // alamat_perusahaan ?>
	<tr id="r_alamat_perusahaan">
		<td class="<?php echo $izin_non_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_non_oss_alamat_perusahaan"><?php echo $izin_non_oss_view->alamat_perusahaan->caption() ?></span></td>
		<td data-name="alamat_perusahaan" <?php echo $izin_non_oss_view->alamat_perusahaan->cellAttributes() ?>>
<span id="el_izin_non_oss_alamat_perusahaan">
<span<?php echo $izin_non_oss_view->alamat_perusahaan->viewAttributes() ?>><?php echo $izin_non_oss_view->alamat_perusahaan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($izin_non_oss_view->alamat_proyek->Visible) { // alamat_proyek ?>
	<tr id="r_alamat_proyek">
		<td class="<?php echo $izin_non_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_non_oss_alamat_proyek"><?php echo $izin_non_oss_view->alamat_proyek->caption() ?></span></td>
		<td data-name="alamat_proyek" <?php echo $izin_non_oss_view->alamat_proyek->cellAttributes() ?>>
<span id="el_izin_non_oss_alamat_proyek">
<span<?php echo $izin_non_oss_view->alamat_proyek->viewAttributes() ?>><?php echo $izin_non_oss_view->alamat_proyek->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($izin_non_oss_view->detail_izin->Visible) { // detail_izin ?>
	<tr id="r_detail_izin">
		<td class="<?php echo $izin_non_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_non_oss_detail_izin"><?php echo $izin_non_oss_view->detail_izin->caption() ?></span></td>
		<td data-name="detail_izin" <?php echo $izin_non_oss_view->detail_izin->cellAttributes() ?>>
<span id="el_izin_non_oss_detail_izin">
<span<?php echo $izin_non_oss_view->detail_izin->viewAttributes() ?>><?php echo $izin_non_oss_view->detail_izin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($izin_non_oss_view->sysdate->Visible) { // sysdate ?>
	<tr id="r_sysdate">
		<td class="<?php echo $izin_non_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_non_oss_sysdate"><?php echo $izin_non_oss_view->sysdate->caption() ?></span></td>
		<td data-name="sysdate" <?php echo $izin_non_oss_view->sysdate->cellAttributes() ?>>
<span id="el_izin_non_oss_sysdate">
<span<?php echo $izin_non_oss_view->sysdate->viewAttributes() ?>><?php echo $izin_non_oss_view->sysdate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($izin_non_oss_view->id_user->Visible) { // id_user ?>
	<tr id="r_id_user">
		<td class="<?php echo $izin_non_oss_view->TableLeftColumnClass ?>"><span id="elh_izin_non_oss_id_user"><?php echo $izin_non_oss_view->id_user->caption() ?></span></td>
		<td data-name="id_user" <?php echo $izin_non_oss_view->id_user->cellAttributes() ?>>
<span id="el_izin_non_oss_id_user">
<span<?php echo $izin_non_oss_view->id_user->viewAttributes() ?>><?php echo $izin_non_oss_view->id_user->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$izin_non_oss_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$izin_non_oss_view->isExport()) { ?>
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
$izin_non_oss_view->terminate();
?>