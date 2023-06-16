<?php 

    require_once '../includes/app.php';

    use Controllers\APIController;
    use Controllers\CitaController;
    use Controllers\HomeController;
    use MVC\Router;

    $router = new Router();
    
    // Iniciar Sesión
    $router -> match('/', [HomeController::class, 'login']);
    $router -> match("/logout", [HomeController::class, 'logout']);
    $router -> match('/olvide', [HomeController::class, 'olvide']);
    $router -> match('/cambiar-password', [HomeController::class, 'cambiarPassword']);

    // Crear Cuenta
    $router -> match('/crear-cuenta', [HomeController::class, 'crear']);
    $router -> match('/confirma-tu-cuenta', [HomeController::class, 'avisoConfirmacion']);
    $router -> match('/confirmar-cuenta', [HomeController::class, 'confirmar']);

    // Admin
    $router -> match('/citas', [CitaController::class, 'index']);

    // API CITAS
    $router -> match('/api/servicios', [APIController::class, 'getServicios']);
    $router -> match('/api/citas', [APIController::class, 'guardarCita']);

    // Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
    $router -> run();