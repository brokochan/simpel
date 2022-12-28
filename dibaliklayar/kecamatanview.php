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
$kecamatan_view = new kecamatan_view();

// Run the page
$kecamatan_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kecamatan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$kecamatan_view->isExport()) { ?>
<script>
var fkecamatanview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fkecamatanview = currentForm = new ew.Form("fkecamatanview", "view");
	loadjs.done("fkecamatanview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$kecamatan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $kecamatan_view->ExportOptions->render("body") ?>
<?php $kecamatan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $kecamatan_view->showPageHeader(); ?>
<?php
$kecamatan_view->showMessage();
?>
<form name="fkecamatanview" id="fkecamatanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kecamatan">
<input type="hidden" name="modal" value="<?php echo (int)$kecamatan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($kecamatan_view->id_kecamatan->Visible) { // id_kecamatan ?>
	<tr id="r_id_kecamatan">
		<td class="<?php echo $kecamatan_view->TableLeftColumnClass ?>"><span id="elh_kecamatan_id_kecamatan"><?php echo $kecamatan_view->id_kecamatan->caption() ?></span></td>
		<td data-name="id_kecamatan" <?php echo $kecamatan_view->id_kecamatan->cellAttributes() ?>>
<span id="el_kecamatan_id_kecamatan">
<span<?php echo $kecamatan_view->id_kecamatan->viewAttributes() ?>><?php echo $kecamatan_view->id_kecamatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kecamatan_view->kecamatan->Visible) { // kecamatan ?>
	<tr id="r_kecamatan">
		<td class="<?php echo $kecamatan_view->TableLeftColumnClass ?>"><span id="elh_kecamatan_kecamatan"><?php echo $kecamatan_view->kecamatan->caption() ?></span></td>
		<td data-name="kecamatan" <?php echo $kecamatan_view->kecamatan->cellAttributes() ?>>
<span id="el_kecamatan_kecamatan">
<span<?php echo $kecamatan_view->kecamatan->viewAttributes() ?>><?php echo $kecamatan_view->kecamatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kecamatan_view->kodepos->Visible) { // kodepos ?>
	<tr id="r_kodepos">
		<td class="<?php echo $kecamatan_view->TableLeftColumnClass ?>"><span id="elh_kecamatan_kodepos"><?php echo $kecamatan_view->kodepos->caption() ?></span></td>
		<td data-name="kodepos" <?php echo $kecamatan_view->kodepos->cellAttributes() ?>>
<span id="el_kecamatan_kodepos">
<span<?php echo $kecamatan_view->kodepos->viewAttributes() ?>><?php echo $kecamatan_view->kodepos->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$kecamatan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$kecamatan_view->isExport()) { ?>
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
$kecamatan_view->terminate();
?>