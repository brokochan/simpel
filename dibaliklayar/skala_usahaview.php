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
$skala_usaha_view = new skala_usaha_view();

// Run the page
$skala_usaha_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$skala_usaha_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$skala_usaha_view->isExport()) { ?>
<script>
var fskala_usahaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fskala_usahaview = currentForm = new ew.Form("fskala_usahaview", "view");
	loadjs.done("fskala_usahaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$skala_usaha_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $skala_usaha_view->ExportOptions->render("body") ?>
<?php $skala_usaha_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $skala_usaha_view->showPageHeader(); ?>
<?php
$skala_usaha_view->showMessage();
?>
<form name="fskala_usahaview" id="fskala_usahaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="skala_usaha">
<input type="hidden" name="modal" value="<?php echo (int)$skala_usaha_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($skala_usaha_view->id_skala_usaha->Visible) { // id_skala_usaha ?>
	<tr id="r_id_skala_usaha">
		<td class="<?php echo $skala_usaha_view->TableLeftColumnClass ?>"><span id="elh_skala_usaha_id_skala_usaha"><?php echo $skala_usaha_view->id_skala_usaha->caption() ?></span></td>
		<td data-name="id_skala_usaha" <?php echo $skala_usaha_view->id_skala_usaha->cellAttributes() ?>>
<span id="el_skala_usaha_id_skala_usaha">
<span<?php echo $skala_usaha_view->id_skala_usaha->viewAttributes() ?>><?php echo $skala_usaha_view->id_skala_usaha->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($skala_usaha_view->skala_usaha->Visible) { // skala_usaha ?>
	<tr id="r_skala_usaha">
		<td class="<?php echo $skala_usaha_view->TableLeftColumnClass ?>"><span id="elh_skala_usaha_skala_usaha"><?php echo $skala_usaha_view->skala_usaha->caption() ?></span></td>
		<td data-name="skala_usaha" <?php echo $skala_usaha_view->skala_usaha->cellAttributes() ?>>
<span id="el_skala_usaha_skala_usaha">
<span<?php echo $skala_usaha_view->skala_usaha->viewAttributes() ?>><?php echo $skala_usaha_view->skala_usaha->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$skala_usaha_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$skala_usaha_view->isExport()) { ?>
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
$skala_usaha_view->terminate();
?>