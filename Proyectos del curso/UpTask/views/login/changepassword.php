<div class="box login ">
    <h1 class="uptask azul">UpTask</h1>
    <p class="tagline">Crea y Administra tus proyectos</p>

    <div class="box-sm">
        <p class="descripcion-pagina">Crear Cuenta</p>
        <?php
            include_once __DIR__ . '/../templates/alerts.php';
        ?>
        <form action="/changepassword?token=<?php echo $token ?>" class="form" method="POST">
            <div class="campo w-password">
                <label for="password" class="bg-azul">Contraseña</label>
                <input 
                    type="password"
                    id="password"
                    class="password"
                    placeholder="Tu Contraseña"
                    name="password"
                    value="<?php echo $usuario -> getPassword(); ?>"
                >
                <div class="icon">
                    <!-- not Show -->
                    <i class="eye fa-regular fa-eye-slash"></i>
                    <!-- Show -->
                    <!-- <i class="fa-regular fa-eye"></i> -->
                </div>
            </div>
            <div class="campo w-password">
                <label for="password2" class="bg-azul">Contraseña</label>
                <input 
                    type="password"
                    id="password2"
                    class="password"
                    placeholder="Repite tu contraseña"
                    name="password2"
                >
                <div class="icon">
                    <!-- not Show -->
                    <i class="eye fa-regular fa-eye-slash"></i>
                    <!-- Show -->
                    <!-- <i class="fa-regular fa-eye"></i> -->
                </div>
            </div>
            <input type="submit" class="boton bg-azul" value="Cambiar Contraseña">
        </form>
        <div class="acciones">
            <a class="azul" href="/">Inicia Sesión</a>
            <a class="azul" href="/forgotpassword">Olvidé mi contraseña</a>
        </div>
    </div>
</div>
<?php
    $script = "<script src='/build/js/showPassword.js'></script>"
?>