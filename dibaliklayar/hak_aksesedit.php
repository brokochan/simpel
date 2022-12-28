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
$hak_akses_edit = new hak_akses_edit();

// Run the page
$hak_akses_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$hak_akses_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fhak_aksesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fhak_aksesedit = currentForm = new ew.Form("fhak_aksesedit", "edit");

	// Validate form
	fhak_aksesedit.validate = function() {
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
			<?php if ($hak_akses_edit->id_hak_akses->Required) { ?>
				elm = this.getElements("x" + infix + "_id_hak_akses");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $hak_akses_edit->id_hak_akses->caption(), $hak_akses_edit->id_hak_akses->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($hak_akses_edit->hak_akses->Required) { ?>
				elm = this.getElements("x" + infix + "_hak_akses");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $hak_akses_edit->hak_akses->caption(), $hak_akses_edit->hak_akses->RequiredErrorMessage)) ?>");
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
	fhak_aksesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fhak_aksesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fhak_aksesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $hak_akses_edit->showPageHeader(); ?>
<?php
$hak_akses_edit->showMessage();
?>
<form name="fhak_aksesedit" id="fhak_aksesedit" class="<?php echo $hak_akses_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="hak_akses">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$hak_akses_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($hak_akses_edit->id_hak_akses->Visible) { // id_hak_akses ?>
	<div id="r_id_hak_akses" class="form-group row">
		<label id="elh_hak_akses_id_hak_akses" class="<?php echo $hak_akses_edit->LeftColumnClass ?>"><?php echo $hak_akses_edit->id_hak_akses->caption() ?><?php echo $hak_akses_edit->id_hak_akses->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $hak_akses_edit->RightColumnClass ?>"><div <?php echo $hak_akses_edit->id_hak_akses->cellAttributes() ?>>
<span id="el_hak_akses_id_hak_akses">
<span<?php echo $hak_akses_edit->id_hak_akses->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($hak_akses_edit->id_hak_akses->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="hak_akses" data-field="x_id_hak_akses" name="x_id_hak_akses" id="x_id_hak_akses" value="<?php echo HtmlEncode($hak_akses_edit->id_hak_akses->CurrentValue) ?>">
<?php echo $hak_akses_edit->id_hak_akses->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($hak_akses_edit->hak_akses->Visible) { // hak_akses ?>
	<div id="r_hak_akses" class="form-group row">
		<label id="elh_hak_akses_hak_akses" for="x_hak_akses" class="<?php echo $hak_akses_edit->LeftColumnClass ?>"><?php echo $hak_akses_edit->hak_akses->caption() ?><?php echo $hak_akses_edit->hak_akses->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $hak_akses_edit->RightColumnClass ?>"><div <?php echo $hak_akses_edit->hak_akses->cellAttributes() ?>>
<span id="el_hak_akses_hak_akses">
<input type="text" data-table="hak_akses" data-field="x_hak_akses" name="x_hak_akses" id="x_hak_akses" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($hak_akses_edit->hak_akses->getPlaceHolder()) ?>" value="<?php echo $hak_akses_edit->hak_akses->EditValue ?>"<?php echo $hak_akses_edit->hak_akses->editAttributes() ?>>
</span>
<?php echo $hak_akses_edit->hak_akses->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$hak_akses_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $hak_akses_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $hak_akses_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$hak_akses_edit->showPageFooter();
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
$hak_akses_edit->terminate();
?>