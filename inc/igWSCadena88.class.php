<?php

/**
 * igWSCadena88  
 * 
 * 
 * @author Eduardo Diez (for GrupoIgal)
 */

class igWSCadena88
{

    public function init()
    {
        // crear menús de administración
        add_action('admin_menu', [$this, 'addAdminMenu']);

        // scripts backend    
        add_action('admin_enqueue_scripts', [$this, 'addScripts']);
    }

    /**
     * menus
     * @desc inclusión de menus y submenús al Plugin
     */
    public function addAdminMenu()
    {
        // main menu
        add_menu_page('IG WS Cadena88', 'IG WS C88', 'manage_options', 'ig-ws-c88', [$this, 'pageDashboard'], 'dashicons-visibility');
        // submenus
        add_submenu_page('ig-ws-c88', 'Settings', 'Settings', 'manage_options', "ig-ws-c88-setings", [$this, 'pageSetting']);
        add_submenu_page('ig-ws-c88', 'Familias AECOC', 'Familias AECOC', 'manage_options', "ig-ws-c88-familiasAECOC", [$this, 'pageFamiliasAECOC']);
        // opciones
        //add_options_page ('IG WS Cadena88 Option', 'IG WS Cadena88', 'manage_options', 'ig-ws-cadena88.php', 'my_plugin_page' );
    }

    /**
     * Pagina: dashboard
     */
    public function pageDashboard()
    {
        include _IGWSC88_DIR . 'admin/dashboard.php';
    }

    public function pageSetting()
    {
        include _IGWSC88_DIR . 'admin/settings.php';
    }

    public function pageFamiliasAECOC()
    {
        include _IGWSC88_DIR . 'admin/familiasAECOC.php';
    }

    /**
     * Scripts
     * @desc inclusión de scripts a nuestro plugin
     */
    public function addScripts()
    {

        $_pages = [
            'ig-ws-c88',
            'ig-ws-c88-setings',
            'ig-ws-c88-submenu-2'
        ];

        // cargar scripts sólo en las páginas de nuestro plugin
        if (in_array(FILTER_INPUT(INPUT_GET, 'page'), $_pages)) {
            wp_enqueue_style('ig-ws-c88-css', _IGWSC88_DIR_URL . 'assets/css/style.css', [], null, false);
            wp_enqueue_script('ig-ws-c88-js', _IGWSC88_DIR_URL . 'assets/js/test.js', [], null, false);
        }
    }

    /**
     * Activación del Plugin
     * @desc creación de tablas personalizadas 
     */
    public function activation()
    {
        global $wpdb;
        $table = $wpdb->prefix . 'igwsc88';

        $sql = 'CREATE TABLE IF NOT EXISTS ' . $table . ' (
            `id` int(9) NOT NULL AUTO_INCREMENT,
            `name` varchar(50) DEFAULT NULL,
            `description` text,
            `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            KEY nombre (nombre)
        ) COLLATE ' . $wpdb->collate;

        // usado para crear tablas y bases de datos
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    public function testWS(){

        $wsdl = "https://intranet.cadena88.com/integracion/ws_cadena88.php?wsdl";
        $clientOptions = array('login' => '28636', 'password' => 'ZSMW6H');
        $client = new SoapClient($wsdl, $clientOptions);
        var_dump($client);

        //$parameters = array('cliente' => '28636','centro'=>'C004');
        //$result = $client->catalogo($parameters);

        //$result = $client->webservice($parameters);
        
        return "123";
    }

}
