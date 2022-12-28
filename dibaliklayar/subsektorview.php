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
$subsektor_view = new subsektor_view();

// Run the page
$subsektor_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$subsektor_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$subsektor_view->isExport()) { ?>
<script>
var fsubsektorview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fsubsektorview = currentForm = new ew.Form("fsubsektorview", "view");
	loadjs.done("fsubsektorview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$subsektor_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $subsektor_view->ExportOptions->render("body") ?>
<?php $subsektor_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $subsektor_view->showPageHeader(); ?>
<?php
$subsektor_view->showMessage();
?>
<form name="fsubsektorview" id="fsubsektorview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="subsektor">
<input type="hidden" name="modal" value="<?php echo (int)$subsektor_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($subsektor_view->id_subsektor->Visible) { // id_subsektor ?>
	<tr id="r_id_subsektor">
		<td class="<?php echo $subsektor_view->TableLeftColumnClass ?>"><span id="elh_subsektor_id_subsektor"><?php echo $subsektor_view->id_subsektor->caption() ?></span></td>
		<td data-name="id_subsektor" <?php echo $subsektor_view->id_subsektor->cellAttributes() ?>>
<span id="el_subsektor_id_subsektor">
<span<?php echo $subsektor_view->id_subsektor->viewAttributes() ?>><?php echo $subsektor_view->id_subsektor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($subsektor_view->subsektor->Visible) { // subsektor ?>
	<tr id="r_subsektor">
		<td class="<?php echo $subsektor_view->TableLeftColumnClass ?>"><span id="elh_subsektor_subsektor"><?php echo $subsektor_view->subsektor->caption() ?></span></td>
		<td data-name="subsektor" <?php echo $subsektor_view->subsektor->cellAttributes() ?>>
<span id="el_subsektor_subsektor">
<span<?php echo $subsektor_view->subsektor->viewAttributes() ?>><?php echo $subsektor_view->subsektor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($subsektor_view->id_sektor->Visible) { // id_sektor ?>
	<tr id="r_id_sektor">
		<td class="<?php echo $subsektor_view->TableLeftColumnClass ?>"><span id="elh_subsektor_id_sektor"><?php echo $subsektor_view->id_sektor->caption() ?></span></td>
		<td data-name="id_sektor" <?php echo $subsektor_view->id_sektor->cellAttributes() ?>>
<span id="el_subsektor_id_sektor">
<span<?php echo $subsektor_view->id_sektor->viewAttributes() ?>><?php echo $subsektor_view->id_sektor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$subsektor_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$subsektor_view->isExport()) { ?>
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
$subsektor_view->terminate();
?>