<?php 
require_once('../params.php');
require_once('../xml_adopt.php');

include '../infxservice.php';

$file = 'SeasonListResponse.xml';
file_put_contents($file, SeasonListRequest());
$file = 'BoardsResponse.xml';
file_put_contents($file, BoardsRequest());
$file = 'RoomTypesResponse.xml';
file_put_contents($file, RoomTypesRequest());
$file = 'AirportsResponse.xml';
file_put_contents($file, AirportsRequest());
$file = 'OtherPricesResponse.xml';
file_put_contents($file, OtherPricesRequest());
$file = 'AccomodationPriceResponse.xml';
file_put_contents($file, AccomodationPriceTypesRequest());
$file = 'GetAddPriceRulesResponse.xml';
file_put_contents($file, GetAddPriceRulesRequest());

$file = 'AvailabilityCheckResponse.xml';
file_put_contents($file, AvailabilityCheckRequest('2431452', '2+1_SV', '3' ));

$paxs = array('19990219','19990219','19990219');

$file = 'PriceAvailiablityCheckResponse.xml';
file_put_contents($file, PriceAvailiablityCheckRequest('2431452', 'A', '2+1_SV', $paxs ));

$file = 'ExtrasResponse.xml';
file_put_contents($file, ExtrasRequest('2431452'));

?>
