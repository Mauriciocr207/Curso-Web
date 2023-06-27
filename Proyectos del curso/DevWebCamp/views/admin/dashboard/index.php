<h2 class="dashboard__heading"><?php echo $titulo ?></h2>
<div class="bloques">
    <div class="bloques__grid">
        <div class="bloque">
            <h3 class="bloque__heading">Últimos Registros</h3>
            <?php foreach($registros as $registro) { ?>
                <p class="bloque__texto">
                    <?php echo $registro -> getIdUsuario()["nombre"] . " " . $registro -> getIdUsuario()["apellido"]; ?>
                </p>
            <?php }?>
        </div>
        <div class="bloque">
            <h3 class="bloque__heading">Ingresos Generados</h3>
            <p class="bloque__texto--cantidad">$<?php echo $ingresos; ?></p>
        </div>
        <div class="bloque">
            <h3 class="bloque__heading">Eventos con menos lugares disponibles</h3>
            <?php foreach($menos_disponibles as $evento) { ?>
                <p class="bloque__texto">
                    <?php echo $evento["nombre"] . " - " . $evento["disponibles"] . " Disponibles"; ?>
                </p>
            <?php }?>
        </div>
        <div class="bloque">
            <h3 class="bloque__heading">Eventos con más lugares disponibles</h3>
            <?php foreach($mas_disponibles as $evento) { ?>
                <p class="bloque__texto">
                    <?php echo $evento["nombre"] . " - " . $evento["disponibles"] . " Disponibles"; ?>
                </p>
            <?php }?>
        </div>
    </div>
</div>