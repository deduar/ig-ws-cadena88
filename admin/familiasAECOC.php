<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="wp-heading-inline">Grupo Igal - consume webservice for Cadena88</h1>
        </div>
    </div>
    <hr />
</div>

<?php

$file = new SplFileObject(dirname(__FILE__)."/familiaAECOC.xml");
$category = [];
$sub_category = [];
$sub_sub_category = [];
$sub_sub_sub_category = [];
$i = 1;
while (!$file->eof()) {
    $data = $file->fgets();
    switch ($i){
        case 5:
            $cat = strtolower(preg_replace('/\s+/', '-',stripAccents(trim($data))));
            if(!in_array($cat,$category)){$category[] = $cat;}
            break;
        case 7:
            $sub_cat = strtolower(preg_replace('/\s+/', '-',stripAccents(trim($data))));
            if(!in_array($sub_cat,$sub_category)){$sub_category[] = $sub_cat;}
            break;
        case 9:
            $sub_sub_cat = strtolower(preg_replace('/\s+/', '-',stripAccents(trim($data))));
            if(!in_array($sub_sub_cat,$sub_sub_category)){$sub_sub_category[] = $sub_sub_cat;}
            break;
        case 11:
            $sub_sub_sub_cat = strtolower(preg_replace('/\s+/', '-',stripAccents(trim($data))));
            if(!in_array($sub_sub_sub_cat,$sub_sub_sub_category)){$sub_sub_sub_category[] = $sub_sub_sub_cat;}
            break;
        case 14:
            $i = 1;
            break;
    }
    $i++;
}

var_dump($category);echo "<br>";
var_dump($sub_category);echo "<br>";
var_dump($sub_sub_category);echo "<br>";
var_dump($sub_sub_sub_category);echo "<br>";
// Unset the file to call __destruct(), closing the file handle.
$file = null;


function stripAccents($str) {
    return strtr(utf8_decode($str), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
}