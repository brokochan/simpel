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
$jenis_izin_edit = new jenis_izin_edit();

// Run the page
$jenis_izin_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jenis_izin_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fjenis_izinedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fjenis_izinedit = currentForm = new ew.Form("fjenis_izinedit", "edit");

	// Validate form
	fjenis_izinedit.validate = function() {
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
			<?php if ($jenis_izin_edit->id_jenis_izin->Required) { ?>
				elm = this.getElements("x" + infix + "_id_jenis_izin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jenis_izin_edit->id_jenis_izin->caption(), $jenis_izin_edit->id_jenis_izin->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jenis_izin_edit->jenis_izin->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis_izin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jenis_izin_edit->jenis_izin->caption(), $jenis_izin_edit->jenis_izin->RequiredErrorMessage)) ?>");
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
	fjenis_izinedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fjenis_izinedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fjenis_izinedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $jenis_izin_edit->showPageHeader(); ?>
<?php
$jenis_izin_edit->showMessage();
?>
<form name="fjenis_izinedit" id="fjenis_izinedit" class="<?php echo $jenis_izin_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jenis_izin">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$jenis_izin_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($jenis_izin_edit->id_jenis_izin->Visible) { // id_jenis_izin ?>
	<div id="r_id_jenis_izin" class="form-group row">
		<label id="elh_jenis_izin_id_jenis_izin" class="<?php echo $jenis_izin_edit->LeftColumnClass ?>"><?php echo $jenis_izin_edit->id_jenis_izin->caption() ?><?php echo $jenis_izin_edit->id_jenis_izin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jenis_izin_edit->RightColumnClass ?>"><div <?php echo $jenis_izin_edit->id_jenis_izin->cellAttributes() ?>>
<span id="el_jenis_izin_id_jenis_izin">
<span<?php echo $jenis_izin_edit->id_jenis_izin->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($jenis_izin_edit->id_jenis_izin->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="jenis_izin" data-field="x_id_jenis_izin" name="x_id_jenis_izin" id="x_id_jenis_izin" value="<?php echo HtmlEncode($jenis_izin_edit->id_jenis_izin->CurrentValue) ?>">
<?php echo $jenis_izin_edit->id_jenis_izin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jenis_izin_edit->jenis_izin->Visible) { // jenis_izin ?>
	<div id="r_jenis_izin" class="form-group row">
		<label id="elh_jenis_izin_jenis_izin" for="x_jenis_izin" class="<?php echo $jenis_izin_edit->LeftColumnClass ?>"><?php echo $jenis_izin_edit->jenis_izin->caption() ?><?php echo $jenis_izin_edit->jenis_izin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jenis_izin_edit->RightColumnClass ?>"><div <?php echo $jenis_izin_edit->jenis_izin->cellAttributes() ?>>
<span id="el_jenis_izin_jenis_izin">
<input type="text" data-table="jenis_izin" data-field="x_jenis_izin" name="x_jenis_izin" id="x_jenis_izin" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($jenis_izin_edit->jenis_izin->getPlaceHolder()) ?>" value="<?php echo $jenis_izin_edit->jenis_izin->EditValue ?>"<?php echo $jenis_izin_edit->jenis_izin->editAttributes() ?>>
</span>
<?php echo $jenis_izin_edit->jenis_izin->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$jenis_izin_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $jenis_izin_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $jenis_izin_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$jenis_izin_edit->showPageFooter();
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
$jenis_izin_edit->terminate();
?>