<main class="agenda">
    <h2 class="agenda__heading">Workshops y Conferencias </h2>
    <p class="agenda__descripcion">
        Talleres y conferencias dictados por expertos en desarrollo web 
    </p>

    <div class="eventos">
        <h3 class="eventos__heading">
            &lt; Conferencias />
        </h3>
        <a href="" class="eventos__fecha">Viernes 5 de Octubre</a>
        <!-- LISTADO DE EVENTOS -->
        <?php
            $tipo_evento = "conferencias";
            $dia = "viernes";
            $aos = "fade-right";
            include __DIR__ . '/templates/conferencias.php';
        ?>
        <a href="" class="eventos__fecha">Sábado 6 de Octubre</a>
        <!-- LISTADO DE EVENTOS -->
        <?php
            $tipo_evento = "conferencias";
            $dia = "sabado";
            $aos = "fade-left";
            include __DIR__ . '/templates/conferencias.php';
        ?>
    </div>
    <div class="eventos eventos--workshops">
        <h3 class="eventos__heading">
            &lt; Workshops />
        </h3>
        <a href="" class="eventos__fecha">Viernes 5 de Octubre</a>
        <!-- LISTADO DE EVENTOS -->
        <?php
            $tipo_evento = "workshops";
            $dia = "viernes";
            $modificador = "workshops";
            $aos = "fade-right";
            include __DIR__ . '/templates/conferencias.php';
        ?>
        <a href="" class="eventos__fecha">Sábado 6 de Octubre</a>
        <!-- LISTADO DE EVENTOS -->
        <?php
            $tipo_evento = "workshops";
            $dia = "sabado";
            $modificador = "workshops";
            $aos = "fade-left";
            include __DIR__ . '/templates/conferencias.php';
        ?>
    </div>
</main>