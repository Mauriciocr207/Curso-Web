<?php 
    $sidebar["projects"] = "active";
    include_once __DIR__ . '/templates/header.php'; 
?>
<div class="main">
    <h2 class="nombre-pagina"><?php echo $titulo ?></h2>
    <?php if(count($proyectos) === 0) { ?>
        <p class="no-proyectos">No hay proyectos Aún</p>
    <?php } else { ?>
        <ul class="listado-proyectos">
            <?php foreach($proyectos  as $proyecto) { ?>
                <a class="proyecto" href="/dashboard/project?url=<?php echo $proyecto -> getUrl(); ?>">
                    <?php echo $proyecto -> getNombre(); ?>
                </a>
            <?php } ?>
        </ul>
    <?php } ?>
</div>
<?php include_once __DIR__ . '/templates/footer.php'; ?>