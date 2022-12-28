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
$hak_akses_view = new hak_akses_view();

// Run the page
$hak_akses_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$hak_akses_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$hak_akses_view->isExport()) { ?>
<script>
var fhak_aksesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fhak_aksesview = currentForm = new ew.Form("fhak_aksesview", "view");
	loadjs.done("fhak_aksesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$hak_akses_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $hak_akses_view->ExportOptions->render("body") ?>
<?php $hak_akses_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $hak_akses_view->showPageHeader(); ?>
<?php
$hak_akses_view->showMessage();
?>
<form name="fhak_aksesview" id="fhak_aksesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="hak_akses">
<input type="hidden" name="modal" value="<?php echo (int)$hak_akses_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($hak_akses_view->id_hak_akses->Visible) { // id_hak_akses ?>
	<tr id="r_id_hak_akses">
		<td class="<?php echo $hak_akses_view->TableLeftColumnClass ?>"><span id="elh_hak_akses_id_hak_akses"><?php echo $hak_akses_view->id_hak_akses->caption() ?></span></td>
		<td data-name="id_hak_akses" <?php echo $hak_akses_view->id_hak_akses->cellAttributes() ?>>
<span id="el_hak_akses_id_hak_akses">
<span<?php echo $hak_akses_view->id_hak_akses->viewAttributes() ?>><?php echo $hak_akses_view->id_hak_akses->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($hak_akses_view->hak_akses->Visible) { // hak_akses ?>
	<tr id="r_hak_akses">
		<td class="<?php echo $hak_akses_view->TableLeftColumnClass ?>"><span id="elh_hak_akses_hak_akses"><?php echo $hak_akses_view->hak_akses->caption() ?></span></td>
		<td data-name="hak_akses" <?php echo $hak_akses_view->hak_akses->cellAttributes() ?>>
<span id="el_hak_akses_hak_akses">
<span<?php echo $hak_akses_view->hak_akses->viewAttributes() ?>><?php echo $hak_akses_view->hak_akses->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$hak_akses_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$hak_akses_view->isExport()) { ?>
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
$hak_akses_view->terminate();
?>