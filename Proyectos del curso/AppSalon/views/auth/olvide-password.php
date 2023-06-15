<h1 class="nombre-pagina">Reestablecer Contraseña</h1>
<p class="descripcion-pagina">
    Ingresa tu email para para reestablecer tu contraseña
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
<form action="/olvide" class="form" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email"
            id="email"
            placeholder="Tu Email"
            name="email"
            required
        >
    </div>
    <div class="boxButton">
        <input type="submit" class="boton" value="Enviar">
    </div>
</form>

<div class="acciones">
    <div class="accion">
        <a href="/">Iniciar Sesión</a>
    </div>
    <div class="accion">
        <a href="/crear-cuenta">Crear una cuenta</a>
    </div>
</div>