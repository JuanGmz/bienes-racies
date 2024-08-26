<?php
    require 'includes/app.php';
    // Incluimos el header
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Contacto</h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="imgAnuncio">
        </picture>

        <h2>Llene el formulario de contacto</h2>

        <form class="formulario">
            <fieldset>
                <legend>Informacion Personal</legend>

                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu Nombre" id="nombre">

                <label for="email">E-Mail</label>
                <input type="email" placeholder="Tu E-Mail" id="email">

                <label for="telefono">Teléfono</label>
                <input type="tel" placeholder="Tu Telefono" id="telefono">

                <label for="mensaje">Mensaje</label>
                <textarea name="mensaje" id="mensaje"></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion sobre la Propiedad</legend>

                <label for="vende-compra">Vende O Compra</label>
                <select name="vende-compra" id="vende-compra">
                    <option value="" selected disabled>-- Seleccione --</option>
                    <option value="vende">Vende</option>
                    <option value="compra">Compra</option>
                </select>

                <label for="precio-presupuesto">Precio O Presupuesto</label>
                <input type="number" placeholder="Tu Precio o Presupuesto" id="precio-presupuesto" min="0">
            </fieldset>

            <fieldset>
                <legend>Información sobre la Propiedad</legend>

                <p>Como desea ser contactado</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input type="radio" value="telefono" name="contacto" id="contactar-telefono">

                    <label for="contactar-email">E-Mail</label>
                    <input type="radio" value="email" name="contacto" id="contactar-email">
                </div>

                <p>Si eligio Telefono, elija la fecha y la hora para ser contactado</p>

                <label for="fecha">Fecha</label>
                <input type="date" id="fecha">

                <label for="hora">Hora</label>
                <input type="time" id="hora" min="09:00" max="18:00">
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
    </main>

<?php 
    incluirTemplate('footer');
?>