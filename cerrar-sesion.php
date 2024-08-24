<?php

    session_start();
    // Cerrar sesión con función php
    // session_destroy();
    // Cerrar sesión limpiando el arreglo
    $_SESSION = [];

    header('location: index.php');