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
$user_delete = new user_delete();

// Run the page
$user_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fuserdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fuserdelete = currentForm = new ew.Form("fuserdelete", "delete");
	loadjs.done("fuserdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $user_delete->showPageHeader(); ?>
<?php
$user_delete->showMessage();
?>
<form name="fuserdelete" id="fuserdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($user_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($user_delete->id_user->Visible) { // id_user ?>
		<th class="<?php echo $user_delete->id_user->headerCellClass() ?>"><span id="elh_user_id_user" class="user_id_user"><?php echo $user_delete->id_user->caption() ?></span></th>
<?php } ?>
<?php if ($user_delete->nama_lengkap->Visible) { // nama_lengkap ?>
		<th class="<?php echo $user_delete->nama_lengkap->headerCellClass() ?>"><span id="elh_user_nama_lengkap" class="user_nama_lengkap"><?php echo $user_delete->nama_lengkap->caption() ?></span></th>
<?php } ?>
<?php if ($user_delete->username->Visible) { // username ?>
		<th class="<?php echo $user_delete->username->headerCellClass() ?>"><span id="elh_user_username" class="user_username"><?php echo $user_delete->username->caption() ?></span></th>
<?php } ?>
<?php if ($user_delete->password->Visible) { // password ?>
		<th class="<?php echo $user_delete->password->headerCellClass() ?>"><span id="elh_user_password" class="user_password"><?php echo $user_delete->password->caption() ?></span></th>
<?php } ?>
<?php if ($user_delete->_email->Visible) { // email ?>
		<th class="<?php echo $user_delete->_email->headerCellClass() ?>"><span id="elh_user__email" class="user__email"><?php echo $user_delete->_email->caption() ?></span></th>
<?php } ?>
<?php if ($user_delete->_userlevel->Visible) { // userlevel ?>
		<th class="<?php echo $user_delete->_userlevel->headerCellClass() ?>"><span id="elh_user__userlevel" class="user__userlevel"><?php echo $user_delete->_userlevel->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$user_delete->RecordCount = 0;
$i = 0;
while (!$user_delete->Recordset->EOF) {
	$user_delete->RecordCount++;
	$user_delete->RowCount++;

	// Set row properties
	$user->resetAttributes();
	$user->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$user_delete->loadRowValues($user_delete->Recordset);

	// Render row
	$user_delete->renderRow();
?>
	<tr <?php echo $user->rowAttributes() ?>>
<?php if ($user_delete->id_user->Visible) { // id_user ?>
		<td <?php echo $user_delete->id_user->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCount ?>_user_id_user" class="user_id_user">
<span<?php echo $user_delete->id_user->viewAttributes() ?>><?php echo $user_delete->id_user->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user_delete->nama_lengkap->Visible) { // nama_lengkap ?>
		<td <?php echo $user_delete->nama_lengkap->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCount ?>_user_nama_lengkap" class="user_nama_lengkap">
<span<?php echo $user_delete->nama_lengkap->viewAttributes() ?>><?php echo $user_delete->nama_lengkap->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user_delete->username->Visible) { // username ?>
		<td <?php echo $user_delete->username->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCount ?>_user_username" class="user_username">
<span<?php echo $user_delete->username->viewAttributes() ?>><?php echo $user_delete->username->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user_delete->password->Visible) { // password ?>
		<td <?php echo $user_delete->password->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCount ?>_user_password" class="user_password">
<span<?php echo $user_delete->password->viewAttributes() ?>><?php echo $user_delete->password->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user_delete->_email->Visible) { // email ?>
		<td <?php echo $user_delete->_email->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCount ?>_user__email" class="user__email">
<span<?php echo $user_delete->_email->viewAttributes() ?>><?php echo $user_delete->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user_delete->_userlevel->Visible) { // userlevel ?>
		<td <?php echo $user_delete->_userlevel->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCount ?>_user__userlevel" class="user__userlevel">
<span<?php echo $user_delete->_userlevel->viewAttributes() ?>><?php echo $user_delete->_userlevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$user_delete->Recordset->moveNext();
}
$user_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $user_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$user_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$user_delete->terminate();
?>