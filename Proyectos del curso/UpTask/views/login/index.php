<div class="box login">
    <h1 class="uptask cyan">UpTask</h1>
    <p class="tagline">Crea y Administra tus proyectos</p>

    <div class="box-sm">
        <p class="descripcion-pagina">Iniciar Sesión</p>
        <?php
            require_once __DIR__ . '/../templates/alerts.php';
        ?>
        <form action="/" class="form" method="POST">
            <div class="campo">
                <label for="email" class="bg-cyan">Email</label>
                <input 
                    type="email"
                    id="email"
                    placeholder="Tu Email"
                    name="email"
                    class="col-span-2"
                    value="<?php echo $usuario -> getEmail(); ?>"
                >
            </div>
            <div class="campo w-password">
                <label for="password" class="bg-cyan">Contraseña</label>
                <input 
                    type="password"
                    id="password"
                    placeholder="Tu Contraseña"
                    name="password"
                    class="password"
                >
                <div class="icon">
                    <!-- not Show -->
                    <i class="eye fa-regular fa-eye-slash"></i>
                    <!-- Show -->
                    <!-- <i class="fa-regular fa-eye"></i> -->
                </div>
            </div>
            <input type="submit" class="boton bg-cyan" value="Iniciar Sesión">
        </form>
        <div class="acciones">
            <a class="cyan" href="/create">Crear una cuenta</a>
            <a class="cyan" href="/forgotpassword">Olvidé mi contraseña</a>
        </div>
    </div>
</div>
<?php
    $script = "<script src='/build/js/showPassword.js'></script>"
?>