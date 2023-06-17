<?php
    include_once __DIR__ . '/../templates/barra.php';
?>
<h1 class="nombre-pagina">Crear Servicio</h1>
<p class="descripcion-pagina">
    Crea un nuevo servicio
</p>
<?php
    include_once __DIR__ . '/../templates/navServicios.php';
?>
<div class="alert">
    <?php  
        foreach($errores as $err) { ?>
            <div class="err">
                <?php echo $err; ?>
            </div>
    <?php         
        }
        if(!empty($res)) {
            echo "<div class='enviado'>" . $res . "</div>";
        }
    ?>
</div>
<form action="/servicios/crear" method="POST" class="form">
    <?php
        include_once __DIR__ . './formulario.php';
    ?>
    <input type="submit" class="boton" value="Guardar Servicio">
</form>