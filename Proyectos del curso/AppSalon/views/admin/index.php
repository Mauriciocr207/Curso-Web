<?php
    include_once __DIR__ . '/../templates/barra.php';
?>
<h1 class="nombre-pagina">Panel de Administración</h1>
<?php
    include_once __DIR__ . '/../templates/navServicios.php';
?>
<h3>Buscar citas</h3>
<div class="busqueda">
    <form action="" class="form">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input 
                type="date"
                id="fecha"
                name="fecha"
                value="<?php echo $fecha; ?>"
            >
        </div>
    </form>
</div>
<div class="citas-admin">
    <?php
        if(count($citas) === 0) { 
    ?>
            <div class="alert">
                <div class="err">
                    No hay citas
                </div>
            </div>    
    <?php 
        }
    ?>
    <div class="citas">
        <?php
            foreach($citas as $cita) { 
        ?>       
            <div class="cita">
                <h3>Cita ( id: <?php echo $cita["id"] ?> )</h3>
                <h4>Información del cliente</h4>
                <div class="info">
                    <p class="dato">Hora: <span><?php echo $cita["hora"] ?></span></p>
                    <p class="dato">Cliente: <span><?php echo $cita["nombre"] ?></span></p>
                    <p class="dato">Telefono: <span><?php echo $cita["telefono"] ?></span></p>
                    <p class="dato">Email: <span><?php echo $cita["email"] ?></span></p>
                </div>
                <h4>Servicios</h4>
                <div class="listado-servicios">
                    <?php
                        foreach ($cita["servicios"] as $servicio) {
                    ?>
                        <div class="servicio">
                            <p class="nombre-servicio">
                                <?php echo $servicio["servicio"] ?>
                            </p>
                            <p class="precio-servicio">
                                <?php echo $servicio["precio"] ?>
                            </p>
                        </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="total">
                    <p>Total: $<?php echo $cita["total"] ?></p>
                </div>
                <form class="form-eliminar" action="/api/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $cita["id"]; ?>">
                    <input type="submit" class="boton-eliminar" value="Eliminar">
                </form>
            </div>
        <?php 
            }
        ?>
    </div>
</div>
<?php
    $script = "<script src='build/js/search.js'></script>"
?>