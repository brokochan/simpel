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
$user_view = new user_view();

// Run the page
$user_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$user_view->isExport()) { ?>
<script>
var fuserview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fuserview = currentForm = new ew.Form("fuserview", "view");
	loadjs.done("fuserview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$user_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $user_view->ExportOptions->render("body") ?>
<?php $user_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $user_view->showPageHeader(); ?>
<?php
$user_view->showMessage();
?>
<form name="fuserview" id="fuserview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user">
<input type="hidden" name="modal" value="<?php echo (int)$user_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($user_view->id_user->Visible) { // id_user ?>
	<tr id="r_id_user">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_id_user"><?php echo $user_view->id_user->caption() ?></span></td>
		<td data-name="id_user" <?php echo $user_view->id_user->cellAttributes() ?>>
<span id="el_user_id_user">
<span<?php echo $user_view->id_user->viewAttributes() ?>><?php echo $user_view->id_user->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user_view->nama_lengkap->Visible) { // nama_lengkap ?>
	<tr id="r_nama_lengkap">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_nama_lengkap"><?php echo $user_view->nama_lengkap->caption() ?></span></td>
		<td data-name="nama_lengkap" <?php echo $user_view->nama_lengkap->cellAttributes() ?>>
<span id="el_user_nama_lengkap">
<span<?php echo $user_view->nama_lengkap->viewAttributes() ?>><?php echo $user_view->nama_lengkap->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user_view->username->Visible) { // username ?>
	<tr id="r_username">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_username"><?php echo $user_view->username->caption() ?></span></td>
		<td data-name="username" <?php echo $user_view->username->cellAttributes() ?>>
<span id="el_user_username">
<span<?php echo $user_view->username->viewAttributes() ?>><?php echo $user_view->username->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user_view->password->Visible) { // password ?>
	<tr id="r_password">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_password"><?php echo $user_view->password->caption() ?></span></td>
		<td data-name="password" <?php echo $user_view->password->cellAttributes() ?>>
<span id="el_user_password">
<span<?php echo $user_view->password->viewAttributes() ?>><?php echo $user_view->password->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user_view->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user__email"><?php echo $user_view->_email->caption() ?></span></td>
		<td data-name="_email" <?php echo $user_view->_email->cellAttributes() ?>>
<span id="el_user__email">
<span<?php echo $user_view->_email->viewAttributes() ?>><?php echo $user_view->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user_view->_userlevel->Visible) { // userlevel ?>
	<tr id="r__userlevel">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user__userlevel"><?php echo $user_view->_userlevel->caption() ?></span></td>
		<td data-name="_userlevel" <?php echo $user_view->_userlevel->cellAttributes() ?>>
<span id="el_user__userlevel">
<span<?php echo $user_view->_userlevel->viewAttributes() ?>><?php echo $user_view->_userlevel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$user_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$user_view->isExport()) { ?>
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
$user_view->terminate();
?>