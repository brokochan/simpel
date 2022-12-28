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
$subsektor_edit = new subsektor_edit();

// Run the page
$subsektor_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$subsektor_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsubsektoredit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fsubsektoredit = currentForm = new ew.Form("fsubsektoredit", "edit");

	// Validate form
	fsubsektoredit.validate = function() {
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
			<?php if ($subsektor_edit->id_subsektor->Required) { ?>
				elm = this.getElements("x" + infix + "_id_subsektor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $subsektor_edit->id_subsektor->caption(), $subsektor_edit->id_subsektor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($subsektor_edit->subsektor->Required) { ?>
				elm = this.getElements("x" + infix + "_subsektor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $subsektor_edit->subsektor->caption(), $subsektor_edit->subsektor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($subsektor_edit->id_sektor->Required) { ?>
				elm = this.getElements("x" + infix + "_id_sektor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $subsektor_edit->id_sektor->caption(), $subsektor_edit->id_sektor->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_sektor");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($subsektor_edit->id_sektor->errorMessage()) ?>");

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
	fsubsektoredit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsubsektoredit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fsubsektoredit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $subsektor_edit->showPageHeader(); ?>
<?php
$subsektor_edit->showMessage();
?>
<form name="fsubsektoredit" id="fsubsektoredit" class="<?php echo $subsektor_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="subsektor">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$subsektor_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($subsektor_edit->id_subsektor->Visible) { // id_subsektor ?>
	<div id="r_id_subsektor" class="form-group row">
		<label id="elh_subsektor_id_subsektor" class="<?php echo $subsektor_edit->LeftColumnClass ?>"><?php echo $subsektor_edit->id_subsektor->caption() ?><?php echo $subsektor_edit->id_subsektor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $subsektor_edit->RightColumnClass ?>"><div <?php echo $subsektor_edit->id_subsektor->cellAttributes() ?>>
<span id="el_subsektor_id_subsektor">
<span<?php echo $subsektor_edit->id_subsektor->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($subsektor_edit->id_subsektor->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="subsektor" data-field="x_id_subsektor" name="x_id_subsektor" id="x_id_subsektor" value="<?php echo HtmlEncode($subsektor_edit->id_subsektor->CurrentValue) ?>">
<?php echo $subsektor_edit->id_subsektor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($subsektor_edit->subsektor->Visible) { // subsektor ?>
	<div id="r_subsektor" class="form-group row">
		<label id="elh_subsektor_subsektor" for="x_subsektor" class="<?php echo $subsektor_edit->LeftColumnClass ?>"><?php echo $subsektor_edit->subsektor->caption() ?><?php echo $subsektor_edit->subsektor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $subsektor_edit->RightColumnClass ?>"><div <?php echo $subsektor_edit->subsektor->cellAttributes() ?>>
<span id="el_subsektor_subsektor">
<input type="text" data-table="subsektor" data-field="x_subsektor" name="x_subsektor" id="x_subsektor" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($subsektor_edit->subsektor->getPlaceHolder()) ?>" value="<?php echo $subsektor_edit->subsektor->EditValue ?>"<?php echo $subsektor_edit->subsektor->editAttributes() ?>>
</span>
<?php echo $subsektor_edit->subsektor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($subsektor_edit->id_sektor->Visible) { // id_sektor ?>
	<div id="r_id_sektor" class="form-group row">
		<label id="elh_subsektor_id_sektor" for="x_id_sektor" class="<?php echo $subsektor_edit->LeftColumnClass ?>"><?php echo $subsektor_edit->id_sektor->caption() ?><?php echo $subsektor_edit->id_sektor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $subsektor_edit->RightColumnClass ?>"><div <?php echo $subsektor_edit->id_sektor->cellAttributes() ?>>
<span id="el_subsektor_id_sektor">
<input type="text" data-table="subsektor" data-field="x_id_sektor" name="x_id_sektor" id="x_id_sektor" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($subsektor_edit->id_sektor->getPlaceHolder()) ?>" value="<?php echo $subsektor_edit->id_sektor->EditValue ?>"<?php echo $subsektor_edit->id_sektor->editAttributes() ?>>
</span>
<?php echo $subsektor_edit->id_sektor->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$subsektor_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $subsektor_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $subsektor_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$subsektor_edit->showPageFooter();
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
$subsektor_edit->terminate();
?>