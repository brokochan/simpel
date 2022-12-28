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
$kbli_delete = new kbli_delete();

// Run the page
$kbli_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kbli_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkblidelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fkblidelete = currentForm = new ew.Form("fkblidelete", "delete");
	loadjs.done("fkblidelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $kbli_delete->showPageHeader(); ?>
<?php
$kbli_delete->showMessage();
?>
<form name="fkblidelete" id="fkblidelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kbli">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($kbli_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($kbli_delete->kode_kbli->Visible) { // kode_kbli ?>
		<th class="<?php echo $kbli_delete->kode_kbli->headerCellClass() ?>"><span id="elh_kbli_kode_kbli" class="kbli_kode_kbli"><?php echo $kbli_delete->kode_kbli->caption() ?></span></th>
<?php } ?>
<?php if ($kbli_delete->judul_kbli->Visible) { // judul_kbli ?>
		<th class="<?php echo $kbli_delete->judul_kbli->headerCellClass() ?>"><span id="elh_kbli_judul_kbli" class="kbli_judul_kbli"><?php echo $kbli_delete->judul_kbli->caption() ?></span></th>
<?php } ?>
<?php if ($kbli_delete->tahun_kbli->Visible) { // tahun_kbli ?>
		<th class="<?php echo $kbli_delete->tahun_kbli->headerCellClass() ?>"><span id="elh_kbli_tahun_kbli" class="kbli_tahun_kbli"><?php echo $kbli_delete->tahun_kbli->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$kbli_delete->RecordCount = 0;
$i = 0;
while (!$kbli_delete->Recordset->EOF) {
	$kbli_delete->RecordCount++;
	$kbli_delete->RowCount++;

	// Set row properties
	$kbli->resetAttributes();
	$kbli->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$kbli_delete->loadRowValues($kbli_delete->Recordset);

	// Render row
	$kbli_delete->renderRow();
?>
	<tr <?php echo $kbli->rowAttributes() ?>>
<?php if ($kbli_delete->kode_kbli->Visible) { // kode_kbli ?>
		<td <?php echo $kbli_delete->kode_kbli->cellAttributes() ?>>
<span id="el<?php echo $kbli_delete->RowCount ?>_kbli_kode_kbli" class="kbli_kode_kbli">
<span<?php echo $kbli_delete->kode_kbli->viewAttributes() ?>><?php echo $kbli_delete->kode_kbli->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kbli_delete->judul_kbli->Visible) { // judul_kbli ?>
		<td <?php echo $kbli_delete->judul_kbli->cellAttributes() ?>>
<span id="el<?php echo $kbli_delete->RowCount ?>_kbli_judul_kbli" class="kbli_judul_kbli">
<span<?php echo $kbli_delete->judul_kbli->viewAttributes() ?>><?php echo $kbli_delete->judul_kbli->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kbli_delete->tahun_kbli->Visible) { // tahun_kbli ?>
		<td <?php echo $kbli_delete->tahun_kbli->cellAttributes() ?>>
<span id="el<?php echo $kbli_delete->RowCount ?>_kbli_tahun_kbli" class="kbli_tahun_kbli">
<span<?php echo $kbli_delete->tahun_kbli->viewAttributes() ?>><?php echo $kbli_delete->tahun_kbli->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$kbli_delete->Recordset->moveNext();
}
$kbli_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $kbli_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$kbli_delete->showPageFooter();
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
$kbli_delete->terminate();
?>