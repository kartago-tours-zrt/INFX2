# Megvalósítási esettanulmány

A statikus adatokat beszerezzük. Erre példa az [infxDataSeed.php](phpDemo.md).  

A beszerzett adatokat a weboldalunk adatbázisába integráljuk.

## INFX használata

Az INFX egy szöveges állomány, statikusan letölthető. Lényege, hogy minden szálloda, minden időpontjára, minden szobatípusára és minden turnusára (1 hetes, 2 hetes, stb) tartalmazza a fő utas teljes árát.

> A Kartago Tours Zrt 2020 nyári időszaktól az árba bele kalkulálja a reptéri illetéket is.

Mire is jó az INFX? Ha egy ügyfél keres utat, akkor az INFX alapján tudunk kezdeti árajánlatot írni. Ha tengerre néző szobát szeretne, akkor csak olyan szobatípusokra szűrünk, és máris csak azokat az árakat látja.
Az INFX tartalmazza a minimum, maximum létszámot és ebből mennyi lehet minimum és maximum felnőtt.

Ahhoz, hogy egy utasnak konkrét árkalkulációt adhassunk, el kell jutnunk addig, hogy az INFX alapján kiválasszon az ügyfél egy konkrét ajánlatot. Ennek az ajánlatnak az INFX-ben van egy PackadeID azonosítója (TID).

Kell tudnunk a létszámot és a gyermekek életkorát. (A pontos életkorok itt még nem fontosak, de a gyerekek életkora a hazaérkezés dátumakor évben stimmeljen.) 
INFX alapján tudjuk a szobatípust és az étkezés kódot.

A termInfoSeed.php egy ilyen lekérést valósít meg. Az INFX paramétereket a params.php-ban a $tesztAjanlat mezőkben vannak beállítva.

### Árajánlat

1. Letölti az ajánlathoz tartozó Extrákat. (Reptéri parkolás, Budapest transzfer, vízum, Storno biztosítás, BBP, stb). Ezek nem kötelezőek, de egyrészük csak foglaláskor köthető, ezért érdemes ajánlani.
2. Az ```AvailabilityCheckRequest``` függvénnyel megnézzük, hogy az ajánlat foglalható e.
> Miért van a listában, ha nem foglalható? Egy szállodában korlátozottan vannak előre lekötött szobák. Lehet, hoyg standard szoba elérhető a rendszer szerint de tengerre néző nem. Ez viszont nem jelenti azt, hogy nem lehet lekéréssel foglalni. Abban az esetben, ha egy ajánlat nem elérhető, akkor az utasnak azt jelenítsük meg, hogy lekérésre foglalható. 
3. Ha elérhető az ajánlat, akkor a ```PriceAvailiablityCheckRequest``` fügvénnyel árajánlatot kérünk a rendszertől. Itt pontos árat kapunk, reptéri illetékekkel és esetleges kedvezményekkel. Az árak részletezve, utasonként vannak. Ez még nem foglalás, csak pontos, részletes árajánlat az ügyfélnek. Ezt az ajánlatot kell az 1. pontban letöltött extrákkal ajánlani.

### Foglalás

Amennyiben egy ajánlat tetszik az ügyfélnek, lehet foglalást kezdeményezni.




