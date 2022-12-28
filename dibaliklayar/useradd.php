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
$user_add = new user_add();

// Run the page
$user_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fuseradd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fuseradd = currentForm = new ew.Form("fuseradd", "add");

	// Validate form
	fuseradd.validate = function() {
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
			<?php if ($user_add->nama_lengkap->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_lengkap");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_add->nama_lengkap->caption(), $user_add->nama_lengkap->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($user_add->username->Required) { ?>
				elm = this.getElements("x" + infix + "_username");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_add->username->caption(), $user_add->username->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($user_add->password->Required) { ?>
				elm = this.getElements("x" + infix + "_password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_add->password->caption(), $user_add->password->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($user_add->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_add->_email->caption(), $user_add->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($user_add->_userlevel->Required) { ?>
				elm = this.getElements("x" + infix + "__userlevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_add->_userlevel->caption(), $user_add->_userlevel->RequiredErrorMessage)) ?>");
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
	fuseradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fuseradd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fuseradd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $user_add->showPageHeader(); ?>
<?php
$user_add->showMessage();
?>
<form name="fuseradd" id="fuseradd" class="<?php echo $user_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$user_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($user_add->nama_lengkap->Visible) { // nama_lengkap ?>
	<div id="r_nama_lengkap" class="form-group row">
		<label id="elh_user_nama_lengkap" for="x_nama_lengkap" class="<?php echo $user_add->LeftColumnClass ?>"><?php echo $user_add->nama_lengkap->caption() ?><?php echo $user_add->nama_lengkap->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_add->RightColumnClass ?>"><div <?php echo $user_add->nama_lengkap->cellAttributes() ?>>
<span id="el_user_nama_lengkap">
<input type="text" data-table="user" data-field="x_nama_lengkap" name="x_nama_lengkap" id="x_nama_lengkap" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($user_add->nama_lengkap->getPlaceHolder()) ?>" value="<?php echo $user_add->nama_lengkap->EditValue ?>"<?php echo $user_add->nama_lengkap->editAttributes() ?>>
</span>
<?php echo $user_add->nama_lengkap->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_add->username->Visible) { // username ?>
	<div id="r_username" class="form-group row">
		<label id="elh_user_username" for="x_username" class="<?php echo $user_add->LeftColumnClass ?>"><?php echo $user_add->username->caption() ?><?php echo $user_add->username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_add->RightColumnClass ?>"><div <?php echo $user_add->username->cellAttributes() ?>>
<span id="el_user_username">
<input type="text" data-table="user" data-field="x_username" name="x_username" id="x_username" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($user_add->username->getPlaceHolder()) ?>" value="<?php echo $user_add->username->EditValue ?>"<?php echo $user_add->username->editAttributes() ?>>
</span>
<?php echo $user_add->username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_add->password->Visible) { // password ?>
	<div id="r_password" class="form-group row">
		<label id="elh_user_password" for="x_password" class="<?php echo $user_add->LeftColumnClass ?>"><?php echo $user_add->password->caption() ?><?php echo $user_add->password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_add->RightColumnClass ?>"><div <?php echo $user_add->password->cellAttributes() ?>>
<span id="el_user_password">
<input type="text" data-table="user" data-field="x_password" name="x_password" id="x_password" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($user_add->password->getPlaceHolder()) ?>" value="<?php echo $user_add->password->EditValue ?>"<?php echo $user_add->password->editAttributes() ?>>
</span>
<?php echo $user_add->password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_add->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_user__email" for="x__email" class="<?php echo $user_add->LeftColumnClass ?>"><?php echo $user_add->_email->caption() ?><?php echo $user_add->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_add->RightColumnClass ?>"><div <?php echo $user_add->_email->cellAttributes() ?>>
<span id="el_user__email">
<input type="text" data-table="user" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($user_add->_email->getPlaceHolder()) ?>" value="<?php echo $user_add->_email->EditValue ?>"<?php echo $user_add->_email->editAttributes() ?>>
</span>
<?php echo $user_add->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_add->_userlevel->Visible) { // userlevel ?>
	<div id="r__userlevel" class="form-group row">
		<label id="elh_user__userlevel" for="x__userlevel" class="<?php echo $user_add->LeftColumnClass ?>"><?php echo $user_add->_userlevel->caption() ?><?php echo $user_add->_userlevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_add->RightColumnClass ?>"><div <?php echo $user_add->_userlevel->cellAttributes() ?>>
<span id="el_user__userlevel">
<input type="text" data-table="user" data-field="x__userlevel" name="x__userlevel" id="x__userlevel" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($user_add->_userlevel->getPlaceHolder()) ?>" value="<?php echo $user_add->_userlevel->EditValue ?>"<?php echo $user_add->_userlevel->editAttributes() ?>>
</span>
<?php echo $user_add->_userlevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$user_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $user_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $user_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$user_add->showPageFooter();
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
$user_add->terminate();
?>