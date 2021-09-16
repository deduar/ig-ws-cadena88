<?php
/**
 * Plugin Name: Grupo Igal consumer webservice of Cadena88
 * Plugin URI: https://grupoigal.com
 * Description: Consumer of WS cadena88
 * Author: Eduardo Diez (for GrupoIgal)
 * Author URI: https://grupoigal.com
 * Version: 1.0
 * Date: 2021-09-16
 * License: GPLv2
 * Text Domain: igWSCadena88
*/

define ( '_IGWSC88_DIR', plugin_dir_path(__FILE__) );
define ( '_IGWSC88_DIR_URL', plugin_dir_url(__FILE__) );

if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {    

    require_once( _IGWSC88_DIR . 'inc/igWSCadena88.class.php' );    
    $wsc88 = new igWSCadena88();  
    $wsc88->init();

    // activation
    register_activation_hook( __FILE__, [ $wsc88, 'activation' ] );    
   
}