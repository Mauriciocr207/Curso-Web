<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">
    Llena el siguiente fomrularo para crear una cuenta
</p>
<div class="alert">
    <?php  
        foreach($errores as $err) { ?>
            <div class="err">
                <?php echo $err; ?>
            </div>
    <?php         
        }
        if(!empty($res)) {
            echo "<div class='enviado'>" . $res . "</div>";
        }
    ?>
</div>
<form action="/crear-cuenta" class="form" method="POST">
    <div class="campo">
        <label for="nombre">Nombres</label>
        <input 
            type="text"
            id="nombre"
            placeholder="Tu Nombre"
            name="nombre"
            required
            value=<?php echo $usuario -> getNombre(); ?>
        >
    </div>
    <div class="campo">
        <label for="apellido">Apellido</label>
        <input 
            type="text"
            id="apellido"
            placeholder="Tu Apellido"
            name="apellido"
            required
            value=<?php echo $usuario -> getApellido(); ?>
        >
    </div>
    <div class="campo">
        <label for="telefono">Tel (sin LADA)</label>
        <input 
            type="text"
            id="telefono"
            placeholder="Tu Teléfono"
            name="telefono"
            
            value=<?php echo $usuario -> gettelefono(); ?>
        >
    </div>
    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email"
            id="email"
            placeholder="Tu Email"
            name="email"
            
            value=<?php echo $usuario -> getEmail(); ?>
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
            value=<?php echo $usuario -> getPassword(); ?>
        >
        <div class="icon">
            <!-- not Show -->
            <i class="eye fa-regular fa-eye-slash"></i>
            <!-- Show -->
            <!-- <i class="fa-regular fa-eye"></i> -->
        </div>
    </div>
    <div class="boxButton">
        <input type="submit" class="boton" value="Crear Cuenta">
    </div>
</form>

<div class="acciones">
    <div class="accion">
        <a href="/">Iniciar Sesión</a>
    </div>
    <div class="accion">
        <a href="/olvide">Olvidé mi contraseña</a>
    </div>
</div>