[Kezdőoldal](README.md)

## RuleBox

### Bevezető

A Kartago Tours a SWISS foglalási rendszeréhez nyújt egy alapvető webes szolgáltatási interfészt. 
Lehetőség van az ajánlatok árának és elérhetőségének ellenőrzésére, valamint opció befoglalására. További eljárásokkal lehetőség van az utasok adatainak átadására és így a foglalás véglegesítésére is. Egyes eljárásokkal pedig a foglalások állapotát, részleteinek megismerését lehet lekérdezni.
Jelenleg meglévő foglalás módosítása vagy törlése nem lehetséges. Ilyen esetben fel kell venni a kapcsolatot a Kartago Tourssal és munkatársaink elvégzik a módosításokat a háttérrendszerünkkel.

### Webszervíz

#### A webszolgáltatás elérése

> Kérjük olvassa el a bevezető [Hozzáférés](README.md) szakaszát!

A webszolgáltatás az alábbi címen érhető el
[http://swiss.kartagotours.hu:88/ws2.asmx/WS1RQ](http://swiss.kartagotours.hu:88/ws2.asmx/WS1RQ)


A biztosított webszolgáltatáshoz letölthető a SOAP (1.1 és 1.2) [WSDL](http://swiss.kartagotours.hu:88/ws2.asmx/?WSDL) file!

Szintén megtekinthető az eljárások hívásához a szintaktika SOAP (1.1 és 1.2) GET és POST hívásokra. [link]()

#### Azonosítás <a name="authentication"></a>

Azok a funkciók, amelyek konkrét foglalással kapcsolatosak bekérnek felhasználó specifikus adatokat. Nyilván ez ahhoz kell, hogy a foglalásaink a saját azonosítónk alatt legyen elérhető és a [Swiss online](https://swiss.kartagotours.hu) rendszerben is láthassuk.

A [swiss online](https://swiss.kartagotours.hu) programba belépve  a felhasználó adatai menüpontnál az alábbihoz hasonló képet kapunk. Itt találhatóak a hitelesítő adatok, amelyeket egyes kéréseknél át kell adni.

![image](/images/SwissInfo.png)

Erről a SWISS_ID és a SWISS_RBPwd azonosítók kellenek. (Az azonosítás nem felhasználó, hanem, partner specifikus!)

#### Fejlesztői környezet

Csak egyetlen **éles** környezet van, nincs külön tesztelésre kialakított adatbázis. 
A tesztet az éles környezeten végezzük, ezért valódi foglalás esetén kérjük tartson szoros kapcsolatot a referatúra osztályunkkal, hogy visszavonhassuk a foglalását. Soha ne foglaljon egy hónapon belül induló járatra teszt célból, amennyire lehetséges, minél távolabbi időpontokon teszteljen. Teszteket hétköznap, munkaidőben végezzenek, hogy a próba foglalásoakt visszavonhassuk.
> Célszerű az adatok megadásánál olyan neveket használni ami egyértelműen teszt célt szolgálnak, ezzel is segítve a munkánkat. : Pl. Próba János, Nagyváros, Nemlétező utca 1

> A teszt foglalásokról mielőbb küldjenek emailt a foglalási szám feltüntetésével, hogy töröljük. Az email annak a desztinációnak az email címére küldjék, amelyiknek foglaltak. TODO kinek kell küldeni? uticél felelős? call center? online?

### Funkciók

#### SeasonListRequest

Szezonok listája

XML kérdés
```XML
<SeasonListRequest></SeasonListRequest>
```

XML válasz

```XML
<?xml version="1.0" encoding="utf-8"?>
<SeasonListResponse>
  <seasons>
    <season>
      <SID>1</SID>
      <dsc>HUNKAS17  </dsc>
      <isActive>N</isActive>
    </season>
    <season>
      <SID>2</SID>
      <dsc>HUNKAW17  </dsc>
      <isActive>N</isActive>
    </season>
```

Mező | Érték leírása
---- | ----
SID | Szezon azonosítója
dsc | Szezon kódja	
isActive | Y/N	Aktív vagy nem


#### BoardsRequest

Ellátás típusok lekérése

XML kérdés
```XML
<BoardsRequest></BoardsRequest>
```

XML válasz

```XML
<BoardsResponse>
  <boards>
    <board>
      <season>HUNKAW18</season>
      <code>AI</code>
      <giata_code>A</giata_code>
      <descr>all inclusive</descr>
      <descr_global>all inclusive</descr_global>
    </board>
    <board>
      <season>HUNKAW18</season>
      <code>SOAI</code>
      <giata_code>A1</giata_code>
      <descr>soft all inclusive</descr>
      <descr_global>soft all inclusive</descr_global>
    </board>
    .
    .

```

Mező | Érték leírása
---- | ----
season | Szezon kódja
code | Ellátás kódja
giata_code | Rövid kód
descr | Leírás
desc_global | Ellátás típus leírás



#### RoomTypesRequest

Szobatípusok lekérése

XML kérdés
```XML
<RoomTypesRequest></RoomTypesRequest>
```

XML válasz

```XML
<RoomTypesResponse>
  <rooms>
    <room>
      <Season>HUNKAW18</Season>
      <room_swiss_id>1+0</room_swiss_id>
      <room_giata_id>E1</room_giata_id>
      <room_configuration>;A;C;</room_configuration>
      <room_descr_1pax>1 ágyas szoba</room_descr_1pax>
      <room_descr_2pax />
      <room_descr_3pax />
      <room_descr_4pax />
      <room_descr_5pax />
      <room_descr_6pax />
      <room_descr_7pax />
      <room_descr_8pax />
      <room_descr_9pax />
      <room_descr_10pax />
    </room>
    .
    .
```

Mező | Érték leírása
---- | ----
season | Szezon kódja
room_swiss_id | szoba swiss azonosító
room_giata_id | Rövid kód
room_configuration | Szoba konfigurációi, A – felnőtt, C - gyermek
room_descr_#pax | Szoba leírás létszámtól függően


#### AirportsRequest

Repterek lekérése

XML kérdés
```XML
<AirportsRequest></AirportsRequest>
```

XML válasz

```XML
<AirportsResponse>
  <airports>
    <airport>
      <season>HUNKAS19  </season>
      <a_type>-</a_type>
      <a_id>A14</a_id>
      <a_descr>no transport</a_descr>
    </airport>
    <airport>
      <season>HUNKAS19  </season>
      <a_type>-</a_type>
      <a_id>AYT</a_id>
      <a_descr>Antalya</a_descr>
    </airport>
    .
    .
```

Mező | Érték leírása
---- | ----
season | Szezon kódja
a_type | + = Otthoni, - = Külföldi	
a_id | Reptér kódja
a_descr | Leírás


#### OtherPricesRequest

Felárak listája

XML kérdés
```XML
<OtherPriceTypesRequest></OtherPriceTypesRequest>
```

XML válasz

```XML
<OtherPriceTypesResponse>
  <price_types>
    <price_type>
      <season>HUNKAS19</season>
      <price_abb>OSRB_PMI</price_abb>
      <price_descr>Reptéri illeték - PMI</price_descr>
      <price_descr_long>Reptéri illeték - PMI</price_descr_long>
      <category>02 illetékek</category>
      <sub_type>kötelezo felár</sub_type>
      <AgeF>0</AgeF>
      <AgeT>99</AgeT>
      <PaxF>1</PaxF>
      <PaxT>99</PaxT>
      <type1>1</type1>
      <type2>N</type2>
    </price_type>
    .
    .
```

Mező | Érték leírása
---- | ----
season | Szezon kódja
price_abb | Ár típus kódja
price_descr | Ár leírása
price_descr_long | Ár hosszú leírása
category | Kategória
sub_type | altípus	
AgeF | Ettől az életkortól alkalmazható	
AgeT | Eddig az életkorig alkalmazható
PaxF | Személyek száma minimum
PaxT | Személyek száma maximum
type1 | 1 = személyenként alkalmazandó,  S = szerződésenként alkalmazandó
type2 | R = kérésre, N = kötelező


#### AccomodationPriceTypesRequest

Szálláshelyek ár típusai

XML kérdés
```XML
<AccomodationPriceTypesRequest></AccomodationPriceTypesRequest>
```

XML válasz

```XML
<AccomodationPriceTypesResponse>
  <price_types>
    <price_type>
      <season>HUNKAW18</season>
      <price_abb>SUP PLA1CHD-1</price_abb>
      <price_descr>Platinum suite 1. gyermek felár xx éves korig</price_descr>
    </price_type>
    <price_type>
      <season>HUNKAW18</season>
      <price_abb>SUP PLA2CHD-1</price_abb>
      <price_descr>Platinum suite 2. gyermek felár xx éves korig</price_descr>
    </price_type>
    .
    .
```

Mező | Érték leírása
---- | ----
season | Szezon kódja	
price_abb | Ár kódja	
price_descr | Leírás


#### ExtrasRequest

Csomaghoz tartozó egyéb opciós felárak

XML kérdés
```XML
<ExtrasRequest><PackageID>60193</PackageID></ExtrasRequest>
```

Bementi paraméterek:

Mező | Érték leírása
---- | ----
PackageID | Csomag azonosító


XML válasz

```XML
<ExtrasResponse>
  <term_info>
    <h_info>
    </h_info>
  </term_info>
  <extras>
    <extra>
      <category>05 Vizum</category>
      <sub_type>online*vizum</sub_type>
      <type>viza Egyiptom</type>
      <descr>Vízumdíj - Egyiptom</descr>
      <price>9000.0000</price>
      <AgeF>0</AgeF>
      <AgeT>99</AgeT>
      <PaxF>1</PaxF>
      <PaxT>99</PaxT>
      <type1>1</type1>
      <type2>N</type2>
    </extra>
    <extra>
      <category>04 Biztositás</category>
      <sub_type>online*bbp</sub_type>
      <type>z.poj.online.gold.8</type>
      <descr>Utazási Biztosítás - Air Gold 940 Ft/fo/nap</descr>
      <price>7520.0000</price>
      <AgeF>0</AgeF>
      <AgeT>99</AgeT>
      <PaxF>1</PaxF>
      <PaxT>99</PaxT>
      <type1>1</type1>
      <type2>N</type2>
    </extra>
    .
    .
    .
```

Mező | Érték leírása
---- | ----
h_info | Extra információ a szállásról és időpontról
category | Kategória
sub_type | Al típus
type | Típus
price | Ár
AgeF | Ettől az életkortól alkalmazható	
AgeT | Eddig az életkorig alkalmazható
PaxF | Személyek száma minimum
PaxT | Személyek száma maximum
type1 | 1 = személyenként alkalmazandó,  S = szerződésenként alkalmazandó
type2 | R = kérésre, N = kötelező


#### PriceAvailiablityCheckRequest

A Csomag azonosító, szállás típus, ellátás és utas adatok alapján ár és foglalhatóság ellenőrzése

XML kérdés
```XML
<PriceAvailabilityCheckRequest>
  <MakeBooking/>
  <PartnerID></PartnerID>
  <UserID></UserID>
  <RBPwd></RBPwd>
  <Rcpt></Rcpt>
  <Package>
    <PackageID>2418765</PackageID>
    <BoardType>A</BoardType>
    <RoomType>2+2_CH</RoomType>
  </Package>
  <PaxDetails>
    <PaxDescription>
      <DateOfBirth>19990219</DateOfBirth>
    </PaxDescription>
    <PaxDescription>
      <DateOfBirth>19990219</DateOfBirth>
    </PaxDescription>
    <PaxDescription>
      <DateOfBirth>19990219</DateOfBirth>
    </PaxDescription>
  </PaxDetails>
</PriceAvailabilityCheckRequest>
```
Bemenő paraméterek

Mező | Érték leírása
---- | ----
PackageID | Csomag azonosító
BoardType | Ellátás típusa
RoomType | Szoba típusa
DateOfBirth | Születési dátum
MakeBooking* | Annak jelölése, hogy foglalás is történik, nem csak információ kérés
PartnerID* | SWISS partner azonosító
UserID* | SWISS felhasználó azonosító
RBPwd* | SWISS felhasználó jelszó
Rcpt* | email cím
UserName* | Név
	
\* Csak akkor kell, ha foglalás is történik


XML válasz

```XML
<PriceAvailabilityCheckResponse>
  <Control>
    <ResponseStatus>success             </ResponseStatus>
    <ResponseMessage>
    </ResponseMessage>
    <ReqID>96797998-620F-4BC8-BADF-06D2D705C979</ReqID>
  </Control>
  <Package>
    <ReqDetails>
      <PackageID>2418765</PackageID>
      <RoomType>2+2_CH         </RoomType>
      <BoardType>A         </BoardType>
      <hotel_a1>AYTSEL                        </hotel_a1>
      <season_id>5</season_id>
      <season_dsc>HUNKAS19  </season_dsc>
      <hotel_type>L</hotel_type>
      <Paxs>
        <Pax>
          <pax_id>1</pax_id>
          <pax_bd>19.02.1999</pax_bd>
        </Pax>
        <Pax>
          <pax_id>2</pax_id>
          <pax_bd>19.02.1999</pax_bd>
        </Pax>
        <Pax>
          <pax_id>3</pax_id>
          <pax_bd>19.02.1999</pax_bd>
        </Pax>
      </Paxs>
    </ReqDetails>
    <PriceDetails>
      <PackagePrice>1658800.0000</PackagePrice>
      <PriceInfos>
        <PriceInfo>
          <pax_id>1</pax_id>
          <quantity>1</quantity>
          <item>DBL</item>
          <item_d>.2 ágyas szoba felnott ár/ fo</item_d>
          <price>676900.0000</price>
          <price_type>C</price_type>
          <price_type_d />
          <rb_d>N</rb_d>
          <rb_id>0</rb_id>
        </PriceInfo>
        <PriceInfo>
          <pax_id>1</pax_id>
          <quantity>1</quantity>
          <item>SLV*EB3*DBL</item>
          <item_d>FM márc.20-ig-2 ágyas szoba felnott ár/ fo</item_d>
          <price>-109800.0000</price>
          <price_type>C</price_type>
          <price_type_d />
          <rb_d>N</rb_d>
          <rb_id>0</rb_id>
        </PriceInfo>
        <PriceInfo>
          <pax_id>1</pax_id>
          <quantity>1</quantity>
          <item>OSRB_AYT</item>
          <item_d>Reptéri illeték AYT</item_d>
          <price>34900.0000</price>
          <price_type>C</price_type>
          <price_type_d />
          <rb_d>N</rb_d>
          <rb_id>0</rb_id>
        </PriceInfo>
        <PriceInfo>
          <pax_id>2</pax_id>
          <quantity>1</quantity>
          <item>DBL</item>
          <item_d>.2 ágyas szoba felnott ár/ fo</item_d>
          <price>676900.0000</price>
          <price_type>C</price_type>
          <price_type_d />
          <rb_d>N</rb_d>
          <rb_id>0</rb_id>
        </PriceInfo>
        <PriceInfo>
          <pax_id>2</pax_id>
          <quantity>1</quantity>
          <item>SLV*EB3*DBL</item>
          <item_d>FM márc.20-ig-2 ágyas szoba felnott ár/ fo</item_d>
          <price>-109800.0000</price>
          <price_type>C</price_type>
          <price_type_d />
          <rb_d>N</rb_d>
          <rb_id>0</rb_id>
        </PriceInfo>
        <PriceInfo>
          <pax_id>2</pax_id>
          <quantity>1</quantity>
          <item>OSRB_AYT</item>
          <item_d>Reptéri illeték AYT</item_d>
          <price>34900.0000</price>
          <price_type>C</price_type>
          <price_type_d />
          <rb_d>N</rb_d>
          <rb_id>0</rb_id>
        </PriceInfo>
        <PriceInfo>
          <pax_id>3</pax_id>
          <quantity>1</quantity>
          <item>1EXBED</item>
          <item_d>1. felnott pótágyon ár/ fo</item_d>
          <price>499900.0000</price>
          <price_type>C</price_type>
          <price_type_d />
          <rb_d>N</rb_d>
          <rb_id>0</rb_id>
        </PriceInfo>
        <PriceInfo>
          <pax_id>3</pax_id>
          <quantity>1</quantity>
          <item>SLV*EB3*1EXBED</item>
          <item_d>FM márc.20-ig-1. felnott pótágyon ár/ fo</item_d>
          <price>-80000.0000</price>
          <price_type>C</price_type>
          <price_type_d />
          <rb_d>N</rb_d>
          <rb_id>0</rb_id>
        </PriceInfo>
        <PriceInfo>
          <pax_id>3</pax_id>
          <quantity>1</quantity>
          <item>OSRB_AYT</item>
          <item_d>Reptéri illeték AYT</item_d>
          <price>34900.0000</price>
          <price_type>C</price_type>
          <price_type_d />
          <rb_d>N</rb_d>
          <rb_id>0</rb_id>
        </PriceInfo>
      </PriceInfos>
    </PriceDetails>
  </Package>
  <Booking>
    <bnr />
    <bnr_result />
    <bnr_exp />
  </Booking>
</PriceAvailabilityCheckResponse>
```

Mező | Érték leírása
---- | ----
ResponseStatus | A kalkuláció eredménye (sikeres vagy sikertelen)
ResponseMessage | Hiba leírása
ReqID | Kalkuláció egyedi azonosítója
PackagePrice | Csomag ára
PriceInfos | Számítás részletei
hotel_a1 | Szállás kódja
season_id | Szezon azonosító
season_dsc | Szezon kódja
hotel_type | Szállás típusa L = túra, A = Autó
pax_id | Utas sorszám
quantity | Mennyiség
Item | Ár típusa
bnr* | Opció foglalási szám (a foglalást ezzel lehet kezdeményezni)
bnr_result | Sikeres opciós foglalás, vagy a hiba leírása
bnr_exp* | Opciós foglalás lejárata

> A <Paxs> tartalmazza az utasok adatait ami a számításhoz szükséges, és a pax_id az azonosító.

\* Csak abban az esetben ha foglalni is szeretnénk


#### BookingInfoRequest

A foglalásról adja vissza az alap információkat

XML kérdés
```XML
<BookingInfoRequvest>
	<bnr></bnr>
    <PartnerID></PartenrID>
    <RBPwd></RBPwd>
</BookingInfoRequvest>
```
Bemenő paraméterek

Mező | Érték leírása
---- | ----
BNR | Foglalási szám
PartnerID | SWISS partner azonostó
RBPwd | SWISS jelszó


XML válasz

```XML
<BookingInfoResponse>
  <Result>
    <bnr>385004915</bnr>
    <bnr_expiration>2019-03-11T20:00:00</bnr_expiration>
    <bnr_status>R</bnr_status>
    <bnr_rlock>0</bnr_rlock>
    <package_id>2431452</package_id>
    <bnr_room>2+1_SV                        </bnr_room>
    <bnr_seats>3</bnr_seats>
  </Result>
</BookingInfoResponse>
```

Mező | Érték leírása
---- | ----
BNR | Foglalási szám
Bnr_expiration | Foglalás lejárati dátuma (Csak akkor,  ha a bnr_status=R)
Req_xml | Utazási szerződés (jelenleg kikapcsolt funkció)
Bnr_status | O = Szerződés (visszaigazolt foglalás); R = Opciós foglalás; X= törölt foglalás
Package_id | Csomag azonostó (Term ID)
Bnr_room | Szoba típus
Bnr_seat | Személyek száma (utaztatáshoz)


#### AvailabilityCheckRequest

Ezzel a függvénnyel ellenőrizhetjük le, hogy egy adott csomag foglalható-e.	

XML kérdés
```XML
<AvailabilityCheckRequest>
  <PackageID>2418765</PackageID>
  <RoomType>2+2_CH</RoomType>
  <PaxCount>3</PaxCount>
  <RoomCount>1</RoomCount>
</AvailabilityCheckRequest>
```

Bemenő paraméterek

Mező | Érték leírása
---- | ----
PackageID | Csomag azonosító
RoomType | Szobatípus
PaxCount | Utasok száma
RoomCount | Szobák száma. Max 3. Ha nem adjuk meg, akkor a rendszer 1-nek veszi.	


XML válasz

```XML
<AvailabilityCheckResponse>
  <Control>
    <ResponseStatus>success             </ResponseStatus>
    <ResponseMessage />
    <ReqID>9F455C9D-17B0-4BEA-9BD7-814B06A4ED3E</ReqID>
  </Control>
  <Availibility>
    <Book>N</Book>
    <LastCap>N</LastCap>
  </Availibility>
</AvailabilityCheckResponse>
```

Mező | Érték leírása
---- | ----
ResponseStatus | A kalkuláció eredménye. (Siker vagy Hiba)
ResponseMessage | Hiba esetén a hiba leírása.
ReqID | A kalkuláció egyedi azonosítója
Book | Y/N/R  Foglalható / Nem foglalható / Lekérésre
LastCap | Y/N Utolsó szoba (igen / nem)


#### GetAddPriceRulesRequest

Egy listát kapunk a kötelező felárakról egy adott Szezon, adott szálloda, adott szobatípusának adott ár típusához.

XML kérdés
```XML
<GetAddPriceRulesRequest></GetAddPriceRulesRequest>
```

XML válasz

```XML
<GetAddPriceRulesResponse>
  <rules>
    <rule>
      <season_dsc>HUNKAW18</season_dsc>
      <hotel_code>LPABPH</hotel_code>
      <price_type>1EXBED</price_type>
      <room_type>2+1</room_type>
      <board>AI</board>
      <add_price_types>
        <add_price_type>SUP AI</add_price_type>
      </add_price_types>
    </rule>
    .
    .
```

Mező | Érték leírása
---- | ----
season_dsc | Szezon kódja
hotel_code | Hotel kódja
price_typ | Ár típus kódja
room_type | Szobatípus kódja
board | Ellátás. (* esetén minden, egyébként az étkezés rövid kódja pl: FP, AI)
add_price_types | Kötelező ár típusok


#### PaymentsByXMLDataInfoRequest

Egy adott foglalás esetére visszaadja, hogy legkésőbb mikor mennyit kell minimálisan fizetni.	

XML kérdés
```XML
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
```

Mező | Érték leírása
---- | ----
bnr | Foglalási szám
ReqID | ReqID


XML válasz

```XML
<PaymentsByXMLDataInfoResponse>
  <Payments>
    <PaymentDate>10.03.2019</PaymentDate>
    <PaymentAmount>548999</PaymentAmount>
  </Payments>
</PaymentsByXMLDataInfoResponse>
```

Mező | Érték leírása
---- | ----
PaymentDate | Fizetési határidő
PaymentAmount | Fizetendő összeg


#### BookingDataRequest

Az utazási szerződés adatait lehet beküldeni. (Utasok és szerződő adatai)

XML kérdés
```XML
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
        .
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
        .
      </paxs>
			<calculation>
        <ReqID></ReqID>
      </calculation>
    </contractdata>
  </xmls3>
</BookingDataRequest>
```
Mező | Érték leírása
---- | ----
bnr | Foglalási szám
pax_id | A szerződő utas sorszáma. Értéke 1 legyen!
fname | Keresztnév
sname | Vezetéknév
title | Megszólítás
street | cím
city | Város
post_code | Irányítószám
country | Ország
phone | Teefonszám
email | Email cím
pax_id | utas sorszáma. (Az első utas legyen a szerződő)
sex | Férfi vagy Nő
bd | Születési dátum
passport | Útlevélszám
nationality | Nemzetiség

XML válasz

```XML
<BookingDataResponse>
  <Result>
    <bnr>385004940</bnr>
    <bnr_expiration>2019-03-13T15:00:00</bnr_expiration>
    <bnr_status>R</bnr_status>
    <bnr_rlock>0</bnr_rlock>
    <package_id>2431452</package_id>
    <bnr_room>2+1_PRE                       </bnr_room>
    <bnr_seats>3</bnr_seats>
  </Result>
</BookingDataResponse>
```

Mező | Érték leírása
---- | ----
BNR | Foglalási szám
Bnr_expiration | Foglalás lejárati dátuma (Csak akkor,  ha a bnr_status=R)
Req_xml | Utazási szerződés (jelenleg kikapcsolt funkció)
Bnr_status | O = Szerződés (visszaigazolt foglalás); R = Opciós foglalás; X= törölt foglalás
Package_id | Csomag azonostó (Term ID)
Bnr_room | Szoba típus
Bnr_seat | Személyek száma (utaztatáshoz)


#### BookingInfoRequest1

Részletes információ a foglalásról

XML kérdés
```XML
<BookingInfoRequvest1>
    <BNR></BNR>
    <PartnerID></PartenrID>
    <RBPwd></RBPwd>
</BookingInfoRequvest1>
```
Bemenő paraméterek

Mező | Érték leírása
---- | ----
BNR | Foglalási szám
PartnerID | SWISS partner azonostó
RBPwd | SWISS jelszó


XML válasz

Lásd: [Demó adat](/Test/Responses/BookingInfoResponse1.xml)




#### BookingRemoveRequest
Opciós foglalást tudunk törölni

Ha a foglalás már nem opciós, akkor a törlés nem lehetséges, akkor a szokaás módon fel kell venni a kapcsolatot a kollégákkal.

XML kérdés
```XML
<BookingRemoveRequest>
	<bnr></bnr>
    <PartnerID></PartenrID>
    <RBPwd></RBPwd>
</BookingRemoveRequest>
```

XML válasz

```XML
<BookingRemoveResponse>
  <Result>
    <bnr>385004915</bnr>
    <bnr_expiration>2019-03-09T20:29:47.620</bnr_expiration>
    <bnr_status>R</bnr_status>
    <bnr_rlock>0</bnr_rlock>
    <package_id>2431452</package_id>
    <bnr_room>2+1_SV                        </bnr_room>
    <bnr_seats>3</bnr_seats>
  </Result>
</BookingRemoveResponse>
```

Mező | Érték leírása
-----|-----
bnr | Foglalási szám
bnr_expiration | Lejárati dátum
bnr_status | O = Szerződés (visszaigazolt foglalás); R = Opciós foglalás; X= törölt foglalás
bnr_rlock | TODO
package_id | Csomag azonosító
bnr_room | Szoba típús
bnr_seats | Létszám