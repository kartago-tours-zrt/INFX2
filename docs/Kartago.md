# Kartago.XML 

## Fő struktúra

```XML
<kartago_xml>
  <seasons>
    <season>
    </season>
  </seasons>
  <boards>
    <board>
    </board>
  </boards>
  <rooms>
    <room>
    </room>
  </rooms>
  <airports>
    <airport>
    </airport>
  </airports>
  <other_price_types>
    <price_type>
    </price_type>
  </other_price_types>
  <accomodatinon_price_types>
    <price_type>
    </price_type>
  </accomodatinon_price_types>
  <hotels>
    <offer>
    </offer>
  </hotels>
</kartago_xml>
```


## season

Szezonok felsorolása, csak azokat érdemes átvenni, amelyik aktív.

> Szinte az összes további elem hivatkozik egy szezonra, mert szezononként eltérhetnek a paraméterek. Szóval ugyan az a kód többször is szerepelhet eltérő szezon hivatkozással.

```XML
<season>
      <SID>1</SID>
      <dsc>HUNKAS17  </dsc>
      <isActive>Y</isActive>
</season>
```

Mező | Leírás
---- | ----
SID	|	Szezon azonosítója
dsc	|	Szezon kódja	
isActive	|	Y/N	Aktív vagy nem



## boards

Létező ellátások.


```XML
<board>
      <season>HUNKAS17</season>
      <code>AI</code>
      <giata_code>A</giata_code>
      <descr>all inclusive</descr>
      <descr_global>all inclusive</descr_global>
</board>
```

Mező | Leírás
---- | ----
season	|	Szezon kódja
code |	Ellátás kódja
giata_code |	Rövid kód
descr | Leírás
desc_global |	Ellátás típus leírás


## rooms

Szobatípusok és azok paraméterei. A létszámtól függően van magyar elnevezés is megadva. 

```XML
<room>
      <Season>HUNKAS17</Season>
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
```

Mező | Leírás
---- | ----
season	|	Szezon kódja
room_swiss_id	|	szoba swiss azonosító
room_giata_id	|	Rövid kód
room_configuration	| Szoba konfigurációi, A – felnőtt, C - gyermek
room_descr_#pax |	Szoba leírás létszámtól függően


## airports

Repülőterek kódja és megnevezése

```XML
<airport>
      <season>HUNKAS17  </season>
      <a_type>-</a_type>
      <a_id>MIR</a_id>
      <a_descr>Monastir</a_descr>
 </airport>
```

Mező | Leírás
---- | ----
season	| Szezon kódja
a_type	|	+ = Otthoni, - = Külföldi	
a_id | Reptér kódja
a_descr | Leírás


## other_price_types

Egyéb költségek ártípusai. 

```XML
<price_type>
      <season>HUNKAS17</season>
      <price_abb>AIR_BLND_RT</price_abb>
      <price_descr>látássérült utas</price_descr>
      <price_descr_long>látássérült utas</price_descr_long>
      <category>06 Repülő extra</category>
      <sub_type>online*repülő</sub_type>
      <AgeF>0</AgeF>
      <AgeT>99</AgeT>
      <PaxF>1</PaxF>
      <PaxT>99</PaxT>
      <type1>1</type1>
      <type2>N</type2>
</price_type>
```

Mező | Leírás
---- | ----
season |	Szezon kódja
price_abb |	Ár típus kódja
price_descr |	Ár leírása
price_descr_long |	Ár hosszú leírása
category |	Kategória
sub_type |	altípus	
AgeF |	Ettől az életkortól alkalmazható	
AgeT |	Eddig az életkorig alkalmazható
PaxF |	Személyek száma minimum
PaxT |	Személyek száma maximum
type1 |	1 = személyenként alkalmazandó,  S = szerződésenként alkalmazandó
type2 |	R = kötelező felár, N = választható felár


## accomodatinon_price_types

ALap ártípusok

```XML
<price_type>
      <season>HUNKAS17</season>
      <price_abb>DBL</price_abb>
      <price_descr>.2 ágyas szoba felnőtt ár/ fo</price_descr>
</price_type>
```

Mező | Leírás
---- | ----
season	|	Szezon kódja	
price_abb	| Ár kódja	
price_descr	| Leírás



## hotels

Hotelek leírása

