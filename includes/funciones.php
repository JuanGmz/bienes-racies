<?php
    // Constantes para la URL de la carpeta templates, __DIR__ devuelve la ruta del directorio actual
    define('TEMPLATES_URL', __DIR__ . '/templates');
    // Constantes para la URL de la carpeta funciones
    define('FUNCIONES_URL', 'funciones.php');

    // Funcion para incluir templates, recibe el nombre del archivo y el bool para saber si es el inicio o no
    function incluirTemplate(string $nombre, bool $inicio = false) {
        // Concatenamos la carpeta templates con el nombre del archivo
        include TEMPLATES_URL . "/$nombre.php"; 
    }

    function autenticado(){
        // Iniciar sesión
        session_start();
        // Acceder al arreglo de sesión y verificar si el login es true
        if(!$_SESSION['login'])
            header('location: /bienesraices/index.php');
    }

    // Funcion que ayuda a ver lo que hacemos
    function debugear($variable) {
        echo '<pre>';
        var_dump($variable);
        echo '</pre>';
        exit;
    }