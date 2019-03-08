<?php 

require_once('params.php');
require_once('xml_adopt.php');


function infx2post($request) {

$fields = [
    'rXML'      => $request
];

$fields_string = http_build_query($fields);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,$infxurl);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

return $respose;
}

function AddAuthentication($xml, $extended = 0)
{
	$xml->addChild('PartnerID', $swiss_id);
	$xml->addChild('RBPwd', $swiss_RLBnr);
	if ($extended != 0) {
		$xml->addChild('UserID', $swiss_user_id);
		$xml->addChild('rcpt', $swiss_rcpt);
		$xml->addChild('UserName', $swiss_user_name);
	}
}


function SeasonListRequest()
{
	$xmlstr = <<<XML
<SeasonListRequest></SeasonListRequest>
XML;
	
	return infx2post($xmlstr); 
}

function BoardsRequest()
{
	$xmlstr = <<<XML
<BoardsRequest></BoardsRequest>
XML;
	
	return infx2post($xmlstr); 
}

function RoomTypesRequest()
{
	$xmlstr = <<<XML
<RoomTypesRequest></RoomTypesRequest>
XML;
	
	return infx2post($xmlstr); 
}

function AirportsRequest()
{
	$xmlstr = <<<XML
<AirportsRequest></AirportsRequest>
XML;
	
	return infx2post($xmlstr); 
}

function OtherPricesRequest()
{
	$xmlstr = <<<XML
<OtherPriceTypesRequest></OtherPriceTypesRequest>
XML;
	
	return infx2post($xmlstr); 
}

function AccomodationPriceTypesRequest()
{
	$xmlstr = <<<XML
<AccomodationPriceTypesRequest></AccomodationPriceTypesRequest>
XML;
	
	return infx2post($xmlstr); 
}

function ExtrasRequest($term_id)
{
	$xmlstr = <<<XML
<AccomodationPriceTypesRequest></AccomodationPriceTypesRequest>
XML;
	$xml = simplexml_load_string($xmlstr);
	$xml->AccomodationPriceTypesRequest = $term_id;
	return infx2post($xml->asXML()); 
}

function PriceAvailiablityCheckRequest($term_id, $board_type, $room_type, $paxdetails, $makebooking = 0)
{
	$xmlstr = <<<XML
<PriceAvailabilityCheckRequest>
  <Package>
    <PackageID></PackageID>
    <BoardType>A</BoardType>
    <RoomType>2+2_CH</RoomType>
  </Package>
  <PaxDetails>
  </PaxDetails>  
</PriceAvailabilityCheckRequest>
XML;
   
    $xmlpaxdetailsstr = <<<XML
<PaxDescription>
  <DateOfBirth></DateOfBirth>
</PaxDescription>
XML;

	$xml = simplexml_load_string($xmlstr);
	$xml->PackageID = $term_id;
	$xml->BoardType = $board_type;
	$xml->RoomType = $room_type;
	
	if ($makebooking != 0)
	{
		$xml->addChild('Makebooking', '');
		AddAuthentication($xml,1);
	}
	
	$xmlpaxdetail = simplexml_load_string($xmlpaxdetailsstr);
	
	$paxscount = count($paxdetails);
	
	for($x = 0; $x < $paxscount; $x++) {
		$xmlpaxdetail->DateOfBirth = $paxdetails[$x];
		xml_adopt($xml->PaxDetails, $xmlpaxdetail);
	}

	return infx2post($xml->asXML()); 
}

function BookingInfoRequest($bnr)
{
	$xmlstr = <<<XML
<BookingInfoRequvest>
	<bnr></bnr>
</BookingInfoRequvest>
XML;

	$xml = simplexml_load_string($xmlstr);
	$xml->bnr = $bnr;
	AddAuthentication($xml,0);
	
	return infx2post($xml->asXML()); 
}

function AvailabilityCheckRequest($term_id, $room_type, $paxcount)
{
	$xmlstr = <<<XML
<AvailabilityCheckRequest>
  <PackageID></PackageID>
  <RoomType></RoomType>
  <PaxCount></PaxCount>
</AvailabilityCheckRequest>
XML;

	$xml = simplexml_load_string($xmlstr);
	$xml->PackageID = $term_id;
	$xml->RoomType = $room_type;
	$xml->PaxCount = $paxcount;
	
	return infx2post($xml->asXML()); 
}

function GetAddPriceRulesRequest()
{
	$xmlstr = <<<XML
<GetAddPriceRulesRequest></GetAddPriceRulesRequest>
XML;

	return infx2post($xml->asXML()); 
}

function PaymentsByXMLDataInfoRequest($term_id, $room_type, $paxcount)
{
	$xmlstr = <<<XML
<PaymentsByXMLDataInfoRequest><contractdata>
Az itt szereplő adat megegyezik a <BookingDataRequest> formátummal
</contractdata></PaymentsByXMLDataInfoRequest>

XML;

	$xml = simplexml_load_string($xmlstr);
	$xml->PackageID = $term_id;
	$xml->RoomType = $room_type;
	$xml->PaxCount = $paxcount;
	
	return infx2post($xml->asXML()); 
}

function BookingDataRequest($term_id, $room_type, $paxcount)
{
	$xmlstr = <<<XML
<PaymentsByXMLDataInfoRequest><contractdata>
Az itt szereplő adat megegyezik a <BookingDataRequest> formátummal
</contractdata></PaymentsByXMLDataInfoRequest>

XML;

	$xml = simplexml_load_string($xmlstr);
	$xml->PackageID = $term_id;
	$xml->RoomType = $room_type;
	$xml->PaxCount = $paxcount;
	
	return infx2post($xml->asXML()); 
}

?>
