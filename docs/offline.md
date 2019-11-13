# Bevezető

Már évek óta elérhető a Kartago Tours partnerei számára egy letölthető XML file, ami tartalmazza az összes ajánlatunkat egyben. A file praktikus, hiszen tömörítve egy ftp oldalról gyorsan és könnyen letölthető, és az XML adatstruktúra miatt, egyszerűen betölthető a partnereink rendszerébe.

A Kartago Tours az EXIM és a DER csoport részeként folyamatosan fejleszti foglalási rendszerét, weboldalát. Ennek főbb okai a kor követelményeinek teljesítése, valamint a több országot lefedő egységes rendszer kiépítése.

Ezen folyamatok miatt a Kartago Tours XML adatstruktúrája megváltozik. Ez a dokumentum az egyben letölthető XML file struktúrájának a leírása. 

# Letöltés
Az adatokat ftp szerverről lehet letölteni tömörített (zip) formátumban.

ftp szerver: ftp://ftp2.kartagotours.hu/INFX2<br>
felhasználónév: „KartagoPartners”<br>
jelszó: „XMLDownload99”<br>

- Kartago.zip tartalmazza a katalógus adatokat
- KartagoPrices.zip a kalkulációs adatbázist tartalmazza
- /Kepek mappában a fotók találhatóak. A fotókat nem kell állandóan letölteni, dátum alapján lehet szűrni, és csak az újdonságokat letölteni. Ez mindenképpen javasolt, mert nagy mennyiségű fotóról van szó.

[Kartago.xml](Kartago.md) felépítése
[Kartago3.xml](Kartago3.md) kalkulációs adatbázis felépítése

# Hogyan használjuk

Az adatokat áttöltve a Kartago.xml tartalmazza az összes elérhető szálloda információt.

A Kartago3.xml adathalmazt információi alapján (ha bekértük hány felnőtt és hány gyermek utazik), le lehet szűrni az 'offer' Variation mezőjére. Felnőtteket A, gyermekeket C jelöli. Ilyenkor a keresés ne legyen kis/nagybetű érzékeny. Pl. Két felnőtt két gyerek aacc.
> mindíg a felnőttek teljes létszáma 'a' betűvel majd a gyermekek száma 'c' betűvel reprezentálva.

A DepartureDate és ArrivalDate mezőkkel dátum intervallumokra és napok számára is lehet szűrni.
(Ellátásra és szoba típusra is szűrhetünk előre)

A Kartago.xml alapján a szálloda kódokat desztinációkba is lehet sorolni, így lehet szűrni adott országra, régióra, szállodára is.

A megmaradt halmaz az ajánlat az utasoknak. Gyermekek életkorát pontosan bekérve lehet pontos árat is kalkulálni.

A kalkuláció nem tartlamazza az esetlegesen igénybe vehető egyéb szolgáltatásokat: pl: budapesti transzfer, parkolás, biztosítások



