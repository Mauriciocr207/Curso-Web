<main class="auth">
    <h2 class="auth__heading">
        <?php echo $titulo ?>
    </h2>
    <p class="auth__texto">Inicia sesión en DevWebCamp</p>
    <?php require_once __DIR__ . '/../templates/alertas.php'; ?>
    <form action="/login" class="form" method="POST">
        <div class="form__campo">
            <label for="email" class="form__label">Email</label>
            <input 
                type="email"
                class="form__input"
                placeholder="Tu Email"
                id="email"
                name="email"
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
        <input type="submit" class="form__submit" value="Iniciar Sesión">
        <div class="acciones">
            <a href="/registro" class="acciones__enalce">¿Aún no tienes cuenta? Obtener una</a>
            <a href="/olvide" class="acciones__enalce">¿Olvidaste tu password?</a>
        </div>
    </form>
</main>