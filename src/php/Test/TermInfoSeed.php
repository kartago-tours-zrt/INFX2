<?php
/* 
    Online információ lekérése egy kiválasztott ajánlatról
    Itt most a params.php file tartalmazza, melyik ajánlatot akarjuk foglalni

    Előzetesen tudnunk kell hányan utaznak és az életkorokat.
*/
require_once('../params.php');

include '../api_infx2/infxservice.php';

global $tesztAjanlat, $tesztAjanlatSzobaTipus, $tesztAjanlatGiata;

// kiegészítő szolgáltatások letöltése adott ajánlathoz
$file = './Responses/ExtrasResponse.xml';
file_put_contents($file, ExtrasRequest($tesztAjanlat));

// ajánlat elérhetőségének ellenőrzése
$file = './Responses/AvailabilityCheckResponse.xml';
file_put_contents($file, AvailabilityCheckRequest($tesztAjanlat, $tesztAjanlatSzobaTipus, '3' ));

// betöltjük a választ 
// (éles rendszerben nem kell lementeni és betölteni!)
$xml1 = simplexml_load_file("./Responses/AvailabilityCheckResponse.xml");

// ha a válasz rendben és foglalható
if (trim($xml1->Control->ResponseStatus) == "success" && $xml1->Availibility->Book == "Y") {

    // utasok életkorai, a helyes árképzéshez 
    // (nem kell pontosan, de gyerek hazaérkezéskor ne legyen idősebb mint az itt megadott,
    // felnőttek esetében lényegtelen, csak 18 évnél idősebb legyen beállítva)
    $paxs = array('19990219','19990219','20100219');

    // ajánlat árképzésének betöltése
    $file = './Responses/PriceAvailabilityCheckResponse.xml';
    file_put_contents($file, PriceAvailabilityCheckRequest($tesztAjanlat, $tesztAjanlatGiata, $tesztAjanlatSzobaTipus, $paxs ));

    // betöltjük a választ 
    // (éles rendszerben nem kell lementeni és betölteni!)
    $xml2 = simplexml_load_file("./Responses/PriceAvailabilityCheckResponse.xml");

    // ha foglalható, ezt az ajánlatot lehet megjeleníteni
    if (trim($xml2->Control->ResponseStatus) == "success") {
        var_dump($xml2->Package->PriceDetails->asXML());
    }
}

?>