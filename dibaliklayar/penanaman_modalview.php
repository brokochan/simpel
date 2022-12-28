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
$penanaman_modal_view = new penanaman_modal_view();

// Run the page
$penanaman_modal_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penanaman_modal_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$penanaman_modal_view->isExport()) { ?>
<script>
var fpenanaman_modalview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpenanaman_modalview = currentForm = new ew.Form("fpenanaman_modalview", "view");
	loadjs.done("fpenanaman_modalview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$penanaman_modal_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $penanaman_modal_view->ExportOptions->render("body") ?>
<?php $penanaman_modal_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $penanaman_modal_view->showPageHeader(); ?>
<?php
$penanaman_modal_view->showMessage();
?>
<form name="fpenanaman_modalview" id="fpenanaman_modalview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penanaman_modal">
<input type="hidden" name="modal" value="<?php echo (int)$penanaman_modal_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($penanaman_modal_view->id_pm->Visible) { // id_pm ?>
	<tr id="r_id_pm">
		<td class="<?php echo $penanaman_modal_view->TableLeftColumnClass ?>"><span id="elh_penanaman_modal_id_pm"><?php echo $penanaman_modal_view->id_pm->caption() ?></span></td>
		<td data-name="id_pm" <?php echo $penanaman_modal_view->id_pm->cellAttributes() ?>>
<span id="el_penanaman_modal_id_pm">
<span<?php echo $penanaman_modal_view->id_pm->viewAttributes() ?>><?php echo $penanaman_modal_view->id_pm->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penanaman_modal_view->penanaman_modal->Visible) { // penanaman_modal ?>
	<tr id="r_penanaman_modal">
		<td class="<?php echo $penanaman_modal_view->TableLeftColumnClass ?>"><span id="elh_penanaman_modal_penanaman_modal"><?php echo $penanaman_modal_view->penanaman_modal->caption() ?></span></td>
		<td data-name="penanaman_modal" <?php echo $penanaman_modal_view->penanaman_modal->cellAttributes() ?>>
<span id="el_penanaman_modal_penanaman_modal">
<span<?php echo $penanaman_modal_view->penanaman_modal->viewAttributes() ?>><?php echo $penanaman_modal_view->penanaman_modal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$penanaman_modal_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$penanaman_modal_view->isExport()) { ?>
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
$penanaman_modal_view->terminate();
?>