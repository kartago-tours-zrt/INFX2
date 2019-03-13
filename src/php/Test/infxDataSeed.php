<?php
require_once('../params.php');

include '../api_infx2/FileLoadService.php';

global $infxdata, $localInfxFiles, $localHotelPath, $infxhotels, $infxphotos, $localImagesPath;

// Hotel adatok letöltése
echo "Hotel adatok letöltése\r\n";
// dátum. Ennél régebbit ne töltsön le. Ha minden nap futtatjuk, akkor pl mindíg az előző napot állítsuk be. "P1D"
// első futtatáskor állítsunk be egy nagyon régi dátumot az összes adat letöltéséhez (pl: "P10Y" )
$dt = new DateTime();
$dt->sub(new DateInterval('P1D'));

// // params fileban rögzített helyről töltünk le a hotelinfokat
// $files = getFilteredFilesList($infxhotels, $dt);
// echo "Összes letöltendő file: " . count($files) . "\r\n";
// downloadList($files, $infxhotels, dirname(__FILE__) . $localHotelPath);

// // képek letöltése (ugyan azt a dátumot használhatjuk)
// $files = getFilteredFilesList($infxphotos, $date);
// echo "Összes letöltendő file: " . count($files) . "\r\n";
// downloadList($files, $infxphotos, dirname(__FILE__) . $localImagesPath);


// Mai nap, tegnapi adat nem kell
$dt = new DateTime('12:00am');
$filelist = getFilteredFilesList($infxdata , $dt);

// INFX file letöltése (a tömörítettet!)
// file keresése
$files = findFilesFromFilteredList($filelist, "infx2_", ".txt.zip");
// letöltés
//var_dump($files);
downloadList($files, $infxdata, dirname(__FILE__) . $localInfxFiles);

// INFX Updt letöltése
// file keresése
$files = findFilesFromFilteredList($filelist, "updt_infx2_", ".txt.zip");
// letöltés
//var_dump($files);
downloadList($files, $infxdata, dirname(__FILE__) . $localInfxFiles);

// Price list letöltése
// file keresése
$files = findFilesFromFilteredList($filelist, "pl_infx2_", ".xml.zip");
// letöltés
//var_dump($files);
downloadList($files, $infxdata, dirname(__FILE__) . $localInfxFiles);

// Extrák letöltése
// file keresése
$files = findFilesFromFilteredList($filelist, "extras_list_", ".xml.zip");
// letöltés
//var_dump($files);
downloadList($files, $infxdata, dirname(__FILE__) . $localInfxFiles);

// Price list update letöltése
// file keresése
$files = findFilesFromFilteredList($filelist, "pl_updt_", ".xml");
// letöltés
//var_dump($files);
downloadList($files, $infxdata, dirname(__FILE__) . $localInfxFiles);

?>