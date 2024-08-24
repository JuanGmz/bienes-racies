<?php
    // Traer el archivo de la base de datos
    require '../includes/config/database.php';
    // Conectar a la base de datos
    $db = conectarDB();
    // Escribir el Query
    $query = "SELECT * FROM propiedades";
    // Consultar la base de datos
    $resultadoPropiedades = mysqli_query($db, $query);

    // Muestra mensaje condicional, Si no existe el valor de la variable resultado, se inicializa en null
    $resultado = $_GET['resul tado'] ?? null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Extraer los valores del form
        $id = $_POST['id'];
        // Sanitizar el ID
        $id = filter_var($id, FILTER_VALIDATE_INT);

        // Si existe el ID se elimina la propiedad
        if ($id) {
            // Eliminar imagen

            // Query para obtener la imagen
            $query = "SELECT imagen FROM propiedades WHERE propiedadID = $id";
            // Obtener el resultado
            $resultado = mysqli_query($db, $query);
            // Guardar el resultado en una variable
            $propiedad = mysqli_fetch_assoc($resultado);
            // Eliminar la imagen con unlink
            unlink('../imagenes/' . $propiedad['imagen']);  

            // Eliminar propiedad
            $query = "DELETE FROM propiedades WHERE propiedadID = $id";
            $resultado = mysqli_query($db, $query);

            if ($resultado) {
                header('Location: /bienesraices/admin?resultado=3');
            }
        }
    }

    if($resultado) {
        header('refresh:3; url=/bienesraices/admin');
    }

    require '../includes/funciones.php';
    // Incluimos el header
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raíces</h1>

        <!-- Sacar el entero con intval -->
        <?php if (intval($resultado) === 1) : ?>
            <p class="alerta exito">Propiedad Creada Correctamente</p>
        <?php elseif (intval($resultado) === 2) : ?>
            <p class="alerta exito">Propiedad Actualizada Correctamente</p>
        <?php elseif (intval($resultado) === 3) : ?>
            <p class="alerta error">Propiedad Eliminada Correctamente</p>
        <?php endif ?>

        <a href="/bienesraices/admin/propiedades/crear.php" class="boton-verde">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados de la base de datos -->
                <?php while ($propiedad = mysqli_fetch_assoc($resultadoPropiedades)) : ?>
                <tr>
                    <td><?php echo $propiedad['propiedadID']; ?></td>
                    <td><?php echo $propiedad['titulo']; ?></td>
                    <td>
                        <img src="../imagenes/<?php echo $propiedad['imagen']; ?>" alt="imagenPropiedad" class="imagen-tabla">
                    </td>
                    <td>$<?php echo $propiedad['precio']; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <!-- Agregar un input oculto para enviar el id de la propiedad -->
                            <input type="hidden" name="id" value="<?php echo $propiedad['propiedadID']; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="propiedades/actualizar.php?id=<?php echo $propiedad['propiedadID']; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

<?php 
    // Cerrar la conexión a la base de datos
    mysqli_close($db);

    incluirTemplate('footer');
?>