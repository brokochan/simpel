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
$kbli_edit = new kbli_edit();

// Run the page
$kbli_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kbli_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkbliedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fkbliedit = currentForm = new ew.Form("fkbliedit", "edit");

	// Validate form
	fkbliedit.validate = function() {
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
			<?php if ($kbli_edit->kode_kbli->Required) { ?>
				elm = this.getElements("x" + infix + "_kode_kbli");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kbli_edit->kode_kbli->caption(), $kbli_edit->kode_kbli->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kbli_edit->judul_kbli->Required) { ?>
				elm = this.getElements("x" + infix + "_judul_kbli");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kbli_edit->judul_kbli->caption(), $kbli_edit->judul_kbli->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kbli_edit->uraian->Required) { ?>
				elm = this.getElements("x" + infix + "_uraian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kbli_edit->uraian->caption(), $kbli_edit->uraian->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kbli_edit->tahun_kbli->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun_kbli");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kbli_edit->tahun_kbli->caption(), $kbli_edit->tahun_kbli->RequiredErrorMessage)) ?>");
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
	fkbliedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fkbliedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fkbliedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $kbli_edit->showPageHeader(); ?>
<?php
$kbli_edit->showMessage();
?>
<form name="fkbliedit" id="fkbliedit" class="<?php echo $kbli_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kbli">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$kbli_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($kbli_edit->kode_kbli->Visible) { // kode_kbli ?>
	<div id="r_kode_kbli" class="form-group row">
		<label id="elh_kbli_kode_kbli" class="<?php echo $kbli_edit->LeftColumnClass ?>"><?php echo $kbli_edit->kode_kbli->caption() ?><?php echo $kbli_edit->kode_kbli->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kbli_edit->RightColumnClass ?>"><div <?php echo $kbli_edit->kode_kbli->cellAttributes() ?>>
<span id="el_kbli_kode_kbli">
<span<?php echo $kbli_edit->kode_kbli->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kbli_edit->kode_kbli->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="kbli" data-field="x_kode_kbli" name="x_kode_kbli" id="x_kode_kbli" value="<?php echo HtmlEncode($kbli_edit->kode_kbli->CurrentValue) ?>">
<?php echo $kbli_edit->kode_kbli->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kbli_edit->judul_kbli->Visible) { // judul_kbli ?>
	<div id="r_judul_kbli" class="form-group row">
		<label id="elh_kbli_judul_kbli" for="x_judul_kbli" class="<?php echo $kbli_edit->LeftColumnClass ?>"><?php echo $kbli_edit->judul_kbli->caption() ?><?php echo $kbli_edit->judul_kbli->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kbli_edit->RightColumnClass ?>"><div <?php echo $kbli_edit->judul_kbli->cellAttributes() ?>>
<span id="el_kbli_judul_kbli">
<input type="text" data-table="kbli" data-field="x_judul_kbli" name="x_judul_kbli" id="x_judul_kbli" size="30" maxlength="128" placeholder="<?php echo HtmlEncode($kbli_edit->judul_kbli->getPlaceHolder()) ?>" value="<?php echo $kbli_edit->judul_kbli->EditValue ?>"<?php echo $kbli_edit->judul_kbli->editAttributes() ?>>
</span>
<?php echo $kbli_edit->judul_kbli->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kbli_edit->uraian->Visible) { // uraian ?>
	<div id="r_uraian" class="form-group row">
		<label id="elh_kbli_uraian" for="x_uraian" class="<?php echo $kbli_edit->LeftColumnClass ?>"><?php echo $kbli_edit->uraian->caption() ?><?php echo $kbli_edit->uraian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kbli_edit->RightColumnClass ?>"><div <?php echo $kbli_edit->uraian->cellAttributes() ?>>
<span id="el_kbli_uraian">
<textarea data-table="kbli" data-field="x_uraian" name="x_uraian" id="x_uraian" cols="35" rows="4" placeholder="<?php echo HtmlEncode($kbli_edit->uraian->getPlaceHolder()) ?>"<?php echo $kbli_edit->uraian->editAttributes() ?>><?php echo $kbli_edit->uraian->EditValue ?></textarea>
</span>
<?php echo $kbli_edit->uraian->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kbli_edit->tahun_kbli->Visible) { // tahun_kbli ?>
	<div id="r_tahun_kbli" class="form-group row">
		<label id="elh_kbli_tahun_kbli" for="x_tahun_kbli" class="<?php echo $kbli_edit->LeftColumnClass ?>"><?php echo $kbli_edit->tahun_kbli->caption() ?><?php echo $kbli_edit->tahun_kbli->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kbli_edit->RightColumnClass ?>"><div <?php echo $kbli_edit->tahun_kbli->cellAttributes() ?>>
<span id="el_kbli_tahun_kbli">
<input type="text" data-table="kbli" data-field="x_tahun_kbli" name="x_tahun_kbli" id="x_tahun_kbli" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($kbli_edit->tahun_kbli->getPlaceHolder()) ?>" value="<?php echo $kbli_edit->tahun_kbli->EditValue ?>"<?php echo $kbli_edit->tahun_kbli->editAttributes() ?>>
</span>
<?php echo $kbli_edit->tahun_kbli->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$kbli_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $kbli_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $kbli_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$kbli_edit->showPageFooter();
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
$kbli_edit->terminate();
?>