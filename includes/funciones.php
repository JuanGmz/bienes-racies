<?php
    require 'app.php';
    // Funcion para incluir templates, recibe el nombre del archivo y el bool para saber si es el inicio o no
    function incluirTemplate(string $nombre, bool $inicio = false) {
        // Concatenamos la carpeta templates con el nombre del archivo
        include TEMPLATES_URL . "/$nombre.php"; 
    }

    function autenticado() : bool{
        // Iniciar sesión
        session_start();

        // Acceder al arreglo de sesión y verificar si el login es true
        $auth = $_SESSION['login'];

        if($auth)
            return true;
            
        return false;

    }