<?php
    require './includes/app.php';
    use App\Propiedad;
    $propiedadesData = Propiedad::getAll();
    $maxAnuncios = 3;
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $maxAnuncios = count($propiedadesData);
    }
    setTemplate('header');
?>
    <!-- MAIN -->
    <main class="box">
        <div class="section section__anuncios">
            <h2 class="section__anuncios--title">Casas y Depas en Venta</h2>
            <div class="section__anuncios--content">
                <?php 
                    $propiedades = [];
                    for ($i=0; $i < $maxAnuncios; $i++) { 
                        $data = $propiedadesData[$i];
                        $propiedades[] = new Propiedad($data);
                    }
                    foreach($propiedades as $propiedad) {
                        $propiedad -> getImagen();
                ?>
                        <div class="anuncio">
                            <picture class="anuncio__img">
                                <source srcset="./imagenes/<?php echo $propiedad -> getImagen(); ?>" type="image/avif">
                                <source srcset="./imagenes/<?php echo $propiedad -> getImagen(); ?>" type="image/webp">
                                <img loading="lazy" src="./imagenes/<?php echo $propiedad -> getImagen(); ?>" alt="">
                            </picture>
                            <div class="anuncio__content">
                                <h3><?php echo $propiedad -> getTitulo() ?></h3>
                                <p class="anuncio__content--descripcion"><?php echo substr($propiedad -> getDescripcion(),0, 30); ?>...</p>
                                <p class="anuncio__content--precio">
                                    $<?php echo $propiedad -> getPrecio(); ?>
                                </p>
                                <ul class="anuncio__content--icons">
                                    <li>
                                        <img loading="lazy" src="build/img/icono_wc.svg" alt="Ícono wc">
                                        <p><?php echo $propiedad -> getWc(); ?></p>
                                    </li>
                                    <li>
                                        <img loading="lazy" src="build/img/icono_estacionamiento.svg"
                                            alt="Ícono estacionamiento">
                                        <p><?php echo $propiedad -> getEstacionamiento(); ?></p>
                                    </li>
                                    <li>
                                        <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="Ícono dormitorio">
                                        <p><?php echo $propiedad -> getHabitaciones() ?></p>
                                    </li>
                                </ul>
                                <a href="anuncio.php?id=<?php echo $propiedad -> getId(); ?>" class="button">
                                    Ver Propiedad
                                </a>
                            </div>
                        </div>
                <?php 
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