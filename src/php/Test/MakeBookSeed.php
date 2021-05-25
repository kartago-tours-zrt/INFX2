<?php
/* 
    Foglalás elkészítése
    Itt most a params.php file tartalmazza, melyik ajánlatot akarjuk foglalni
*/
require_once('../params.php');

include '../api_infx2/infxservice.php';

global $tesztAjanlat, $tesztAjanlatSzobaTipus, $tesztAjanlatGiata, $indulas, $hazaerkezes;

// ajánlat elérhetőségének ellenőrzése
$file = './Responses/AvailabilityCheckResponse.xml';
//file_put_contents($file, AvailabilityCheckRequest($tesztAjanlat, $tesztAjanlatSzobaTipus, '2' ));

// betöltjük a választ 
// (éles rendszerben nem kell lementeni és betölteni!)
$xml1 = simplexml_load_file("./Responses/AvailabilityCheckResponse.xml");

// ha a válasz rendben és foglalható
if (trim($xml1->Control->ResponseStatus) == "success" && $xml1->Availibility->Book == "Y") {
    echo "Availability success!";
    // utasok életkorai, a helyes árképzéshez 
    // (nem kell pontosan, de gyerek hazaérkezéskor ne legyen idősebb mint az itt megadott,
    // felnőttek esetében lényegtelen, csak 18 évnél idősebb legyen beállítva)
    $paxs = array('19740104','19660202');

    // ajánlat árképzésének betöltése
    $file = './Responses/PriceAvailabilityCheckMakeBookingResponse.xml';
    // utolsó paraméter nem 0, ezért opciós ajánlat készül
    file_put_contents($file, PriceAvailabilityCheckRequest($tesztAjanlat, $tesztAjanlatGiata, $tesztAjanlatSzobaTipus, $paxs, 1 ));

    // betöltjük a választ 
    // (éles rendszerben nem kell lementeni és betölteni!)
    $xml2 = simplexml_load_file("./Responses/PriceAvailabilityCheckMakeBookingResponse.xml");
		
    // extra felárak. Teszt miatt ebből kiválasztjuk a silver biztosítást, a storno biztosítást és a parkolást
    // ez itt most erre a foglalásra igaz, más foglalásnál egyedileg kell megnézni, milyen lehetőségek vannak.
    // a lehetőségek a ExtrasResponse.xml-ben vannak
    $extrasFull = simplexml_load_file("./Responses/ExtrasResponse.xml");

    $priceList = simplexml_load_file("./infxFiles/priceList.xml");
    
    $extras[] = [];
    foreach ($extrasFull->extras->extra as $extra) {
        if ($extra->type == 'z.poj.online.silver.8')
        {
            $extras[] = $extra;
        }
        if ($extra->type == 'STOREXTA-HRG')
        {
            $extras[] = $extra;
        }
        if ($extra->type == 'PARKING_EB_7')
        {
            $extras[] = $extra;
        }
    }
    // az első 0 elemet töröljük
    array_shift($extras);
    
    // ha foglalható, ezt az ajánlatot lehet megjeleníteni
    if (trim($xml2->Control->ResponseStatus) == "success") {
        
        // ha sikeres a foglalás
        if (trim($xml2->Booking->bnr_result) == "success") {
            // foglalási szám
            $bnr = $xml2->Booking->bnr;
            echo "Availability success! Bnr: " . $bnr;
            // foglalás alapadatok
            $file = './Responses/BookingInfoResponse.xml';
            file_put_contents($file, BookingInfoRequest($bnr));

            // utasadatok 
            $customer = array ("name"=>"Geza", "sname"=>"Proba", "title"=>"",
            "street"=>"Locsei ut 57", "city"=>"Budapest", "post_code"=>"1147",
            "country"=>"HUN", "phone"=>"209472212", "email"=>"admin@kartagotours.hu");
        
            $pax1 = array ("id"=>"1", "fname"=>"Elek", "sname"=>"Teszt",
                        "title"=>"", "idcrm"=>"", "sex"=>"M",
                        "bd"=>"02.02.1966", "passport"=>"", "nationality"=>"HUN");
            $pax2 = array ("id"=>"2", "fname"=>"BÉLA", "sname"=>"PRÓBA",
                        "title"=>"", "idcrm"=>"", "sex"=>"M",
                        "bd"=>"04.01.1974", "passport"=>"", "nationality"=>"HUN");
            // $pax3 = array ("id"=>"3", "fname"=>"Bella", "sname"=>"Proba",
                        // "title"=>"", "idcrm"=>"", "sex"=>"W",
                        // "bd"=>"01.01.2010", "passport"=>"", "nationality"=>"HUN");

            // utasadatok tömb: szerződő és az utasok
            $paxs = array ($pax1, $pax2);

            // Szerződő és utas adatok átadása
            $file = './Responses/BookingDataResponse.xml';
            file_put_contents($file, BookingDataRequest($xml2, $customer, $priceList, $paxs, $extras, $indulas, $hazaerkezes));

            // fizetési ütemezés lekérése
            $file = './Responses/PaymentsByXMLDataInfoResponse.xml';
            file_put_contents($file, PaymentsByXMLDataInfoRequest($xml2, $paxs));

            // Foglalás részletes infó
            $file = './Responses/BookingInfoResponse1.xml';
            file_put_contents($file, BookingInfoRequest1($bnr));

            // Ez csak teszt, töröljük is le a foglalást!!
            $file = './Responses/BookingRemoveResponse.xml';
            //file_put_contents($file, BookingRemoveRequest($bnr));
        }
    }
}

?>