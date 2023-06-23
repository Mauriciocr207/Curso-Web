<main class="auth">
    <h2 class="auth__heading">
        <?php echo $titulo ?>
    </h2>
    <p class="auth__texto">Regístrate en DevWebCamp</p>
    <?php require_once __DIR__ . '/../templates/alertas.php'; ?>
    <form action="/registro" class="form" method="POST">
        <div class="form__campo">
            <label for="nombre" class="form__label">Nombre</label>
            <input 
                type="nombre"
                class="form__input"
                placeholder="Tu Nombre"
                id="nombre"
                name="nombre"
                value="<?php echo $usuario -> nombre; ?>"
            >
        </div>
        <div class="form__campo">
            <label for="apellido" class="form__label">Apellido</label>
            <input 
                type="apellido"
                class="form__input"
                placeholder="Tu Apellido"
                id="apellido"
                name="apellido"
                value="<?php echo $usuario -> apellido; ?>"
            >
        </div>
        <div class="form__campo">
            <label for="email" class="form__label">Email</label>
            <input 
                type="email"
                class="form__input"
                placeholder="Tu Email"
                id="email"
                name="email"
                value="<?php echo $usuario -> email; ?>"
            >
        </div>
        <div class="form__campo">
            <label for="password" class="form__label">Password</label>
            <input 
                type="password"
                class="form__input"
                placeholder="Tu Password"
                id="password"
                name="password"
            >
        </div>
        <div class="form__campo">
            <label for="password2" class="form__label">Password</label>
            <input 
                type="password"
                class="form__input"
                placeholder="Repetir Password"
                id="password2"
                name="password2"
            >
        </div>
        <input type="submit" class="form__submit" value="Crear Cuenta">
        <div class="acciones">
            <a href="/login" class="acciones__enalce">¿Ya tienes una cuenta? Iniciar Sesión</a>
            <a href="/olvide" class="acciones__enalce">¿Olvidaste tu apellido?</a>
        </div>
    </form>
</main>