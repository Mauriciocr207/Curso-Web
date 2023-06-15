<h1 class="nombre-pagina">Cambiar Contraseña</h1>
<p class="descripcion-pagina">
    Ingresa una nueva contraseña para iniciar
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
<?php
    if(empty($res)) {
?>
<form action="/cambiar-password?token=<?php echo $token; ?>" class="form" method="POST">
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
        <input type="submit" class="boton" value="Cambiar contraseña">
    </div>
</form>
<?php
    } 
?>

<div class="acciones">
<div class="accion">
        <a href="/">Inicia Sesión</a>
    </div>
    <div class="accion">
        <a href="/crear-cuenta">Crear una cuenta</a>
    </div>
</div>