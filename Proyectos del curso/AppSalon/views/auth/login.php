<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">
    Inicia sesión con tus datos
</p>
<div class="alert">
    <?php  
        foreach($errores as $err) { ?>
            <div class="err">
                <?php echo $err; ?>
            </div>
    <?php         
        }
    ?>
</div>
<form action="/" class="form" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email"
            id="email"
            placeholder="Tu Email"
            name="email"
            required
            value="<?php echo $usuario -> getEmail(); ?>"
        >
    </div>
    <div class="campo">
        <label for="password">Contraseña</label>
        <input 
            type="password"
            id="password"
            placeholder="Tu Contraseña"
            name="password"
            required
            value="<?php echo $usuario -> getPassword(); ?>"
        >
        <div class="icon">
            <!-- not Show -->
            <i class="eye fa-regular fa-eye-slash"></i>
            <!-- Show -->
            <!-- <i class="fa-regular fa-eye"></i> -->
        </div>
    </div>
    <div class="boxButton">
        <input type="submit" class="boton" value="Iniciar Sesión">
    </div>
</form>

<div class="acciones">
    <div class="accion">
        <a href="/crear-cuenta">Crear una cuenta</a>
    </div>
    <div class="accion">
        <a href="/olvide">Olvidé mi contraseña</a>
    </div>
</div>