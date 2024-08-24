<?php

    // Importar la conexión
    require 'includes/config/database.php';
    $db = conectarDB();
    // Crear email y password 
    $email = 'correo@correo.com';
    $pass = '123456';
    // Encriptar password con PHP -- PASSWORD_DEFAULT, PASSWORD_BCRYPT
    $passHash = password_hash($pass, PASSWORD_DEFAULT);
    // Query para crear usuario
    $query = "INSERT INTO usuarios (email, password) VALUES('$email', '$passHash');";
    // Agregarlo a la base de datos
    mysqli_query($db, $query);
    // Cerrar la conexión base de datos
    mysqli_close($db);