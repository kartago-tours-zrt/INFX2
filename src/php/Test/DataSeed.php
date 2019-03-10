<?php 
require_once('../params.php');


include '../api_infx2/infxservice.php';
include '../api_infx2/FileLoadService.php';

// Hotel adatok letöltése
echo "Hotel adatok letöltése\r\n";
// dátum. Ennél régebbit ne töltsön le. Ha minden nap futtatjuk, akkor pl mindíg az előző napot állítsuk be. "P1D"
// első futtatáskor állítsunk be egy nagyon régi dátumot az összes adat letöltéséhez (pl: "P10Y" )
$dt = new DateTime();
$dt->sub(new DateInterval('P10Y'));

// params fileban rögzített helyről töltünk le a hotelinfokat
$files = getFilteredFilesList($GLOBALS['infxhotels'], $dt);
echo "Összes letöltendő file: " . count($files) . "\r\n";
downloadList($files, $GLOBALS['infxhotels'], dirname(__FILE__) . $GLOBALS['localHotelPath']);

// képek letöltése (ugyan azt a dátumot használhatjuk)
$files = getFilteredFilesList($GLOBALS['infxphotos'], $date);
echo "Összes letöltendő file: " . count($files) . "\r\n";
downloadList($files, $GLOBALS['infxphotos'], dirname(__FILE__) . $GLOBALS['localImagesPath']);

// szezonok letöltése
$file = './Responses/SeasonListResponse.xml';
file_put_contents($file, SeasonListRequest());

// ellátás típusok letöltése
$file = './Responses/BoardsResponse.xml';
file_put_contents($file, BoardsRequest());

// szobatípusok letültése
$file = './Responses/RoomTypesResponse.xml';
file_put_contents($file, RoomTypesRequest());

// repterek letöltése
$file = './Responses/AirportsResponse.xml';
file_put_contents($file, AirportsRequest());

// egyéb ártípusok letöltése
$file = './Responses/OtherPricesResponse.xml';
file_put_contents($file, OtherPricesRequest());

// felárak letöltése
$file = './Responses/AccomodationPriceResponse.xml';
file_put_contents($file, AccomodationPriceTypesRequest());

// Ár szabályok letöltése
$file = './Responses/GetAddPriceRulesResponse.xml';
file_put_contents($file, GetAddPriceRulesRequest());

?>
