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
        add_submenu_page('ig-ws-c88', 'SubMenu 2', 'SubMenu 2', 'manage_options', "ig-ws-c88-submenu-2", [$this, 'pageSubMenu2']);
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
        $settings = $this->getSettings();
        include _IGWSC88_DIR . 'admin/settings.php';
    }

    public function pageSubmenu2()
    {
        echo "SubMenu2";
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

    public function getSettings(){
        global $wpdb;
        $table = $wpdb->prefix . 'igwsc88';

        $sqlInitialWSDL = 'SELECT description FROM ' . $table . ' WHERE `name` = \'initialWDSL\'';
        $initalWDSL = $wpdb->get_var($sqlInitialWSDL);

        $sqlWDSLUsername = 'SELECT description FROM ' . $table . ' WHERE `name` = \'wdslUsername\'';
        $WDSLUsername = $wpdb->get_var($sqlWDSLUsername);

        $sqlWDSLPassword = 'SELECT description FROM ' . $table . ' WHERE `name` = \'wdslPassword\'';
        $WDSLPassword = $wpdb->get_var($sqlWDSLPassword);

        $settings = ['initialWDSL' => $initalWDSL,'wdslUsername' => $WDSLUsername, 'wdslPassword' => $WDSLPassword];

        return $settings;
    }

}
