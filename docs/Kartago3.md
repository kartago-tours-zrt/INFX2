# Kartago3.XML felépłtése

```XML
   <offer code="HRGCORA" hotel_dsc="CORAL BEACH" season="HUNKAS19" term_id="2456324" DepartureDate="13.07.2020" ArrivalDate="20.07.2020" RoomSwissId="2+2_FR_CHA" BoardCode="AI" BoardGiataCode="A" AdultCount="2" ChildCount="1" Variation="AAc" KatalogPrice="0240400.00HUF" Price="0240400.00HUF">
    <prices>
      <price PersonNumber="1" MinAge="14" MaxAge="99" Price="278900.00" PriceDescription=".2 ágyas szoba felnott ár/ fo" PriceType="DBL" Extra="N" IsChild="N" IsDiscount="N" IsLastMinute="N" ChildNumber="0" />
      <price PersonNumber="1" MinAge="14" MaxAge="99" Price="45900.00" PriceDescription="Családi szoba felnott felár/ fo" PriceType="SUP FR" Extra="N" IsChild="N" IsDiscount="N" IsLastMinute="N" ChildNumber="0" />
      <price PersonNumber="2" MinAge="14" MaxAge="99" Price="278900.00" PriceDescription=".2 ágyas szoba felnott ár/ fo" PriceType="DBL" Extra="N" IsChild="N" IsDiscount="N" IsLastMinute="N" ChildNumber="0" />
      <price PersonNumber="2" MinAge="14" MaxAge="99" Price="45900.00" PriceDescription="Családi szoba felnott felár/ fo" PriceType="SUP FR" Extra="N" IsChild="N" IsDiscount="N" IsLastMinute="N" ChildNumber="0" />
      <price PersonNumber="3" MinAge="2" MaxAge="14" Price="119900.00" PriceDescription="1. gyermek pótágyon ár  xx éves korig" PriceType="1CHEXB-1 F" Extra="N" IsChild="Y" IsDiscount="N" IsLastMinute="N" ChildNumber="1" />
      <price PersonNumber="3" MinAge="2" MaxAge="14" Price="0.00" PriceDescription="Családi szoba 1. gyermek felár xx éves korig" PriceType="SUP FR1CH-1" Extra="N" IsChild="Y" IsDiscount="N" IsLastMinute="N" ChildNumber="1" />
      <price PersonNumber="3" MinAge="0" MaxAge="2" Price="13900.00" PriceDescription="Baby ár" PriceType="INFN" Extra="N" IsChild="Y" IsDiscount="N" IsLastMinute="N" ChildNumber="1" />
    </prices>
  </offer>

```

Offer adatai:

Mező | Leírás
---- | ----
code | Szálloda kódja (lásd Kartago.xml leírást)
hotel_dsc | Szálloda megnevezés
season | szezon azonosító (lásd Kartago.xml leírást)
term_id | ajánlat azonosító (lásd Kartago.xml leírást)
DepartureDate | Indulási dátum
ArrivalDate | Hazaérkezés dátuma
RoomSwissId | Szoba kódja (lásd Kartago.xml leírást)
BoardCode | Ellátás kódja (lásd Kartago.xml leírást)
BoardGiataCode | Ellátás Giata rendszerbeli kódja. INFX összerendelés miatt (lásd Kartago.xml leírást)
AdultCount | Felnőttek száma
ChildCount | Gyermekek száma
Variation | Ágyak leosztása. Nagy betű: fő ágy. Kis betű: pót ágy. A: Adult - felnőtt, C : Child - gyermek 
KatalogPrice | Katalógus ára a fő utasnak
Price | Ár a fő utasnak

Price adatai:

Mező | Leírás
---- | ----
PersonNumber | Az ajánlaton belül a szemlyeket sorszámmal látjuk el. (Felnőtt és gyermek is.)
MinAge | Minimum korhatár akire az ár érvényes (Ezt már be kell töltenie hazaérkezéskor)
MaxAge | Maximum korhatár akire az ár érvényes (ezt még nem töltheti be hazaérkezéskor)
Price | Ár
PriceDescription | Ár megnevezése
PriceType | Ár típusa a Kartago Tours renszerében
Extra | Ha 'Y', akkor ez egy extra felár.
IsChild | Ha 'Y', akkor egy gyermekre vonatkozó ár
IsDiscount | Ha 'Y', akkor ez egy kedvezményes ár 
IsLastMinute | Ha 'Y', akkor lastminute kedvezményt tartalmazó ár 
ChildNumber | Ha gyermek ár, akkor megadja hányadik gyermek.

## Utasok elhelyezése a szobában - legjobb ajánlat

Az offer Variation attribútuma megadja, hogy hány fő megy a szobába. Felnőtt és gyermek, és ki megy főagyra és ki pótágyra.
Alapvetően először a felnőttekkel töltjük fel a helyeket.
A fő ágyakat a legidősebb utassal elkezdve töltjük fel. Ennek akkor van jelentősége, ha gyermek is kerül fő ágyra.
A pótágyakat ha van felnőtt, akkor szintén azzal kezdjük tölteni, majd a gyermekek következnek, a --legfiatalabbal-- kezdve, kivéve a csecsemőt. A csecsemőkre speciális ár van, ezért a csecsemők mindíg a legutolsók a sorban.

Ha így elhelyezzük az utasokat a szobákban, akkor minden utasra a PersonNumber értékének megfelelően alkalmazzuk az árakat, figyelembe véve a MinAge és a MaxAge életkor szűrőt.

A fenti példában két felnőtt és egy gyerek kerül a szobába. Felnőttek főágyon, gyerek pótágyon.
Ha a gyerek 2-14 éves kor között van a hazainduláskor, akkor a 1CHEXB-1 F + SUP FR1CH-1 értípusú árakat kell számolni.
Ha csecsemő a gyermek, akkor az INFN ártípus érvényes csak.

Az offer nem tartalmaz kalkulált teljes árat, mivel a gyermekek életkorától függően véltozhat az ár.
Ha valakinek a rendszere csak teljes kikalkulált árakkal működik, akkor az ezekből az információkból legenerálhatja az összes variációt.