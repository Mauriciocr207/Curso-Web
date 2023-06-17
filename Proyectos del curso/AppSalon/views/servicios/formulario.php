<div class="campo">
    <label for="nombre">Nombre</label>
    <input type="text"
        type="text"
        id="nombre"
        placeholder="Nombre del Servicio"
        name="nombre"
        value="<?php echo $servicio -> getNombre(); ?>"
    >
</div>
<div class="campo">
    <label for="precio">Precio</label>
    <input type="number"
        type="text"
        id="precio"
        placeholder="Precio del Servicio"
        name="precio"
        value="<?php echo $servicio -> getPrecio(); ?>"
    >
</div>