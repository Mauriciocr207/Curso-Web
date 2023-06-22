<?php 
    include_once __DIR__ . '/templates/header.php'; 
?>
<div class="main">
    <h2 class="nombre-pagina"><?php echo $titulo ?></h2>
    <div class="box-sm">
        <div class="contenedor-nueva-tarea">
            <button
                type="button"
                class="agregar-tarea"
                id="agregar-tarea"
            >
                &#43; Nueva Tarea
            </button>
        </div>
        <div class="filtros" id="filtros">
            <div class="filtros-inputs">
                <h2>Búsqueda</h2>
                <div class="campo">
                    <label for="todas">Todas</label>
                    <input 
                        type="radio"
                        id="todas"
                        name="filtro"
                        value="-1"
                        checked
                    >
                </div>
                <div class="campo">
                    <label for="pendientes">Pendientes</label>
                    <input 
                        type="radio"
                        id="pendientes"
                        name="filtro"
                        value="0"
                    >
                </div>
                <div class="campo">
                    <label for="comppletadas letadas">Completadas</label>
                    <input 
                        type="radio"
                        id="completadas"
                        name="filtro"
                        value="1"
                    >
                </div>
            </div>
        </div>
        <ul id="listado-tareas" class="listado-tareas"></ul>
    </div>

</div>
<?php include_once __DIR__ . '/templates/footer.php'; ?>