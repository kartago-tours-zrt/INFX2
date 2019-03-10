[Kezdőoldal](README.md)

## INFX2

Az INFX2 egy egyszerű szöveges file, kötött adatszerkezettel. Csak a zölddel jelölt sorokat használja az EXIM csoport. Az INFX file konkrét ajánlatokat tartalmaz kalkulált árakkal. Az adott szobatípuson belül a fő utasra kikalkulált / fő árat tartalmazza.
Használata nagyon hasznos, amennyiben az utas böngészik az ajánlatok között, mert ehhez konkrét árat tudunk rendelni egy egy ajánlathoz.

Az INFX2 struktúra, egy nemzetközi szabványon alapul, viszont nem minden mezöjét használjuk. A struktúra végén a használaton kívüli nagy részt az EXIM csoport kiegészítő információk tárolására használja. [Beágyazott XML adat](#embedded-data).

### Elérhető

Az adat TXT formátumban a http://swiss.kartagotours.hu:88/infx2/ helyről tölthető le.

A file elnevezési konvenziója a következő:

infx2_*.txt

Ahol a "*" a file aktuális generálásakori idő értéke a következő formátumban: ÉÉÉÉ-HH-NN-ÓÓ-PP-MM-eee-------

példa: infx2_2019-03-07-02-11-36-017-------.txt

Mivel a file mérete meglehetősen nagy ezért a file elérhető zip tömörítéssel is ahol a teljes név kiegészül a ".zip" kiterjesztéssel.

példa: infx2_2019-03-07-02-11-36-017-------.txt.zip

### Frissítés

Napközben 2 óránkén készül(het) egy frissíés, ami a hajnalban elkészült filehoz képesti változásokat tartalmazza.
Ha nam volt az árakban változás, akkor nem készül file, de ha volt, akkor igen.

A file elnevezési konvenciója 

updt_infx2_*.txt
	
Különbség file az előző pl_infx2_*.xml filehoz képest. A struktúra megegyezik.

példa: updt_infx2_2019-03-06-13-00-49-750-------.txt

A file elérhető zip tömörítéssel is ahol a teljes név kiegészül a ".zip" kiterjesztéssel.

példa: updt_infx2_2019-03-06-13-00-49-750-------.txt.zip

### Letöltési utasítás

A fileból naponta egy készül hajnalban. Délelőtt 3:00 -ig elkészül, ezért az utánra érdemes időzíteni a letöltést és feldolgozást.

Frissítés kb 2 óránként minden páratlan órában készül.

### Adat leírása


Mező | Pozíció kezdete | Pozíció vége | Hossz | Megjegyzés 
---- | ---- | ---- | ---- | ----
Verzió | 1 | 2 | 2 | 
Akció | 3 | 3 | 1 | 
**Szervező** | 4 | 8 | 5 |  
Üres | 9 | 14 | 6 | 
Ajánlat száma | 15 | 24 | 10 |  
Felhasználó csoportok | 25 | 33 | 9 | 
**Indulás dátuma** | 34 | 43 | 10 |  
**Hazaérkezés dátuma** | 44 | 53 | 10 | 
**Oda út indulási repülőtér** | 54 | 56 | 3 |  
**Oda út cél repülőtér** | 57 | 59 | 3 |  
**Visszaút indulási reptér** | 60 | 62 | 3 |  
**Visszaút cél reptér** | 63 | 65 | 3 |  
**Oda út légitársaság** | 66 | 68 | 3 | 
Visszaút légitársaság | 69 | 71 | 3 | 
Oda út gép száma | 72 | 74 | 3 |  
Visszaút gép száma | 75 | 77 | 3 |  
**Oda út beszállás** | 78 | 81 | 4 | Ha értéke 0000 akkor még nincs pontos idő.
Ünnepnap jelölése kiutazáskor | 82 | 82 | 1 | 
**Oda út érkezés** | 83 | 86 | 4 | Ha értéke 0000 akkor még nincs pontos idő. 
**Visszaút beszállás** | 87 | 90 | 4 | Ha értéke 0000 akkor még nincs pontos idő.
Ünnepnap jelölése visszaútkor | 91 | 91 | 1 |  
**Visszaút érkezés** | 92 | 95 | 4 | Ha értéke 0000 akkor még nincs pontos idő. 
Oda út járatszám | 96 | 99 | 4  | 
Visszaút járatszám | 100 | 103 | 4 |  
**Kijelölés** | 104 | 104 | 1 |  
Gyermek kijelölés | 105 | 105 | 1 |  
**Személyek minimum száma** | 106 | 106 | 1 |  
**Személyek maximális száma** | 107 | 107 | 1 | 
**Felnőttek min száma** | 108 | 108 | 1 |  
**Felnőttek max száma** | 109 | 109 | 1 |  
**Valuta** | 110 | 112 | 3 |  
**Ár** | 113 | 124 | 12 |  
Időskori ár | 125 | 136 | 12 |  
Csecsemő ár | 137 | 148 | 12 |  
**Gyermek 1 kortól** | 149 | 150 | 2 |  
**Gyermek 1 korig** | 151 | 152 | 2 |  
Gyermekár 1 | 153 | 164 | 12 |  
Gyermek 2 kortól | 165 | 166 | 2 |  
Gyermek 2 korig | 167 | 168 | 2 |  
Gyermekár 2 | 169 | 180 | 12 |  
Különleges kedvezmény | 181 | 181 | 1 |  
Különleges gyermek kedvezmény | 182 | 182 | 1 |  
Pótágy korig | 183 | 184 | 2 |  
**Pótágyak száma** | 185 | 185 | 1 |  
Üres | 186 | 187 | 2 |  
**Úti cél** | 188 | 212 | 25 |  
**Hotel neve** | 213 | 237 | 25 |  
**Kategória** | 238 | 240 | 3 |  
**Szállás kód** | 241 | 242 | 2 |  
**Szállás megnevezése** | 243 | 267 | 25 |  
**Étkezés kód** | 268 | 269 | 2 |  
Étkezés megnevezése | 270 | 294 | 25 |  
Utazás típus kód | 295 | 296 | 2 |  
Utazás típus megnevezés | 297 | 321 | 25 |  
**TOMA Szervező** | 322 | 325 | 4 |  
**TOMA Strand** | 326 | 329 | 4 |  
TOMA Akció | 330 | 331 | 2 |  
TOMA Feltételek 1 | 332 | 334 | 3 |  
TOMA Feltételek 2 | 335 | 337 | 3 |  
TOMA Feltételek 3 | 338 | 340 | 3 |  
TOMA Feltételek 4 | 341 | 343 | 3 |  
**TOMA Repterek 1** | 344 | 360 | 17 |  
**TOMA Repterek 2** | 361 | 377 | 17 |  
TOMA Repterek 3 | 378 | 394 | 17 |  
TOMA Repterek 4 | 395 | 411 | 17 |  
**TOMA Szállás 1** | 412 | 417 | 6 |  
**TOMA Szállás 2** | 418 | 423 | 6 |  
TOMA Szállás 3 | 424 | 429 | 6 |  
TOMA Szállás 4 | 430 | 435 | 6 |  
Hotel neve 1 | 436 | 515 | 80 |  
Felszerelés | 516 | 595 | 80 |  
***Felszerelés helye*** | 596 | 675 | 80 |  
***További infó*** | 676 | 755 | 80 |  
***Katalógus neve*** | 756 | 795 | 40 |  
***Katalógus oldal*** | 796 | 799 | 4 |  
***Repülőtér*** | 800 | 802 | 3 |  
***Hotel*** | 803 | 805 | 3 |  
***Prioritás*** | 806 | 807 | 2 |  
***Infó cím*** | 808 | 825 | 18 |  
***Hivatkozás*** | 826 | 985 | 160 |       

### Beágyazott XML struktúra <a name="embedded-data"></a>

Az INFX2 szabványos struktúra 596-os pozíciójától 390 karakter hosszan az EXIM XML struktúrában tárol adatot. Ez a kiegészítő információ fontos a megfelelő működéshez.

Egy példa struktúra itt látható. Sortörések és szünetek nélkül tartalmazza. Nem feltétlen van minden mező a struktúrában.

````XML
<INFO>
    <ISU>Y</ISU>
    <SDOV>21.04.2019</SDOV>
    <SODV>07.04.2019</SODV>
    <SID>4</SID>
    <TID>000002372936</TID>
    <RT>1+0</RT>
    <DAB>HRGBELA</DAB>
    <PRC>0281800.00HUF</PRC>
    <KC>0336800.00HUF</KC>
    <FX>0.00325</FX>
    <PT>LM*39</PT>
    <OnR>0</OnR>
    <PG>N</PG>
    <SL>N</SL>
    <ST>AAAA</ST>
    <Q>8</Q>
</INFO> 
````

Mező | Érték leírása
---- | ----
F2LD | Haza érkezés	időpont
F1SD | Indulás időpont
SDOV | Szállás kijelentkezés napja
SODV | Szállás bejelentkezés napja
SID | Szezon azonosító
TID | Csomag azonosító (régen TERM ID)
RT | Szállás típusa
DAB | Kartago csoport hotel azonosító
PRC | Ár és pénznem
FX | Használt EUR árfolyam
PT | Ár típusa	C, LM,ULM,…	
PG | Y/N	ingyen gyermekár lehetséges PG%
SL | Y/N	Kedvezményes ár SLV*%
KC | Katalógus ár és pénznem
OnR | Foglalhatóság típusa. 1 = lekérésre, egyébként 0
ISU | Y/N Változott e a sor, vagy új az előző INFX2-höz képest. kb. 4:30-kor készül naponta.	
ST | négyjegyű kód marketing események (pl. valós kedvezmény)

