<?php 
    $sidebar["user"] = "active";
    include_once __DIR__ . '/templates/header.php'; 
?>
<div class="main">
    <h2 class="nombre-pagina"><?php echo $titulo ?></h2>
    <?php
        include_once __DIR__ . '/../templates/alerts.php';
    ?>

    <form class="form box-sm" method="POST" action="/dashboard/perfil">
        <div class="campo bg-azul">
            <label for="nombre">Nombre</label>
            <input 
                type="text"
                value="<?php echo $usuario -> getNombre() ?>"
                name="nombre"
                placeholder="Tu Nombre"
                class="col-span-2"
            >
        </div>
        <div class="campo bg-azul">
            <label for="email">Email</label>
            <input 
                type="text"
                value="<?php echo $usuario -> getEmail() ?>"
                name="email"
                placeholder="Tu Email"
                class="col-span-2"
            >
        </div>
        <input type="submit" value="Guardar Cambios">
    </form>

    <a class="enlace" href="/dashboard/change_password">Cambiar Contraseña</a>
</div>  
<?php include_once __DIR__ . '/templates/footer.php'; ?>