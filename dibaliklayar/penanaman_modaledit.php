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
$penanaman_modal_edit = new penanaman_modal_edit();

// Run the page
$penanaman_modal_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penanaman_modal_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpenanaman_modaledit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fpenanaman_modaledit = currentForm = new ew.Form("fpenanaman_modaledit", "edit");

	// Validate form
	fpenanaman_modaledit.validate = function() {
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
			<?php if ($penanaman_modal_edit->id_pm->Required) { ?>
				elm = this.getElements("x" + infix + "_id_pm");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penanaman_modal_edit->id_pm->caption(), $penanaman_modal_edit->id_pm->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penanaman_modal_edit->penanaman_modal->Required) { ?>
				elm = this.getElements("x" + infix + "_penanaman_modal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penanaman_modal_edit->penanaman_modal->caption(), $penanaman_modal_edit->penanaman_modal->RequiredErrorMessage)) ?>");
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
	fpenanaman_modaledit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpenanaman_modaledit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpenanaman_modaledit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $penanaman_modal_edit->showPageHeader(); ?>
<?php
$penanaman_modal_edit->showMessage();
?>
<form name="fpenanaman_modaledit" id="fpenanaman_modaledit" class="<?php echo $penanaman_modal_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penanaman_modal">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$penanaman_modal_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($penanaman_modal_edit->id_pm->Visible) { // id_pm ?>
	<div id="r_id_pm" class="form-group row">
		<label id="elh_penanaman_modal_id_pm" class="<?php echo $penanaman_modal_edit->LeftColumnClass ?>"><?php echo $penanaman_modal_edit->id_pm->caption() ?><?php echo $penanaman_modal_edit->id_pm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penanaman_modal_edit->RightColumnClass ?>"><div <?php echo $penanaman_modal_edit->id_pm->cellAttributes() ?>>
<span id="el_penanaman_modal_id_pm">
<span<?php echo $penanaman_modal_edit->id_pm->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($penanaman_modal_edit->id_pm->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="penanaman_modal" data-field="x_id_pm" name="x_id_pm" id="x_id_pm" value="<?php echo HtmlEncode($penanaman_modal_edit->id_pm->CurrentValue) ?>">
<?php echo $penanaman_modal_edit->id_pm->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penanaman_modal_edit->penanaman_modal->Visible) { // penanaman_modal ?>
	<div id="r_penanaman_modal" class="form-group row">
		<label id="elh_penanaman_modal_penanaman_modal" for="x_penanaman_modal" class="<?php echo $penanaman_modal_edit->LeftColumnClass ?>"><?php echo $penanaman_modal_edit->penanaman_modal->caption() ?><?php echo $penanaman_modal_edit->penanaman_modal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penanaman_modal_edit->RightColumnClass ?>"><div <?php echo $penanaman_modal_edit->penanaman_modal->cellAttributes() ?>>
<span id="el_penanaman_modal_penanaman_modal">
<input type="text" data-table="penanaman_modal" data-field="x_penanaman_modal" name="x_penanaman_modal" id="x_penanaman_modal" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($penanaman_modal_edit->penanaman_modal->getPlaceHolder()) ?>" value="<?php echo $penanaman_modal_edit->penanaman_modal->EditValue ?>"<?php echo $penanaman_modal_edit->penanaman_modal->editAttributes() ?>>
</span>
<?php echo $penanaman_modal_edit->penanaman_modal->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$penanaman_modal_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $penanaman_modal_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $penanaman_modal_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$penanaman_modal_edit->showPageFooter();
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
$penanaman_modal_edit->terminate();
?>