# php kliens megvalósítás

## letöltés

[Githubon](https://github.com/kartago-tours-zrt/INFX2) elérhető.

## RuleBox API

Az api_infx2 mappában található az infxservice.php file.

Ez a file a [RuleBox](RuleBox.md) összes funkcióját kezeli.

A működéshez szüksége pár globális változót definiálni

```php
$infxurl = 'http://swiss.kartagotours.hu:88/ws2.asmx/WS1RQ';
$swiss_user_id = 127;
$swiss_id = 'xxx';
$swiss_RBPwd = 'xxx';
$swiss_user_name = 'Lacika';
$swiss_rcpt = 'home.voxo.hu';
```

Ezek az adatok a [RuleBox](RuleBox.md) leírás alapján a SWISS programból nyerhetőek ki.

### Kommunikáció

A megvalósítás curl POST hívásokat használ.

Az ```infx2post($request)``` függvény átírásával könnyedén lehet GET vagy SOAP hívásokara áttérni.  

## Statikus adatok letöltése

Statikus adatok letöltésére is van php kód, ezt a FileLoadService.php file betöltésével tudjuk használni.

## Demó működés

Az előző függvényeket használva, könnyen tudják a rendszerükkel illeszeni a Kartago Tours Zrt árualapját.

Az infxDataSeed.php programmal a statikus fileokat tudjuk letölteni. Ez egy komplett megoldás, pár módosítással integrálható a rendszerünk mellé.

Futtatásával a következő adatok töltődnek le a ```params.php``` beállításai szerinti mappákba
- Hotel információk (kb 2600 xml file)
- Hotel képei (kb 48000 jpg file)
- infx2 file
- updt_infx2 fileok (lehet több is egy nap)
- pl_infx2 file
- pl_updt file (lehet több is egy nap)
- extras_list (2 db file)

pl_updt file kivételével a zip-el tömörített változat töltődik le.

> Fontos, hogy csak megfelelően paraméterezve indítsuk a letöltéseket.

A Hotel információ és a képek nagyon nagy adatmennyiség viszont viszonylag ritkán módosulnak, ezért dátum szűréssel minimalizálni kell a letöltések mennyiségét.
A program a Hotel és kép letöltését mindenképpen szabályozza egy dátum változóval, és csak a megadott dátumnál újabb fileokat tölti le.
Ez a gyakorlatban azt jelenti, hogy legelső használatkor ezt a dátumot egy meglehetősen korai időre pl. 10 évvel ezelőttre kell állítani, hogy biztosan letöltsünk mindent.

Az infxDataSeed.php file módosításával tudjuk elérni. Az alábbi kód 1 nappal korábbra állítja a szűrő dátumát.

```php
$dt = new DateTime();
$dt->sub(new DateInterval('P1D'));
```

> Ha a **P1D** értéket **P10Y** értékre cseréljük, akkor a 10 évvel ezelőttre állítottuk a szűrőt. így csak egyszer futtassuk, utána állítsuk vissza az eredeti értékre.
> Persze lehet paraméterezni is, és programból állítani, de ez csak mintaprogram, nem éles megvalósítás.

A DataSeed.php program a dinamikusan (API) letölthető adatokat menti le.
Futtatásával a következő adatok töltődnek le a ```params.php``` beállításai szerinti mappákba
- Szezonok
- Ellátás típusok
- Szobatípusok
- Repterek
- Ártípusok
- Felárak
- Felár szabályok
