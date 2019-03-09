<?php 
require_once('../params.php');
require_once('../xml_adopt.php');

include '../infxservice.php';

$customer = array ("name"=>"Géza", "sname"=>"Próba", "title"=>"",
            "street"=>"Lőcsei út 57", "city"=>"Budapest", "post_code"=>"1147",
            "country"=>"Hungary", "phone"=>"209472212", "email"=>"admin@kartagotours.hu");
        
$pax1 = array ("id"=>"1", "fname"=>"Géza", "sname"=>"Próba",
            "title"=>"", "idcrm"=>"", "sex"=>"M",
            "bd"=>"03.09.1973", "passport"=>"", "nationality"=>"HUN");
$pax2 = array ("id"=>"2", "fname"=>"Piroska", "sname"=>"Próba",
            "title"=>"", "idcrm"=>"", "sex"=>"F",
            "bd"=>"21.09.1989", "passport"=>"", "nationality"=>"HUN");
$pax3 = array ("id"=>"3", "fname"=>"Bella", "sname"=>"Próba",
            "title"=>"", "idcrm"=>"", "sex"=>"F",
            "bd"=>"01.01.2010", "passport"=>"", "nationality"=>"HUN");

$paxs = array ($customer, $pax1, $pax2, $pax3);



$base = simplexml_load_file("PriceAvailiablityCheckMakeBookResponse.xml");

?>
