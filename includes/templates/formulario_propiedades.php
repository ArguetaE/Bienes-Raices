<fieldset>
    <legend>Información General</legend>

        <label for="titulo">Titulo:</label>
        <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo Propiedad" value="<?php

use App\Vendedor;

 echo sane($propiedad->titulo); ?>">

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?php echo sane($propiedad->precio); ?>">

        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">

        <?php if ($propiedad->imagen) { ?>
            <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small">
        <?php } ?>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="propiedad[descripcion]"><?php echo sane($propiedad->descripcion); ?></textarea>

</fieldset>

    <fieldset>
        <legend>Información Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input 
            type="number" 
            id="habitaciones" 
            name="propiedad[habitaciones]" 
            placeholder="Ej: 3" 
            min="1" 
            max="9" 
            value="<?php echo sane($propiedad->habitaciones); ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej: 3" min="1" max="9" value="<?php echo sane($propiedad->wc); ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej: 3" min="1" max="9" value="<?php echo sane($propiedad->estacionamiento); ?>">

    </fieldset>

    <fieldset>
        <legend>Vendedor</legend>

        <label for="vendedor">Vendedor</label>
        <select name="propiedad[vendedores_id]" id="vendedor">
            <option selected value="" disabled>-- Seleccione --</option>
            <?php foreach ($vendedores as $vendedor) {?>
                <option 
                <?php echo $propiedad->vendedores_id === $vendedor->id ? 'Selected' : ''; ?>
                value="<?php echo sane($vendedor->id) ?>"> <?php echo sane($vendedor->nombre) . " " . sane($vendedor->apellido); ?></option>
            <?php } ?>
        </select>
    </fieldset>