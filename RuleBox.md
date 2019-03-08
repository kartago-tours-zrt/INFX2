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

```

#### BoardsRequest

#### RoomTypesRequest

#### AirportsRequest

#### OtherPricesRequest

#### AccomodationPriceTypesRequest

#### ExtrasRequest

#### PriceAvailiablityCheckRequest

#### BookingInfoRequest

#### AvailabilityCheckRequest

#### GetAddPriceRulesRequest

#### PaymentsByXMLDataInfoRequest

#### BookingDataRequest

#### BookingInfoRequest1

#### BookingRemoveRequest




