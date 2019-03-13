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

function GeneratePaxRequest($paxs)
{
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

$paxsrecord = <<<XML
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
<paxs></paxs>
XML;


	$res = simplexml_load_string($paxsrecord);
	
	// customer data
	$paxsrecord->address_customer->pax_id = 1;
	$paxsrecord->address_customer->fname = $paxs[0]['name'];
	$paxsrecord->address_customer->sname = $paxs[0]['sname'];
	$paxsrecord->address_customer->title = $paxs[0]['title'];
	$paxsrecord->address_customer->street = $paxs[0]['street'];
	$paxsrecord->address_customer->city = $paxs[0]['city'];
	$paxsrecord->address_customer->post_code = $paxs[0]['post_code'];
	$paxsrecord->address_customer->country = $paxs[0]['country'];
	$paxsrecord->address_customer->phone = $paxs[0]['phone'];
	$paxsrecord->address_customer->email = $paxs[0]['email'];

	// paxs
	$paxxml = simplexml_load_string($paxrecord);
	$paxcount = count($paxs);
	
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
		xml_adopt($res->paxs ,$paxxml);
	}

	return $res;
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
      
      
			<calculation>
        <ReqID></ReqID>
      </calculation>
    </contractdata>
  </xmls3>
</BookingDataRequest>
XML;

	$xml = simplexml_load_string($bdr);
	
	$xml->bnr = $base->Booking->bnr;
	AddAuthentication($xml,0);

	$xml->xmls3->contractdata->bnr = $base->Booking->bnr;
	$xml->xmls3->contractdata->partner_addr_id = $GLOBALS['swiss_id'];
	$xml->xmls3->contractdata->partner_addr_type = 0;

	xml_adopt($xml->xmls3->contractdata, GeneratePaxRequest($paxs)); 
	

	$xml->xmls3->contractdata->calculation->ReqID = $base->Control->ReqID;

	return infx2post($xml->asXML()); 
}


// Paraméterben várja a <PriceAvailabilityCheckResponse> eredményét -> $base
// $extras array tartalmazza az extra felárakat, amit kérnek (mindent csak 1x, a rendszer automatikusan minden utasra felrakja) 
function GeneratePrices($base, $extras)
{
	$restemplate = <<<XML
<calculation>
	<ReqID></ReqID>
	<base_prices>
	</base_prices>
	<extras>
	</extras>
</calculation>
XML;

	// first base prices
	$basepricestemplate = <<<XML
<price_record>
	<pax_id></pax_id>
	<quantity></quantity>
	<item></item>
	<item_d></item_d>
	<base_price></base_price>
	<discount></discount>
	<final_price></final_price>
	<price_type></price_type>
	<price_type_d />
</price_record>
XML;

	$extrarecordtemplate = <<<XML
<price_record>
	<pax_id></pax_id>
	<quantity></quantity>
	<item></item>
	<item_d></item_d>
	<base_price></base_price>
	<discount></discount>
	<final_price></final_price>
</price_record>
XML;

	$baseprices = $base->Package->PriceDetails->PriceInfos->Priceinfo;
	$basepricecount = count($baseprices);

	$res = simplexml_load_string($restemplate);

	$baseprice = simplexml_load_string($basepricestemplate);
	for($x = 1; $x < $basepricecount; $x++) {
		$baseprice->pax_id = $baseprices[$x]->pax_id;
		$baseprice->quantity = $baseprices[$x]->quantity;
		$baseprice->item = $baseprices[$x]->item;
		$baseprice->item_d = $baseprices[$x]->item_d;
		$baseprice->base_price = $baseprices[$x]->price;
		$baseprice->discount = $baseprices[$x]->pax_id;
		$baseprice->final_price = $baseprices[$x]->pax_id;
		$baseprice->price_type = $baseprices[$x]->pax_id;
		$baseprice->price_type_d = $baseprices[$x]->pax_id;
	}
}

?>
