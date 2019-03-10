[Kezdőoldal](README.md)

## Szálloda információk

### Elérhető

[http://swiss.kartagotours.hu:88/hotel_xml/xml-nf](http://swiss.kartagotours.hu:88/hotel_xml/xml-nf)

#### Alternatív elérhetőségek: #beágyazott kép formátum

A szálloda információk elérhetőek a 
- [http://swiss.kartagotours.hu:88/hotel_xml](http://swiss.kartagotours.hu:88/hotel_xml)
- [http://swiss.kartagotours.hu:88/hotel_xml/xmllint-format](http://swiss.kartagotours.hu:88/hotel_xml/xmllint-format)

helyeken is. Mindkét alternatív helyen az első helyen lévő XML adatot kapjuk, de itt a képekre nem csupán hivatkozás van, hanem az XML file tartalmazza a képeket is Base64 kódolással. 
> Lehet ezt is használni, de a frissítés nehézkesebb. A képek frissítésére ebben az esetben nem kell külön eljárást készíteni, viszont a képek dekódolása és mentése plusz kódolási folyamat, így végeredményben nem tudunk kódolási időt spórolni.

### Letöltési utasítás

Közel 2600 szálloda leírás van a rendszerben XML formátumban, ezért fontos, hogy csak azokat az adatokat töltsük le, amit még nem töltöttünk le korábban.
Erre a legmegfelelőbb módszer, hogy első ízben letöltjük az elérhető tartalmat (ha lehet éjjeli időpontban), és a letöltés időpontját eltároljuk.
Időközönként csak egy frissítő letöltést indítunk, ahol csak az utolsó letöltés dátumánál újabb fileokat töltjük le.

Ugyan ezt az eljárást alkalmazzuk a [képek](Pictures.md) letöltésénél is.

### Adat leírása

#### Példa adat

```XML
<offer>
    <code> MIRHOU</code>
    <name> HOUDA GOLF & BEACH CLUB</name>
    <dest_code> TUNP</dest_code>
    <dest_name> Tunézia</dest_name>
    <dest_region> Monastir</dest_region>
    <dest_subregion> Monastir</dest_subregion>
    <dest_airport> Monastir</dest_airport>
    <category> 3</category>
    <offertype> PP</offertype>
    <exclusivity/>
    <url/>
    <texts>
    <perex> Közvetlenül a homokos tengerparton fekvő szálloda, mely jó szolgáltatásokkal várja a pihenni vágyókat. A hotel nem messze fekszik Sousse és Monastir központjától, mindkét központ buszjárattal könnyedén megközelíthető. A golfozás szerelmesei itt valóban megtalálhatják számításaikat. Minden korosztály számára ajánljukUtazásszervező iroda hazai besorolása: 3*.</perex>
    <distances> távolság a tengerparttól: közvetlen<br>távolság a repülőtértől (Monastir): 10 km<br>távolság a központtól (Sousse): 10 km<br>távolság az üzletektől: 10 km</distances>
    <roomfacil> kétágyas szoba <br>tengerre nézo szoba felárért lekérésre<br>egyéni légkondicionáló (foszezonban)<br>telefon, muholdas TV<br>saját fürdoszoba (kád vagy zuhanyfülke, WC)<br>széf - külön fizetendo<br>erkély vagy terasz</roomfacil>
    <hotelfacil> recepció, főétterem<br>2 a la carte étterem (tunéziai, olasz)<br>bár, snack bár, diszkó<br>üzlet<br>internet sarok - külön fizetendő<br>medence (napágyak és napernyők ingyenesen)<br>gyermekmedence, miniklub<br>aquapark, csúszdák</hotelfacil>
    <beachdescr> homokos part<br>napágyak és napernyők ingyen, matrac illetékért<br>vízi sportok illetékért<br></beachdescr>
    <entericnl> animációs programok<br>alkalmanként esti műsorok<br>fitnesz, török gőzfürdő, szauna<br>aerobik, teniszpálya, asztalitenisz, minigolf<br>darts, röplabda, kosárlabda, íjászat</entericnl>
    <enterchrg> biliárd<br>jacuzzi, masszázs</enterchrg>
    <boardincl> all inclusive: napi háromszori foétkezés, helyi alkoholos és alkoholmentes italok korlátlan fogyasztása 10:00-tol  02:00-ig, heti 2 szer étkezés az a la carte étteremben, napközben snack (snack bár, szendvics). Az all inclusive szállodák szolgáltatásai bizonyos részletekben szállodánként eltérhetnek.</boardincl>
    <boardchrg></boardchrg>
    <youtubelnk/>
    <pictograms> 110001111011111001101000</pictograms>
    <icons/>
    <gps> 35.781953; 10.693483</gps>
    </texts>
    <images>
        <image image_id="24549"/>
        <image image_id="24572"/>
        <image image_id="24571"/>
        <image image_id="24569"/>
        <image image_id="24568"/>
        <image image_id="24567"/>
        <image image_id="24566"/>
        <image image_id="24565"/>
        <image image_id="24564"/>
        <image image_id="24563"/>
        <image image_id="24562"/>
        <image image_id="24561"/>
        <image image_id="24560"/>
        <image image_id="24557"/>
        <image image_id="24556"/>
        <image image_id="24555"/>
        <image image_id="24554"/>
        <image image_id="24553"/>
        <image image_id="24552"/>
        <image image_id="24551"/>
        <image image_id="24550"/>
    </images>
</offer>
```

#### Mező leírások

Mező | Érték leírása
-----|-----
code | Kartago csoport hotel kód
name | hotel megnevezése
dest_code | Kartago csoport desztináció kódja
dest_name | Desztináció neve
dest_region | Desztináció régiója
dest_subregion | Desztináció alrégiója
dest_airport | Desztináció szálloda kódja
category | Szállás kategória besorolása
offertype | Foglalás típusa (pl síelés, tengerparti üdülés, stb..) 
exclusivity | Csak Kartago kínálat
perex | Szállás információ, bevezető szöveg.
distances | Szállás elhelyezkedése
roomfacil | Vendégszobák leírása
hotelfacil | Szállodai szolgáltatások
beachdescr | Strand és a környék leírása
entericnl | Ingyenes sportolási lehetőségek
enterchrg | Sportolási lehetőségek illetékért
boardincl | Ellátás, amit az ár tartalmaz
boardchrg | Ellátások, amiket illetékért lehet igénybe venni
youtubelnk | YouTube videó link
pictograms | Szolgáltatás kínálat piktogramok (bináris kódolással)
icons | Ikonok
gps | GPS koordináta
image | image_id="egyedi azonosító"  coding="image/jpeg base64" *coding rész, csak ha a #beágyazott formátumot használjuk*


#### `<offertype>` Foglalás típusa. 

Két betű jelöli. Fő és al típus.

Fő típusok:

Jel | Leírás
--- | ---
P | Üdülés 
Z | kirándulás 
L | síút 
 
Altípus, ami a pontos típust jelöli
 
Jel | Leírás
--- | --- 
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

#### `<picotgrams>`	

24 karakter hosszan. Minden karakter két értéket vehet fel, ami jelöli a szolgáltatás meglétét

0 = nincs, 1 = van 
 
Piktogramok sorrendben
 
- Légkondicionáló a szobában
- Wi-Fi 
- internet 
- Parkolás
- Kerekesszékkel is járható
- wellness / Spa 
- Gyereksarok
- Úszás
- tobogán / aquapark 
- Búvár
- golf 
- tenisz 
- Vizi sportok
- Tornaterem, fitnesz
- röplabda
- kerékpár
- Mango club 
- Új
- Tengerpari szállás
- Csak felnőtteknek
- Magyar nyelvű idegenvezető
- Háziállat bevihető
- Exim tipp
- Exim minőség 

> Megjegyzés:
> Ha a fejlécben másként nincs jelölve, akkor a kódolás „windows-1252”



