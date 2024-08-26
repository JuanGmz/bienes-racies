<?php
    require 'includes/app.php';
    $db = conectarDB();

    $errores = [];

    // Autenticar usuario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validar que el valor del input sea un email
        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if (!$email)
            $errores[] = 'El email es obligatorio o no es válido';
        if (!$password)
            $errores[] = 'El password es obligatorio';

        // Si no existen errores al mandar el formulario
        if (empty($errores)) {
            // Revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '$email';";
            // Ejecutar la consulta
            $resultado = mysqli_query($db, $query);

            // Si num_rows esta vacío entonces escribimos un código, en caso contrario escribimos otro, se accede con flecha ya que el resultado es un objeto
            if ($resultado->num_rows) {
                // Revisar si el password es correcto
                // Acceder a los valores de la variable resultado con fetch assoc
                $usuario = mysqli_fetch_assoc($resultado);
                // Verificar si el password es correcto o no con password_verify, le pasamos el password que el usuario introdujo y el password que esta en la base de datos
                $auth = password_verify($password, $usuario['password']);

                if ($auth) {
                    // Usuario Autenticado
                    session_start();

                    // La superglobal $_SESSION es un arreglo, llenemoslo
                    // En el usuario de $_SESSION lo igualamos a el email de la base de datos
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    echo '<pre>';
                    echo var_dump($_SESSION);
                    echo '</pre>';

                    header('Location: /bienesraices/admin');
                } else {
                    $errores[] = 'El password es incorrecto';
                }
            } else {
                // Guardar en el arreglo de errores para mostrarlo
                $errores[] = 'El Usuario no existe';
            }
        }

    }
    // Incluimos el header
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php foreach ($errores as $error) :?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST">
            <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-Mail</label>
                <input type="email" name="email" placeholder="Tu E-Mail" id="email">

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu Password" id="password">
            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton-verde">
        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>