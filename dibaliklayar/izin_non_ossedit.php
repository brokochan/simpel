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
$izin_non_oss_edit = new izin_non_oss_edit();

// Run the page
$izin_non_oss_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$izin_non_oss_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fizin_non_ossedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fizin_non_ossedit = currentForm = new ew.Form("fizin_non_ossedit", "edit");

	// Validate form
	fizin_non_ossedit.validate = function() {
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
			<?php if ($izin_non_oss_edit->id_izin_non_oss->Required) { ?>
				elm = this.getElements("x" + infix + "_id_izin_non_oss");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_non_oss_edit->id_izin_non_oss->caption(), $izin_non_oss_edit->id_izin_non_oss->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($izin_non_oss_edit->no_izin->Required) { ?>
				elm = this.getElements("x" + infix + "_no_izin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_non_oss_edit->no_izin->caption(), $izin_non_oss_edit->no_izin->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($izin_non_oss_edit->id_jenis_izin->Required) { ?>
				elm = this.getElements("x" + infix + "_id_jenis_izin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_non_oss_edit->id_jenis_izin->caption(), $izin_non_oss_edit->id_jenis_izin->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_jenis_izin");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($izin_non_oss_edit->id_jenis_izin->errorMessage()) ?>");
			<?php if ($izin_non_oss_edit->jenis_pemohon->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis_pemohon");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_non_oss_edit->jenis_pemohon->caption(), $izin_non_oss_edit->jenis_pemohon->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($izin_non_oss_edit->nama_pemohon->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_pemohon");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_non_oss_edit->nama_pemohon->caption(), $izin_non_oss_edit->nama_pemohon->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($izin_non_oss_edit->id_jbu->Required) { ?>
				elm = this.getElements("x" + infix + "_id_jbu");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_non_oss_edit->id_jbu->caption(), $izin_non_oss_edit->id_jbu->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_jbu");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($izin_non_oss_edit->id_jbu->errorMessage()) ?>");
			<?php if ($izin_non_oss_edit->id_sektor->Required) { ?>
				elm = this.getElements("x" + infix + "_id_sektor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_non_oss_edit->id_sektor->caption(), $izin_non_oss_edit->id_sektor->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_sektor");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($izin_non_oss_edit->id_sektor->errorMessage()) ?>");
			<?php if ($izin_non_oss_edit->id_subsektor->Required) { ?>
				elm = this.getElements("x" + infix + "_id_subsektor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_non_oss_edit->id_subsektor->caption(), $izin_non_oss_edit->id_subsektor->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_subsektor");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($izin_non_oss_edit->id_subsektor->errorMessage()) ?>");
			<?php if ($izin_non_oss_edit->tanggal_izin->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal_izin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_non_oss_edit->tanggal_izin->caption(), $izin_non_oss_edit->tanggal_izin->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal_izin");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($izin_non_oss_edit->tanggal_izin->errorMessage()) ?>");
			<?php if ($izin_non_oss_edit->alamat_pemohon->Required) { ?>
				elm = this.getElements("x" + infix + "_alamat_pemohon");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_non_oss_edit->alamat_pemohon->caption(), $izin_non_oss_edit->alamat_pemohon->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($izin_non_oss_edit->alamat_perusahaan->Required) { ?>
				elm = this.getElements("x" + infix + "_alamat_perusahaan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_non_oss_edit->alamat_perusahaan->caption(), $izin_non_oss_edit->alamat_perusahaan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($izin_non_oss_edit->alamat_proyek->Required) { ?>
				elm = this.getElements("x" + infix + "_alamat_proyek");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_non_oss_edit->alamat_proyek->caption(), $izin_non_oss_edit->alamat_proyek->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($izin_non_oss_edit->detail_izin->Required) { ?>
				elm = this.getElements("x" + infix + "_detail_izin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_non_oss_edit->detail_izin->caption(), $izin_non_oss_edit->detail_izin->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($izin_non_oss_edit->sysdate->Required) { ?>
				elm = this.getElements("x" + infix + "_sysdate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_non_oss_edit->sysdate->caption(), $izin_non_oss_edit->sysdate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sysdate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($izin_non_oss_edit->sysdate->errorMessage()) ?>");
			<?php if ($izin_non_oss_edit->id_user->Required) { ?>
				elm = this.getElements("x" + infix + "_id_user");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $izin_non_oss_edit->id_user->caption(), $izin_non_oss_edit->id_user->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_user");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($izin_non_oss_edit->id_user->errorMessage()) ?>");

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
	fizin_non_ossedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fizin_non_ossedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fizin_non_ossedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $izin_non_oss_edit->showPageHeader(); ?>
<?php
$izin_non_oss_edit->showMessage();
?>
<form name="fizin_non_ossedit" id="fizin_non_ossedit" class="<?php echo $izin_non_oss_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="izin_non_oss">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$izin_non_oss_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($izin_non_oss_edit->id_izin_non_oss->Visible) { // id_izin_non_oss ?>
	<div id="r_id_izin_non_oss" class="form-group row">
		<label id="elh_izin_non_oss_id_izin_non_oss" class="<?php echo $izin_non_oss_edit->LeftColumnClass ?>"><?php echo $izin_non_oss_edit->id_izin_non_oss->caption() ?><?php echo $izin_non_oss_edit->id_izin_non_oss->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_non_oss_edit->RightColumnClass ?>"><div <?php echo $izin_non_oss_edit->id_izin_non_oss->cellAttributes() ?>>
<span id="el_izin_non_oss_id_izin_non_oss">
<span<?php echo $izin_non_oss_edit->id_izin_non_oss->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($izin_non_oss_edit->id_izin_non_oss->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="izin_non_oss" data-field="x_id_izin_non_oss" name="x_id_izin_non_oss" id="x_id_izin_non_oss" value="<?php echo HtmlEncode($izin_non_oss_edit->id_izin_non_oss->CurrentValue) ?>">
<?php echo $izin_non_oss_edit->id_izin_non_oss->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($izin_non_oss_edit->no_izin->Visible) { // no_izin ?>
	<div id="r_no_izin" class="form-group row">
		<label id="elh_izin_non_oss_no_izin" for="x_no_izin" class="<?php echo $izin_non_oss_edit->LeftColumnClass ?>"><?php echo $izin_non_oss_edit->no_izin->caption() ?><?php echo $izin_non_oss_edit->no_izin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_non_oss_edit->RightColumnClass ?>"><div <?php echo $izin_non_oss_edit->no_izin->cellAttributes() ?>>
<span id="el_izin_non_oss_no_izin">
<input type="text" data-table="izin_non_oss" data-field="x_no_izin" name="x_no_izin" id="x_no_izin" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($izin_non_oss_edit->no_izin->getPlaceHolder()) ?>" value="<?php echo $izin_non_oss_edit->no_izin->EditValue ?>"<?php echo $izin_non_oss_edit->no_izin->editAttributes() ?>>
</span>
<?php echo $izin_non_oss_edit->no_izin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($izin_non_oss_edit->id_jenis_izin->Visible) { // id_jenis_izin ?>
	<div id="r_id_jenis_izin" class="form-group row">
		<label id="elh_izin_non_oss_id_jenis_izin" for="x_id_jenis_izin" class="<?php echo $izin_non_oss_edit->LeftColumnClass ?>"><?php echo $izin_non_oss_edit->id_jenis_izin->caption() ?><?php echo $izin_non_oss_edit->id_jenis_izin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_non_oss_edit->RightColumnClass ?>"><div <?php echo $izin_non_oss_edit->id_jenis_izin->cellAttributes() ?>>
<span id="el_izin_non_oss_id_jenis_izin">
<input type="text" data-table="izin_non_oss" data-field="x_id_jenis_izin" name="x_id_jenis_izin" id="x_id_jenis_izin" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($izin_non_oss_edit->id_jenis_izin->getPlaceHolder()) ?>" value="<?php echo $izin_non_oss_edit->id_jenis_izin->EditValue ?>"<?php echo $izin_non_oss_edit->id_jenis_izin->editAttributes() ?>>
</span>
<?php echo $izin_non_oss_edit->id_jenis_izin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($izin_non_oss_edit->jenis_pemohon->Visible) { // jenis_pemohon ?>
	<div id="r_jenis_pemohon" class="form-group row">
		<label id="elh_izin_non_oss_jenis_pemohon" for="x_jenis_pemohon" class="<?php echo $izin_non_oss_edit->LeftColumnClass ?>"><?php echo $izin_non_oss_edit->jenis_pemohon->caption() ?><?php echo $izin_non_oss_edit->jenis_pemohon->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_non_oss_edit->RightColumnClass ?>"><div <?php echo $izin_non_oss_edit->jenis_pemohon->cellAttributes() ?>>
<span id="el_izin_non_oss_jenis_pemohon">
<input type="text" data-table="izin_non_oss" data-field="x_jenis_pemohon" name="x_jenis_pemohon" id="x_jenis_pemohon" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($izin_non_oss_edit->jenis_pemohon->getPlaceHolder()) ?>" value="<?php echo $izin_non_oss_edit->jenis_pemohon->EditValue ?>"<?php echo $izin_non_oss_edit->jenis_pemohon->editAttributes() ?>>
</span>
<?php echo $izin_non_oss_edit->jenis_pemohon->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($izin_non_oss_edit->nama_pemohon->Visible) { // nama_pemohon ?>
	<div id="r_nama_pemohon" class="form-group row">
		<label id="elh_izin_non_oss_nama_pemohon" for="x_nama_pemohon" class="<?php echo $izin_non_oss_edit->LeftColumnClass ?>"><?php echo $izin_non_oss_edit->nama_pemohon->caption() ?><?php echo $izin_non_oss_edit->nama_pemohon->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_non_oss_edit->RightColumnClass ?>"><div <?php echo $izin_non_oss_edit->nama_pemohon->cellAttributes() ?>>
<span id="el_izin_non_oss_nama_pemohon">
<input type="text" data-table="izin_non_oss" data-field="x_nama_pemohon" name="x_nama_pemohon" id="x_nama_pemohon" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($izin_non_oss_edit->nama_pemohon->getPlaceHolder()) ?>" value="<?php echo $izin_non_oss_edit->nama_pemohon->EditValue ?>"<?php echo $izin_non_oss_edit->nama_pemohon->editAttributes() ?>>
</span>
<?php echo $izin_non_oss_edit->nama_pemohon->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($izin_non_oss_edit->id_jbu->Visible) { // id_jbu ?>
	<div id="r_id_jbu" class="form-group row">
		<label id="elh_izin_non_oss_id_jbu" for="x_id_jbu" class="<?php echo $izin_non_oss_edit->LeftColumnClass ?>"><?php echo $izin_non_oss_edit->id_jbu->caption() ?><?php echo $izin_non_oss_edit->id_jbu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_non_oss_edit->RightColumnClass ?>"><div <?php echo $izin_non_oss_edit->id_jbu->cellAttributes() ?>>
<span id="el_izin_non_oss_id_jbu">
<input type="text" data-table="izin_non_oss" data-field="x_id_jbu" name="x_id_jbu" id="x_id_jbu" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($izin_non_oss_edit->id_jbu->getPlaceHolder()) ?>" value="<?php echo $izin_non_oss_edit->id_jbu->EditValue ?>"<?php echo $izin_non_oss_edit->id_jbu->editAttributes() ?>>
</span>
<?php echo $izin_non_oss_edit->id_jbu->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($izin_non_oss_edit->id_sektor->Visible) { // id_sektor ?>
	<div id="r_id_sektor" class="form-group row">
		<label id="elh_izin_non_oss_id_sektor" for="x_id_sektor" class="<?php echo $izin_non_oss_edit->LeftColumnClass ?>"><?php echo $izin_non_oss_edit->id_sektor->caption() ?><?php echo $izin_non_oss_edit->id_sektor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_non_oss_edit->RightColumnClass ?>"><div <?php echo $izin_non_oss_edit->id_sektor->cellAttributes() ?>>
<span id="el_izin_non_oss_id_sektor">
<input type="text" data-table="izin_non_oss" data-field="x_id_sektor" name="x_id_sektor" id="x_id_sektor" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($izin_non_oss_edit->id_sektor->getPlaceHolder()) ?>" value="<?php echo $izin_non_oss_edit->id_sektor->EditValue ?>"<?php echo $izin_non_oss_edit->id_sektor->editAttributes() ?>>
</span>
<?php echo $izin_non_oss_edit->id_sektor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($izin_non_oss_edit->id_subsektor->Visible) { // id_subsektor ?>
	<div id="r_id_subsektor" class="form-group row">
		<label id="elh_izin_non_oss_id_subsektor" for="x_id_subsektor" class="<?php echo $izin_non_oss_edit->LeftColumnClass ?>"><?php echo $izin_non_oss_edit->id_subsektor->caption() ?><?php echo $izin_non_oss_edit->id_subsektor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_non_oss_edit->RightColumnClass ?>"><div <?php echo $izin_non_oss_edit->id_subsektor->cellAttributes() ?>>
<span id="el_izin_non_oss_id_subsektor">
<input type="text" data-table="izin_non_oss" data-field="x_id_subsektor" name="x_id_subsektor" id="x_id_subsektor" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($izin_non_oss_edit->id_subsektor->getPlaceHolder()) ?>" value="<?php echo $izin_non_oss_edit->id_subsektor->EditValue ?>"<?php echo $izin_non_oss_edit->id_subsektor->editAttributes() ?>>
</span>
<?php echo $izin_non_oss_edit->id_subsektor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($izin_non_oss_edit->tanggal_izin->Visible) { // tanggal_izin ?>
	<div id="r_tanggal_izin" class="form-group row">
		<label id="elh_izin_non_oss_tanggal_izin" for="x_tanggal_izin" class="<?php echo $izin_non_oss_edit->LeftColumnClass ?>"><?php echo $izin_non_oss_edit->tanggal_izin->caption() ?><?php echo $izin_non_oss_edit->tanggal_izin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_non_oss_edit->RightColumnClass ?>"><div <?php echo $izin_non_oss_edit->tanggal_izin->cellAttributes() ?>>
<span id="el_izin_non_oss_tanggal_izin">
<input type="text" data-table="izin_non_oss" data-field="x_tanggal_izin" name="x_tanggal_izin" id="x_tanggal_izin" maxlength="10" placeholder="<?php echo HtmlEncode($izin_non_oss_edit->tanggal_izin->getPlaceHolder()) ?>" value="<?php echo $izin_non_oss_edit->tanggal_izin->EditValue ?>"<?php echo $izin_non_oss_edit->tanggal_izin->editAttributes() ?>>
<?php if (!$izin_non_oss_edit->tanggal_izin->ReadOnly && !$izin_non_oss_edit->tanggal_izin->Disabled && !isset($izin_non_oss_edit->tanggal_izin->EditAttrs["readonly"]) && !isset($izin_non_oss_edit->tanggal_izin->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fizin_non_ossedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fizin_non_ossedit", "x_tanggal_izin", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $izin_non_oss_edit->tanggal_izin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($izin_non_oss_edit->alamat_pemohon->Visible) { // alamat_pemohon ?>
	<div id="r_alamat_pemohon" class="form-group row">
		<label id="elh_izin_non_oss_alamat_pemohon" for="x_alamat_pemohon" class="<?php echo $izin_non_oss_edit->LeftColumnClass ?>"><?php echo $izin_non_oss_edit->alamat_pemohon->caption() ?><?php echo $izin_non_oss_edit->alamat_pemohon->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_non_oss_edit->RightColumnClass ?>"><div <?php echo $izin_non_oss_edit->alamat_pemohon->cellAttributes() ?>>
<span id="el_izin_non_oss_alamat_pemohon">
<textarea data-table="izin_non_oss" data-field="x_alamat_pemohon" name="x_alamat_pemohon" id="x_alamat_pemohon" cols="35" rows="4" placeholder="<?php echo HtmlEncode($izin_non_oss_edit->alamat_pemohon->getPlaceHolder()) ?>"<?php echo $izin_non_oss_edit->alamat_pemohon->editAttributes() ?>><?php echo $izin_non_oss_edit->alamat_pemohon->EditValue ?></textarea>
</span>
<?php echo $izin_non_oss_edit->alamat_pemohon->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($izin_non_oss_edit->alamat_perusahaan->Visible) { // alamat_perusahaan ?>
	<div id="r_alamat_perusahaan" class="form-group row">
		<label id="elh_izin_non_oss_alamat_perusahaan" for="x_alamat_perusahaan" class="<?php echo $izin_non_oss_edit->LeftColumnClass ?>"><?php echo $izin_non_oss_edit->alamat_perusahaan->caption() ?><?php echo $izin_non_oss_edit->alamat_perusahaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_non_oss_edit->RightColumnClass ?>"><div <?php echo $izin_non_oss_edit->alamat_perusahaan->cellAttributes() ?>>
<span id="el_izin_non_oss_alamat_perusahaan">
<textarea data-table="izin_non_oss" data-field="x_alamat_perusahaan" name="x_alamat_perusahaan" id="x_alamat_perusahaan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($izin_non_oss_edit->alamat_perusahaan->getPlaceHolder()) ?>"<?php echo $izin_non_oss_edit->alamat_perusahaan->editAttributes() ?>><?php echo $izin_non_oss_edit->alamat_perusahaan->EditValue ?></textarea>
</span>
<?php echo $izin_non_oss_edit->alamat_perusahaan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($izin_non_oss_edit->alamat_proyek->Visible) { // alamat_proyek ?>
	<div id="r_alamat_proyek" class="form-group row">
		<label id="elh_izin_non_oss_alamat_proyek" for="x_alamat_proyek" class="<?php echo $izin_non_oss_edit->LeftColumnClass ?>"><?php echo $izin_non_oss_edit->alamat_proyek->caption() ?><?php echo $izin_non_oss_edit->alamat_proyek->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_non_oss_edit->RightColumnClass ?>"><div <?php echo $izin_non_oss_edit->alamat_proyek->cellAttributes() ?>>
<span id="el_izin_non_oss_alamat_proyek">
<textarea data-table="izin_non_oss" data-field="x_alamat_proyek" name="x_alamat_proyek" id="x_alamat_proyek" cols="35" rows="4" placeholder="<?php echo HtmlEncode($izin_non_oss_edit->alamat_proyek->getPlaceHolder()) ?>"<?php echo $izin_non_oss_edit->alamat_proyek->editAttributes() ?>><?php echo $izin_non_oss_edit->alamat_proyek->EditValue ?></textarea>
</span>
<?php echo $izin_non_oss_edit->alamat_proyek->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($izin_non_oss_edit->detail_izin->Visible) { // detail_izin ?>
	<div id="r_detail_izin" class="form-group row">
		<label id="elh_izin_non_oss_detail_izin" for="x_detail_izin" class="<?php echo $izin_non_oss_edit->LeftColumnClass ?>"><?php echo $izin_non_oss_edit->detail_izin->caption() ?><?php echo $izin_non_oss_edit->detail_izin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_non_oss_edit->RightColumnClass ?>"><div <?php echo $izin_non_oss_edit->detail_izin->cellAttributes() ?>>
<span id="el_izin_non_oss_detail_izin">
<textarea data-table="izin_non_oss" data-field="x_detail_izin" name="x_detail_izin" id="x_detail_izin" cols="35" rows="4" placeholder="<?php echo HtmlEncode($izin_non_oss_edit->detail_izin->getPlaceHolder()) ?>"<?php echo $izin_non_oss_edit->detail_izin->editAttributes() ?>><?php echo $izin_non_oss_edit->detail_izin->EditValue ?></textarea>
</span>
<?php echo $izin_non_oss_edit->detail_izin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($izin_non_oss_edit->sysdate->Visible) { // sysdate ?>
	<div id="r_sysdate" class="form-group row">
		<label id="elh_izin_non_oss_sysdate" for="x_sysdate" class="<?php echo $izin_non_oss_edit->LeftColumnClass ?>"><?php echo $izin_non_oss_edit->sysdate->caption() ?><?php echo $izin_non_oss_edit->sysdate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_non_oss_edit->RightColumnClass ?>"><div <?php echo $izin_non_oss_edit->sysdate->cellAttributes() ?>>
<span id="el_izin_non_oss_sysdate">
<input type="text" data-table="izin_non_oss" data-field="x_sysdate" name="x_sysdate" id="x_sysdate" maxlength="10" placeholder="<?php echo HtmlEncode($izin_non_oss_edit->sysdate->getPlaceHolder()) ?>" value="<?php echo $izin_non_oss_edit->sysdate->EditValue ?>"<?php echo $izin_non_oss_edit->sysdate->editAttributes() ?>>
<?php if (!$izin_non_oss_edit->sysdate->ReadOnly && !$izin_non_oss_edit->sysdate->Disabled && !isset($izin_non_oss_edit->sysdate->EditAttrs["readonly"]) && !isset($izin_non_oss_edit->sysdate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fizin_non_ossedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fizin_non_ossedit", "x_sysdate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $izin_non_oss_edit->sysdate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($izin_non_oss_edit->id_user->Visible) { // id_user ?>
	<div id="r_id_user" class="form-group row">
		<label id="elh_izin_non_oss_id_user" for="x_id_user" class="<?php echo $izin_non_oss_edit->LeftColumnClass ?>"><?php echo $izin_non_oss_edit->id_user->caption() ?><?php echo $izin_non_oss_edit->id_user->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $izin_non_oss_edit->RightColumnClass ?>"><div <?php echo $izin_non_oss_edit->id_user->cellAttributes() ?>>
<span id="el_izin_non_oss_id_user">
<input type="text" data-table="izin_non_oss" data-field="x_id_user" name="x_id_user" id="x_id_user" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($izin_non_oss_edit->id_user->getPlaceHolder()) ?>" value="<?php echo $izin_non_oss_edit->id_user->EditValue ?>"<?php echo $izin_non_oss_edit->id_user->editAttributes() ?>>
</span>
<?php echo $izin_non_oss_edit->id_user->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$izin_non_oss_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $izin_non_oss_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $izin_non_oss_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$izin_non_oss_edit->showPageFooter();
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
$izin_non_oss_edit->terminate();
?>