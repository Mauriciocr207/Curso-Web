<main class="auth">
    <h2 class="auth__heading">
        <?php echo $titulo ?>
    </h2>
    <p class="auth__texto">Recupera tu acceso a DevWebCamp</p>

    <form action="/forgotpassword" class="form">
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
        <input type="submit" class="form__submit" value="Enviar Instrucciones">
        <div class="acciones">
            <a href="/login" class="acciones__enalce">¿Ya tienes cuenta? Iniciar Sesión</a>
            <a href="/create" class="acciones__enalce">¿Aún no tienes cuenta? Obtener una</a>
        </div>
    </form>
</main>