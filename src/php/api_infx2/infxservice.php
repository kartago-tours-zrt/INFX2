<?php 

require_once('xml_adopt.php');

function infx2post($request) {

$fields = [
    'rXML'      => $request
];

$fields_string = http_build_query($fields);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,$GLOBALS['infxurl']);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

return $response;
}

function AddAuthentication($xml, $extended = 0)
{
	$xml->addChild('PartnerID', $GLOBALS['swiss_id']);
	$xml->addChild('RBPwd', $GLOBALS['swiss_RBPwd']);
	if ($extended != 0) {
		$xml->addChild('UserID', $GLOBALS['swiss_user_id']);
		$xml->addChild('rcpt', $GLOBALS['swiss_rcpt']);
		$xml->addChild('UserName', $GLOBALS['swiss_user_name']);
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
<ExtrasRequest>
	<PackageID></PackageID>
</ExtrasRequest>
XML;

	$xml = simplexml_load_string($xmlstr);
	$xml->PackageID = $term_id;
	return infx2post($xml->asXML()); 
}

function PriceAvailabilityCheckRequest($term_id, $board_type, $room_type, $paxdetails, $makebooking = 0)
{
	$xmlstr = <<<XML
<PriceAvailabilityCheckRequest>
  <Package>
    <PackageID></PackageID>
    <BoardType></BoardType>
    <RoomType></RoomType>
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
	$xml->Package->PackageID = $term_id;
	$xml->Package->BoardType = $board_type;
	$xml->Package->RoomType = $room_type;
	
	if ($makebooking != 0)
	{
		$xml->addChild('MakeBooking', '');
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
<BookingInfoRequest>
		<bnr></bnr>
</BookingInfoRequest>
XML;

	$xml = simplexml_load_string($xmlstr);
	$xml->bnr = $bnr;
	AddAuthentication($xml,0);
	
	return infx2post($xml->asXML()); 
}

function BookingInfoRequest1($bnr)
{
	$xmlstr = <<<XML
<BookingInfoRequest1>
		<BNR></BNR>
</BookingInfoRequest1>
XML;

	$xml = simplexml_load_string($xmlstr);
	$xml->BNR = $bnr;
	AddAuthentication($xml,0);
	
	return infx2post($xml->asXML()); 
}

function BookingRemoveRequest($bnr)
{
	$xmlstr = <<<XML
<BookingRemoveRequest>
		<bnr></bnr>
</BookingRemoveRequest>
XML;

	$xml = simplexml_load_string($xmlstr);
	$xml->bnr = $bnr;
	AddAuthentication($xml,0);
	
	return infx2post($xml->asXML()); 
}

function AvailabilityCheckRequest($term_id, $room_type, $paxcount, $roomcount = 1)
{
	$xmlstr = <<<XML
<AvailabilityCheckRequest>
  <PackageID></PackageID>
  <RoomType></RoomType>
  <PaxCount></PaxCount>
	<RoomCount></RoomCount>
</AvailabilityCheckRequest>
XML;

	$xml = simplexml_load_string($xmlstr);
	$xml->PackageID = $term_id;
	$xml->RoomType = $room_type;
	$xml->PaxCount = $paxcount;
	$xml->RoomCount = $roomcount;
	
	return infx2post($xml->asXML()); 
}

function GetAddPriceRulesRequest()
{
	$xmlstr = <<<XML
<GetAddPriceRulesRequest></GetAddPriceRulesRequest>
XML;

	return infx2post($xmlstr); 
}

function PaymentsByXMLDataInfoRequest($base)
{
	$bdr = <<<XML
<PaymentsByXMLDataInfoRequest>
  <bnr></bnr>
  <xmls3>
    <contractdata>
      <calculation>
        <ReqID></ReqID>
      </calculation>
    </contractdata>
  </xmls3>
</PaymentsByXMLDataInfoRequest>
XML;

	$xml = simplexml_load_string($bdr);
	$xml->bnr = $basedata->Booking->bnr;
	AddAuthentication($xml,0);
	
	$xml->xmls3->contractdata->bnr = $basedata->Booking->bnr;
	$xml->xmls3->contractdata->partner_addr_id = $GLOBALS['swiss_id'];
	$xml->xmls3->contractdata->partner_addr_type = 0;

  // ReqID beállítása 
	$xml->xmls3->contractdata->calculation->ReqID = $base->Control->ReqID;

	 return infx2post($xml->asXML()); 
}

function BookingDataRequest($base, $paxs)
{
	$bdr = <<<XML
<BookingDataRequest>
  <bnr></bnr>
  <xmls3>
    <contractdata>
    	<bnr></bnr>
      <partner_addr_id></partner_addr_id>
      <partner_addr_type></partner_addr_type>
      <address_customer>
        <pax_id></pax_id>
        <fname></fname>
        <sname></sname>
        <title />
        <street></street>
        <city></city>
        <post_code></post_code>
        <country></country>
        <phone></phone>
        <email></email>
      </address_customer>
      <paxs>
      </paxs>
			<calculation>
        <ReqID></ReqID>
      </calculation>
    </contractdata>
  </xmls3>
</BookingDataRequest>
XML;

$paxrecord = <<<XML
<pax>
	<pax_id></pax_id>
	<fname></fname>
	<sname></sname>
	<title />
	<idcrm />
	<sex></sex>
	<bd></bd>
	<passport />
	<nationality></nationality>
</pax>
XML;

	$xml = simplexml_load_string($bdr);
	
	$xml->bnr = $base->Booking->bnr;
	AddAuthentication($xml,0);

	$xml->xmls3->contractdata->bnr = $base->Booking->bnr;
	$xml->xmls3->contractdata->partner_addr_id = $GLOBALS['swiss_id'];
	$xml->xmls3->contractdata->partner_addr_type = 0;

	// customer data
	$xml->xmls3->contractdata->address_customer->pax_id = 1;
	$xml->xmls3->contractdata->address_customer->fname = $paxs[0]['name'];
	$xml->xmls3->contractdata->address_customer->sname = $paxs[0]['sname'];
	$xml->xmls3->contractdata->address_customer->title = $paxs[0]['title'];
	$xml->xmls3->contractdata->address_customer->street = $paxs[0]['street'];
	$xml->xmls3->contractdata->address_customer->city = $paxs[0]['city'];
	$xml->xmls3->contractdata->address_customer->post_code = $paxs[0]['post_code'];
	$xml->xmls3->contractdata->address_customer->country = $paxs[0]['country'];
	$xml->xmls3->contractdata->address_customer->phone = $paxs[0]['phone'];
	$xml->xmls3->contractdata->address_customer->email = $paxs[0]['email'];

	// paxs
	$paxcount = count($paxs);
	$paxxml = simplexml_load_string($paxrecord);
	for($x = 1; $x < $paxcount; $x++) {
		$paxxml->pax_id = $paxs[$x]['id'];
		$paxxml->fname = $paxs[$x]['fname'];
		$paxxml->sname = $paxs[$x]['sname'];
		$paxxml->title = $paxs[$x]['title'];
		$paxxml->idcrm = $paxs[$x]['idcrm'];
		$paxxml->sex = $paxs[$x]['sex'];
		$paxxml->bd = $paxs[$x]['bd'];
		$paxxml->passport = $paxs[$x]['passport'];
		$paxxml->nationality = $paxs[$x]['nationality'];
		xml_adopt($xml->xmls3->contractdata->paxs ,$paxxml);
	}

	$xml->xmls3->contractdata->calculation->ReqID = $base->Control->ReqID;

	return infx2post($xml->asXML()); 
}

?>
