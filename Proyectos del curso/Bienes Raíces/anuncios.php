<?php
    require './includes/app.php';
    $propiedades = obtenerPropiedades();
    $propiedadesContables = [];
    $maxAnuncios = 6;
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $mostrarMaxPropiedades = count($propiedadesContables);
    }
    setTemplate('header');
?>
    <!-- MAIN -->
    <main class="box">
        <div class="section section__anuncios">
            <h2 class="section__anuncios--title">Casas y Depas en Venta</h2>
            <div class="section__anuncios--content">
                <?php 
                    if(!empty($propiedades)) {
                        foreach ($propiedades as $propiedad) {
                            $propiedadesContables[] = $propiedad;
                        }
                        $numPropiedades = count($propiedades);
                        if($numPropiedades < $maxAnuncios) {
                            $mostrarMaxPropiedades = $numPropiedades;
                        } else {
                            $mostrarMaxPropiedades = $maxAnuncios;
                        }
                        for ($i=0; $i < $mostrarMaxPropiedades; $i++) { 
                ?>
                        <div class="anuncio">
                            <picture class="anuncio__img">
                                <source srcset="./imagenes/<?php echo $propiedadesContables[$i]["imagen"] ?>" type="image/avif">
                                <source srcset="./imagenes/<?php echo $propiedadesContables[$i]["imagen"] ?>" type="image/webp">
                                <img loading="lazy" src="./imagenes/<?php echo $propiedadesContables[$i]["imagen"] ?>" alt="">
                            </picture>
                            <div class="anuncio__content">
                                <h3><?php echo $propiedadesContables[$i]["titulo"] ?></h3>
                                <p class="anuncio__content--descripcion"><?php echo substr($propiedadesContables[$i]["descripcion"],0, 30); ?>...</p>
                                <p class="anuncio__content--precio">
                                    $<?php echo $propiedadesContables[$i]["precio"] ?>
                                </p>
                                <ul class="anuncio__content--icons">
                                    <li>
                                        <img loading="lazy" src="build/img/icono_wc.svg" alt="Ícono wc">
                                        <p><?php echo $propiedadesContables[$i]["wc"] ?></p>
                                    </li>
                                    <li>
                                        <img loading="lazy" src="build/img/icono_estacionamiento.svg"
                                            alt="Ícono estacionamiento">
                                        <p><?php echo $propiedadesContables[$i]["estacionamiento"] ?></p>
                                    </li>
                                    <li>
                                        <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="Ícono dormitorio">
                                        <p><?php echo $propiedadesContables[$i]["habitaciones"] ?></p>
                                    </li>
                                </ul>
                                <a href="anuncio.php?id=<?php echo $propiedadesContables[$i]["id"] ?>" class="button">
                                    Ver Propiedad
                                </a>
                            </div>
                        </div>
                <?php 
                        }
                    }
                ?>
            </div>
            <div class="view-all">
                <form action="./anuncios.php" method="POST">
                    <input class="button" type="submit" value="Ver Todas">
                </form>
            </div>
        </div>
    </main>
<?php
    setTemplate('footer');
?>