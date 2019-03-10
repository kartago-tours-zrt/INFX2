<?php
require_once('../params.php');

include '../api_infx2/FileLoadService.php';

global $infxdata, $localInfxFiles;

// Mai nap, tegnapi adat nem kell
$dt = new DateTime('12:00am');

$filelist = getFilteredFilesList($infxdata , $dt);

// foreach ($filelist as $file) {
//     //var_dump($file);
//     echo $file->name . " - " . $file->date->format('Y-m-d H:i') . "\r\n";
// }

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