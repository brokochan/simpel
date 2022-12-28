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
$skala_usaha_edit = new skala_usaha_edit();

// Run the page
$skala_usaha_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$skala_usaha_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fskala_usahaedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fskala_usahaedit = currentForm = new ew.Form("fskala_usahaedit", "edit");

	// Validate form
	fskala_usahaedit.validate = function() {
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
			<?php if ($skala_usaha_edit->id_skala_usaha->Required) { ?>
				elm = this.getElements("x" + infix + "_id_skala_usaha");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $skala_usaha_edit->id_skala_usaha->caption(), $skala_usaha_edit->id_skala_usaha->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($skala_usaha_edit->skala_usaha->Required) { ?>
				elm = this.getElements("x" + infix + "_skala_usaha");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $skala_usaha_edit->skala_usaha->caption(), $skala_usaha_edit->skala_usaha->RequiredErrorMessage)) ?>");
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
	fskala_usahaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fskala_usahaedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fskala_usahaedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $skala_usaha_edit->showPageHeader(); ?>
<?php
$skala_usaha_edit->showMessage();
?>
<form name="fskala_usahaedit" id="fskala_usahaedit" class="<?php echo $skala_usaha_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="skala_usaha">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$skala_usaha_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($skala_usaha_edit->id_skala_usaha->Visible) { // id_skala_usaha ?>
	<div id="r_id_skala_usaha" class="form-group row">
		<label id="elh_skala_usaha_id_skala_usaha" class="<?php echo $skala_usaha_edit->LeftColumnClass ?>"><?php echo $skala_usaha_edit->id_skala_usaha->caption() ?><?php echo $skala_usaha_edit->id_skala_usaha->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $skala_usaha_edit->RightColumnClass ?>"><div <?php echo $skala_usaha_edit->id_skala_usaha->cellAttributes() ?>>
<span id="el_skala_usaha_id_skala_usaha">
<span<?php echo $skala_usaha_edit->id_skala_usaha->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($skala_usaha_edit->id_skala_usaha->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="skala_usaha" data-field="x_id_skala_usaha" name="x_id_skala_usaha" id="x_id_skala_usaha" value="<?php echo HtmlEncode($skala_usaha_edit->id_skala_usaha->CurrentValue) ?>">
<?php echo $skala_usaha_edit->id_skala_usaha->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($skala_usaha_edit->skala_usaha->Visible) { // skala_usaha ?>
	<div id="r_skala_usaha" class="form-group row">
		<label id="elh_skala_usaha_skala_usaha" for="x_skala_usaha" class="<?php echo $skala_usaha_edit->LeftColumnClass ?>"><?php echo $skala_usaha_edit->skala_usaha->caption() ?><?php echo $skala_usaha_edit->skala_usaha->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $skala_usaha_edit->RightColumnClass ?>"><div <?php echo $skala_usaha_edit->skala_usaha->cellAttributes() ?>>
<span id="el_skala_usaha_skala_usaha">
<input type="text" data-table="skala_usaha" data-field="x_skala_usaha" name="x_skala_usaha" id="x_skala_usaha" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($skala_usaha_edit->skala_usaha->getPlaceHolder()) ?>" value="<?php echo $skala_usaha_edit->skala_usaha->EditValue ?>"<?php echo $skala_usaha_edit->skala_usaha->editAttributes() ?>>
</span>
<?php echo $skala_usaha_edit->skala_usaha->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$skala_usaha_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $skala_usaha_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $skala_usaha_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$skala_usaha_edit->showPageFooter();
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
$skala_usaha_edit->terminate();
?>