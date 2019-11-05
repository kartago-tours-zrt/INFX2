/*
// fizetési ütemezés lekérése
*/
<?php
/* 
    Foglalás elkészítése
    Itt most a params.php file tartalmazza, melyik ajánlatot akarjuk foglalni
*/
require_once('../params.php');

include '../api_infx2/infxservice.php';

global $tesztAjanlat, $tesztAjanlatSzobaTipus, $tesztAjanlatGiata, $hazaerkezes;

$xml2 = simplexml_load_file("./Responses/PriceAvailabilityCheckMakeBookingResponse.xml");

// ha foglalható, ezt az ajánlatot lehet megjeleníteni
if (trim($xml2->Control->ResponseStatus) == "success") {
    
    // ha sikeres a foglalás
    if (trim($xml2->Booking->bnr_result) == "success") {
        // foglalási szám
        $bnr = $xml2->Booking->bnr;
        
        // fizetési ütemezés lekérése
        $file = './Responses/PaymentsByXMLDataInfoResponse.xml';
        file_put_contents($file, PaymentsByXMLDataInfoRequest($xml2, $paxs));

        // Foglalás részletes infó
        $file = './Responses/BookingInfoResponse1.xml';
        file_put_contents($file, BookingInfoRequest1($bnr));
    }
}

?>