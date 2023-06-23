<main class="auth">
    <h2 class="auth__heading">
        <?php echo $titulo ?>
    </h2>
    <p class="auth__texto">Regístrate en DevWebCamp</p>
    <?php require_once __DIR__ . '/../templates/alertas.php'; ?>
    <form action="/changepassword?token=<?php echo $token; ?>" class="form" method="POST">
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
        <input type="submit" class="form__submit" value="Crear Cuenta">
        <div class="acciones">
            <a href="/login" class="acciones__enalce">Iniciar Sesión</a>
            <a href="/forgotpassword" class="acciones__enalce">¿Olvidaste tu contraseña?</a>
        </div>
    </form>
</main>