<?php
    // Es necesario iniciar las sesión para usar la superglobal $_SESSION -- verificar que no este definida para evitar errores
    if(!isset($_SESSION))
        session_start();

    $auth = $_SESSION['login'] ?? false;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raíces</title>
    <link rel="stylesheet" href="/bienesraices/build/css/app.css">
</head>

<body>
    <!-- Header si la variable inicio esta definida se muestra la imagen y el texto -->
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/bienesraices/index.php">
                    <img src="/bienesraices/build/img/logo.svg" alt="logotipo">
                </a>

                <div class="mobile-menu">
                    <img src="/bienesraices/build/img/barras.svg" alt="menu">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/bienesraices/build/img/dark-mode.svg">
                    <div class="navegacion">
                        <a href="/bienesraices/nosotros.php">Nosotros</a>
                        <a href="/bienesraices/anuncios.php">Anuncios</a>
                        <a href="/bienesraices/blog.php">Blog</a>
                        <a href="/bienesraices/contacto.php">Contacto</a>
                        <?php if ($auth) : ?>
                            <a href="/bienesraices/admin/index.php">Administrar</a>
                            <a href="/bienesraices/cerrar-sesion.php">Cerrar Sesión</a>
                        <?php endif; ?>
                        <?php if (!$auth) : ?>
                            <a href="/bienesraices/login.php">Iniciar Sesión</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div><!-- Cierre de Barra -->

            <?php
                // Validar si es la página de inicio isset para verificar la variable
                if($inicio) {
                    ?>
                    <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
                    <?php
                }
            ?>
        </div>
    </header>