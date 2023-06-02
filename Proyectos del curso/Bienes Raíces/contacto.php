<?php
    require './includes/funciones.php';
    setTemplate('header');
?>
    <!-- MAIN -->
    <main class="box">
        <div class="section contact__form">
            <h1 class="contact__form--title">Contacto</h1>
            <h4>Llena el Formulario</h4>
            <form class="contact__form--form">
                <fieldset class="form__section">
                    <legend>Información Personal</legend>
                    <div class="inputs">
                        <!-- NOMBRE -->
                        <div class="input">
                            <label class="input__label">Nombre</label>
                            <input type="text" placeholder="Tu Nombre">
                        </div>
                        <!-- E-MAIL -->
                        <div class="input">
                            <label class="input__label">E-mail</label>
                            <input type="email" placeholder="Tu Email">
                        </div>
                        <!-- TELÉFONO -->
                        <div class="input">
                            <label class="input__label">Teléfono</label>
                            <input type="tel" placeholder="Tu Teléfono">
                        </div>
                        <!-- MENSAJE -->
                        <div class="input">
                            <label class="input__label">Mensaje</label>
                            <textarea class="textarea" placeholder="Mensaje"></textarea>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="form__section">
                    <legend>Información sobre Propiedad</legend>
                    <!-- PROPIEDAD -->
                    <div class="input">
                        <label class="input__label">
                            Vende o Compra
                        </label>
                        <select name="" id="">
                            <option value="" disabled selected>-- Seleccione --</option>
                            <option value="">Vende</option>
                            <option value="">Compra</option>
                        </select>
                    </div>
                    <!-- CANTIDAD -->
                    <div class="input">
                        <label class="input__label">
                            Cantidad
                        </label>
                        <input type="number">
                    </div>
                </fieldset>
                <fieldset class="form__section">
                    <legend>Contacto</legend>
                    <!-- TIPO DE CONTRATO -->
                    <p>Como desea ser Contactado:</p>
                    <div class="input checkbox">
                        <label for="" class="input__label ">
                            Teléfono
                        </label>
                        <input type="checkbox">
                        <label for="" class="input__label">
                            E-mail
                        </label>
                        <input type="checkbox">
                    </div>
                    <!-- FECHA -->
                    <p>Si eligió Teléfono, elija la fecha y la hora</p>
                    <div class="input">
                        <label class="input__label">
                            Fecha:
                        </label>
                        <input type="date">
                    </div>
                    <!-- HORA -->
                    <div class="input">
                        <label for="" class="input__label">
                            Hora:
                        </label>
                        <input type="time">
                    </div>
                </fieldset>
                <div class="submit">
                    <a href="#" class="button">Enviar</a>
                </div>
            </form>
        </div>
    </main>
<?php
    setTemplate('footer');
?>