<h2 class="pagina__heading"><?php echo $titulo; ?></h2>
<p class="pagina__descripcion">Elige hasta 5 eventos para asistir de forma presencial</p>
<div class="eventos-registro">
    <main class="eventos-registro__listado">
        <h3 class="eventos-registro__heading--conferencias">
            &lt; Conferencias />
        </h3>
        <a href="" class="eventos-registro__fecha">Viernes 5 de Octubre</a>
        <div class="eventos-registro__grid">
            <?php
                $tipo_evento = "conferencias";
                $dia = "viernes";
                foreach($eventos[$tipo_evento][$dia] as $evento) {
                    include __DIR__ . '/evento.php';
                } 
            ?>
        </div>
        <a href="" class="eventos-registro__fecha">Sábado 6 de Octubre</a>
        <div class="eventos-registro__grid">
            <?php
                $tipo_evento = "conferencias";
                $dia = "sabado";
                foreach($eventos[$tipo_evento][$dia] as $evento) {
                    include __DIR__ . '/evento.php';
                } 
            ?>
        </div>
        <h3 class="eventos-registro__heading--workshops">
            &lt; Workshops />
        </h3>
        <a href="" class="eventos-registro__fecha">Viernes 5 de Octubre</a>
        <div class="eventos-registro__grid eventos">
            <?php
                $tipo_evento = "workshops";
                $dia = "viernes";
                $modificador = "workshops";
                foreach($eventos[$tipo_evento][$dia] as $evento) {
                    include __DIR__ . '/evento.php';
                } 
            ?>
        </div>
        <a href="" class="eventos-registro__fecha">Sábado 6 de Octubre</a>
        <div class="eventos-registro__grid">
            <?php
                $tipo_evento = "workshops";
                $dia = "sabado";
                $modificador = "workshops";
                foreach($eventos[$tipo_evento][$dia] as $evento) {
                    include __DIR__ . '/evento.php';
                } 
            ?>
        </div>
    </main>
    <aside class="registro-bar">
        <h2 class="registro-bar__heading">Tu Registro</h2>
        <div id="registro-bar-resumen" class="registro-bar__resumen"></div>
        <div id="registro-bar-regalo" class="registro-bar__regalo">
            <label for="regalo" class="registro-bar__label">Selecciona un regalo</label>
            <select id="regalo" class="registro-bar__select">
                <option value="">--Selecciona tu regalo--</option>
                <?php foreach($regalos as $regalo) { ?>
                    <option value="<?php echo $regalo -> getId(); ?>"><?php echo $regalo -> getNombre(); ?></option>
                <?php } ?>
            </select>
        </div>
        <form action="" class="form" id="registro">
            <div class="form__campo">
                <input type="submit" class="form__submit form__submit--full" value="Registrarme">
            </div>
        </form>
    </aside>
</div>