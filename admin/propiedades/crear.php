<?php
require '../../includes/config/database.php';

$db = conectarDB();

// Obtener todos los vendedores
$query = "SELECT * FROM vendedores";
$resultadoVendedores = mysqli_query($db, $query); // Cambié el nombre de la variable

// Arreglo con mensajes de error
$errores = [];

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorid = '';
$creado = date('Y/m/d');
$imagen = '';

// Si el método es POST se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // $numero = 1;
    // $numero2 = 'HOLA2';
    // Sanitizar los datos -- Ejemplo: esta función elimina lo que no son INT
    // $resultado =  filter_var($numero2, FILTER_SANITIZE_SPECIAL_CHARS);
    // $resultado2 =  filter_var($numero2, FILTER_VALIDATE_INT);
    // var_dump($resultado);
    // var_dump($resultado2);

    // Asignar los valores al arreglo $_POST
    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedorid = mysqli_real_escape_string($db, $_POST['vendedorid'] ?? '');
    $creado = date('Y/m/d');
    // Asignar files hacia una variable
    $imagen = $_FILES['imagen'];

    // Validaciones
    if (!$titulo)
        $errores[] = "Debes añadir un título";
    if (!$precio)
        $errores[] = "Debes añadir un precio";
    if (!$imagen['name'])
        $errores[] = "Debes añadir una imagen";
    // Validar tamaño a 1MB
    $medida = 1000 * 1000;
    if ($imagen['size'] > $medida)
        $errores[] = "La imagen es muy pesada";
    if (strlen($descripcion) < 50)
        $errores[] = "La descripción es demasiado corta";
    if (!$habitaciones)
        $errores[] = "Debes añadir el número de habitaciones";
    if (!$wc)
        $errores[] = "Debes añadir el número de baños";
    if (!$estacionamiento)
        $errores[] = "Debes añadir el número de estacionamientos";
    if (!$vendedorid)
        $errores[] = "Debes añadir un vendedor";



    // Revisar que el arreglo de errores esté vacío
    if (empty($errores)) {

        // Crear carpeta para subir imagenes
        $carpetaImagenes = '../../imagenes/';
        // Crear carpeta, is_dir comprueba si existe la carpeta
        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        // Generar un nombre unico -- md5 genera un identificador unico, rand() genera un numero aleatorio, true es para que se genere en binario, .jpg es el formato
        $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

        // Subir la imagen -- move_uploaded_file mueve el archivo a la carpeta de imagenes, toma el nombre de la imagen y la ruta
        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

        // Insertar en la base de datos
        $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedorID) 
                  VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorid')";

        $resultadoInsert = mysqli_query($db, $query);

        if ($resultadoInsert) {
            // Redireccionar al usuario a admin
            header ('Location: /bienesraices/admin?resultado=1');
        }
    }
}

require '../../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Crear Propiedad</h1>

    <a href="/bienesraices/admin" class="boton-verde">Volver</a>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" placeholder="Título Propiedad" value="<?php echo $titulo ?>">

            <label for="precio">Precio</label>
            <input type="number" min="1" id="precio" name="precio" placeholder="Precio Propiedad"
                value="<?php echo $precio ?>">

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" name="imagen" accept="image/*">

            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion"><?php echo $descripcion ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información Propiedad</legend>

            <label for="habitaciones">Habitaciones</label>
            <input type="number" min="1" max="9" id="habitaciones" name="habitaciones" placeholder="Ejemplo: 3"
                value="<?php echo $habitaciones ?>">

            <label for="wc">Baños</label>
            <input type="number" min="1" max="9" id="wc" name="wc" placeholder="Ejemplo: 3" value="<?php echo $wc ?>">

            <label for="estacionamiento">Estacionamientos</label>
            <input type="number" min="1" max="9" id="estacionamiento" name="estacionamiento" placeholder="Ejemplo: 3"
                value="<?php echo $estacionamiento ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <label for="vendedor">Vendedor</label>
            <select name="vendedorid" id="vendedor">
                <option value="" selected disabled>-- Seleccione --</option>
                <?php while($vendedor = mysqli_fetch_assoc($resultadoVendedores)): ?>
                    <option <?php echo $vendedorid === $vendedor['vendedorID'] ? 'selected' : ''; ?> value="<?php echo $vendedor['vendedorID'] ?>">
                        <?php echo $vendedor['nombre'] . " " . $vendedor['apellidos']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton-verde">
    </form>
</main>

<?php
incluirTemplate('footer');
?>
