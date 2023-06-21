<?php 
    $sidebar["newProject"] = "active";
    include_once __DIR__ . '/templates/header.php'; 
?>
<div class="main">
    <h2 class="nombre-pagina"><?php echo $titulo ?></h2>
    <div class="box-sm">
        <?php
            include_once __DIR__ . '/../templates/alerts.php';
        ?>
        <form action="/dashboard/create" class="form" method="POST">
        <?php
            include_once __DIR__ . '/templates/form.php';
        ?>
            <input type="submit" value="Crear Proyecto">
        </form>
    </div>
</div>
<?php include_once __DIR__ . '/templates/footer.php'; ?>