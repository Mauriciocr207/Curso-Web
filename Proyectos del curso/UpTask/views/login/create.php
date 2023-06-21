<div class="box login ">
    <h1 class="uptask morado">UpTask</h1>
    <p class="tagline">Crea y Administra tus proyectos</p>
    <?php
        require_once __DIR__ . '/../templates/alerts.php';
    ?>
    <div class="box-sm">
        <p class="descripcion-pagina">Crear Cuenta</p>
        <form action="/create" class="form" method="POST">
            <div class="campo">
                <label for="nombre" class="bg-morado">Nombre</label>
                <input 
                    class="col-span-2"
                    type="text"
                    id="nombre"
                    placeholder="Tu Nombre"
                    name="nombre"
                    value="<?php echo $usuario -> getNombre(); ?>"
                >
            </div>
            <div class="campo">
                <label for="email" class="bg-morado">Email</label>
                <input 
                    class="col-span-2"
                    type="email"
                    id="email"
                    placeholder="Tu Email"
                    name="email"
                    value="<?php echo $usuario -> getEmail(); ?>"
                >
            </div>
            <div class="campo w-password">
                <label for="password" class="bg-morado">Contraseña</label>
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
                <label for="password2" class="bg-morado">Contraseña</label>
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
            <input type="submit" class="boton bg-morado" value="Crear Cuenta">
        </form>
        <div class="acciones">
            <a class="morado" href="/">Inicia Sesión</a>
            <a class="morado" href="/forgotpassword">Olvidé mi contraseña</a>
        </div>
    </div>
</div>
<?php
    $script = "<script src='/build/js/showPassword.js'></script>"
?>