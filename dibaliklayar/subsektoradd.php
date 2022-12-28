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
$subsektor_add = new subsektor_add();

// Run the page
$subsektor_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$subsektor_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsubsektoradd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fsubsektoradd = currentForm = new ew.Form("fsubsektoradd", "add");

	// Validate form
	fsubsektoradd.validate = function() {
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
			<?php if ($subsektor_add->subsektor->Required) { ?>
				elm = this.getElements("x" + infix + "_subsektor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $subsektor_add->subsektor->caption(), $subsektor_add->subsektor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($subsektor_add->id_sektor->Required) { ?>
				elm = this.getElements("x" + infix + "_id_sektor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $subsektor_add->id_sektor->caption(), $subsektor_add->id_sektor->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_sektor");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($subsektor_add->id_sektor->errorMessage()) ?>");

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
	fsubsektoradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsubsektoradd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fsubsektoradd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $subsektor_add->showPageHeader(); ?>
<?php
$subsektor_add->showMessage();
?>
<form name="fsubsektoradd" id="fsubsektoradd" class="<?php echo $subsektor_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="subsektor">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$subsektor_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($subsektor_add->subsektor->Visible) { // subsektor ?>
	<div id="r_subsektor" class="form-group row">
		<label id="elh_subsektor_subsektor" for="x_subsektor" class="<?php echo $subsektor_add->LeftColumnClass ?>"><?php echo $subsektor_add->subsektor->caption() ?><?php echo $subsektor_add->subsektor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $subsektor_add->RightColumnClass ?>"><div <?php echo $subsektor_add->subsektor->cellAttributes() ?>>
<span id="el_subsektor_subsektor">
<input type="text" data-table="subsektor" data-field="x_subsektor" name="x_subsektor" id="x_subsektor" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($subsektor_add->subsektor->getPlaceHolder()) ?>" value="<?php echo $subsektor_add->subsektor->EditValue ?>"<?php echo $subsektor_add->subsektor->editAttributes() ?>>
</span>
<?php echo $subsektor_add->subsektor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($subsektor_add->id_sektor->Visible) { // id_sektor ?>
	<div id="r_id_sektor" class="form-group row">
		<label id="elh_subsektor_id_sektor" for="x_id_sektor" class="<?php echo $subsektor_add->LeftColumnClass ?>"><?php echo $subsektor_add->id_sektor->caption() ?><?php echo $subsektor_add->id_sektor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $subsektor_add->RightColumnClass ?>"><div <?php echo $subsektor_add->id_sektor->cellAttributes() ?>>
<span id="el_subsektor_id_sektor">
<input type="text" data-table="subsektor" data-field="x_id_sektor" name="x_id_sektor" id="x_id_sektor" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($subsektor_add->id_sektor->getPlaceHolder()) ?>" value="<?php echo $subsektor_add->id_sektor->EditValue ?>"<?php echo $subsektor_add->id_sektor->editAttributes() ?>>
</span>
<?php echo $subsektor_add->id_sektor->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$subsektor_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $subsektor_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $subsektor_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$subsektor_add->showPageFooter();
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
$subsektor_add->terminate();
?>