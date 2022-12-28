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
$skala_usaha_add = new skala_usaha_add();

// Run the page
$skala_usaha_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$skala_usaha_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fskala_usahaadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fskala_usahaadd = currentForm = new ew.Form("fskala_usahaadd", "add");

	// Validate form
	fskala_usahaadd.validate = function() {
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
			<?php if ($skala_usaha_add->skala_usaha->Required) { ?>
				elm = this.getElements("x" + infix + "_skala_usaha");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $skala_usaha_add->skala_usaha->caption(), $skala_usaha_add->skala_usaha->RequiredErrorMessage)) ?>");
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
	fskala_usahaadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fskala_usahaadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fskala_usahaadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $skala_usaha_add->showPageHeader(); ?>
<?php
$skala_usaha_add->showMessage();
?>
<form name="fskala_usahaadd" id="fskala_usahaadd" class="<?php echo $skala_usaha_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="skala_usaha">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$skala_usaha_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($skala_usaha_add->skala_usaha->Visible) { // skala_usaha ?>
	<div id="r_skala_usaha" class="form-group row">
		<label id="elh_skala_usaha_skala_usaha" for="x_skala_usaha" class="<?php echo $skala_usaha_add->LeftColumnClass ?>"><?php echo $skala_usaha_add->skala_usaha->caption() ?><?php echo $skala_usaha_add->skala_usaha->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $skala_usaha_add->RightColumnClass ?>"><div <?php echo $skala_usaha_add->skala_usaha->cellAttributes() ?>>
<span id="el_skala_usaha_skala_usaha">
<input type="text" data-table="skala_usaha" data-field="x_skala_usaha" name="x_skala_usaha" id="x_skala_usaha" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($skala_usaha_add->skala_usaha->getPlaceHolder()) ?>" value="<?php echo $skala_usaha_add->skala_usaha->EditValue ?>"<?php echo $skala_usaha_add->skala_usaha->editAttributes() ?>>
</span>
<?php echo $skala_usaha_add->skala_usaha->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$skala_usaha_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $skala_usaha_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $skala_usaha_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$skala_usaha_add->showPageFooter();
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
$skala_usaha_add->terminate();
?>