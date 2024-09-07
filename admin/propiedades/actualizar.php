<?php
use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

require '../../includes/app.php';

// Esta funcion nos indica si esta autenticado
autenticado();

// Obtener los datos de la propiedad desde el a de actualizar
$id = $_GET['id'];

// Sanitizar el ID --  Ejemplo: esta función elimina lo que no son INT
$id = filter_var($id, FILTER_VALIDATE_INT);

// Comprobar que el ID es correcto si no lo es, redireccionar
if (!$id) {
    header('Location: /bienesraices/admin');
}

$propiedad = Propiedad::find($id);

// Obtener todos los vendedores
$query = "SELECT * FROM vendedores";
$resultadoVendedores = mysqli_query($db, $query); // Cambié el nombre de la variable

// Arreglo con mensajes de error
$errores = Propiedad::getErrores();

// Si el método es POST se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Asignar los atributos
    $args = $_POST['propiedad'];

    $propiedad->sincronizar($args);

    $errores = $propiedad->validar();

    $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

    if (empty($errores)) {
        //save img
        if ($_FILES['propiedad']['tmp_name']['imagen']) {
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
            $propiedad->setImage($nombreImagen);
            $image->save(CARPETA_IMAGENES . $nombreImagen);
        }
 
        $propiedad->guardar();
    }
}
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>

    <a href="/bienesraices/admin" class="boton-verde">Volver</a>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

        <input type="submit" value="Actualizar Propiedad" class="boton-verde">
    </form>
</main>

<?php
incluirTemplate('footer');
?>