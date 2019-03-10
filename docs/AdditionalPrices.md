[Kezdőoldal](README.md)

## Felárak

A választható felárakat tartalmazza. (A [req_ OtherPricesRequest]() funkcióval is elérhető)

### Elérhető

Az adat XML formátumban a http://swiss.kartagotours.hu:88/infx2/ helyről tölthető le.

A file elnevezési konvenziója a következő:

extras_list_*_[0,1].xml

Ahol a "*" a file aktuális generálásakori idő értéke a következő formátumban: ÉÉÉÉ-HH-NN-ÓÓ-PP-MM-eee-------

példa: extras_list_2019-03-07-02-11-36-017-------_0.xml

Mivel nagyon nagy az adat mennyiség, ezért két file tartalmazza az adatokat. *_1.xml és *_2.xml 


A fileok elérhetőek zip tömörítéssel is ahol a teljes név kiegészül a ".zip" kiterjesztéssel.

példa: extras_list_2019-03-07-02-11-36-017-------_0.xml.zip

### Letöltési utasítás

A fileból naponta egy készül hajnalban. Délelőtt 3:00 -ig elkészül, ezért az utánra érdemes időzíteni a letöltést és feldolgozást.

### Adat leírása

#### Példa adat

```XML
<Extras>
    <Extra i="2373967" h="LPALOP" t="OSRB_LPA" p="39900.0000" t1="1" t2="N"/>
    <Extra i="2373967" h="LPALOP" t="z.poj.online.silver.8" p="5280.0000" t1="1" t2="N"/>
    <Extra i="2373967" h="LPALOP" t="STOREXTA-LPA" p="200.0000" t1="S" t2="N"/>
    <Extra i="2373967" h="LPALOP" t="z.poj.online.gold.8" p="7120.0000" t1="1" t2="N"/>
    .
    .
    .
</Extras>    
```

Mező | Érték leírása
---- | ----
i | Csomag ID (TERM ID)	
t | Ár típus kódja
h | Szállás kódja
p | Ár
t1 | 1 = minden utasra alkalmazni kell; S = szerződésenként egyszer
t2 | R = kérésre; 	N = ?? TODO


