<!-- MAIN -->
<main class="box">
    <div class="section contact__form">
        <h1 class="contact__form--title">Contacto</h1>
        <h4>Llena el Formulario</h4>
        <div class="alert">
            <?php    
                if(isset($result)) {     
                    if($result["status"]) {
                        echo "<div class='enviado'>" . $result["message"] . "</div>";
                    } else {
                        echo "<div class='enviado'>" . $result["message"] . "</div>";
                    }
                }
            ?>
        </div>
        <form class="contact__form--form" action="/contacto" method="POST">
            <fieldset class="form__section">
                <legend>Información Personal</legend>
                <div class="inputs">
                    <!-- NOMBRE -->
                    <div class="input">
                        <label class="input__label" >Nombre</label>
                        <input type="text" name="nombre" placeholder="Tu Nombre" required>
                    </div>
                    <!-- E-MAIL -->
                    <div class="input">
                        <label class="input__label">E-mail</label>
                        <input type="email" name="email" placeholder="Tu Email" required>
                    </div>
                    <!-- TELÉFONO -->
                    <div class="input">
                        <label class="input__label">Teléfono</label>
                        <input type="tel" name="telefono" placeholder="Tu Teléfono">
                    </div>
                    <!-- MENSAJE -->
                    <div class="input">
                        <label class="input__label">Mensaje</label>
                        <textarea class="textarea" name="mensaje" placeholder="Mensaje" required ></textarea>
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
                    <select name="operacion" id="" required>
                        <option disabled selected>-- Seleccione --</option>
                        <option value="vende">Vende</option>
                        <option value="compra">Compra</option>
                    </select>
                </div>
                <!-- CANTIDAD -->
                <div class="input">
                    <label class="input__label">
                        Precio
                    </label>
                    <input type="number" class="precio" name="precio" required>
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
                    <input type="radio" name="contacto" value="telefono" required>
                    <label for="" class="input__label">
                        E-mail
                    </label>
                    <input type="radio" name="contacto" value="email" required>
                </div>
                <div id="contacto"></div>
                <!-- FECHA -->
                <p>Si eligió Teléfono, elija la fecha y la hora</p>
                <div class="input">
                    <label class="input__label">
                        Fecha:
                    </label>
                    <input type="date" name="fecha">
                </div>
                <!-- HORA -->
                <div class="input">
                    <label for="" class="input__label">
                        Hora:
                    </label>
                    <input type="time" name="hora">
                </div>
            </fieldset>
            <div class="submit">
                <input type="submit" class="button" value="Enviar">
            </div>
        </form>
    </div>
</main>