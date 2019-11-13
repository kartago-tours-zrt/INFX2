<?php 

require_once('xml_adopt.php');

function infx2post($request, $requestFileName = "") {

if ($requestFileName != "")
{
	//$request->saveXML($requestFileName);
	file_put_contents($requestFileName, $request);
	$temp = simplexml_load_file($requestFileName);
	$dom1 = dom_import_simplexml($temp)->ownerDocument;
	$dom1->formatOutput = true;
	file_put_contents($requestFileName, $dom1->saveXML());
}


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
	
	foreach($paxdetails as $paxdetail) {
		$xmlpaxdetail->DateOfBirth = $paxdetail;
		xml_adopt($xml->PaxDetails, $xmlpaxdetail);
	}

	return infx2post($xml->asXML(), "PriceAvailabilityCheckRequest.xml"); 
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
	
	return infx2post($xml->asXML(), "AvailabilityCheckRequest.xml"); 
}

function GetAddPriceRulesRequest()
{
	$xmlstr = <<<XML
<GetAddPriceRulesRequest></GetAddPriceRulesRequest>
XML;

	return infx2post($xmlstr); 
}

function PaymentsByXMLDataInfoRequest($basedata)
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

	return infx2post($xml->asXML(), "PaymentsByXMLDataInfoRequest.xml"); 
}

function GenerateCustomerRequest($pax)
{


$paxsrecord = <<<XML
<address_customer>
	<pax_id></pax_id>
	<fname></fname>
	<sname></sname>
	<title></title>
	<street></street>
	<city></city>
	<post_code></post_code>
	<country></country>
	<phone></phone>
	<email></email>
</address_customer>
XML;

	$res = simplexml_load_string($paxsrecord);
	
	// customer data
	$res->pax_id = 1;
	$res->fname = $pax['name'];
	$res->sname = $pax['sname'];
	$res->title = $pax['title'];
	$res->street = $pax['street'];
	$res->city = $pax['city'];
	$res->post_code = $pax['post_code'];
	$res->country = $pax['country'];
	$res->phone = $pax['phone'];
	$res->email = $pax['email'];

	return $res;
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
<paxs></paxs>
XML;

	$res = simplexml_load_string($paxsrecord);

	// paxs
	$paxxml = simplexml_load_string($paxrecord);

	foreach($paxs as $pax) {
		$paxxml->pax_id = $pax['id'];
		$paxxml->fname = $pax['fname'];
		$paxxml->sname = $pax['sname'];
		$paxxml->title = $pax['title'];
		$paxxml->idcrm = $pax['idcrm'];
		$paxxml->sex = $pax['sex'];
		$paxxml->bd = $pax['bd'];
		$paxxml->passport = $pax['passport'];
		$paxxml->nationality = $pax['nationality'];
		xml_adopt($res ,$paxxml);
	}

	return $res;
}


function BookingDataRequest($base, $customer, $priceList, $paxs, $extras, $startDate, $endDate, $fileName = '')
{
	$bdr = <<<XML
<BookingDataRequest>
  <bnr></bnr>
  <xmls3>
    <contractdata>
    	<bnr></bnr>
      	<partner_addr_id></partner_addr_id>
      	<partner_addr_type></partner_addr_type>
		<remark_order/>
		<remark_order0/>
		<remark_order1/>
		<remark_order2/>
		<join_bnr/>
		<vouchers/>
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

	xml_adopt($xml->xmls3->contractdata, GenerateCustomerRequest($customer)); 
	xml_adopt($xml->xmls3->contractdata, GeneratePaxRequest($paxs)); 
	
	xml_adopt($xml->xmls3->contractdata, GenerateCalculation($base, $extras, $priceList, $endDate)); 

	$otherPrice = 0.0;
	foreach ($xml->xmls3->contractdata->calculation->extras->price_record as $extra) {
		$otherPrice = $otherPrice + ((float)$extra->quantity)*((float)$extra->final_price);
	}

	xml_adopt($xml->xmls3->contractdata, GeneratePayments($startDate, (float)$base->Package->PriceDetails->PackagePrice, $otherPrice));
	
	return infx2post($xml->asXML(), "BookingDataRequest.xml"); 
}

