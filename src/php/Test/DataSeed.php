<?php 
require_once('../params.php');

include '../api_infx2/infxservice.php';

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
