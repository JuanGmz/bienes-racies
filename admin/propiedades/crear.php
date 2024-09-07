<?php
require '../../includes/app.php';

use App\Propiedad;

use Intervention\Image\ImageManagerStatic as Image;

// Esta funcion nos indica si esta autenticado
autenticado();

// Conexión a la base de datos
$db = conectarDB();

$propiedad = new Propiedad;

// Obtener todos los vendedores
$query = "SELECT * FROM vendedores";
$resultadoVendedores = mysqli_query($db, $query); // Cambié el nombre de la variable

// Arreglo con mensajes de error
$errores = Propiedad::getErrores();

// Si el método es POST se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $propiedad = new Propiedad($_POST['propiedad']);

    // Generar un nombre unico -- md5 genera un identificador unico, rand() genera un numero aleatorio, true es para que se genere en binario, .jpg es el formato
    $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

    // Subir la imagen -- move_uploaded_file mueve el archivo a la carpeta de imagenes, toma el nombre de la imagen y la ruta
    // move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

    // Realizar un resize usando intervention
    if($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        $propiedad->setImage($nombreImagen);
    }

    $errores = $propiedad->validar();

    // Revisar que el arreglo de errores esté vacío
    if (empty($errores)) {

        // Crear carpeta
        if(!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES);
        }
        
        $image->save(CARPETA_IMAGENES . $nombreImagen);

        $propiedad->crear();
    }
}
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
        <?php include '../../includes/templates/formulario_propiedades.php' ?>

        <input type="submit" value="Crear Propiedad" class="boton-verde">
    </form>
</main>

<?php
incluirTemplate('footer');
?>