// Paraméterben várja a <PriceAvailabilityCheckResponse> eredményét -> $base
// $extras array tartalmazza az extra felárakat, amit kérnek (mindent csak 1x, a rendszer automatikusan minden utasra felrakja) 
// $endDate a hazaérkezés dátuma 'nap.honap.ev' formátumban szövegesen. (xml adatokból)
function GenerateCalculation($base, $extras, $priceList, $endDate)
{
	$calculationTemplate = <<<XML
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

	$res = simplexml_load_string($calculationTemplate);
	$res->ReqID = $base->Control->ReqID;

	$totalPrice = (float)$base->Package->PriceDetails->PackagePrice;

	print_r($priceList);

    foreach($base->Package->PriceDetails->PriceInfos->PriceInfo as $basepriceInput) {

		
		$price = getPrice($priceList, trim($basepriceInput->item));
		$baseprice = simplexml_load_string($basepricestemplate);
		
		if (!$price) continue;  // ilyen nem lehetne! hibakezelés!!! (most csak simán kihagyom)
		
		$baseprice->pax_id = $basepriceInput->pax_id;
		$baseprice->quantity = $basepriceInput->quantity;
		$baseprice->item = $basepriceInput->item;
		$baseprice->item_d = $basepriceInput->item_d;
		$baseprice->base_price = $price->price_c;
		$baseprice->final_price = $basepriceInput->price;
		$baseprice->discount = $baseprice->base_price - $baseprice->finla_price;
		$baseprice->price_type = $basepriceInput->price_type;
		$baseprice->price_type_d = $basepriceInput->price_type_d;

		xml_adopt($res->base_prices, $baseprice); 
	}

	$firstPerson = true;
	// utasokra extra felárak
	foreach ($base->Package->ReqDetails->Paxs->Pax as $pax) {
		// extras		
		foreach($extras as $extra) {

			// ha csak szerződésenként kell az ár, akkor csak a főutashoz adjuk hozzá
			if (!$firstPerson && $extra->type1 == 'S') continue;
			
			// az adott utas életkora megfelel e az ártípusnak?
			if (!IsYearOk($endDate, $pax->pax_bd, $extra->AgeF, $extra->AgeT )) continue;

			$extraprice = simplexml_load_string($extrarecordtemplate);
			
			$extraprice->pax_id = $pax->pax_id;
			$extraprice->quantity = 1;
			$extraprice->item = $extra->type;
			$extraprice->item_d = $extra->descr;
			$extraprice->base_price = $extra->price;
			$extraprice->discount = '0%';
			$extraprice->final_price = $extra->price;

			if (substr($extra->type,0,8) == 'STOREXTA') {
				$extraprice->base_price = round($extra->price*$totalPrice/10000);
				$extraprice->final_price = round($extra->price*$totalPrice/10000);
			}

			xml_adopt($res->extras, $extraprice); 
			
		}

		$firstPerson = false;
	} 

	return $res;
}

function getPrice($priceList, $priceType) {
	foreach ($priceList->price as $pr) {
		if (trim($pr->price_type) == $priceType)
		{
			return $pr;
		}
	}
	return null;
}

function GeneratePayments($start, $packagePrice, $otherPrice) {
	$paymentsTemplate = <<<XML
	<payments>
		<payment_voucher />
	</payments>
	XML;

	$paymentTemplate = <<<XML
	<payment>
		<amount />
		<due_date />
	</payment>
	XML;

	$res = simplexml_load_string($paymentsTemplate);

	$startDate = DateTime::createFromFormat('d.m.Y', $start);
	
	$day30 = DateTime::createFromFormat('d.m.Y', $start);;
	$day65 = DateTime::createFromFormat('d.m.Y', $start);;

	$day30->sub(new DateInterval('P15D'));
	$day65->sub(new DateInterval('P65D'));

	$today = new DateTime();

	$totalPrice = $packagePrice + $otherPrice;
	$priceBag = 0;

	// 65 napont túl 10000 előleggel fizetés
	if ($today < $day65)
	{
		$pt = simplexml_load_string($paymentTemplate);
		$pt->amount = 10000;
		$pt->due_date = $today->format('d.m.Y'); 
		$priceBag = 10000;
		xml_adopt($res, $pt); 
	}

	// 40% előleg befizetése
	if ($today < $day30)
	{
		$pt = simplexml_load_string($paymentTemplate);
		$price40Percent = round($totalPrice*0.4);
		$pt->amount = $price40Percent-$priceBag;
		if ($today < $day65 && $priceBag > 0) {
			$pt->due_date = $day65->format('d.m.Y'); 
		} else {
			$pt->due_date = $today->format('d.m.Y'); 
		}
		
		$priceBag = $price40Percent;
		xml_adopt($res, $pt);
	}

	// 30 napon belül a teljes hátralék esedékes
	$pt = simplexml_load_string($paymentTemplate);
	$pt->amount = $totalPrice-$priceBag;
	if ($today < $day30) {
		$pt->due_date = $day30->format('d.m.Y'); 
	} else {
		$pt->due_date = $today->format('d.m.Y'); 
	}
	
	$priceBag = $price40Percent;
	xml_adopt($res, $pt);

	return $res;
}

// két dátum különbsége napokban 'nap.honap.év' formátumú szöveges dátumok között
function IsYearOk($baseDate, $birth, $minYear, $maxYear)
{
	$endDate = DateTime::createFromFormat('d.m.Y', $baseDate);
	$birthDate = DateTime::createFromFormat('d.m.Y', $birth);
	if ($birthDate->add(new DateInterval('P'.$minYear.'Y')) >= $endDate) return false;
	if ($birthDate->add(new DateInterval('P'.$maxYear.'Y')) < $endDate) return false;
	return true;
}



?>
