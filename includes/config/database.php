<?php

    // Indicar a la funcion conectarDB que recibe una base de datos mysqli 
    function conectarDB() : mysqli {
        // Conexión a la base de datos con MySQLI primero se importa la librería de mysqli, primer parametro, el servidor, segundo el usuario, tercero la contraseña, cuarto el nombre de la base de datos
        $db = new mysqli('localhost', 'root', '.123Access123.', 'bienesraices_crud');

        if(!$db) {
            echo "Conexión Fallida";
            exit;
        }

        return $db;
    }