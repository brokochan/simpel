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
$user_edit = new user_edit();

// Run the page
$user_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fuseredit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fuseredit = currentForm = new ew.Form("fuseredit", "edit");

	// Validate form
	fuseredit.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($user_edit->id_user->Required) { ?>
				elm = this.getElements("x" + infix + "_id_user");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_edit->id_user->caption(), $user_edit->id_user->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($user_edit->nama_lengkap->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_lengkap");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_edit->nama_lengkap->caption(), $user_edit->nama_lengkap->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($user_edit->username->Required) { ?>
				elm = this.getElements("x" + infix + "_username");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_edit->username->caption(), $user_edit->username->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($user_edit->password->Required) { ?>
				elm = this.getElements("x" + infix + "_password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_edit->password->caption(), $user_edit->password->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($user_edit->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_edit->_email->caption(), $user_edit->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($user_edit->_email->errorMessage()) ?>");
			<?php if ($user_edit->_userlevel->Required) { ?>
				elm = this.getElements("x" + infix + "__userlevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_edit->_userlevel->caption(), $user_edit->_userlevel->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fuseredit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fuseredit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fuseredit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $user_edit->showPageHeader(); ?>
<?php
$user_edit->showMessage();
?>
<form name="fuseredit" id="fuseredit" class="<?php echo $user_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$user_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($user_edit->id_user->Visible) { // id_user ?>
	<div id="r_id_user" class="form-group row">
		<label id="elh_user_id_user" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user_edit->id_user->caption() ?><?php echo $user_edit->id_user->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div <?php echo $user_edit->id_user->cellAttributes() ?>>
<span id="el_user_id_user">
<span<?php echo $user_edit->id_user->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($user_edit->id_user->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_id_user" name="x_id_user" id="x_id_user" value="<?php echo HtmlEncode($user_edit->id_user->CurrentValue) ?>">
<?php echo $user_edit->id_user->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_edit->nama_lengkap->Visible) { // nama_lengkap ?>
	<div id="r_nama_lengkap" class="form-group row">
		<label id="elh_user_nama_lengkap" for="x_nama_lengkap" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user_edit->nama_lengkap->caption() ?><?php echo $user_edit->nama_lengkap->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div <?php echo $user_edit->nama_lengkap->cellAttributes() ?>>
<span id="el_user_nama_lengkap">
<input type="text" data-table="user" data-field="x_nama_lengkap" name="x_nama_lengkap" id="x_nama_lengkap" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($user_edit->nama_lengkap->getPlaceHolder()) ?>" value="<?php echo $user_edit->nama_lengkap->EditValue ?>"<?php echo $user_edit->nama_lengkap->editAttributes() ?>>
</span>
<?php echo $user_edit->nama_lengkap->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_edit->username->Visible) { // username ?>
	<div id="r_username" class="form-group row">
		<label id="elh_user_username" for="x_username" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user_edit->username->caption() ?><?php echo $user_edit->username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div <?php echo $user_edit->username->cellAttributes() ?>>
<span id="el_user_username">
<input type="text" data-table="user" data-field="x_username" name="x_username" id="x_username" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($user_edit->username->getPlaceHolder()) ?>" value="<?php echo $user_edit->username->EditValue ?>"<?php echo $user_edit->username->editAttributes() ?>>
</span>
<?php echo $user_edit->username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_edit->password->Visible) { // password ?>
	<div id="r_password" class="form-group row">
		<label id="elh_user_password" for="x_password" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user_edit->password->caption() ?><?php echo $user_edit->password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div <?php echo $user_edit->password->cellAttributes() ?>>
<span id="el_user_password">
<div class="input-group"><input type="password" name="x_password" id="x_password" autocomplete="new-password" data-field="x_password" value="<?php echo $user_edit->password->EditValue ?>" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($user_edit->password->getPlaceHolder()) ?>"<?php echo $user_edit->password->editAttributes() ?>><div class="input-group-append"><button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button></div></div>
</span>
<?php echo $user_edit->password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_edit->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_user__email" for="x__email" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user_edit->_email->caption() ?><?php echo $user_edit->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div <?php echo $user_edit->_email->cellAttributes() ?>>
<span id="el_user__email">
<input type="text" data-table="user" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($user_edit->_email->getPlaceHolder()) ?>" value="<?php echo $user_edit->_email->EditValue ?>"<?php echo $user_edit->_email->editAttributes() ?>>
</span>
<?php echo $user_edit->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_edit->_userlevel->Visible) { // userlevel ?>
	<div id="r__userlevel" class="form-group row">
		<label id="elh_user__userlevel" for="x__userlevel" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user_edit->_userlevel->caption() ?><?php echo $user_edit->_userlevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div <?php echo $user_edit->_userlevel->cellAttributes() ?>>
<span id="el_user__userlevel">
<input type="text" data-table="user" data-field="x__userlevel" name="x__userlevel" id="x__userlevel" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($user_edit->_userlevel->getPlaceHolder()) ?>" value="<?php echo $user_edit->_userlevel->EditValue ?>"<?php echo $user_edit->_userlevel->editAttributes() ?>>
</span>
<?php echo $user_edit->_userlevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$user_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $user_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $user_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$user_edit->showPageFooter();
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
$user_edit->terminate();
?>