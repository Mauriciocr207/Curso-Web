<?php
    require '../includes/app.php';

    use Controllers\AdminController;
    use Controllers\PropiedadController;
    use Controllers\VendedorController;
    use Controllers\HomeController;
    use MVC\Router;
    $router = new Router();
    //== ADMIN ==//
    $router -> match("/admin", [AdminController::class, 'index']);
    // Para admin/propiedades
    $router -> match("/admin/propiedades/create", [PropiedadController::class, 'create']);
    $router -> match("/admin/propiedades/update", [PropiedadController::class, 'update']);
    // Para admin/vendedores
    $router -> match("/admin/vendedores/create", [VendedorController::class, 'create']);
    $router -> match("/admin/vendedores/update", [VendedorController::class, 'update']);
    //== HOME ==//
    // página principal
    $router -> match('/', [HomeController::class, 'index']);
    $router -> match('/nosotros', [HomeController::class, 'nosotros']);
    $router -> match('/anuncios', [HomeController::class, 'anuncios']);
    $router -> match('/anuncio', [HomeController::class, 'propiedad']);
    $router -> match('/blog', [HomeController::class, 'blog']);
    $router -> match('/entrada', [HomeController::class, 'entrada']);
    $router -> match('/contacto', [HomeController::class, 'contacto']);
    $router -> match('/login', [HomeController::class, 'login']);
    $router -> run();

    $home = new HomeController();
?>