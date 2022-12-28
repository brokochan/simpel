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
$sektor_view = new sektor_view();

// Run the page
$sektor_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sektor_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$sektor_view->isExport()) { ?>
<script>
var fsektorview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fsektorview = currentForm = new ew.Form("fsektorview", "view");
	loadjs.done("fsektorview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$sektor_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $sektor_view->ExportOptions->render("body") ?>
<?php $sektor_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $sektor_view->showPageHeader(); ?>
<?php
$sektor_view->showMessage();
?>
<form name="fsektorview" id="fsektorview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sektor">
<input type="hidden" name="modal" value="<?php echo (int)$sektor_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($sektor_view->id_sektor->Visible) { // id_sektor ?>
	<tr id="r_id_sektor">
		<td class="<?php echo $sektor_view->TableLeftColumnClass ?>"><span id="elh_sektor_id_sektor"><?php echo $sektor_view->id_sektor->caption() ?></span></td>
		<td data-name="id_sektor" <?php echo $sektor_view->id_sektor->cellAttributes() ?>>
<span id="el_sektor_id_sektor">
<span<?php echo $sektor_view->id_sektor->viewAttributes() ?>><?php echo $sektor_view->id_sektor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sektor_view->sektor->Visible) { // sektor ?>
	<tr id="r_sektor">
		<td class="<?php echo $sektor_view->TableLeftColumnClass ?>"><span id="elh_sektor_sektor"><?php echo $sektor_view->sektor->caption() ?></span></td>
		<td data-name="sektor" <?php echo $sektor_view->sektor->cellAttributes() ?>>
<span id="el_sektor_sektor">
<span<?php echo $sektor_view->sektor->viewAttributes() ?>><?php echo $sektor_view->sektor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$sektor_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$sektor_view->isExport()) { ?>
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
$sektor_view->terminate();
?>