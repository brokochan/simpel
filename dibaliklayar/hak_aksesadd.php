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
$hak_akses_add = new hak_akses_add();

// Run the page
$hak_akses_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$hak_akses_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fhak_aksesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fhak_aksesadd = currentForm = new ew.Form("fhak_aksesadd", "add");

	// Validate form
	fhak_aksesadd.validate = function() {
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
			<?php if ($hak_akses_add->hak_akses->Required) { ?>
				elm = this.getElements("x" + infix + "_hak_akses");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $hak_akses_add->hak_akses->caption(), $hak_akses_add->hak_akses->RequiredErrorMessage)) ?>");
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
	fhak_aksesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fhak_aksesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fhak_aksesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $hak_akses_add->showPageHeader(); ?>
<?php
$hak_akses_add->showMessage();
?>
<form name="fhak_aksesadd" id="fhak_aksesadd" class="<?php echo $hak_akses_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="hak_akses">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$hak_akses_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($hak_akses_add->hak_akses->Visible) { // hak_akses ?>
	<div id="r_hak_akses" class="form-group row">
		<label id="elh_hak_akses_hak_akses" for="x_hak_akses" class="<?php echo $hak_akses_add->LeftColumnClass ?>"><?php echo $hak_akses_add->hak_akses->caption() ?><?php echo $hak_akses_add->hak_akses->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $hak_akses_add->RightColumnClass ?>"><div <?php echo $hak_akses_add->hak_akses->cellAttributes() ?>>
<span id="el_hak_akses_hak_akses">
<input type="text" data-table="hak_akses" data-field="x_hak_akses" name="x_hak_akses" id="x_hak_akses" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($hak_akses_add->hak_akses->getPlaceHolder()) ?>" value="<?php echo $hak_akses_add->hak_akses->EditValue ?>"<?php echo $hak_akses_add->hak_akses->editAttributes() ?>>
</span>
<?php echo $hak_akses_add->hak_akses->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$hak_akses_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $hak_akses_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $hak_akses_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$hak_akses_add->showPageFooter();
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
$hak_akses_add->terminate();
?>