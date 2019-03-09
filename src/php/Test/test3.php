<?php 
require_once('../params.php');
require_once('../xml_adopt.php');

include '../infxservice.php';

// $paxs = array('19990219','19990219','20100219');

// $file = 'AvailabilityCheckResponse.xml';
// file_put_contents($file, AvailabilityCheckRequest('2431452', '2+1_SV', 3, 1 ));



// $paxs = array('19990219','19990219','20100219');

// $file = 'PriceAvailiablityCheckMakeBookResponse.xml';
// file_put_contents($file, PriceAvailiablityCheckRequest('2431452', 'A', '2+1_SV', $paxs, 1 ));


// $file = 'BookingInfoResponse1.xml';
// file_put_contents($file, BookingInfoRequest1('385004915'));

// $file = 'ExtrasResponse.xml';
// file_put_contents($file, ExtrasRequest('2431452'));

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

$paxs = array ($customer, $pax1, $pax2, $pax3);



$base = simplexml_load_file("PriceAvailiablityCheckMakeBookResponse.xml");
$paymentsdata = simplexml_load_file("PaymentsByXMLDataInfoResponse.xml");

//$file = 'PaymentsByXMLDataInfoResponse.xml';
//file_put_contents($file, PaymentsByXMLDataInfoRequest($base, $paxs));

$file = 'BookingDataResponse.xml';
file_put_contents($file, BookingDataRequest($base, $paxs, $paymentsdata));

?>
