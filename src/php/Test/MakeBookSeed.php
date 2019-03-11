<?php
require_once('../params.php');

include '../api_infx2/infxservice.php';

global $tesztAjanlat, $tesztAjanlatSzobaTipus, $tesztAjanlatGiata;

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
    $paxs = array('19990219','19990219','19990219');

    // ajánlat árképzésének betöltése
    $file = './Responses/PriceAvailabilityCheckMakeBookingResponse.xml';
    // utolsó paraméter nem 0, ezért opciós ajánlat készül
    file_put_contents($file, PriceAvailabilityCheckRequest($tesztAjanlat, $tesztAjanlatGiata, $tesztAjanlatSzobaTipus, $paxs, 1 ));

    // betöltjük a választ 
    // (éles rendszerben nem kell lementeni és betölteni!)
    $xml2 = simplexml_load_file("./Responses/PriceAvailabilityCheckMakeBookingResponse.xml");

    // ha foglalható, ezt az ajánlatot lehet megjeleníteni
    if (trim($xml2->Control->ResponseStatus) == "success") {
        
        // ha sikeres a foglalás
        if (trim($xml2->Booking->bnr_result) == "success") {
            // foglalási szám
            $bnr = $xml2->Booking->bnr;
            
            // foglalás alapadatok
            $file = './Responses/BookingInfoResponse.xml';
            file_put_contents($file, BookingInfoRequest($bnr));

            // utasadatok 
            $customer = array ("name"=>"Geza", "sname"=>"Proba", "title"=>"",
            "street"=>"Locsei ut 57", "city"=>"Budapest", "post_code"=>"1147",
            "country"=>"Hungary", "phone"=>"209472212", "email"=>"admin@kartagotours.hu");
        
            $pax1 = array ("id"=>"1", "fname"=>"Geza", "sname"=>"Proba",
                        "title"=>"", "idcrm"=>"", "sex"=>"M",
                        "bd"=>"03.09.1973", "passport"=>"", "nationality"=>"HUN");
            $pax2 = array ("id"=>"2", "fname"=>"Piroska", "sname"=>"Proba",
                        "title"=>"", "idcrm"=>"", "sex"=>"F",
                        "bd"=>"21.09.1989", "passport"=>"", "nationality"=>"HUN");
            $pax3 = array ("id"=>"3", "fname"=>"Bella", "sname"=>"Proba",
                        "title"=>"", "idcrm"=>"", "sex"=>"F",
                        "bd"=>"01.01.2010", "passport"=>"", "nationality"=>"HUN");

            // utasadatok tömb: szerződő és az utasok
            $paxs = array ($customer, $pax1, $pax2, $pax3);

            // Szerződő és utas adatok átadása
            $file = './Responses/BookingDataResponse.xml';
            file_put_contents($file, BookingDataRequest($xml2, $paxs));

            // fizetési ütemezés lekérése
            $file = './Responses/PaymentsByXMLDataInfoResponse.xml';
            file_put_contents($file, PaymentsByXMLDataInfoRequest($xml2, $paxs));

            // Foglalás részletes infó
            $file = './Responses/BookingInfoResponse1.xml';
            file_put_contents($file, BookingInfoRequest1($bnr));

            // Ez csak teszt, töröljük is le a foglalást!!
            $file = './Responses/BookingRemoveResponse.xml';
            file_put_contents($file, BookingRemoveRequest($bnr));
        }
    
    }
}

?>