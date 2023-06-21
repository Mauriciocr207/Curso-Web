<?php 
    include_once __DIR__ . '/templates/header.php'; 
?>
<div class="main">
    <h2 class="nombre-pagina"><?php echo $titulo ?></h2>
    <div class="alert">
        <div class="err">No se pudo encontrar el proyecto</div>
    </div>
</div>
<?php include_once __DIR__ . '/templates/footer.php'; ?>