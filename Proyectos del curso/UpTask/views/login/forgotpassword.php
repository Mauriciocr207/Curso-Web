<div class="box login ">
    <h1 class="uptask rosa">UpTask</h1>
    <p class="tagline">Crea y Administra tus proyectos</p>
    <div class="box-sm">
        <p class="descripcion-pagina">Recupera tu Acceso Uptask</p>
        <?php
            include_once __DIR__ . '/../templates/alerts.php';
        ?>
        <form action="/forgotpassword" class="form" method="POST">
            <div class="campo">
                <label for="email" class="bg-rosa">Email</label>
                <input 
                    type="email"
                    id="email"
                    placeholder="Tu Email"
                    name="email"
                    class="col-span-2"
                >
            </div>
            <input type="submit" class="boton bg-rosa" value="Enviar">
        </form>
        <div class="acciones">
            <a class="rosa" href="/">Inicia Sesión</a>
            <a class="rosa" href="/create">Crear Cuenta</a>
        </div>
    </div>
</div>