<aside class="sidebar colapsed">
    <div class="sidebar-button">
        <i class="fa-solid fa-chevron-up"></i>
        <input class="hidden" type="checkBox">
    </div>
    <nav class="sidebar-nav">
        <div class="content">
            <a class="option <?php echo $sidebar["home"] ?? "" ?>" href="/dashboard">
                <div class="icon">
                    <i class="fa-solid fa-house"></i>
                </div>
                <p class="option-text">Inicio</p>
            </a>
            <a class="option <?php echo $sidebar["projects"] ?? "" ?>" href="/dashboard/projects">
                <div class="icon">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <p class="option-text">Proyectos</p>
            </a>
            <a class="option <?php echo $sidebar["newProject"] ?? "" ?>" href="/dashboard/create">
                <div class="icon">
                    <i class="fa-solid fa-folder-plus"></i>
                </div>
                <p class="option-text">Crear Proyecto</p>
            </a>
            <a class="option <?php echo $sidebar["user"] ?? "" ?>" href="/dashboard/perfil">
                <div class="icon">
                    <i class="fa-solid fa-circle-user"></i>
                </div>
                <p class="option-text">Perfil</p>
            </a>
        </div>
        <a class="option theme" id="themeBtn">
            <div class="icon">
                <i class="fa-regular fa-sun"></i>
            </div>
            <p class="option-text">Light</p>
        </a>
    </nav>
</aside>