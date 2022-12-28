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
$jenis_izin_view = new jenis_izin_view();

// Run the page
$jenis_izin_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jenis_izin_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$jenis_izin_view->isExport()) { ?>
<script>
var fjenis_izinview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fjenis_izinview = currentForm = new ew.Form("fjenis_izinview", "view");
	loadjs.done("fjenis_izinview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$jenis_izin_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $jenis_izin_view->ExportOptions->render("body") ?>
<?php $jenis_izin_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $jenis_izin_view->showPageHeader(); ?>
<?php
$jenis_izin_view->showMessage();
?>
<form name="fjenis_izinview" id="fjenis_izinview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jenis_izin">
<input type="hidden" name="modal" value="<?php echo (int)$jenis_izin_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($jenis_izin_view->id_jenis_izin->Visible) { // id_jenis_izin ?>
	<tr id="r_id_jenis_izin">
		<td class="<?php echo $jenis_izin_view->TableLeftColumnClass ?>"><span id="elh_jenis_izin_id_jenis_izin"><?php echo $jenis_izin_view->id_jenis_izin->caption() ?></span></td>
		<td data-name="id_jenis_izin" <?php echo $jenis_izin_view->id_jenis_izin->cellAttributes() ?>>
<span id="el_jenis_izin_id_jenis_izin">
<span<?php echo $jenis_izin_view->id_jenis_izin->viewAttributes() ?>><?php echo $jenis_izin_view->id_jenis_izin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jenis_izin_view->jenis_izin->Visible) { // jenis_izin ?>
	<tr id="r_jenis_izin">
		<td class="<?php echo $jenis_izin_view->TableLeftColumnClass ?>"><span id="elh_jenis_izin_jenis_izin"><?php echo $jenis_izin_view->jenis_izin->caption() ?></span></td>
		<td data-name="jenis_izin" <?php echo $jenis_izin_view->jenis_izin->cellAttributes() ?>>
<span id="el_jenis_izin_jenis_izin">
<span<?php echo $jenis_izin_view->jenis_izin->viewAttributes() ?>><?php echo $jenis_izin_view->jenis_izin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$jenis_izin_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$jenis_izin_view->isExport()) { ?>
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
$jenis_izin_view->terminate();
?>