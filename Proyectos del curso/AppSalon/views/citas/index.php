<h1 class="nombre-pagina">Crear Nueva Cita</h1>
<p class="descripcion-pagina">
    Elige tus servicios a continuación.
</p>
<div class="app">
    <nav class="tabs">
        <button type="button" class="actual" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Informacion Cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>
    <div id="paso-1" class="seccion ocultar mostrar" >
        <h3>Servicios</h3>
        <p class="text-center">Elige tus servicios a continuación</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>
    <div id="paso-2" class="seccion ocultar" >
        <h3>Tus datos y Cita</h3>
        <p class="text-center">Coloca tus datos y fecha de la cita</p>
        <form class="form">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input 
                    id="nombre"
                    type="text"
                    placeholder="Tu nombre"
                    value="<?php echo $nombre; ?>"
                    disabled
                >
            </div>
            <div class="campo">
                <label for="fecha">Fecha</label>
                <input 
                    id="fecha"
                    type="date"
                >
            </div>
            <div class="campo">
                <label for="hora">Hora</label>
                <input 
                    id="hora"
                    type="time"
                >
            </div>
        </form>
    </div>
    <div id="paso-3" class="seccion ocultar" >
        <h3>Resumen</h3>
        <p class="text-center">Verifica que la informacion sea correcta</p>
    </div>
    <div class="paginacion">
        <button
            id="anterior"
            class="boton"
        >&laquo; Anterior</button>
        <button
            id="siguiente"
            class="boton"
        >Siguiente &raquo;</button>
    </div>
</div>
<?php
    $script = "
        <script src='build/js/citas.js'></script>
    ";

?>