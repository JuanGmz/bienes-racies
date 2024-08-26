<?php
    require 'includes/app.php';
    // Incluimos el header
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Conoce Sobre Nosotros</h1>
    </main>

    <main class="nosotros contenedor">
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Imagen de Nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>25 Años de Experiencia</blockquote>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius provident, ipsam, nihil recusandae obcaecati, deleniti iusto accusantium debitis labore necessitatibus eaque eligendi ab doloremque omnis soluta eveniet. Pariatur, accusantium nobis.</p>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius provident, ipsam, nihil recusandae obcaecati, deleniti iusto accusantium debitis labore necessitatibus eaque eligendi ab doloremque omnis soluta eveniet. Pariatur, accusantium nobis.</p>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius provident, ipsam, nihil recusandae obcaecati, deleniti iusto accusantium debitis labore necessitatibus eaque eligendi ab doloremque omnis soluta eveniet. Pariatur, accusantium nobis.</p>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius provident, ipsam, nihil recusandae obcaecati, deleniti iusto accusantium debitis labore necessitatibus eaque eligendi ab doloremque omnis soluta eveniet. Pariatur, accusantium nobis.</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h2>Mas Sobre Nosotros</h2>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="iconoSeguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, dolores.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="iconoPrecio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, dolores.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="iconoTiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, dolores.</p>
            </div>
        </div>
    </section>

<?php 
    incluirTemplate('footer');
?>