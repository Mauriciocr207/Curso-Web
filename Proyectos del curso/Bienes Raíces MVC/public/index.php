<?php
    require '../includes/app.php';

    use Controllers\AdminController;        
    use MVC\Router;
    use Controllers\PropiedadController;
    $router = new Router();
    // Para admin
    $router -> match("/admin", [AdminController::class, 'index']);
    $router -> match("/admin/propiedades/create", [PropiedadController::class, 'create']);
    $router -> match("/admin/propiedades/update", [PropiedadController::class, 'update']);
    $router -> run();
?>