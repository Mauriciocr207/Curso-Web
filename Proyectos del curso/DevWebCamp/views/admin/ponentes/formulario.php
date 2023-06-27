<fieldset class="form__fieldset">
    <legend class="form__legend">Información Personal</legend>
    <div class="form__campo">
        <label for="nombre" class="form__label">Nombre</label>
        <input 
            type="text"
            class="form__input"
            id="nombre"
            name="nombre"
            placeholder="Nombre del Ponente"
            value="<?php echo $ponente -> getNombre(); ?>"
        >
    </div>
    <div class="form__campo">
        <label for="apellido" class="form__label">Apellido</label>
        <input 
            type="text"
            class="form__input"
            id="apellido"
            name="apellido"
            placeholder="Apellido del Ponente"
            value="<?php echo $ponente -> getApellido(); ?>"
        >
    </div>
    <div class="form__campo">
        <label for="ciudad" class="form__label">Ciudad</label>
        <input 
            type="text"
            class="form__input"
            id="ciudad"
            name="ciudad"
            placeholder="Ciudad del Ponente"
            value="<?php echo $ponente -> getCiudad(); ?>"
        >
    </div>
    <div class="form__campo">
        <label for="pais" class="form__label">País</label>
        <input 
            type="text"
            class="form__input"
            id="pais"
            name="pais"
            placeholder="País del Ponente"
            value="<?php echo $ponente -> getPais(); ?>"
        >
    </div>
    <div class="form__campo">
        <label for="imagen" class="form__label">Imagen</label>
        <input 
            type="file"
            class="form__input form__input--file"
            id="imagen"
            name="imagen"
        >
    </div>
    <?php if(isset($imagen)) { 
        $urlImagen = '/img/speakers/' . $imagen;
    ?>
        <p class="form__texto">
            Imagen Actual:
        </p>
        <div class="form__imagen">
            <picture>
                <source srcset="<?php echo $urlImagen ?>.webp" type="image/webp">
                <img loading="lazy" src="<?php echo $urlImagen ?>.png" alt="">
            </picture>
        </div>
    <?php } ?>
</fieldset>
<fieldset class="form__fieldset">
    <legend class="form__legend">Información Extra</legend>
    <div class="form__campo">
        <label for="tags_input" class="form__label">Áreas de Experiencia (separadas por coma: ",")</label>
        <input 
            type="text"
            class="form__input"
            id="tags_input"
            placeholder="Ej. Node.js, PHP, CSS, Laravel, UX / UI, "
        >
        <div id="tags" class="form__listado"></div>
        <input type="hidden" name="tags" value="<?php echo $ponente -> getTags(); ?>">
    </div>
</fieldset>
<fieldset class="form__fieldset">
    <legend class="form__legend">Redes Sociales</legend>
    <div class="form__campo">
        <div class="form__contenedor-icono">
            <div class="form__icono">
                <i class="fa-brands fa-facebook"></i>
            </div>
            <input 
                type="text"
                class="form__input--sociales"
                name="redes[facebook]"
                placeholder="Facebook"
                value="<?php echo ($ponente -> getRedes())["facebook"] ?? ''; ?>"
            >
        </div>
        <div class="form__contenedor-icono">
            <div class="form__icono">
                <i class="fa-brands fa-twitter"></i>
            </div>
            <input 
                type="text"
                class="form__input--sociales"
                name="redes[twitter]"
                placeholder="Twitter"
                value="<?php echo ($ponente -> getRedes())["twitter"] ?? ''; ?>"
            >
        </div>
        <div class="form__contenedor-icono">
            <div class="form__icono">
                <i class="fa-brands fa-youtube"></i>
            </div>
            <input 
                type="text"
                class="form__input--sociales"
                name="redes[youtube]"
                placeholder="YouTube"
                value="<?php echo ($ponente -> getRedes())["youtube"] ?? ''; ?>"
            >
        </div>
        <div class="form__contenedor-icono">
            <div class="form__icono">
                <i class="fa-brands fa-instagram"></i>
            </div>
            <input 
                type="text"
                class="form__input--sociales"
                name="redes[instagram]"
                placeholder="Instagram"
                value="<?php echo ($ponente -> getRedes())["instagram"] ?? ''; ?>"
            >
        </div>
        <div class="form__contenedor-icono">
            <div class="form__icono">
                <i class="fa-brands fa-tiktok"></i>
            </div>
            <input 
                type="text"
                class="form__input--sociales"
                name="redes[tiktok]"
                placeholder="Tiktok"
                value="<?php echo ($ponente -> getRedes())["tiktok"] ?? ''; ?>"
            >
        </div>
        <div class="form__contenedor-icono">
            <div class="form__icono">
                <i class="fa-brands fa-github"></i>
            </div>
            <input 
                type="text"
                class="form__input--sociales"
                name="redes[github]"
                placeholder="GitHub"
                value="<?php echo ($ponente -> getRedes())["github"] ?? ''; ?>"
            >
        </div>
    </div>
</fieldset>
