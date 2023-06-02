<?php
    require './includes/funciones.php';
    require './includes/manageDB/usuario.php';
    // Autenticar usuario
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $campos["email"] = $_POST["email"];
        $campos["password"] = $_POST["password"];
        // Validamos los campos
        $errores = validarDatos($campos);
        if(empty($errores)) {
            // Validar si el usuario existe y si su contraseña es correcta
            $auth = signUp($campos["email"], $campos["password"]);
            if($auth["validated"]) {
                session_start();
                $_SESSION["user"] = $campos["email"];
                $_SESSION["login"] = true;
                header('Location: ./admin');
            } else {
                foreach ($auth["errores"] as $err) {
                    $errores[] = $err;
                }
            }
        }
    }
    setTemplate('header');
?>
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
                    // if($respuesta != "") {
                    //     echo "<div class='enviado'>" . $respuesta . "</div>";
                    // }
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
                            <input name="email" type="email" placeholder="Ingresa Email" value="<?php echo $campos["email"]; ?>" require>
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


<?php 
    setTemplate('footer');
?>