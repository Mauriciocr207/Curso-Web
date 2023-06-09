<div class="barra">
    <p class="saludo">Hola <?php echo $nombre ?? ""; ?></p>
    <a class="cerrarSesion" href="/logout"><i class="fa-solid fa-right-from-bracket"></i></a>
</div>
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
        <h3 class="seccion_titulo">Servicios</h3>
        <p class="seccion_descripcion text-center">Elige tus servicios a continuación</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>
    <div id="paso-2" class="seccion ocultar" >
        <h3 class="seccion_titulo">Tus datos y Cita</h3>
        <p class="seccion_descripcion text-center">Coloca tus datos y fecha de la cita</p>
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
                    min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
                >
            </div>
            <div class="campo">
                <label for="hora">Hora</label>
                <input 
                    id="hora"
                    type="time"
                >
            </div>
            <input type="hidden" id="id" value="<?php echo $id; ?>">
        </form>
    </div>
    <div id="paso-3" class="seccion ocultar resumen" >
        <h3 class="seccion_titulo">Resumen</h3>
        <p class="seccion_descripcion text-center">Verifica que la informacion sea correcta</p>
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
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='build/js/citas.js'></script>
    ";

?>