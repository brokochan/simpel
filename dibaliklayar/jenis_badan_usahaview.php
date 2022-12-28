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
$jenis_badan_usaha_view = new jenis_badan_usaha_view();

// Run the page
$jenis_badan_usaha_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jenis_badan_usaha_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$jenis_badan_usaha_view->isExport()) { ?>
<script>
var fjenis_badan_usahaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fjenis_badan_usahaview = currentForm = new ew.Form("fjenis_badan_usahaview", "view");
	loadjs.done("fjenis_badan_usahaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$jenis_badan_usaha_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $jenis_badan_usaha_view->ExportOptions->render("body") ?>
<?php $jenis_badan_usaha_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $jenis_badan_usaha_view->showPageHeader(); ?>
<?php
$jenis_badan_usaha_view->showMessage();
?>
<form name="fjenis_badan_usahaview" id="fjenis_badan_usahaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jenis_badan_usaha">
<input type="hidden" name="modal" value="<?php echo (int)$jenis_badan_usaha_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($jenis_badan_usaha_view->id_jbu->Visible) { // id_jbu ?>
	<tr id="r_id_jbu">
		<td class="<?php echo $jenis_badan_usaha_view->TableLeftColumnClass ?>"><span id="elh_jenis_badan_usaha_id_jbu"><?php echo $jenis_badan_usaha_view->id_jbu->caption() ?></span></td>
		<td data-name="id_jbu" <?php echo $jenis_badan_usaha_view->id_jbu->cellAttributes() ?>>
<span id="el_jenis_badan_usaha_id_jbu">
<span<?php echo $jenis_badan_usaha_view->id_jbu->viewAttributes() ?>><?php echo $jenis_badan_usaha_view->id_jbu->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jenis_badan_usaha_view->jenis_perusahaan->Visible) { // jenis_perusahaan ?>
	<tr id="r_jenis_perusahaan">
		<td class="<?php echo $jenis_badan_usaha_view->TableLeftColumnClass ?>"><span id="elh_jenis_badan_usaha_jenis_perusahaan"><?php echo $jenis_badan_usaha_view->jenis_perusahaan->caption() ?></span></td>
		<td data-name="jenis_perusahaan" <?php echo $jenis_badan_usaha_view->jenis_perusahaan->cellAttributes() ?>>
<span id="el_jenis_badan_usaha_jenis_perusahaan">
<span<?php echo $jenis_badan_usaha_view->jenis_perusahaan->viewAttributes() ?>><?php echo $jenis_badan_usaha_view->jenis_perusahaan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$jenis_badan_usaha_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$jenis_badan_usaha_view->isExport()) { ?>
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
$jenis_badan_usaha_view->terminate();
?>