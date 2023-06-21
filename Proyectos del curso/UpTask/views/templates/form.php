<form action="/" class="form" method="POST">
    <div class="campo">
        <label for="email" class="<?php echo $bg ?>">Email</label>
        <input 
            type="email"
            id="email"
            placeholder="Tu Email"
            name="email"
        >
    </div>
    <div class="campo">
        <label for="password" class="<?php echo $bg ?>">Contraseña</label>
        <input 
            type="password"
            id="password"
            placeholder="Tu Contraseña"
            name="password"
        >
    </div>
    <input type="submit" class="boton <?php echo $bg ?>" value="Iniciar Sesión">
</form>