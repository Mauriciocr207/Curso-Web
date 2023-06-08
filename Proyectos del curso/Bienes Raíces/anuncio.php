<?php
    use App\Propiedad;
    require './includes/app.php';
    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id) header('Location: ./');
    $metadata = Propiedad::getById($id);
    $propiedad = new Propiedad($metadata);
    setTemplate('header');
?>
    <!-- MAIN -->
    <main class="box">
        <div class="section propiedad">
            <div class="propiedad__img">
                <picture class="anuncio__img">
                    <source srcset="./imagenes/Propiedades/<?php echo $propiedad -> getImagen(); ?>" type="image/avif">
                    <source srcset="./imagenes/Propiedades/<?php echo $propiedad -> getImagen(); ?>" type="image/webp">
                    <img loading="lazy" src="./imagenes/Propiedades/<?php echo $propiedad -> getImagen(); ?>" alt="">
                </picture>
            </div>
            <h1 class="propiedad__title"><?php echo $propiedad -> getTitulo(); ?></h1>
            <div class="propiedad__resumen">
                <p class="propiedad__resumen--precio">
                    $<?php echo $propiedad -> getPrecio(); ?>
                </p>
                <ul class="anuncio__content--icons propiedad__resumen--icons">
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
                        <p><?php echo $propiedad -> getHabitaciones(); ?></p>
                    </li>
                </ul>
            </div>
            <p class="propiedad__descripcion">
                <?php echo $propiedad -> getDescripcion(); ?>
            </p>
        </div>
    </main>
<?php
    setTemplate('footer');
?>