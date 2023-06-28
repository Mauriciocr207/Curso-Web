<div class="eventos__listado slider swiper <?php echo isset($modificador) ? "eventos__listado--$modificador" : ""; ?> ?>" data-aos="<?php echo $aos ?? ""; ?>">
    <div class="swiper-wrapper">
        <?php foreach($eventos[$tipo_evento][$dia] as $evento) { ?>
            <div class="evento swiper-slide <?php echo isset($modificador) ? "evento--$modificador" : ""; ?>">
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
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>