<?php 
    include_once __DIR__ . '/templates/header.php'; 
?>
<div class="main">
    <h2 class="nombre-pagina"><?php echo $titulo ?></h2>
    <?php
        include_once __DIR__ . '/../templates/alerts.php';
    ?>
    <a class="enlace" href="/dashboard/perfil">Regresar a perfil</a>
    <form class="form box-sm" method="POST" action="/dashboard/change_password">
            <div class="campo w-password ">
                <label for="password" class="bg-azul">Contraseña Actual</label>
                <input 
                    type="password"
                    id="password"
                    class="password"
                    placeholder="Tu Contraseña"
                    name="password"
                >
                <div class="icon bg-blanco">
                    <!-- not Show -->
                    <i class="eye fa-regular fa-eye-slash"></i>
                    <!-- Show -->
                    <!-- <i class="fa-regular fa-eye"></i> -->
                </div>
            </div>
            <div class="campo w-password ">
                <label for="password" class="bg-azul">Nueva Contraseña</label>
                <input 
                    type="password"
                    id="password"
                    class="password"
                    placeholder="Tu Contraseña"
                    name="password_new"
                >
                <div class="icon bg-blanco">
                    <!-- not Show -->
                    <i class="eye fa-regular fa-eye-slash"></i>
                    <!-- Show -->
                    <!-- <i class="fa-regular fa-eye"></i> -->
                </div>
            </div>
        <input type="submit" value="Guardar Cambios">
    </form>
</div> 
<?php include_once __DIR__ . '/templates/footer.php'; ?>