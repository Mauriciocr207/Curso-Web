<main class="box">
    <div class="section login">
        <h1>Iniciar Sesión</h1>
        <!-- ALERTA -->
        <div class="alert">
            <?php  
                foreach($errores as $err) { 
            ?>
                    <div class="err">
                        <?php echo $err; ?>
                    </div>
            <?php         
                }
            ?>
        </div>
        <!-- FORMULARIO -->
        <form method="POST" class="contact__form--form" novalidate>
            <fieldset class="form__section">
                <legend>Email y Password</legend>
                <div class="inputs">
                    <!-- E-MAIL -->
                    <div class="input">
                        <label class="input__label">E-mail</label>
                        <input name="email" type="email" placeholder="Ingresa Email" value="<?php echo $usuario -> getEmail(); ?>" require>
                    </div>
                    <!-- PASSWORD -->
                    <div class="input">
                        <label class="input__label">Contraseña</label>
                        <input name="password" type="text" placeholder="Ingresa tu Contraseña" require>
                    </div>
                </div>
            </fieldset>
            <div class="submit">
                <input type="submit" value="Iniciar Sesión" class="button">
            </div>
        </form>
    </div>
</main>