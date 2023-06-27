<?php 
    include_once __DIR__ . '/workshops-conferencias.php';
?>
<section class="resumen">
    <div class="resumen__grid">
        <div class="resumen__bloque" data-aos="fade-down">
            <p class="resumen__texto resumen__texto--numero"><?php echo $totales["ponentes"]; ?></p>
            <p class="resumen__texto resumen__texto--texto">Speakers</p>
        </div>
        <div class="resumen__bloque" data-aos="fade-left">
        <p class="resumen__texto resumen__texto--numero"><?php echo $totales["conferencias"]; ?></p>
            <p class="resumen__texto resumen__texto--texto">Conferencias</p>
        </div>
        <div class="resumen__bloque" data-aos="fade-right">
        <p class="resumen__texto resumen__texto--numero"><?php echo $totales["workshops"]; ?></p>
            <p class="resumen__texto resumen__texto--texto">Workshops</p>
        </div>
        <div class="resumen__bloque" data-aos="fade-up">
        <p class="resumen__texto resumen__texto--numero"><?php echo $totales["asistentes"]; ?></p>
            <p class="resumen__texto resumen__texto--texto">Asistentes</p>
        </div>
    </div>
</section>
<section class="speakers">
    <h2 class="speakers__heading">Speakers</h2>
    <p class="speakers__descripcion">
        Conoce a nuestros expertos del DevWebCamp
    </p>

    <div class="speakers__grid">
        <?php 
            $aosText = ["left", "right", "up", "down"];
            foreach($ponentes as $ponente) { 
            $randomFlip = $aosText[rand(0,3)];
            $flip = "flip-$randomFlip";
        ?>
            <div class="speaker <?php echo $flip; ?>" data-aos="<?php echo $flip; ?>">
                <picture>
                    <source srcset="/img/speakers/<?php echo $ponente -> getImagen(); ?>.webp" type="image/webp">
                    <img class="speaker__imagen-autor" loading="lazy" src="/img/speakers/<?php echo $ponente -> getImagen(); ?>.png" alt="">
                </picture>
                <div class="speaker__informacion">
                    <h4 class="speaker__nombre">
                        <?php echo $ponente -> getNombre() . " " . $ponente -> getApellido(); ?>
                    </h4>
                    <div class="speaker__ubicacion">
                        <?php echo $ponente -> getCiudad() . ", " . $ponente -> getPais(); ?>
                    </div>
                    <nav class="speaker-sociales">
                        <?php
                            $redes = $ponente -> getRedes();
                            foreach($redes as $key => $red) {
                                if(!empty($red)) {
                        ?>
                                <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $red ?>">
                                    <!-- <span class="speaker__ocultar"><?php echo $key ?></span> -->
                                </a> 
                        <?php 
                                }
                            } 
                        ?>
                    </nav>
                    <ul class="speaker__listado-skills">
                        <?php 
                            $tagsTexto = $ponente -> getTags();
                            $tagsArray = explode(',', $tagsTexto);
                            foreach($tagsArray as $tag) {
                        ?>
                            <li class="speaker__skill"><?php echo $tag ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
<section id="mapa" class="mapa"></section>
<section class="boletos">
    <h2 class="boletos__heading">Boletos y Precios</h2>
    <p class="boletos__descripcion">Precios para DevWebCamp</p>
    <div class="boletos__grid">
        <div class="boleto boleto--presencial" data-aos="flip-left">
            <h4 class="boleto__logo">&#60;DevWebCamp/></h4>
            <p class="boleto__plan">Presencial</p>
            <p class="boleto__precio">$199</p>
        </div>
        <div class="boleto boleto--virtual" data-aos="flip-up">
            <h4 class="boleto__logo">&#60;DevWebCamp/></h4>
            <p class="boleto__plan">Virtual</p>
            <p class="boleto__precio">$49</p>
        </div>
        <div class="boleto boleto--gratis" data-aos="flip-right">
            <h4 class="boleto__logo">&#60;DevWebCamp/></h4>
            <p class="boleto__plan">Gratis</p>
            <p class="boleto__precio">$0</p>
        </div>
    </div>
    <div class="boleto__enlace-contenedor">
        <a href="/paquetes" class="boleto__enlace">Ver Paquetes</a>
    </div>
</section>