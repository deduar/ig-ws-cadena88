<?php

/**
 * igWSCadena88  
 * 
 * 
 * @author Eduardo Diez (for GrupoIgal)
 */

class igWSCadena88
{

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
            `nombre` varchar(50) DEFAULT NULL,
            `description` text,
            `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            KEY nombre (nombre)
        ) COLLATE ' . $wpdb->collate;

        // usado para crear tablas y bases de datos
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}
