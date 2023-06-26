<h2 class="dashboard__heading"><?php echo $titulo ?></h2>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/eventos">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>
<div class="dashboard__form-ponente">
    <?php 
        include_once __DIR__ . '/../../templates/alertas.php';
    ?>
    <form class="form" method="POST">
        <?php include_once __DIR__ . '/formulario.php'; ?>
        <input type="submit" class="form__submit form__submit--registrar" value="Actualizar Ponente">
    </form>
</div>