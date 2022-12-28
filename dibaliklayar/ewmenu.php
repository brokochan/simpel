<?php
namespace PHPMaker2020\simpel;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
	$MenuRelativePath = "";
	$MenuLanguage = &$Language;
} else { // Compat reports
	$LANGUAGE_FOLDER = "../lang/";
	$MenuRelativePath = "../";
	$MenuLanguage = new Language();
}

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(3, "mi_izin_oss", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "izin_osslist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(2, "mi_izin_non_oss", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "izin_non_osslist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(13, "mci_Pengaturan", $MenuLanguage->MenuPhrase("13", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(4, "mi_jenis_badan_usaha", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "jenis_badan_usahalist.php", 13, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(5, "mi_jenis_izin", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "jenis_izinlist.php", 13, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(6, "mi_kbli", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "kblilist.php", 13, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(7, "mi_kecamatan", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "kecamatanlist.php", 13, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(8, "mi_penanaman_modal", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "penanaman_modallist.php", 13, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(10, "mi_skala_usaha", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "skala_usahalist.php", 13, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(9, "mi_sektor", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "sektorlist.php", 13, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(11, "mi_subsektor", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "subsektorlist.php", 13, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(12, "mi_user", $MenuLanguage->MenuPhrase("12", "MenuText"), $MenuRelativePath . "userlist.php", 13, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(1, "mi_hak_akses", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "hak_akseslist.php", 13, "", TRUE, FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>