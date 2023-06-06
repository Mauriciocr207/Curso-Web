<?php
    require './includes/app.php';
    use App\Database;
    $db = new Database();
    $propiedades = obtenerPropiedades();
    $propiedadesContables = [];
    $maxAnuncios = 3;

    echo "</pre>";

    setTemplate(template: "header", inHome: true);
?>
<!-- MAIN ICONOS NOSOTROS -->
    <main class="box">
        <div class="section about">
            <h1 class="about__title">Más sobre Nosotros</h1>
            <div class="about__icons">
                <div class="icon">
                    <img src="build/img/icono1.svg" alt="Ícono Seguridad" loading="lazy">
                    <h3>Seguridad</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus repudiandae iure quae unde ab,
                        ea nostrum atque facilis totam voluptatem.</p>
                </div>
                <div class="icon">
                    <img src="build/img/icono2.svg" alt="Ícono Precio" loading="lazy">
                    <h3>Precio</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus repudiandae iure quae unde ab,
                        ea nostrum atque facilis totam voluptatem.</p>
                </div>
                <div class="icon">
                    <img src="build/img/icono3.svg" alt="Ícono Tiempo" loading="lazy">
                    <h3>A Tiempo</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus repudiandae iure quae unde ab,
                        ea nostrum atque facilis totam voluptatem.</p>
                </div>
            </div>
        </div>
    </main>
    <!-- SECTION ANUNCIOS -->
    <section class="box">
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
                <a href="./anuncios.php" class="button">
                    Ver Todas
                </a>
            </div>
        </div>
    </section>
    <!-- SECTION CONTACTO -->
    <section class="contact">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondrá en conctacto contigo a la brevedad</p>
        <a href="contacto.php" class="button">Contáctanos</a>
    </section>
    <!-- SECTION BLOG -->
    <section class="box">
        <div class="section section__blog">
            <section class="section__blog--content">
                <h3 class="content__title">Nuestro Blog</h3>
                <!-- ENTRADA 1 -->
                <article class="content__article">
                    <div class="content__article--img">
                        <picture>
                            <source srcset="build/img/blog1.avif" type="image/avif">
                            <source srcset="build/img/blog1.webp" type="image/webp">
                            <img loading="lazy" src="build/img/blog1" alt="Entrada de blog 1">
                        </picture>
                    </div>
                    <div class="content__article--entrada">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p>Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
                        <p>Consejos para construir una terraza en el techo de tu casa, con los mejores materiales y
                            ahorrando dinero</p>
                        <div class="view-entrada">
                            <a href="entrada.php" class="button">
                                Leer entrada
                            </a>
                        </div>
                    </div>
                </article>
                <!-- ENTRADA 2 -->
                <article class="content__article">
                    <div class="content__article--img">
                        <picture>
                            <source srcset="build/img/blog2.avif" type="image/avif">
                            <source srcset="build/img/blog2.webp" type="image/webp">
                            <img loading="lazy" src="build/img/blog2" alt="Entrada de blog 2">
                        </picture>
                    </div>
                    <div class="content__article--entrada">
                        <h4>Guía para la decoración de tu hogar</h4>
                        <p>Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
                        <p>Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y colores para
                            darle vida a tu hogar</p>
                        <div class="view-entrada">
                            <a href="entrada.php" class="button">
                                Leer entrada
                            </a>
                        </div>
                    </div>
                </article>

            </section>
            <section class="section__blog--testimoniales">
                <h3 class="testimoniales__title">Testimoniales</h3>
                <div class="testimoniales__content">
                    <div class="testimonial">
                        <blockquote>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. A quis at vitae animi itaque, facere aperiam officiis fugiat consectetur possimus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, quas?
                        </blockquote>
                        <p>- Mauricio Carrillo</p>
                    </div>
                </div>
            </section>
        </div>
    </section>
<?php
    setTemplate('footer');
?>