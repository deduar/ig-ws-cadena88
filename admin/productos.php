<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="wp-heading-inline">Grupo Igal - consume webservice for Cadena88</h1>
        </div>
    </div>
    <hr />
</div>

<?php
echo "PRODUCTOS ------------------<br>";

$producto = new SplFileObject(dirname(__FILE__) . "/producto.xml");
$i = 1;
while (!$producto->eof()) {
    $prod_data = $producto->fgets();
    switch ($i) {
        case 2:
            preg_match('/<ib_cabecera xsi:type="xsd:string">(.*?)<\/ib_cabecera>/s', $prod_data, $prod_title);
            echo "Title: " . ($prod_title[1] . ", ") . "<br>";
            break;
        case 3:
            preg_match('/<ib_descripcion xsi:type="xsd:string">(.*?)<\/ib_descripcion>/s', $prod_data, $prod_desc);
            echo "Description: " . ($prod_desc[1] . ", ") . "<br>";
            break;
        case 4:
            preg_match('/<descripcion xsi:type="xsd:string">(.*?)<\/descripcion>/s', $prod_data, $prod_short_desc);
            echo "Short Description: " . ($prod_short_desc[1] . ", ") . "<br>";
            break;
        case 5:
            preg_match('/<ib_imagen_marca xsi:type="xsd:string">(.*?)<\/ib_imagen_marca>/s', $prod_data, $img_marca);
            echo "Img Marca: " . ($img_marca[1] . ", ") . "<br>";
            break;
        case 6:
            preg_match('/<ib_nom_marca xsi:type="xsd:string">(.*?)<\/ib_nom_marca>/s', $prod_data, $nom_marca);
            echo "Marca: " . ($nom_marca[1] . ", ") . "<br>";
            break;
        case 7:
            preg_match('/<ta_descripcion xsi:type="xsd:string">(.*?)<\/ta_descripcion>/s', $prod_data, $long_desc);
            echo "Long Description: " . ($long_desc[1] . ", ") . "<br>";
            break;
        case 8:
            preg_match('/<pr_ref xsi:type="xsd:string">(.*?)<\/pr_ref>/s', $prod_data, $prod_pr_ref);
            echo "SKU: " . $prod_pr_ref[1] . ", ";
            $familia = new SplFileObject(dirname(__FILE__) . "/familiaAECOC.xml");
            $j = 1;
            $block_fam = false;
            while (!$familia->eof()) {
                $fam_data = $familia->fgets();
                switch ($j) {
                    case 2:
                        preg_match('/<ec_ref>(.*?)<\/ec_ref>/s', $fam_data, $fam_pr_ref);
                        if ($prod_pr_ref[1] == $fam_pr_ref[1]) {
                            echo "SKU: " . $fam_data . ", ";
                            $block_fam = true;
                        }
                        break;
                    case 14:
                        $j = 1;
                        $block_fam = false;
                        break;
                    default:
                        if ($block_fam) {
                            if ($j == 5) {
                                preg_match('/<ec_tema>(.*?)<\/ec_tema>/s', $fam_data, $cat_id);
                                $c_id = get_term_by('slug', $cat_id[1], 'product_cat');
                            }
                            if ($j == 7) {
                                preg_match('/<ec_categoria>(.*?)<\/ec_categoria>/s', $fam_data, $sub_cat_id);
                                $s_c_id = get_term_by('slug', $sub_cat_id[1], 'product_cat');
                            }
                            if ($j == 9) {
                                preg_match('/<ec_subcategoria>(.*?)<\/ec_subcategoria>/s', $fam_data, $sub_sub_cat_id);
                                $s_s_c_id = get_term_by('slug', $sub_sub_cat_id[1], 'product_cat');
                            }
                            if ($j == 11) {
                                preg_match('/<ec_familia>(.*?)<\/ec_familia>/s', $fam_data, $sub_sub_sub_cat_id);
                                $s_s_s_c_id = get_term_by('slug', $sub_sub_sub_cat_id[1], 'product_cat');
                                echo "Cat: " . $fam_data . "Cat ID: " . $c_id->term_id .
                                    ", Sub Cat: " . $fam_data . "Sub cat ID:" . $s_c_id->term_id .
                                    ", Sub Sub Cat: " . $fam_data . "Sub Sub cat ID:" . $s_s_c_id->term_id .
                                    ", Sub Sub Cat: " . $fam_data . "Sub Sub cat ID:" . $s_s_s_c_id->term_id .
                                    "<br>";
                            }
                        }
                        break;
                }
                $j++;
            }
            $familia = null;
            break;
        case 9:
            preg_match('/<pr_unidad xsi:type="xsd:string">(.*?)<\/pr_unidad>/s', $prod_data, $pr_unidad);
            echo "Unidad: " . ($pr_unidad[1] . ", ") . "<br>";
            break;
        case 10:
            preg_match('/<env xsi:type="xsd:string">(.*?)<\/env>/s', $prod_data, $envase);
            echo "Envase: " . ($envase[1] . ", ") . "<br>";
            break;
        case 11:
            preg_match('/<p_cesion xsi:type="xsd:string">(.*?)<\/p_cesion>/s', $prod_data, $p_cesion);
            echo "Precio session: " . ($p_cesion[1] / 100 . ", ") . "<br>";
            break;
        case 12:
            preg_match('/<p_recomendado xsi:type="xsd:string">(.*?)<\/p_recomendado>/s', $prod_data, $pr_neto);
            echo "Precio neto: " . ($pr_neto[1] / 100 . ", ") . "<br>";
            break;
        case 14:
            preg_match('/<observaciones xsi:type="xsd:string">(.*?)<\/observaciones>/s', $prod_data, $observaciones);
            echo "Nota del Fabricante: " . ($observaciones[1] . ", ") . "<br>";
            break;
        case 15:
            preg_match('/<oferta xsi:type="xsd:string">(.*?)<\/oferta>/s', $prod_data, $oferta);
            echo "ID Oferta: " . ($oferta[1] . ", ") . "<br>";
            break;
        case 16:
            preg_match('/<en_oferta xsi:type="xsd:string">(.*?)<\/en_oferta>/s', $prod_data, $en_oferta);
            echo "En Oferta: " . ($en_oferta[1] . ", ") . "<br>";
            break;
        case 18:
            preg_match('/<p_oferta xsi:type="xsd:string">(.*?)<\/p_oferta>/s', $prod_data, $p_oferta);
            echo "Precio Oferta: " . ($p_oferta[1] / 100 . ", ") . "<br>";
            break;
        case 19:
            preg_match('/<ib_nodo_imagen xsi:type="xsd:string">(.*?)<\/ib_nodo_imagen>/s', $prod_data, $ib_nodo_imagen);
            echo "ID Imagen: " . ($ib_nodo_imagen[1] . ", ") . "<br>";
            break;
        case 20:
            preg_match('/<pr_envase1 xsi:type="xsd:string">(.*?)<\/pr_envase1>/s', $prod_data, $pr_envase1);
            echo "1er Envase: " . ($pr_envase1[1] . ", ") . "<br>";
            break;
        case 21:
            preg_match('/<pr_neto xsi:type="xsd:string">(.*?)<\/pr_neto>/s', $prod_data, $pr_neto);
            echo "Precio Neto: " . ($pr_neto[1] / 100 . ", ") . "<br>";
            break;
        case 22:
            preg_match('/<pr_pvp_futuro xsi:type="xsd:string">(.*?)<\/pr_pvp_futuro>/s', $prod_data, $pr_pvp_futuro);
            echo "Precio Futuro: " . ($pr_pvp_futuro[1] / 100 . ", ") . "<br>";
            break;
        case 23:
            preg_match('/<pr_fecha_futuro xsi:type="xsd:string">(.*?)<\/pr_fecha_futuro>/s', $prod_data, $pr_fecha_futuro);
            echo "Fecha Precio Futuro: " . ($pr_fecha_futuro[1] . ", ") . "<br>";
            break;
        case 24:
            preg_match('/<grupo_art xsi:type="xsd:string">(.*?)<\/grupo_art>/s', $prod_data, $grupo_art);
            echo "Familia: " . ($grupo_art[1] . ", ") . "<br>";
            break;
        case 25:
            preg_match('/<peso xsi:type="xsd:string">(.*?)<\/peso>/s', $prod_data, $peso);
            echo "Peso: " . ($peso[1] . ", ") . "<br>";
            break;
        case 32:
            $i = 1;

            $post_id = wc_get_product_id_by_sku($prod_pr_ref[1]);
            $my_post = array(
                'ID'            => $post_id,
                'post_type'     => 'product',
                'post_title'    => wp_strip_all_tags($prod_title[1]),
                'post_content'  => $prod_desc[1],
                'post_status'   => 'publish',
                'post_author'   => 1,
                'tax_input' => array(
                    'product_cat' => array($c_id->term_id, $s_c_id->term_id, $s_s_c_id->term_id, $s_s_s_c_id->term_id)
                )
            );

            $post_id = wp_insert_post($my_post);
            $product = wc_get_product($post_id);
            $product->set_sku($prod_pr_ref[1]);
            $product->set_price($p_recomendado[1] / 100);
            $product->set_regular_price($p_recomendado[1] / 100);
            $product->save();

            update_post_meta($post_id, 'oferta', $oferta[1]);
            update_post_meta($post_id, 'en_oferta', $en_oferta[1]);
            update_post_meta($post_id, 'p_cesion', $p_cesion[1]/100);
            update_post_meta($post_id, 'pr_neto', $pr_neto[1]/100);
            update_post_meta($post_id, 'pr_pvp_futuro', $pr_pvp_futuro[1]/100);
            update_post_meta($post_id, 'pr_fecha_futuro', $pr_fecha_futuro[1]);
            update_post_meta($post_id, 'pr_unidad', $pr_unidad[1]);
            
            
            echo "POST ID: " . $post_id . "--------------------<br>";

            break;
    }
    $i++;
}
$producto = null;
