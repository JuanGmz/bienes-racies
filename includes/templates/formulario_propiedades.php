<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Título</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Título Propiedad" value="<?php echo htmlspecialchars($propiedad->titulo); ?>">

    <label for="precio">Precio</label>
    <input type="number" min="1" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?php echo htmlspecialchars($propiedad->precio); ?>">

    <label for="imagen">Imagen</label>
    <input type="file" id="imagen" name="propiedad[imagen]" accept="image/*">

    <?php if ($propiedad->imagen): ?>
        <img src="../imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-small" alt="imagenPropiedad">
    <?php endif; ?>

    <label for="descripcion">Descripción</label>
    <textarea name="propiedad[descripcion]" id="descripcion"><?php echo htmlspecialchars($propiedad->descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend>Información Propiedad</legend>

    <label for="habitaciones">Habitaciones</label>
    <input type="number" min="1" max="9" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ejemplo: 3" value="<?php echo htmlspecialchars($propiedad->habitaciones); ?>">

    <label for="wc">Baños</label>
    <input type="number" min="1" max="9" id="wc" name="propiedad[wc]" placeholder="Ejemplo: 3" value="<?php echo htmlspecialchars($propiedad->wc); ?>">

    <label for="estacionamiento">Estacionamientos</label>
    <input type="number" min="1" max="9" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ejemplo: 3" value="<?php echo htmlspecialchars($propiedad->estacionamiento); ?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>

    <label for="vendedor">Vendedor</label>

</fieldset>