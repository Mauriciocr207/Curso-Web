<?php
    include_once __DIR__ . '/../templates/barra.php';
?>
<h1 class="nombre-pagina">Actualizar Servicio</h1>
<p class="descripcion-pagina">
    Edita tus servicios
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
<form action="/servicios/actualizar?id=<?php echo $servicio -> getId(); ?>" method="POST" class="form">
    <?php
        include_once __DIR__ . './formulario.php';
    ?>
    <input type="submit" class="boton" value="Actualizar Servicio">
</form>