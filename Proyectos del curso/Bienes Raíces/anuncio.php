<?php
    require './includes/funciones.php';
    setTemplate('header');
?>
    <!-- MAIN -->
    <main class="box">
        <div class="section propiedad">
            <h1 class="propiedad__title">Casa en Venta Frente al Bosque</h1>
            <div class="propiedad__img">
                <picture>
                    <source srcset="build/img/destacada.avif" type="image/avif">
                    <source srcset="build/img/destacada.webp" type="image/webp">
                    <img loading="lazy" src="build/img/destacada.jpg" alt="">
                </picture>
            </div>
            <div class="propiedad__resumen">
                <p class="propiedad__resumen--precio">
                    $3,000,000
                </p>
                <ul class="anuncio__content--icons propiedad__resumen--icons">
                    <li>
                        <img loading="lazy" src="build/img/icono_wc.svg" alt="Ícono wc">
                        <p>3</p>
                    </li>
                    <li>
                        <img loading="lazy" src="build/img/icono_estacionamiento.svg"
                            alt="Ícono estacionamiento">
                        <p>3</p>
                    </li>
                    <li>
                        <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="Ícono dormitorio">
                        <p>4</p>
                    </li>
                </ul>
            </div>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia cum fugiat vero dolor accusantium harum minus maiores esse, obcaecati quas nam molestiae voluptates neque dolores vitae alias enim praesentium nobis ipsum. Commodi exercitationem ab unde vero molestias, numquam sit maiores impedit beatae. Expedita iusto sequi rerum, dolor quos tenetur perspiciatis.
            </p>
            <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ducimus deserunt eius magnam quibusdam eos eveniet laborum, odio accusamus asperiores vel consequuntur ex? Quod error nostrum ut! Officia quasi, tempora est magnam accusantium tempore libero beatae maiores? Ipsa excepturi optio totam laudantium nostrum magni quos. Voluptatibus reiciendis earum molestiae assumenda doloribus.
            </p>
        </div>
    </main>
<?php
    setTemplate('footer');
?>