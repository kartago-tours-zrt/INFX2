[Kezdőoldal](README.md)

## Alapárak

### Elérhető

Az adat XML formátumban a http://swiss.kartagotours.hu:88/infx2/ helyről tölthető le.

A file elnevezési konvenziója a következő:

pl_infx2_*.xml

Ahol a "*" a file aktuális generálásakori idő értéke a következő formátumban: ÉÉÉÉ-HH-NN-ÓÓ-PP-MM-eee-------

példa: pl_infx2_2019-03-07-02-11-36-017-------.xml

Mivel a file mérete meglehetősen nagy ezért a file elérhető zip tömörítéssel is ahol a teljes név kiegészül a ".zip" kiterjesztéssel.

példa: pl_infx2_2019-03-07-02-11-36-017-------.xml.zip

### Letöltési utasítás

A fileból naponta egy készül hajnalban. Délelőtt 3:00 -ig elkészül, ezért az utánra érdemes időzíteni a letöltést és feldolgozást.

### Adat leírása

#### Példa adat

```XML
<price_list>
    <price>
        <season_dsc>HUNKAW18</season_dsc>
        <package_id>2372940</package_id>
        <h>HRGMNH</h>
        <price_type>DBL</price_type>
        <price_c>165900.00</price_c>
        <max_age>99</max_age>
        <price_c_vf>01.01.2000</price_c_vf>
        <price_c_vt>31.12.2099</price_c_vt>
        <price_lm>129900.00</price_lm>
        <price_lm_vf>02.03.2019</price_lm_vf>
        <price_lm_vt>29.03.2019</price_lm_vt>
        <price_lm_d>LM*39</price_lm_d>
    </price>
    .
    .
    .
</price_list>
```

Mező | Érték leírása
---- | ----
season_dsc | Szezon kódja	
pakage_id | Csomag ID (TERM ID)
price_type | Ár típus
price_c | Katalógus ár
max_age | Ekkora életkorig alkalmazható
price_c_vf | Katalógus ár ettől az időponttól alkalmazható
price_c_vt | Katalógus ár eddig az időpontig alkalmazható
price_lm | Lastminute ár
price_lm_vf | Lastminute ár ettől az időponttól alkalmazható
price_lm_vt | Lastminute ár eddig az időpontig alkalmazható
price_lm_d | Lastminute ár típusa


### Frissítés

Napközben 2 óránkén készül(het) egy frissíés, ami a hajnalban elkészült filehoz képesti változásokat tartalmazza.
Ha nam volt az árakban változás, akkor nem készül file, de ha volt, akkor igen.

A file elnevezési konvenciója 

pl_updt*.xml
	
Különbség file az előző pl_infx2_*.xml filehoz képest. A struktúra megegyezik.

példa: pl_updt_2019-03-06-21-00-52-700-------.xml

> Mivel ez a file alapvetően nem nagy, ezért tömörített változat ebből nem készül.
