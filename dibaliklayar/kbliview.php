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
$kbli_view = new kbli_view();

// Run the page
$kbli_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kbli_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$kbli_view->isExport()) { ?>
<script>
var fkbliview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fkbliview = currentForm = new ew.Form("fkbliview", "view");
	loadjs.done("fkbliview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$kbli_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $kbli_view->ExportOptions->render("body") ?>
<?php $kbli_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $kbli_view->showPageHeader(); ?>
<?php
$kbli_view->showMessage();
?>
<form name="fkbliview" id="fkbliview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kbli">
<input type="hidden" name="modal" value="<?php echo (int)$kbli_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($kbli_view->kode_kbli->Visible) { // kode_kbli ?>
	<tr id="r_kode_kbli">
		<td class="<?php echo $kbli_view->TableLeftColumnClass ?>"><span id="elh_kbli_kode_kbli"><?php echo $kbli_view->kode_kbli->caption() ?></span></td>
		<td data-name="kode_kbli" <?php echo $kbli_view->kode_kbli->cellAttributes() ?>>
<span id="el_kbli_kode_kbli">
<span<?php echo $kbli_view->kode_kbli->viewAttributes() ?>><?php echo $kbli_view->kode_kbli->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kbli_view->judul_kbli->Visible) { // judul_kbli ?>
	<tr id="r_judul_kbli">
		<td class="<?php echo $kbli_view->TableLeftColumnClass ?>"><span id="elh_kbli_judul_kbli"><?php echo $kbli_view->judul_kbli->caption() ?></span></td>
		<td data-name="judul_kbli" <?php echo $kbli_view->judul_kbli->cellAttributes() ?>>
<span id="el_kbli_judul_kbli">
<span<?php echo $kbli_view->judul_kbli->viewAttributes() ?>><?php echo $kbli_view->judul_kbli->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kbli_view->uraian->Visible) { // uraian ?>
	<tr id="r_uraian">
		<td class="<?php echo $kbli_view->TableLeftColumnClass ?>"><span id="elh_kbli_uraian"><?php echo $kbli_view->uraian->caption() ?></span></td>
		<td data-name="uraian" <?php echo $kbli_view->uraian->cellAttributes() ?>>
<span id="el_kbli_uraian">
<span<?php echo $kbli_view->uraian->viewAttributes() ?>><?php echo $kbli_view->uraian->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kbli_view->tahun_kbli->Visible) { // tahun_kbli ?>
	<tr id="r_tahun_kbli">
		<td class="<?php echo $kbli_view->TableLeftColumnClass ?>"><span id="elh_kbli_tahun_kbli"><?php echo $kbli_view->tahun_kbli->caption() ?></span></td>
		<td data-name="tahun_kbli" <?php echo $kbli_view->tahun_kbli->cellAttributes() ?>>
<span id="el_kbli_tahun_kbli">
<span<?php echo $kbli_view->tahun_kbli->viewAttributes() ?>><?php echo $kbli_view->tahun_kbli->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$kbli_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$kbli_view->isExport()) { ?>
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
$kbli_view->terminate();
?>