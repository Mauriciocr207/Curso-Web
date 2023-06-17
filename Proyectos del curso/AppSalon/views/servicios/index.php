<?php
    include_once __DIR__ . '/../templates/barra.php';
?>
<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">
    Administración de servicios
</p>
<?php
    include_once __DIR__ . '/../templates/navServicios.php';
?>
<div class="listado-servicios">
    <?php
        foreach ($servicios as $servicio) {
    ?>
        <div class="servicio">
            <p class="nombre-servicio">
                <?php echo $servicio -> getNombre(); ?>
            </p>
            <p class="precio-servicio">
                <?php echo $servicio -> getPrecio(); ?>
            </p>
            <div class="servicio-opciones">
                <a class="icon" href="/servicios/actualizar?id=<?php echo $servicio -> getId(); ?>">
                    <i class="actualizar fa-solid fa-pen-to-square"></i>
                </a>
                <a class="icon" href="/servicios/eliminar?id=<?php echo $servicio -> getId(); ?>">
                    <i class="eliminar fa-solid fa-trash-can"></i>
                </a>
            </div>
        </div>
        
    <?php
        }
    ?>
</div>