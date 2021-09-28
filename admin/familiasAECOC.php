<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="wp-heading-inline">Grupo Igal - consume webservice for Cadena88</h1>
        </div>
    </div>
    <hr />
</div>

<?php

$file = new SplFileObject(dirname(__FILE__) . "/familiaAECOC.xml");
$categories = 0;
$sub_categories = 0;
$sub_sub_category = 0;
$sub_sub_sub_category = 0;
$i = 1;
while (!$file->eof()) {
    $data = $file->fgets();
    switch ($i) {
        case 5:
            if (strlen($data) != 29) {
                $catMain = $data;
                if (!get_term_by('slug', $data, 'product_cat')) {
                    $cat = strtolower(preg_replace('/\s+/', '-', stripAccents(trim($data))));
                    wp_insert_term($data, 'product_cat', array(
                        'description' => $data,
                        'parent' => 0,
                        'slug' => $cat
                    ));
                    echo "Insert Cat: ".$data."<br>";
                    $categories++;
                }
            }
            break;
        case 7:
            if (strlen($data) != 29) {
                $sub_cat = $data;
                if (!get_term_by('slug', $data, 'product_cat')) {
                    $sub_cat = strtolower(preg_replace('/\s+/', '-', stripAccents(trim($data))));
                    $cat_id = get_term_by('slug', $catMain, 'product_cat');
                    wp_insert_term($data, 'product_cat', array(
                        'description' => $data,
                        'parent' => $cat_id->term_id,
                        'slug' => $sub_cat
                    ));
                    echo "Insert Sub Cat: ".$data."<br>";
                    $sub_categories++;
                }
            }
            break;
        case 9:
            if (strlen($data) != 29) {
                $sub_sub_cat = $data;
                if (!get_term_by('slug', $data, 'product_cat')) {
                    $sub_sub_cat = strtolower(preg_replace('/\s+/', '-', stripAccents(trim($data))));
                    $sub_cat_id = get_term_by('slug', $sub_cat, 'product_cat');
                    wp_insert_term($data, 'product_cat', array(
                        'description' => $data,
                        'parent' => $sub_cat_id->term_id,
                        'slug' => $sub_sub_cat
                    ));
                    echo "Inert Sub Sub Cat: ".$data."<br>";
                    $sub_sub_category++;
                }
            }
            break;
        case 11:
            if (strlen($data) != 29) {
                $sub_sub_sub_cat = $data;
                if (!get_term_by('slug', $data, 'product_cat')) {
                    $sub_sub_sub_cat = strtolower(preg_replace('/\s+/', '-', stripAccents(trim($data))));
                    $sub_sub_cat_id = get_term_by('slug', $sub_sub_cat, 'product_cat');
                    wp_insert_term($data, 'product_cat', array(
                        'description' => $data,
                        'parent' => $sub_sub_cat_id->term_id,
                        'slug' => $sub_sub_sub_cat
                    ));
                    echo "Insert Sub Sub Sub Cat: ".$data."<br>";
                    $sub_sub_sub_category++;
                }
            }
            break;
        case 14:
            $i = 1;
            unset($catMain);
            unset($sub_cat);
            unset($sub_sub_cat);
            unset($sub_sub_sub_cat);
            break;
    }
    $i++;
}
// Unset the file to call __destruct(), closing the file handle.
$file = null;

echo "<br>Finished process ---------- <br>";
echo "Cat added <br>";
echo "Cat: ".$categories."<br>";
echo "Sub Cat: ".$sub_categories."<br>";
echo "Sub Sub Cat: ".$sub_categories."<br>";
echo "Sub Sub Sub Cat: ".$sub_sub_sub_category."<br>";


function stripAccents($str)
{
    return strtr(utf8_decode($str), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
}
