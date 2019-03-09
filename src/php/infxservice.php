<?php 

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

function PriceAvailiablityCheckRequest($term_id, $board_type, $room_type, $paxdetails, $makebooking = 0)
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

  var_dump($xml->asXML());

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
		<bnr></bnr>
</BookingInfoRequest1>
XML;

	$xml = simplexml_load_string($xmlstr);
	$xml->bnr = $bnr;
	AddAuthentication($xml,0);
	
	return infx2post($xml->asXML()); 
}

function BookingRemoveRequest1($bnr)
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

function PaymentsByXMLDataInfoRequest($base, $paxs)
{
	$bdr = <<<XML
<PaymentsByXMLDataInfoRequest>
  <bnr></bnr>
  <xmls3>
    <contractdata>
    	<bnr></bnr>
      <partner_addr_id></partner_addr_id>
      <partner_addr_type></partner_addr_type>
      <remark_order />
      <remark_order0 />
      <remark_order1 />
      <remark_order2 />
      <join_bnr />
      <vouchers />
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
        <base_prices>

        </base_prices>
        <extras>

        </extras>
      </calculation>
			
    </contractdata>
  </xmls3>
</PaymentsByXMLDataInfoRequest>
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

$pricerecord = <<<XML
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

$pricerecordextra = <<<XML
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

	$xml = simplexml_load_string($bdr);
	$xml->bnr = $basedata->Booking->bnr;
	AddAuthentication($xml,0);
	
	$xml->xmls3->contractdata->bnr = $basedata->Booking->bnr;
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

  // return $base->Package->PriceDetails->PriceInfos->->asXML();

	// prices
	$pricecount = count($base->Package->PriceDetails->PriceInfos->PriceInfo);
	$xmlitem = simplexml_load_string($pricerecord);
	for($x = 0; $x < $pricecount; $x++) {
		$xmlitem->pax_id = $base->Package->PriceDetails->PriceInfos->PriceInfo[$x]->pax_id;
		$xmlitem->quantity = $base->Package->PriceDetails->PriceInfos->PriceInfo[$x]->quantity;
		$xmlitem->item = $base->Package->PriceDetails->PriceInfos->PriceInfo[$x]->item;
		$xmlitem->item_d = $base->Package->PriceDetails->PriceInfos->PriceInfo[$x]->item_d;
		$xmlitem->base_price = $base->Package->PriceDetails->PriceInfos->PriceInfo[$x]->price;
		$xmlitem->discount = '0%';
		$xmlitem->final_price = $base->Package->PriceDetails->PriceInfos->PriceInfo[$x]->price;
		$xmlitem->price_type = $base->Package->PriceDetails->PriceInfos->PriceInfo[$x]->price_type;
		$xmlitem->price_type_d = $base->Package->PriceDetails->PriceInfos->PriceInfo[$x]->price_type_d;

		xml_adopt($xml->xmls3->contractdata->calculation->base_prices ,$xmlitem);
	}

//	return $xml->asXML();
	 return infx2post($xml->asXML()); 
}

function BookingDataRequest($base, $paxs, $paymentsdata)
{
	$bdr = <<<XML
<BookingDataRequest>
  <bnr></bnr>
  <xmls3>
    <contractdata>
    	<bnr></bnr>
      <partner_addr_id></partner_addr_id>
      <partner_addr_type></partner_addr_type>
      <remark_order />
      <remark_order0 />
      <remark_order1 />
      <remark_order2 />
      <join_bnr />
      <vouchers />
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
        <base_prices>

        </base_prices>
        <extras>

        </extras>
      </calculation>
			<payments>
      	<payment_voucher></payment_voucher>
				
      </payments>
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

$pricerecord = <<<XML
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

$pricerecordextra = <<<XML
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

$payment = <<<XML
<payment>
	<amount></amount>
	<due_date></due_date>
</payment>
XML;

	$xml = simplexml_load_string($bdr);
	$xml->bnr = $basedata->Booking->bnr;
	AddAuthentication($xml,0);

	$xml->xmls3->contractdata->bnr = $basedata->Booking->bnr;
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

  // return $base->Package->PriceDetails->PriceInfos->->asXML();

	// prices
	$pricecount = count($base->Package->PriceDetails->PriceInfos->PriceInfo);
	$xmlitem = simplexml_load_string($pricerecord);
	for($x = 0; $x < $pricecount; $x++) {
		$xmlitem->pax_id = $base->Package->PriceDetails->PriceInfos->PriceInfo[$x]->pax_id;
		$xmlitem->quantity = $base->Package->PriceDetails->PriceInfos->PriceInfo[$x]->quantity;
		$xmlitem->item = $base->Package->PriceDetails->PriceInfos->PriceInfo[$x]->item;
		$xmlitem->item_d = $base->Package->PriceDetails->PriceInfos->PriceInfo[$x]->item_d;
		$xmlitem->base_price = intval($base->Package->PriceDetails->PriceInfos->PriceInfo[$x]->price);
		$xmlitem->discount = '0%';
		$xmlitem->final_price = intval($base->Package->PriceDetails->PriceInfos->PriceInfo[$x]->price);
		$xmlitem->price_type = $base->Package->PriceDetails->PriceInfos->PriceInfo[$x]->price_type;
		$xmlitem->price_type_d = $base->Package->PriceDetails->PriceInfos->PriceInfo[$x]->price_type_d;

		xml_adopt($xml->xmls3->contractdata->calculation->base_prices ,$xmlitem);
	}

	// payments
	$paymentcount = count($paymentsdata->Payments);
	$xmlitem = simplexml_load_string($payment);
	for($x = 0; $x < $paymentcount; $x++) {
		if (!$paymentsdata->Payments[$x]->PaymentAmount) {
			$xmlitem->amount = intval($base->Package->PriceDetails->PackagePrice);
		} else {
			$xmlitem->amount = intval($paymentsdata->Payments[$x]->PaymentAmount);
		}
		
		$xmlitem->due_date = $paymentsdata->Payments[$x]->PaymentDate;
		xml_adopt($xml->xmls3->contractdata->payments ,$xmlitem);
	}
	
  return $xml->asXML();

	//return infx2post($xml->asXML()); 
}

?>
