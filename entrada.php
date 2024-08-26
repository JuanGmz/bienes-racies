<?php
    require 'includes/app.php';
    // Incluimos el header
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guía para la decoración en tu hogar</h1>

        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="imgAnuncio">
        </picture>

        <p class="informacion-meta">Escrito el: <span>20/10/2022</span> por: <span>Admin</span></p>

        <div class="resumen-propiedad">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, dolores. Lorem ipsum dolor sit amet
                consectetur adipisicing elit. Voluptates, dolores. Lorem ipsum dolor sit amet consectetur adipisicing
                elit. Voluptates, dolores. Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, dolores.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, dolores. Lorem ipsum dolor sit amet
                consectetur adipisicing elit. Voluptates, dolores. Lorem ipsum dolor sit amet consectetur adipisicing
                elit. Voluptates, dolores. Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, dolores.
            </p>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, dolores. Lorem ipsum dolor sit amet
                consectetur adipisicing elit. Voluptates, dolores. Lorem ipsum dolor sit amet consectetur adipisicing
            </p>
        </div>
    </main>

<?php 
    incluirTemplate('footer');
?>