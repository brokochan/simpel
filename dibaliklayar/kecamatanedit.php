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
$kecamatan_edit = new kecamatan_edit();

// Run the page
$kecamatan_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kecamatan_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkecamatanedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fkecamatanedit = currentForm = new ew.Form("fkecamatanedit", "edit");

	// Validate form
	fkecamatanedit.validate = function() {
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
			<?php if ($kecamatan_edit->id_kecamatan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_kecamatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kecamatan_edit->id_kecamatan->caption(), $kecamatan_edit->id_kecamatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kecamatan_edit->kecamatan->Required) { ?>
				elm = this.getElements("x" + infix + "_kecamatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kecamatan_edit->kecamatan->caption(), $kecamatan_edit->kecamatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kecamatan_edit->kodepos->Required) { ?>
				elm = this.getElements("x" + infix + "_kodepos");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kecamatan_edit->kodepos->caption(), $kecamatan_edit->kodepos->RequiredErrorMessage)) ?>");
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
	fkecamatanedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fkecamatanedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fkecamatanedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $kecamatan_edit->showPageHeader(); ?>
<?php
$kecamatan_edit->showMessage();
?>
<form name="fkecamatanedit" id="fkecamatanedit" class="<?php echo $kecamatan_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kecamatan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$kecamatan_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($kecamatan_edit->id_kecamatan->Visible) { // id_kecamatan ?>
	<div id="r_id_kecamatan" class="form-group row">
		<label id="elh_kecamatan_id_kecamatan" class="<?php echo $kecamatan_edit->LeftColumnClass ?>"><?php echo $kecamatan_edit->id_kecamatan->caption() ?><?php echo $kecamatan_edit->id_kecamatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kecamatan_edit->RightColumnClass ?>"><div <?php echo $kecamatan_edit->id_kecamatan->cellAttributes() ?>>
<span id="el_kecamatan_id_kecamatan">
<span<?php echo $kecamatan_edit->id_kecamatan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kecamatan_edit->id_kecamatan->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="kecamatan" data-field="x_id_kecamatan" name="x_id_kecamatan" id="x_id_kecamatan" value="<?php echo HtmlEncode($kecamatan_edit->id_kecamatan->CurrentValue) ?>">
<?php echo $kecamatan_edit->id_kecamatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kecamatan_edit->kecamatan->Visible) { // kecamatan ?>
	<div id="r_kecamatan" class="form-group row">
		<label id="elh_kecamatan_kecamatan" for="x_kecamatan" class="<?php echo $kecamatan_edit->LeftColumnClass ?>"><?php echo $kecamatan_edit->kecamatan->caption() ?><?php echo $kecamatan_edit->kecamatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kecamatan_edit->RightColumnClass ?>"><div <?php echo $kecamatan_edit->kecamatan->cellAttributes() ?>>
<span id="el_kecamatan_kecamatan">
<input type="text" data-table="kecamatan" data-field="x_kecamatan" name="x_kecamatan" id="x_kecamatan" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($kecamatan_edit->kecamatan->getPlaceHolder()) ?>" value="<?php echo $kecamatan_edit->kecamatan->EditValue ?>"<?php echo $kecamatan_edit->kecamatan->editAttributes() ?>>
</span>
<?php echo $kecamatan_edit->kecamatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kecamatan_edit->kodepos->Visible) { // kodepos ?>
	<div id="r_kodepos" class="form-group row">
		<label id="elh_kecamatan_kodepos" for="x_kodepos" class="<?php echo $kecamatan_edit->LeftColumnClass ?>"><?php echo $kecamatan_edit->kodepos->caption() ?><?php echo $kecamatan_edit->kodepos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kecamatan_edit->RightColumnClass ?>"><div <?php echo $kecamatan_edit->kodepos->cellAttributes() ?>>
<span id="el_kecamatan_kodepos">
<input type="text" data-table="kecamatan" data-field="x_kodepos" name="x_kodepos" id="x_kodepos" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($kecamatan_edit->kodepos->getPlaceHolder()) ?>" value="<?php echo $kecamatan_edit->kodepos->EditValue ?>"<?php echo $kecamatan_edit->kodepos->editAttributes() ?>>
</span>
<?php echo $kecamatan_edit->kodepos->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$kecamatan_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $kecamatan_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $kecamatan_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$kecamatan_edit->showPageFooter();
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
$kecamatan_edit->terminate();
?>