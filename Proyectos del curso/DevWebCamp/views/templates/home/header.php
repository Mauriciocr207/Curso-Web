<header class="header">
    <div class="header__contenedor">
        <na class="header__navegacion">
            <?php
                if(isAuth()) {
            ?>
                <a href="/<?php echo isAdmin() ? 'admin/dashboard' : 'finalizar-registro'; ?>" class="header__enlace">Administrar</a>
                <form action="/logout" class="header__form" method="POST">
                    <input 
                        type="Submit"
                        value="Cerrar Sesión"
                        class="header__submit--logout"
                    >
                </form>
            <?php
                } else {
            ?>
                <a href="/registro" class="header__enlace">Registro</a>
                <a href="/login" class="header__enlace">Iniciar Sesión</a>
            <?php
                }
            ?>
        </na>
        <div class="header__contenido">
            <a href="/">
                <h1 class="header__logo">
                    &#60;DevWebCamp/>
                </h1>
            </a>
            <p class="header__texto">Octubre 5-6 - 2023</p>
            <p class="header__texto header__texto--modalidad">En linea - Presencial</p>

            <a href="/registro" class="header__boton">Compar Pase</a>
        </div>
    </div>
</header>
<div class="barra">
    <div class="barra__contenido">
        <a href="/">
            <h2 class="barra__logo">
                &#60;DevWebCamp/>
            </h2>    
        </a>
        <nav class="navegacion">
            <?php
                $links = [
                    [
                        "href" => "/devwebcamp",
                        "text" => "Evento",
                    ],
                    [
                        "href" => "/paquetes",
                        "text" => "Paquetes",
                    ],
                    [
                        "href" => "/workshops-conferencias",
                        "text" => "Workshops / Conferencias",
                    ],
                    [
                        "href" => "/registro",
                        "text" => "Registro",
                    ],
                ];
                foreach($links as $link) {
                    $class = "";
                    if(isset($_SERVER["PATH_INFO"])) {
                        if(pagina_actual($link["href"])) {
                            $class = "navegacion__enlace--actual";
                        }
                    }
                    ?>
                        <a href="<?php echo $link["href"] ?>" class="navegacion__enlace <?php echo $class?>"><?php echo $link["text"] ?></a>
                    <?php
                }
            ?>
        </nav>
    </div>
</div>