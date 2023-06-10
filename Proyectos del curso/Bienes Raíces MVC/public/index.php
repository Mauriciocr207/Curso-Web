<?php
    require '../includes/app.php';

    use Controllers\AdminController;        
    use Controllers\PropiedadController;
    use Controllers\VendedorController;
    use MVC\Router;
    $router = new Router();
    // Para admin
    $router -> match("/admin", [AdminController::class, 'index']);
    // Para admin/propiedades
    $router -> match("/admin/propiedades/create", [PropiedadController::class, 'create']);
    $router -> match("/admin/propiedades/update", [PropiedadController::class, 'update']);
    // Para admin/vendedores
    $router -> match("/admin/vendedores/create", [VendedorController::class, 'create']);
    $router -> match("/admin/vendedores/update", [VendedorController::class, 'update']);
    $router -> run();
?>