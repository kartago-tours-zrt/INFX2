/*
    Létrehozott utolsó foglalás törlése
*/
<?php
/* 
    Foglalás elkészítése
    Itt most a params.php file tartalmazza, melyik ajánlatot akarjuk foglalni
*/
require_once('../params.php');

include '../api_infx2/infxservice.php';

global $tesztAjanlat, $tesztAjanlatSzobaTipus, $tesztAjanlatGiata;

$xml2 = simplexml_load_file("./Responses/PriceAvailabilityCheckMakeBookingResponse.xml");

// ha foglalható, ezt az ajánlatot lehet megjeleníteni
if (trim($xml2->Control->ResponseStatus) == "success") {
    
    // ha sikeres a foglalás
    if (trim($xml2->Booking->bnr_result) == "success") {
        // foglalási szám
        $bnr = $xml2->Booking->bnr;
        
        // Ez csak teszt, töröljük is le a foglalást!!
        $file = './Responses/BookingRemoveResponse.xml';
        file_put_contents($file, BookingRemoveRequest($bnr));
    }
}

?>