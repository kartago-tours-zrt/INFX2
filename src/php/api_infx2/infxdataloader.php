<?php

    // a path helyről beolvassa a pl_ filet és a $packageid által jelölt árlistát kiszedi
    // az updt_pl update file(okat) is megnyitja, és ha van benne a packageid-ra hivatkozás, akkor kiveszi és
    // összefésüli az alap árakkal.
    // eredményül visszaadja az árakat
    function getPrices($path, $packageid)
    {
        $ret = array();
        // pricelist file keresése
        $plname = findLastFile($path, "pl_", ".xml");
        
        if ($plname != "")
        {

            $pl = simplexml_load_file($path . $plname);
            
            $ret = $pl->xpath("/price_list/price/package_id[.='$packageid']/parent::*");
        }
        var_dump($ret);
    }

    // egy mappából beolvassa a legutolsó előfordulását a $prefix kezdetű és a $suffix végű filekból.
    function findLastFile($path, $prefix, $suffix)
    {
        
        $ret = "";
        
        $files = scandir($path);
        $lastDate = new DateTime(); 
        
        foreach ($files as $name) {
            
            if (substr($name, 0, strlen($prefix)) === $prefix && substr($name, strlen($name)-strlen($suffix), strlen($suffix)) === $suffix) {
                
                if ($ret == null) {
                    $ret = $name;
                    $lastDate = date ("F d Y H:i:s.", filemtime($path . $name));
                } else {
                    $fileDate = date ("F d Y H:i:s.", filemtime($path . $name));
                    if ($lastDate < $fileDate)
                    {
                        $lastDate = $fileDate;
                        $ret = $name;
                    }
                }
            }
        }
        
        return $ret;
    }

?>