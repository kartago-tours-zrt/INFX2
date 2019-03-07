# Kartago Tours Zrt - INFX2 dokumentáció

## Dokumentáció tartalma

Az oldal írásos dokumentációban összesíti a Kartago Tours Zrt P2P online foglalási rendszerét.

Az egyes részekhez példakódot is közzé teszünk. A példák nem komplett megoldások, és csak egy lehetséges implementálása a feladatnak. 

## INFX2 felépítése

A rendszer offline letölthető adatokból és online API-n keresztül meghívott parancsokból áll össze.
> Némi átfedés is van, mert egyes adatok offline letöltés mellett API híváson keresztül is elérhetőek.
> Erre azért van szükség, mertt az offline adatok ütemezett időnként frissülnek, de az API-n keresztül a valós pillanatnyi állapotot kapjuk.

### Offline letöltendő adatok

Az adatok nagy része offline elérhető. Ezek egy része XML formátumú, egy másik része TXT formátumú adatok, valamint a kínálathoz tartozó képek.

#### XML formátumban letölthető adatok

- [Szálloda adatok](HotelsInfo.md) - frissítés alkalmanként, ha változtatás történt
- [Alapárak](BasePrices.md) - frissítése minden éjjel egy alaklommal
- Alapárak frissítés - frissítése 2 óránként, csak ha volt változás, csak a változott tételeket tartalmazza
- [Felárak](AdditionalPrices.md) - frissítése minden éjjel egy alaklommal

#### TXT formátumban letölthető adatok

- [INFX2](INFX2.md) - frissítése minden éjjel egy alaklommal
- INFX2 frissítés - frissítése 2 óránként, csak ha volt változás, csak a változott tételeket tartalmazza

#### [Képek](Pictures.md)

- Minden kép egy sorszámmla van azonosítva, ez a kép neve. A szállodainfóban hivatkozás erre a névre történik. 
> Közel 2600 szálloda 40.000 fotója van a rendszerben. Ez nagy mennyiség, ezért ezek frissítésére (szálloda infó + képek) konkrét megoldásunk van a leírásban. 

### API hívások

Egy [RuleBox](RuleBox.md) rendszer működik az API hívások mögött. Ennek segítségével, nem csak információt lehet lekérni, hanem komplett árkalkulációt lehet végezni, amelyek segítségével árajánlat készíthető vagy a foglalás is elvégezhető.

![Infx2](/images/INFX2Structure.png)






## Welcome to GitHub Pages

You can use the [editor on GitHub](https://github.com/kartago-tours-zrt/INFX2/edit/master/README.md) to maintain and preview the content for your website in Markdown files.

Whenever you commit to this repository, GitHub Pages will run [Jekyll](https://jekyllrb.com/) to rebuild the pages in your site, from the content in your Markdown files.

### Markdown

Markdown is a lightweight and easy-to-use syntax for styling your writing. It includes conventions for

```markdown
Syntax highlighted code block

# Header 1
## Header 2
### Header 3

- Bulleted
- List

1. Numbered
2. List

**Bold** and _Italic_ and `Code` text

[Link](url) and ![Image](src)
```

For more details see [GitHub Flavored Markdown](https://guides.github.com/features/mastering-markdown/).

### Jekyll Themes

Your Pages site will use the layout and styles from the Jekyll theme you have selected in your [repository settings](https://github.com/kartago-tours-zrt/INFX2/settings). The name of this theme is saved in the Jekyll `_config.yml` configuration file.

### Support or Contact

Having trouble with Pages? Check out our [documentation](https://help.github.com/categories/github-pages-basics/) or [contact support](https://github.com/contact) and we’ll help you sort it out.
