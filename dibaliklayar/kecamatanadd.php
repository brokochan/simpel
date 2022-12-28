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
$kecamatan_add = new kecamatan_add();

// Run the page
$kecamatan_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kecamatan_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkecamatanadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fkecamatanadd = currentForm = new ew.Form("fkecamatanadd", "add");

	// Validate form
	fkecamatanadd.validate = function() {
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
			<?php if ($kecamatan_add->kecamatan->Required) { ?>
				elm = this.getElements("x" + infix + "_kecamatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kecamatan_add->kecamatan->caption(), $kecamatan_add->kecamatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kecamatan_add->kodepos->Required) { ?>
				elm = this.getElements("x" + infix + "_kodepos");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kecamatan_add->kodepos->caption(), $kecamatan_add->kodepos->RequiredErrorMessage)) ?>");
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
	fkecamatanadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fkecamatanadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fkecamatanadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $kecamatan_add->showPageHeader(); ?>
<?php
$kecamatan_add->showMessage();
?>
<form name="fkecamatanadd" id="fkecamatanadd" class="<?php echo $kecamatan_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kecamatan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$kecamatan_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($kecamatan_add->kecamatan->Visible) { // kecamatan ?>
	<div id="r_kecamatan" class="form-group row">
		<label id="elh_kecamatan_kecamatan" for="x_kecamatan" class="<?php echo $kecamatan_add->LeftColumnClass ?>"><?php echo $kecamatan_add->kecamatan->caption() ?><?php echo $kecamatan_add->kecamatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kecamatan_add->RightColumnClass ?>"><div <?php echo $kecamatan_add->kecamatan->cellAttributes() ?>>
<span id="el_kecamatan_kecamatan">
<input type="text" data-table="kecamatan" data-field="x_kecamatan" name="x_kecamatan" id="x_kecamatan" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($kecamatan_add->kecamatan->getPlaceHolder()) ?>" value="<?php echo $kecamatan_add->kecamatan->EditValue ?>"<?php echo $kecamatan_add->kecamatan->editAttributes() ?>>
</span>
<?php echo $kecamatan_add->kecamatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kecamatan_add->kodepos->Visible) { // kodepos ?>
	<div id="r_kodepos" class="form-group row">
		<label id="elh_kecamatan_kodepos" for="x_kodepos" class="<?php echo $kecamatan_add->LeftColumnClass ?>"><?php echo $kecamatan_add->kodepos->caption() ?><?php echo $kecamatan_add->kodepos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kecamatan_add->RightColumnClass ?>"><div <?php echo $kecamatan_add->kodepos->cellAttributes() ?>>
<span id="el_kecamatan_kodepos">
<input type="text" data-table="kecamatan" data-field="x_kodepos" name="x_kodepos" id="x_kodepos" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($kecamatan_add->kodepos->getPlaceHolder()) ?>" value="<?php echo $kecamatan_add->kodepos->EditValue ?>"<?php echo $kecamatan_add->kodepos->editAttributes() ?>>
</span>
<?php echo $kecamatan_add->kodepos->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$kecamatan_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $kecamatan_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $kecamatan_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$kecamatan_add->showPageFooter();
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
$kecamatan_add->terminate();
?>