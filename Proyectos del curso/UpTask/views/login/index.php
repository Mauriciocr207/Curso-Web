<div class="box login">
    <h1 class="uptask cyan">UpTask</h1>
    <p class="tagline">Crea y Administra tus proyectos</p>

    <div class="box-sm">
        <p class="descripcion-pagina">Iniciar Sesión</p>
        <form action="/" class="form" method="POST">
            <div class="campo">
                <label for="email" class="bg-cyan">Email</label>
                <input 
                    type="email"
                    id="email"
                    placeholder="Tu Email"
                    name="email"
                    class="col-span-2"
                >
            </div>
            <div class="campo">
                <label for="password" class="bg-cyan">Contraseña</label>
                <input 
                    type="password"
                    id="password"
                    placeholder="Tu Contraseña"
                    name="password"
                    class="col-span-2"
                >
            </div>
            <input type="submit" class="boton bg-cyan" value="Iniciar Sesión">
        </form>
        <div class="acciones">
            <a class="cyan" href="/create">Crear una cuenta</a>
            <a class="cyan" href="/forgotpassword">Olvidé mi contraseña</a>
        </div>
    </div>
</div>