```XML
<offer>
      <code> A07AGB</code>
      <name> AGATHAWIRT - BAD GOISERN</name>
      <dest_code> VDA</dest_code>
      <dest_name></dest_name>
      <dest_region></dest_region>
      <dest_subregion></dest_subregion>
      <dest_airport></dest_airport>
      <category> 3</category>
      <offertype> C</offertype>
      <exclusivity></exclusivity>
      <url></url>
      <texts>
        <perex><![CDATA[ A Landhotel Agathawirt Salzkammergut régió szívében található. A közlekedési szempontból jó fekvésű ház Agatha-ban épült, Bad Goisern egy külvárosi részén. A központ vásárlási lehetőségekkel kb. 3 km távolságra található. A hotel ideális kiindulási pont túrákhoz és kisebb sétákhoz.]]></perex>
        <distances><![CDATA[ távolság a központtól: 3 km<br>távolság a vásárlási lehetőségektől: 3 km]]></distances>
        <roomfacil><![CDATA[ rádió, telefon, műholdas TV<br>minibár ,Wi-Fi illetékmentesen<br>saját fürdőszoba (kád vagy zuhanyfülke, hajszárító, WC)]]></roomfacil>
        <hotelfacil><![CDATA[ recepció, bár, étterem<br>kávézó, gyerek játszószoba<br>parkolási lehetőség, Wi-Fi illetékmentesen<br>wellness - medence, szauna, fitnesz]]></hotelfacil>
        <beachdescr><![CDATA[]]></beachdescr>
        <entericnl><![CDATA[ szauna, gőzfürdő]]></entericnl>
        <enterchrg><![CDATA[ masszázs, szolárium]]></enterchrg>
        <boardincl><![CDATA[ büféjellegű reggeli<br><br>Kartago Tours hazai besorolás: 3*]]></boardincl>
        <boardchrg><![CDATA[]]></boardchrg>
        <youtubelnk></youtubelnk>
        <pictograms></pictograms>
        <icons></icons>
        <gps></gps>
      </texts>
      <images>
        <image image_id="26550" />
        <image image_id="26555" />
        <image image_id="26554" />
        <image image_id="26553" />
        <image image_id="26552" />
        <image image_id="26551" />
      </images>
      <seasons />
</offer>
```

Mező | Leírás
---- | ----
code |	Kartago csoport hotel kód
name |	hotel megnevezése
dest_code |	Kartago csoport desztináció kódja
dest_name |	Desztináció neve
dest_region |	Desztináció régiója
dest_subregion |		Desztináció alrégiója
dest_airport |	Desztináció szálloda kódja
category |	Szállás kategória besorolása
offertype |	Foglalás típusa (pl síelés, tengerparti üdülés, stb..) 
exclusivity |	Csak Kartago kínálat
perex	|	Szállás információ, bevezető szöveg.
distances |	Szállás elhelyezkedése
roomfacil |	Vendégszobák leírása
hotelfacil |	Szállodai szolgáltatások
beachdescr |	Strand és a környék leírása
entericnl |	Ingyenes sportolási lehetőségek
enterchrg |	Sportolási lehetőségek illetékért
boardincl |	Ellátás, amit az ár tartalmaz
boardchrg |	Ellátások, amiket illetékért lehet igénybe venni
youtubelnk |	YouTube videó link
pictograms |	Szolgáltatás kínálat piktogramok (bináris kódolással)
icons |	Ikonok
gps |	GPS koordináta
image |	image_id="egyedi azonosító"  coding="image/jpeg base64"

offertype -> Foglalás típusa. Két betű jelöli. Fő és al típus.

Fő típusok: 

Kód|Megnevezés
--|--
P | Üdülés 
Z | kirándulás 
L | síút 

Altípus, ami a pontos típust jelöli

Kód|Megnevezés
--|--
PP | Tengerparti üdülés 
PX | Egzotikus üdülés 
PJ | Tóparti üdülés 
PH | Hegyvidéki üdülés
PL | SPA / Wellness 
PB | Buszos üdülés
ZO | Városnézés 
ZS | Szafari túra 
ZK | kombinációs út 
ZE | Városnézés / európai hétvége 
LL | Síelés 

<picotgrams>	
0 = nincs, 1 = van 
 
Piktogramok
 
-	Légkondicionáló a szobában
-	Wi-Fi 
-	internet 
-	Parkolás
-	Kerekesszékkel is járható
-	wellness / Spa 
-	Gyereksarok
-	Úszás
-	tobogán / aquapark 
-	Búvár
-	golf 
-	tenisz 
-	Vizi sportok
-	Tornaterem, fitnesz
-	röplabda
-	kerékpár
-	Mango club 
-	Új
-	Tengerpari szállás
-	Csak felnőtteknek
-	Magyar nyelvű idegenvezető
-	Háziállat bevihető
-	Exim tipp
-	Exim minőség 

Megjegyzés:
Ha a fejlécben másként nincs jelölve, akkor a kódolás „windows-1252”

### Seasons
A hotel alatt vannak az adott hotelbe az ajánlatok szezononként.

```XML
<seasons>
    <season SID="1" dsc="HUNKAS17">
        <rules>
        <rule>
        </rules>
        <terms>
        <term id="49583" ….>
            <infx2s>
            <INFX2 …. />
            </infx2s>
            <extras>
            <Extra  …. />
            </extras>
            <prices>
            <price>
                …
            </price>
            </prices>
        </term>
        </terms>
    </season>
</seasons>
```

### Rule

```XML
<rule>
              <season_dsc>HUNKAS17</season_dsc>
              <hotel_code>FNCJAR</hotel_code>
              <price_type>1EXBED</price_type>
              <room_type>ST2+1</room_type>
              <board>*</board>
              <add_price_types>
                <add_price_type>SUP STU</add_price_type>
              </add_price_types>
</rule>
```

Szabályokat határoz meg az ár képzéshez. A példa az adott szezon adott hoteljének 1EXBED ár típusa esetén ST2+1 típusú szobában az összes ellátás típusnál lehet alkalmazni a SUP STU típusú árat.


