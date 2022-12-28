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
$sektor_edit = new sektor_edit();

// Run the page
$sektor_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sektor_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsektoredit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fsektoredit = currentForm = new ew.Form("fsektoredit", "edit");

	// Validate form
	fsektoredit.validate = function() {
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
			<?php if ($sektor_edit->id_sektor->Required) { ?>
				elm = this.getElements("x" + infix + "_id_sektor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sektor_edit->id_sektor->caption(), $sektor_edit->id_sektor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($sektor_edit->sektor->Required) { ?>
				elm = this.getElements("x" + infix + "_sektor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sektor_edit->sektor->caption(), $sektor_edit->sektor->RequiredErrorMessage)) ?>");
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
	fsektoredit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsektoredit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fsektoredit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $sektor_edit->showPageHeader(); ?>
<?php
$sektor_edit->showMessage();
?>
<form name="fsektoredit" id="fsektoredit" class="<?php echo $sektor_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sektor">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$sektor_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($sektor_edit->id_sektor->Visible) { // id_sektor ?>
	<div id="r_id_sektor" class="form-group row">
		<label id="elh_sektor_id_sektor" class="<?php echo $sektor_edit->LeftColumnClass ?>"><?php echo $sektor_edit->id_sektor->caption() ?><?php echo $sektor_edit->id_sektor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sektor_edit->RightColumnClass ?>"><div <?php echo $sektor_edit->id_sektor->cellAttributes() ?>>
<span id="el_sektor_id_sektor">
<span<?php echo $sektor_edit->id_sektor->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($sektor_edit->id_sektor->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="sektor" data-field="x_id_sektor" name="x_id_sektor" id="x_id_sektor" value="<?php echo HtmlEncode($sektor_edit->id_sektor->CurrentValue) ?>">
<?php echo $sektor_edit->id_sektor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($sektor_edit->sektor->Visible) { // sektor ?>
	<div id="r_sektor" class="form-group row">
		<label id="elh_sektor_sektor" for="x_sektor" class="<?php echo $sektor_edit->LeftColumnClass ?>"><?php echo $sektor_edit->sektor->caption() ?><?php echo $sektor_edit->sektor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sektor_edit->RightColumnClass ?>"><div <?php echo $sektor_edit->sektor->cellAttributes() ?>>
<span id="el_sektor_sektor">
<input type="text" data-table="sektor" data-field="x_sektor" name="x_sektor" id="x_sektor" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($sektor_edit->sektor->getPlaceHolder()) ?>" value="<?php echo $sektor_edit->sektor->EditValue ?>"<?php echo $sektor_edit->sektor->editAttributes() ?>>
</span>
<?php echo $sektor_edit->sektor->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$sektor_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $sektor_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $sektor_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$sektor_edit->showPageFooter();
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
$sektor_edit->terminate();
?>