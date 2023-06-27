<div class="evento <?php echo isset($modificador) ? "evento--$modificador" : ""; ?>">
    <p class="evento__hora"><?php echo $evento -> getIdHora()["hora"]; ?></p>
    <div class="evento__informacion <?php echo isset($modificador) ? "evento__informacion--$modificador" : ""; ?>">
        <h4 class="evento__nombre"><?php echo $evento -> getNombre(); ?></h4>
        <p class="evento__introduccion"><?php  echo $evento -> getDescripcion(); ?></p>
        <div class="evento__autor-info">
            <picture>
                <source srcset="/img/speakers/<?php echo $evento -> getIdPonente()["imagen"] ?>.webp" type="image/webp">
                <img class="evento__imagen-autor" loading="lazy" src="/img/speakers/<?php echo $evento -> getIdPonente()["imagen"] ?>.png" alt="">
            </picture>
            <p class="evento__autor-nombre">
                <?php echo $evento -> getIdPonente()["nombre"] . " " . $evento -> getIdPonente()["apellido"]; ?>
            </p>
        </div>
        <button
            type="button"
            data-id="<?php echo $evento -> getId(); ?>"
            class="evento__agregar"
            <?php echo ($evento -> getDisponibles()) === 0 ? 'disabled' : ''; ?>
        >
            <?php echo ($evento -> getDisponibles()) === 0 ? 'Agotado' : 'Agregar - ' . $evento -> getDisponibles() . ' Disponibles'; ?>
        </button>
    </div>
</div>