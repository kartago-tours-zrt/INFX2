<?php

// filelist listában léfő fileokat tölti le a megadott url-ről a $path -ban lévő helyre.
function downloadList($filelist, $url, $path)
{
    foreach ($filelist as $fileinfo) {
        echo $fileinfo->name . " letöltése\r\n";
        file_download($url, $fileinfo->name, $path);
    }
}

// a megadott url-en listázza a fileokat és fileinfo listába rakja
function getFilteredFilesList($url, $date)
{
    // sorok letöltése
    $rows = file_list($url);

    // fileifo-vá alakítás
    $fileinfos = array();
    foreach($rows as $row) {
        $fileinfo = get_fileinfo($row);
        if ($fileinfo)
        {
            $fileinfos[] = $fileinfo;
        }
    }

    return filterrows($fileinfos, $date);
}

function findFilesFromFilteredList($filelist, $prefix, $suffix) {
    $ret = array();
    foreach ($filelist as $file) {
        $name = $file->name;

        if (substr($name, 0, strlen($prefix)) === $prefix && substr($name, strlen($name)-strlen($suffix), strlen($suffix)) === $suffix) {
            $ret[] = $file;
        }
    }
    return $ret;
}

// adott web folder tartalmának letöltése
function file_list($url)
{
    echo $url; echo "\r\n";

    $c_session = curl_init();

    curl_setopt ($c_session, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($c_session, CURLOPT_URL, $url);
    curl_setopt ($c_session, CURLOPT_TIMEOUT, '100');
    
    $content = curl_exec($c_session);
    curl_close ($c_session);

    $rows = explode('<br>', $content);
    
    echo 'Found ' . count($rows) . " rows."; echo "\r\n";
    
    return $rows;
}

// adott file letöltése
function file_download($url, $filename, $path)
{
    set_time_limit(0);
    //This is the file where we save the    information
    $fp = fopen ($path . $filename, 'w+');
    // downloaded file
    $durl = $url . $filename;

    //Here is the file we are downloading, replace spaces with %20
    $ch = curl_init(str_replace(" ","%20",$durl));
    curl_setopt($ch, CURLOPT_TIMEOUT, 50);
    // write curl response to file
    curl_setopt($ch, CURLOPT_FILE, $fp); 
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    // get curl response
    curl_exec($ch); 
    curl_close($ch);
    fclose($fp);
}


// web folder adatsor fileinfo-vá alakítása
function get_fileinfo($row)
{
    $ret = new \stdClass();
    if (preg_match('/(?<time>.*)(?<D>[PA]M)(?<size>.*)<A HREF=\".*\">(?<name>.*)<\/a>/i', $row, $matches)) //
    {
        $ret->name =  trim($matches["name"]);
        $ret->size = intval($matches["size"]);
        $ret->date = date_create_from_format('D, M d, Y H:i', trim($matches["time"]));
        if ($matches["D"] == "PM")
        {
            $ret->date->add(new DateInterval('PT10H'));
        }
        
        // 0 hosszúságú, akkor könyvtár, vagy hibás file, ami úgyse kell.
        if ($ret->size == 0) return NULL;
    }
    else {
        return NULL;
    } 
    
    return $ret;
}

// fileinfo tömb dátum alapján szűrése
function filterrows($fileinfos, $date)
{
    $ret = array();
    foreach($fileinfos as $fileinfo) {
        if ($fileinfo->date >= $date) {
            $ret[] = $fileinfo;
        }
    }

    return $ret;
}

?>
