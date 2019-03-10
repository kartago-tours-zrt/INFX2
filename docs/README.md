# Kartago Tours Zrt - INFX2 dokumentáció

Dokumentáció elérhető [itt](https://kartago-tours-zrt.github.io/INFX2/).

![Infx2](/images/INFX2Structure.png)

## Dokumentáció tartalma

Az oldal írásos dokumentációban összesíti a Kartago Tours Zrt P2P online foglalási rendszerét.

Az egyes részekhez példakódot is közzé teszünk. A példák nem komplett megoldások, és csak egy lehetséges implementálása a feladatnak. 

## INFX2 felépítése

A rendszer offline letölthető adatokból és online API-n keresztül meghívott parancsokból áll össze.
> Némi átfedés is van, mert egyes adatok offline letöltés mellett API híváson keresztül is elérhetőek.
> Erre azért van szükség, mertt az offline adatok ütemezett időnként frissülnek, de az API-n keresztül a valós pillanatnyi állapotot kapjuk.

### Hozzáférés <a name="access"></a>

A Kartago Tours INFX szerveréhez a hozzáférést regisztrálni kell, nincs publikus elérés. Bármely szerződött partnerünk kérhet hozzáférést, ehhez el kell küldenie azt a fix IPv4 címet, ahonnan a szolgáltatást igénybe kívánják venni.

Tesztelés, fejlesztés nem feltétlen a production szerver IP címről történik, ezért van lehetőség több IP cím megadására is, de meg kell jelölni, melyik címet milyen céllal regisztráltak.

> **Újdonság!** Amennyiben az IP címhez tartozik DNS név, akkor IP cím helyett azzal is lehet regisztrálni.

### Offline letöltendő adatok

Az adatok nagy része offline elérhető. Ezek egy része XML formátumú, egy másik része TXT formátumú adatok, valamint a kínálathoz tartozó képek.

#### XML formátumban letölthető adatok

- [Szálloda adatok](HotelsInfo.md) - frissítés alkalmanként, ha változtatás történt
- [Alapárak](BasePrices.md) - frissítése minden éjjel egy alaklommal
- [Alapárak](BasePrices.md) frissítés - frissítése 2 óránként, csak ha volt változás, csak a változott tételeket tartalmazza
- [Felárak](AdditionalPrices.md) - frissítése minden éjjel egy alaklommal

#### TXT formátumban letölthető adatok

- [INFX2](INFX2.md) - frissítése minden éjjel egy alaklommal
- [INFX2](INFX2.md) frissítés - frissítése 2 óránként, csak ha volt változás, csak a változott tételeket tartalmazza

#### [Képek](Pictures.md)

- Minden kép egy sorszámmal van azonosítva, ez a kép neve. A szállodainfóban hivatkozás erre a névre történik. 
> Közel 2600 szálloda 40.000 fotója van a rendszerben. Ez nagy mennyiség, ezért ezek frissítésére (szálloda infó + képek) konkrét megoldásunk van a leírásban. 

### API hívások

Egy [RuleBox](RuleBox.md) rendszer működik az API hívások mögött. Ennek segítségével, nem csak információt lehet lekérni, hanem komplett árkalkulációt lehet végezni, amelyek segítségével árajánlat készíthető vagy a foglalás is elvégezhető.


## Demó progam

Példakódok jelenleg [PHP](phpdemo.md) nyelven áll rendelkezésre.

[Használati esettanulmány](UseCase.md) pedig segít az INFX rendszer működését megérteni, így az integrációt elősegíteni.

Kérem, amennyiben igény van **JavaScript** ill. **C#** kódra, jelezzék felénk. Amennyiben elegendő kérés érkezik, ezeken a nyelveken is biztosítjuk a példakódokat.