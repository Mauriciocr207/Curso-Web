<fieldset class="form__fieldset">
    <legend class="form__legend">Información Evento</legend>
    <div class="form__campo">
        <label for="nombre" class="form__label">Nombre del Evento</label>
        <input 
            type="text"
            class="form__input"
            id="nombre"
            name="nombre"
            placeholder="Nombre del Ponente"
            value="<?php echo $evento -> getNombre(); ?>"
        >
    </div>
    <div class="form__campo">
        <label for="descripcion" class="form__label">Descripcion del Evento</label>
        <textarea 
            class="form__input"
            id="descripcion"
            name="descripcion"
            placeholder="Descripcion del Evento"
            rows="5"
        ><?php echo $evento -> getDescripcion(); ?></textarea>
    </div>
    <div class="form__campo">
        <label for="nombre" class="form__label">Categoría o Tipo de Evento</label>
        <select name="id_categoria" id="categoria" class="form__select">
            <?php foreach($categorias as $categoria) { 
                ?>
                <option
                    <?php echo (int)($evento -> getIdCategoria()) === $categoria["id"] ? "selected" : "" ?>
                    value="<?php echo $categoria["id"] ?>"
                >
                    <?php echo $categoria["nombre"]; ?>
                </option>
            <?php } ?>
        </select>
    </div>
    <div class="form__campo">
        <label for="dia" class="form__label">Selecciona el día</label>
        <div class="form__radio">
            <?php foreach($dias as $dia) { ?>
                <div>
                    <label for=""><?php echo $dia["nombre"]; ?></label>
                    <input 
                        type="radio"
                        id="<?php echo strtolower($dia["nombre"]) ?>"
                        name="dia"
                        value="<?php echo $dia["id"] ?>"
                    >
                </div>
            <?php } ?>
        </div>
        <input type="hidden" value="<?php echo $evento -> getIdDia(); ?>" name="id_dia">
    </div>
    <div class="form__campo">
        <label for="" class="form__label">Seleccionar Hora</label>
        <ul id="horas" class="horas">
            <?php foreach($horas as $hora) { ?>
                <li data-id-hora=<?php echo $hora["id"] ?> class="horas__hora horas__hora--deshabilitada">
                    <?php echo $hora["hora"]; ?>
                </li>
            <?php } ?>
        </ul>
        <input type="hidden" value="<?php echo $evento -> getIdHora(); ?>" name="id_hora">
    </div>
</fieldset>
<fieldset class="form__fieldset">
    <legend class="form__legend">Información Extra</legend>
    <div class="form__campo">
        <label for="ponentes" class="form__label">Ponente</label>
        <input 
            type="text"
            class="form__input"
            id="ponentes"
            placeholder="Buscar Ponente"
        >
        <ul class="listado-ponentes" id="listado-ponentes"></ul>
        <input type="hidden" name="id_ponente" value="<?php echo $evento -> getIdPonente(); ?>">
    </div>
    <div class="form__campo">
        <label for="disponibles" class="form__label">Lugares Disponibles</label>
        <input 
            type="number"
            min="1"
            class="form__input"
            id="disponibles"
            name="disponibles"
            placeholder="Ej. 20"
            value="<?php echo $evento -> getDisponibles(); ?>"
        >
    </div>
</fieldset>
