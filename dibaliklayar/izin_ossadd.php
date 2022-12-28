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
$izin_oss_add = new izin_oss_add();

// Run the page
$izin_oss_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$izin_oss_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fizin_ossadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fizin_ossadd = currentForm = new ew.Form("fizin_ossadd", "add");

	// Validate form
	fizin_ossadd.validate = function() {
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
			<?php if ($izin_oss_add->NIB->Required) { ?>
				elm = this.getElements("x" + infix + "_NIB");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_oss_add->NIB->caption(), $izin_oss_add->NIB->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($izin_oss_add->jenis_pelaku_usaha->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis_pelaku_usaha");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_oss_add->jenis_pelaku_usaha->caption(), $izin_oss_add->jenis_pelaku_usaha->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($izin_oss_add->nama_pelaku_usaha->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_pelaku_usaha");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_oss_add->nama_pelaku_usaha->caption(), $izin_oss_add->nama_pelaku_usaha->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($izin_oss_add->id_jbu->Required) { ?>
				elm = this.getElements("x" + infix + "_id_jbu");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_oss_add->id_jbu->caption(), $izin_oss_add->id_jbu->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_jbu");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($izin_oss_add->id_jbu->errorMessage()) ?>");
			<?php if ($izin_oss_add->id_pm->Required) { ?>
				elm = this.getElements("x" + infix + "_id_pm");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_oss_add->id_pm->caption(), $izin_oss_add->id_pm->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_pm");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($izin_oss_add->id_pm->errorMessage()) ?>");
			<?php if ($izin_oss_add->id_kecamatan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_kecamatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_oss_add->id_kecamatan->caption(), $izin_oss_add->id_kecamatan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_kecamatan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($izin_oss_add->id_kecamatan->errorMessage()) ?>");
			<?php if ($izin_oss_add->kode_kbli->Required) { ?>
				elm = this.getElements("x" + infix + "_kode_kbli");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_oss_add->kode_kbli->caption(), $izin_oss_add->kode_kbli->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kode_kbli");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($izin_oss_add->kode_kbli->errorMessage()) ?>");
			<?php if ($izin_oss_add->id_skala_usaha->Required) { ?>
				elm = this.getElements("x" + infix + "_id_skala_usaha");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_oss_add->id_skala_usaha->caption(), $izin_oss_add->id_skala_usaha->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_skala_usaha");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($izin_oss_add->id_skala_usaha->errorMessage()) ?>");
			<?php if ($izin_oss_add->sysdate->Required) { ?>
				elm = this.getElements("x" + infix + "_sysdate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_oss_add->sysdate->caption(), $izin_oss_add->sysdate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sysdate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($izin_oss_add->sysdate->errorMessage()) ?>");
			<?php if ($izin_oss_add->id_user->Required) { ?>
				elm = this.getElements("x" + infix + "_id_user");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_oss_add->id_user->caption(), $izin_oss_add->id_user->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_user");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($izin_oss_add->id_user->errorMessage()) ?>");

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
	fizin_ossadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fizin_ossadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fizin_ossadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $izin_oss_add->showPageHeader(); ?>
<?php
$izin_oss_add->showMessage();
?>
<form name="fizin_ossadd" id="fizin_ossadd" class="<?php echo $izin_oss_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="izin_oss">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$izin_oss_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($izin_oss_add->NIB->Visible) { // NIB ?>
	<div id="r_NIB" class="form-group row">
		<label id="elh_izin_oss_NIB" for="x_NIB" class="<?php echo $izin_oss_add->LeftColumnClass ?>"><?php echo $izin_oss_add->NIB->caption() ?><?php echo $izin_oss_add->NIB->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_oss_add->RightColumnClass ?>"><div <?php echo $izin_oss_add->NIB->cellAttributes() ?>>
<span id="el_izin_oss_NIB">
<input type="text" data-table="izin_oss" data-field="x_NIB" name="x_NIB" id="x_NIB" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($izin_oss_add->NIB->getPlaceHolder()) ?>" value="<?php echo $izin_oss_add->NIB->EditValue ?>"<?php echo $izin_oss_add->NIB->editAttributes() ?>>
</span>
<?php echo $izin_oss_add->NIB->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($izin_oss_add->jenis_pelaku_usaha->Visible) { // jenis_pelaku_usaha ?>
	<div id="r_jenis_pelaku_usaha" class="form-group row">
		<label id="elh_izin_oss_jenis_pelaku_usaha" for="x_jenis_pelaku_usaha" class="<?php echo $izin_oss_add->LeftColumnClass ?>"><?php echo $izin_oss_add->jenis_pelaku_usaha->caption() ?><?php echo $izin_oss_add->jenis_pelaku_usaha->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_oss_add->RightColumnClass ?>"><div <?php echo $izin_oss_add->jenis_pelaku_usaha->cellAttributes() ?>>
<span id="el_izin_oss_jenis_pelaku_usaha">
<input type="text" data-table="izin_oss" data-field="x_jenis_pelaku_usaha" name="x_jenis_pelaku_usaha" id="x_jenis_pelaku_usaha" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($izin_oss_add->jenis_pelaku_usaha->getPlaceHolder()) ?>" value="<?php echo $izin_oss_add->jenis_pelaku_usaha->EditValue ?>"<?php echo $izin_oss_add->jenis_pelaku_usaha->editAttributes() ?>>
</span>
<?php echo $izin_oss_add->jenis_pelaku_usaha->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($izin_oss_add->nama_pelaku_usaha->Visible) { // nama_pelaku_usaha ?>
	<div id="r_nama_pelaku_usaha" class="form-group row">
		<label id="elh_izin_oss_nama_pelaku_usaha" for="x_nama_pelaku_usaha" class="<?php echo $izin_oss_add->LeftColumnClass ?>"><?php echo $izin_oss_add->nama_pelaku_usaha->caption() ?><?php echo $izin_oss_add->nama_pelaku_usaha->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_oss_add->RightColumnClass ?>"><div <?php echo $izin_oss_add->nama_pelaku_usaha->cellAttributes() ?>>
<span id="el_izin_oss_nama_pelaku_usaha">
<input type="text" data-table="izin_oss" data-field="x_nama_pelaku_usaha" name="x_nama_pelaku_usaha" id="x_nama_pelaku_usaha" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($izin_oss_add->nama_pelaku_usaha->getPlaceHolder()) ?>" value="<?php echo $izin_oss_add->nama_pelaku_usaha->EditValue ?>"<?php echo $izin_oss_add->nama_pelaku_usaha->editAttributes() ?>>
</span>
<?php echo $izin_oss_add->nama_pelaku_usaha->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($izin_oss_add->id_jbu->Visible) { // id_jbu ?>
	<div id="r_id_jbu" class="form-group row">
		<label id="elh_izin_oss_id_jbu" for="x_id_jbu" class="<?php echo $izin_oss_add->LeftColumnClass ?>"><?php echo $izin_oss_add->id_jbu->caption() ?><?php echo $izin_oss_add->id_jbu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_oss_add->RightColumnClass ?>"><div <?php echo $izin_oss_add->id_jbu->cellAttributes() ?>>
<span id="el_izin_oss_id_jbu">
<input type="text" data-table="izin_oss" data-field="x_id_jbu" name="x_id_jbu" id="x_id_jbu" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($izin_oss_add->id_jbu->getPlaceHolder()) ?>" value="<?php echo $izin_oss_add->id_jbu->EditValue ?>"<?php echo $izin_oss_add->id_jbu->editAttributes() ?>>
</span>
<?php echo $izin_oss_add->id_jbu->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($izin_oss_add->id_pm->Visible) { // id_pm ?>
	<div id="r_id_pm" class="form-group row">
		<label id="elh_izin_oss_id_pm" for="x_id_pm" class="<?php echo $izin_oss_add->LeftColumnClass ?>"><?php echo $izin_oss_add->id_pm->caption() ?><?php echo $izin_oss_add->id_pm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_oss_add->RightColumnClass ?>"><div <?php echo $izin_oss_add->id_pm->cellAttributes() ?>>
<span id="el_izin_oss_id_pm">
<input type="text" data-table="izin_oss" data-field="x_id_pm" name="x_id_pm" id="x_id_pm" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($izin_oss_add->id_pm->getPlaceHolder()) ?>" value="<?php echo $izin_oss_add->id_pm->EditValue ?>"<?php echo $izin_oss_add->id_pm->editAttributes() ?>>
</span>
<?php echo $izin_oss_add->id_pm->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($izin_oss_add->id_kecamatan->Visible) { // id_kecamatan ?>
	<div id="r_id_kecamatan" class="form-group row">
		<label id="elh_izin_oss_id_kecamatan" for="x_id_kecamatan" class="<?php echo $izin_oss_add->LeftColumnClass ?>"><?php echo $izin_oss_add->id_kecamatan->caption() ?><?php echo $izin_oss_add->id_kecamatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_oss_add->RightColumnClass ?>"><div <?php echo $izin_oss_add->id_kecamatan->cellAttributes() ?>>
<span id="el_izin_oss_id_kecamatan">
<input type="text" data-table="izin_oss" data-field="x_id_kecamatan" name="x_id_kecamatan" id="x_id_kecamatan" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($izin_oss_add->id_kecamatan->getPlaceHolder()) ?>" value="<?php echo $izin_oss_add->id_kecamatan->EditValue ?>"<?php echo $izin_oss_add->id_kecamatan->editAttributes() ?>>
</span>
<?php echo $izin_oss_add->id_kecamatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($izin_oss_add->kode_kbli->Visible) { // kode_kbli ?>
	<div id="r_kode_kbli" class="form-group row">
		<label id="elh_izin_oss_kode_kbli" for="x_kode_kbli" class="<?php echo $izin_oss_add->LeftColumnClass ?>"><?php echo $izin_oss_add->kode_kbli->caption() ?><?php echo $izin_oss_add->kode_kbli->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_oss_add->RightColumnClass ?>"><div <?php echo $izin_oss_add->kode_kbli->cellAttributes() ?>>
<span id="el_izin_oss_kode_kbli">
<input type="text" data-table="izin_oss" data-field="x_kode_kbli" name="x_kode_kbli" id="x_kode_kbli" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($izin_oss_add->kode_kbli->getPlaceHolder()) ?>" value="<?php echo $izin_oss_add->kode_kbli->EditValue ?>"<?php echo $izin_oss_add->kode_kbli->editAttributes() ?>>
</span>
<?php echo $izin_oss_add->kode_kbli->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($izin_oss_add->id_skala_usaha->Visible) { // id_skala_usaha ?>
	<div id="r_id_skala_usaha" class="form-group row">
		<label id="elh_izin_oss_id_skala_usaha" for="x_id_skala_usaha" class="<?php echo $izin_oss_add->LeftColumnClass ?>"><?php echo $izin_oss_add->id_skala_usaha->caption() ?><?php echo $izin_oss_add->id_skala_usaha->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_oss_add->RightColumnClass ?>"><div <?php echo $izin_oss_add->id_skala_usaha->cellAttributes() ?>>
<span id="el_izin_oss_id_skala_usaha">
<input type="text" data-table="izin_oss" data-field="x_id_skala_usaha" name="x_id_skala_usaha" id="x_id_skala_usaha" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($izin_oss_add->id_skala_usaha->getPlaceHolder()) ?>" value="<?php echo $izin_oss_add->id_skala_usaha->EditValue ?>"<?php echo $izin_oss_add->id_skala_usaha->editAttributes() ?>>
</span>
<?php echo $izin_oss_add->id_skala_usaha->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($izin_oss_add->sysdate->Visible) { // sysdate ?>
	<div id="r_sysdate" class="form-group row">
		<label id="elh_izin_oss_sysdate" for="x_sysdate" class="<?php echo $izin_oss_add->LeftColumnClass ?>"><?php echo $izin_oss_add->sysdate->caption() ?><?php echo $izin_oss_add->sysdate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_oss_add->RightColumnClass ?>"><div <?php echo $izin_oss_add->sysdate->cellAttributes() ?>>
<span id="el_izin_oss_sysdate">
<input type="text" data-table="izin_oss" data-field="x_sysdate" name="x_sysdate" id="x_sysdate" maxlength="10" placeholder="<?php echo HtmlEncode($izin_oss_add->sysdate->getPlaceHolder()) ?>" value="<?php echo $izin_oss_add->sysdate->EditValue ?>"<?php echo $izin_oss_add->sysdate->editAttributes() ?>>
<?php if (!$izin_oss_add->sysdate->ReadOnly && !$izin_oss_add->sysdate->Disabled && !isset($izin_oss_add->sysdate->EditAttrs["readonly"]) && !isset($izin_oss_add->sysdate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fizin_ossadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fizin_ossadd", "x_sysdate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $izin_oss_add->sysdate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($izin_oss_add->id_user->Visible) { // id_user ?>
	<div id="r_id_user" class="form-group row">
		<label id="elh_izin_oss_id_user" for="x_id_user" class="<?php echo $izin_oss_add->LeftColumnClass ?>"><?php echo $izin_oss_add->id_user->caption() ?><?php echo $izin_oss_add->id_user->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_oss_add->RightColumnClass ?>"><div <?php echo $izin_oss_add->id_user->cellAttributes() ?>>
<span id="el_izin_oss_id_user">
<input type="text" data-table="izin_oss" data-field="x_id_user" name="x_id_user" id="x_id_user" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($izin_oss_add->id_user->getPlaceHolder()) ?>" value="<?php echo $izin_oss_add->id_user->EditValue ?>"<?php echo $izin_oss_add->id_user->editAttributes() ?>>
</span>
<?php echo $izin_oss_add->id_user->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$izin_oss_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $izin_oss_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $izin_oss_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$izin_oss_add->showPageFooter();
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
$izin_oss_add->terminate();
?>