### Term

Egy adott ajánlatot azonosít a kódjával.

```XML
<term id="49583" DepartureDate="01.10.2017" ArrivalDate="08.10.2017" 
  DepartureFromAirport="BUD" DepartureToAirport="FNC" 
    ArrivalFromAirport="FNC" ArrivalToAirport="BUD" DepartureStartTime="0000" DepartureStopTime="0000" 
    ArrivalStartTime="0000" ArrivalStopTime="0000">
```

Mező | Leírás
---- | ----
id | Kartago csoport ajánlat azonosító
DepartureDate	| Odaút dátuma
ArrivalDate	| Visszaérkezés dátuma
DepartureFromAirport |	Odaút indulás reptér
DepartureToAirport |	Odaút cél reptér
ArrivalFromAirport |	Visszaút induló reptér
ArrivalToAirport |	Visszaút cél reptér
DepartureStartTime |	Odaút indulás időpont (ha 0000 érték, akkor még nincs meg a pontos idő)
DepartureStopTime |	Odaút érkezés időpontja
ArrivalStartTime |	Visszaút indulás időpontja
ArrivalStopTime |	Visszaút érkezés időpontja


### Extra
Az extra sorok a felárakat tartalmazzák.

```XML
<Extra i="49583" h="FNCJAR" t="OSRB_FNC" p="59900.0000" t1="1" t2="R" />
```

Mező | Leírás
---- | ----
i   |	Csomag ID (TERM ID)	
t	|	Ár típus kódja
h	|	Szállás kódja
p	|	Ár
t1	|	1 = minden főre alkalmazni kell; S = szerződésenként egyszer
t2	|	R = kérésre; 	N = nem kérésre

### Price
A kiválasztott ajánlathoz tartozó árak. Azt hogy melyik árat kell alkalmazni az a kiválasztott szoba típustól, ellátás típustól, életkortól, stb függ. 
Ez a rész elavult, ne használjuk. Helyette a Kartago3.XML adatait használjuk.

```XML
<price>
    <season_dsc>HUNKAS17</season_dsc>
    <package_id>49583</package_id>
    <h>FNCJAR</h>
    <price_type>DBL</price_type>
    <price_c>183900.00</price_c>
    <max_age>99</max_age>
    <price_c_vf>01.01.2000</price_c_vf>
    <price_c_vt>31.12.2099</price_c_vt>
    <price_lm>EMPTY</price_lm>
    <price_lm_vf>EMPTY</price_lm_vf>
    <price_lm_vt>EMPTY</price_lm_vt>
    <price_lm_d>EMPTY</price_lm_d>
</price>
```

Mező | Leírás
---- | ----
season_dsc |	Szezon kódja	
pakage_id |	Csomag ID (TERM ID)
price_type |	Ár típus
price_c	|	Katalógus ár
max_age |	Ekkora életkorig alkalmazható
price_c_vf |	Katalógus ár ettől az időponttól alkalmazható
price_c_vt |	Katalógus ár eddig az időpontig alkalmazható
price_lm |	Lastminute ár
price_lm_vf |	Lastminute ár ettől az időponttól alkalmazható
price_lm_vt |	Lastminute ár eddig az időpontig alkalmazható
price_lm_d |	Lastminute ár típusa

### INFX2

Az infx2 sorok kifejezetten a weboldalon történő megjelenítést szolgálja. Az adott időpontra az adott szobatípusra és ellátás típusra megadja a felnőtt alapárat. 
> --Fontos!-- Amennyiben reptéri illeték külön szerepel az árlistában, akkor az nincs ebben az árban. Ha nincs feltüntetve repülős utaknál a reptéri illeték, akkor az bele van kalkulálva az árakba! 

```XML
<INFX2 Person_Min="2" Person_Max="3" Adult_Min="1" Adult_Max="3" Child_Age_From_1="0" Child_Age_To_1="12" 
    RoomSwissId="ST2+1_SV" BoardGiataCode="H" Price="0239040.00HUF" KatalogPrice="0265600.00HUF" />
```

Mező | Leírás
---- | ----
Person_Min |	A kiválasztott szobatípus miatt a minimum létszám
Person_Max |	A kiválasztott szobatípus miatt a maximum létszám
Adult_Min |	A kiválasztott szobatípus miatt a minimum felnőtt létszám
Adult_Max |	A kiválasztott szobatípus miatt a maximum felnőtt létszám
Child_Age_From_1 |	Első gyermek min életkor
Child_Age_To_1 |	Első gyermek max életkor
RoomSwissId |	Szoba azonosítója 
BoardGiataCode |	Ellátás azonosítója
Price |	Ez az aktuálisan érvényes ár
KatalogPrice |	Az eredeti katalógus ár

A példa egy két fő ággyal és egy pótággyal rendelkező, tengerre néző szoba esetén megadja az egy főre eső pillanatnyi árat és a katalógus árat. Megtudhatjuk továbbá, hogy ez abban az esetben érvényes, ha minimum 2 max 3 fő foglalja a szobát és minimum egy felnőttnek kell lennie.

