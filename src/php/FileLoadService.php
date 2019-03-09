<?php

function file_list2($url)
{

    $c_session = curl_init();

    curl_setopt ($c_session, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($c_session, CURLOPT_URL, $url);
    curl_setopt ($c_session, CURLOPT_TIMEOUT, '100');
    
    $content = curl_exec($c_session);
    curl_close ($c_session);

    $file = 'a.xml';
    file_put_contents($file, $content);
}

function file_list($url)
{
    $html = file_get_contents($url);
    var_dump($html);
    $count = preg_match_all('/<li><a href="([^"]+)">[^<]*<\/a><\/li>/i', $html, $files);
    for ($i = 0; $i < $count; ++$i) {
      echo "File: " . $files[1][$i] . "<br />\n";
    }

    return $files;
}


function file_list3($url)
{
    $contents = file_get_contents($url);
    preg_match_All("|href=[\"'](.*?)[\"']|", $contents, $hrefs);
    var_dump($hrefs);

    return $hrefs;
}

?>