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
    </div>

</div>
<?php include_once __DIR__ . '/templates/footer.php'; ?>