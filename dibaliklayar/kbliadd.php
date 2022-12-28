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
$kbli_add = new kbli_add();

// Run the page
$kbli_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kbli_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkbliadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fkbliadd = currentForm = new ew.Form("fkbliadd", "add");

	// Validate form
	fkbliadd.validate = function() {
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
			<?php if ($kbli_add->judul_kbli->Required) { ?>
				elm = this.getElements("x" + infix + "_judul_kbli");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kbli_add->judul_kbli->caption(), $kbli_add->judul_kbli->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kbli_add->uraian->Required) { ?>
				elm = this.getElements("x" + infix + "_uraian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kbli_add->uraian->caption(), $kbli_add->uraian->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kbli_add->tahun_kbli->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun_kbli");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kbli_add->tahun_kbli->caption(), $kbli_add->tahun_kbli->RequiredErrorMessage)) ?>");
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
	fkbliadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fkbliadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fkbliadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $kbli_add->showPageHeader(); ?>
<?php
$kbli_add->showMessage();
?>
<form name="fkbliadd" id="fkbliadd" class="<?php echo $kbli_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kbli">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$kbli_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($kbli_add->judul_kbli->Visible) { // judul_kbli ?>
	<div id="r_judul_kbli" class="form-group row">
		<label id="elh_kbli_judul_kbli" for="x_judul_kbli" class="<?php echo $kbli_add->LeftColumnClass ?>"><?php echo $kbli_add->judul_kbli->caption() ?><?php echo $kbli_add->judul_kbli->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kbli_add->RightColumnClass ?>"><div <?php echo $kbli_add->judul_kbli->cellAttributes() ?>>
<span id="el_kbli_judul_kbli">
<input type="text" data-table="kbli" data-field="x_judul_kbli" name="x_judul_kbli" id="x_judul_kbli" size="30" maxlength="128" placeholder="<?php echo HtmlEncode($kbli_add->judul_kbli->getPlaceHolder()) ?>" value="<?php echo $kbli_add->judul_kbli->EditValue ?>"<?php echo $kbli_add->judul_kbli->editAttributes() ?>>
</span>
<?php echo $kbli_add->judul_kbli->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kbli_add->uraian->Visible) { // uraian ?>
	<div id="r_uraian" class="form-group row">
		<label id="elh_kbli_uraian" for="x_uraian" class="<?php echo $kbli_add->LeftColumnClass ?>"><?php echo $kbli_add->uraian->caption() ?><?php echo $kbli_add->uraian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kbli_add->RightColumnClass ?>"><div <?php echo $kbli_add->uraian->cellAttributes() ?>>
<span id="el_kbli_uraian">
<textarea data-table="kbli" data-field="x_uraian" name="x_uraian" id="x_uraian" cols="35" rows="4" placeholder="<?php echo HtmlEncode($kbli_add->uraian->getPlaceHolder()) ?>"<?php echo $kbli_add->uraian->editAttributes() ?>><?php echo $kbli_add->uraian->EditValue ?></textarea>
</span>
<?php echo $kbli_add->uraian->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kbli_add->tahun_kbli->Visible) { // tahun_kbli ?>
	<div id="r_tahun_kbli" class="form-group row">
		<label id="elh_kbli_tahun_kbli" for="x_tahun_kbli" class="<?php echo $kbli_add->LeftColumnClass ?>"><?php echo $kbli_add->tahun_kbli->caption() ?><?php echo $kbli_add->tahun_kbli->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kbli_add->RightColumnClass ?>"><div <?php echo $kbli_add->tahun_kbli->cellAttributes() ?>>
<span id="el_kbli_tahun_kbli">
<input type="text" data-table="kbli" data-field="x_tahun_kbli" name="x_tahun_kbli" id="x_tahun_kbli" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($kbli_add->tahun_kbli->getPlaceHolder()) ?>" value="<?php echo $kbli_add->tahun_kbli->EditValue ?>"<?php echo $kbli_add->tahun_kbli->editAttributes() ?>>
</span>
<?php echo $kbli_add->tahun_kbli->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$kbli_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $kbli_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $kbli_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$kbli_add->showPageFooter();
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
$kbli_add->terminate();
?>