<?php
    require './includes/funciones.php';
    require './includes/manageDB/propiedades.php';
    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id) header('Location: ./');
    $propiedad = obtenerPropiedadPorId($id);
    setTemplate('header');
?>
    <!-- MAIN -->
    <main class="box">
        <div class="section propiedad">
            <div class="propiedad__img">
                <picture class="anuncio__img">
                    <source srcset="./imagenes/<?php echo $propiedad["imagen"] ?>" type="image/avif">
                    <source srcset="./imagenes/<?php echo $propiedad["imagen"] ?>" type="image/webp">
                    <img loading="lazy" src="./imagenes/<?php echo $propiedad["imagen"] ?>" alt="">
                </picture>
            </div>
            <h1 class="propiedad__title"><?php echo $propiedad["titulo"] ?></h1>
            <div class="propiedad__resumen">
                <p class="propiedad__resumen--precio">
                    $<?php echo $propiedad["precio"] ?>
                </p>
                <ul class="anuncio__content--icons propiedad__resumen--icons">
                    <li>
                        <img loading="lazy" src="build/img/icono_wc.svg" alt="Ícono wc">
                        <p><?php echo $propiedad["wc"] ?></p>
                    </li>
                    <li>
                        <img loading="lazy" src="build/img/icono_estacionamiento.svg"
                            alt="Ícono estacionamiento">
                        <p><?php echo $propiedad["estacionamiento"] ?></p>
                    </li>
                    <li>
                        <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="Ícono dormitorio">
                        <p><?php echo $propiedad["habitaciones"] ?></p>
                    </li>
                </ul>
            </div>
            <p class="propiedad__descripcion">
                <?php echo $propiedad["descripcion"] ?>
            </p>
        </div>
    </main>
<?php
    setTemplate('footer');
?>