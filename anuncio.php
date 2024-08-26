<?php
    $id = $_GET['id'] ?? null;

    // Sanitizar el ID
    $id = filter_var($id, FILTER_VALIDATE_INT);

    // Si el ID no existe redirecciona a index.php
    if (!$id) 
        header('Location: index.php');

    // Importar la base de datos
    require 'includes/app.php';
    // Conectar a la base de datos
    $db = conectarDB();
    // Escribir el Query
    $query = "SELECT * FROM propiedades WHERE propiedadID = $id";
    // Obtener los resultados
    $resultado = mysqli_query($db, $query);

    // Num rows funciona para que cuando se escriba un ID y no exista redireccione a index.php
    if (!$resultado->num_rows) {
        header('Location: index.php');
    }

    $propiedad = mysqli_fetch_assoc($resultado);

    // Incluimos el header
    incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad['titulo']; ?></h1>

    <img loading="lazy" src="imagenes/<?php echo $propiedad['imagen']; ?>" alt="imgAnuncio">

    <div class="resumen-propiedad">
        <p class="precio">$<?php echo $propiedad['precio']; ?></p>

        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad['wc']; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $propiedad['estacionamiento']; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                <p><?php echo $propiedad['habitaciones']; ?></p>
            </li>
        </ul>

        <p><?php echo $propiedad['descripcion'];?></p>
</main>

<?php
    incluirTemplate('footer');
?>