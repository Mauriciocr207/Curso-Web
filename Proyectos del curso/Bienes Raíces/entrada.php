<?php
    require './includes/app.php';
    setTemplate('header');
?>
    <!-- MAIN -->
    <main class="box">
        <div class="section entrada">
            <h1 class="entrada__title">Guía para la Decoración de tu Hogar</h1>
            <p class="entrada__meta">Escrito el: <span>20/10/2021</span> por: <span>Mauricio Carrillo</span></p>
            <div class="entrada__img">
                <picture>
                    <source srcset="build/img/destacada.avif" type="image/avif">
                    <source srcset="build/img/destacada.webp" type="image/webp">
                    <img loading="lazy" src="build/img/destacada.jpg" alt="">
                </picture>
            </div>
            <div class="entrada__content">
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque deleniti laudantium sunt fugit saepe, quasi soluta, beatae officia possimus iusto assumenda ullam hic natus voluptate id odit inventore, libero nam magnam cum velit asperiores ea. Enim quas obcaecati repellendus deleniti error temporibus, itaque ipsa qui et sapiente tempora modi repudiandae?
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Hic dolor asperiores praesentium repellat nobis nisi cumque optio quas dolores vitae sit perspiciatis atque porro, voluptate maiores soluta consequuntur aliquid reiciendis ad incidunt autem architecto. Voluptates culpa iusto consectetur necessitatibus iste quasi pariatur recusandae unde, deleniti, sapiente et repellendus praesentium ducimus, labore reiciendis! Voluptate assumenda iste cum maiores tempora recusandae delectus quam sapiente, suscipit debitis, facere accusamus necessitatibus reprehenderit sit provident quidem! Officiis qui sequi quod, magni dolores minus voluptatum harum molestias impedit! Laboriosam asperiores rerum animi illo? Itaque obcaecati, illo blanditiis repellat praesentium recusandae deserunt inventore est dignissimos, ducimus ipsa.
                </p>
            </div>
            
        </div>
    </main>
<?php
    setTemplate('footer');
?>