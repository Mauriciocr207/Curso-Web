<?php 

    require_once '../includes/app.php';

use Controllers\AdminController;
use Controllers\APIController;
    use Controllers\CitaController;
    use Controllers\HomeController;
use Controllers\ServicioController;
use MVC\Router;

    $router = new Router();
    
    // Iniciar Sesión
    $router -> match('/', [HomeController::class, 'login']);
    $router -> match("/logout", [HomeController::class, 'logout']);
    $router -> match('/olvide', [HomeController::class, 'olvide']);
    $router -> match('/cambiar-password', [HomeController::class, 'cambiarPassword']);

    //== USUARIOS ==//
    // Crear Cuenta
    $router -> match('/crear-cuenta', [HomeController::class, 'crear']);
    $router -> match('/confirma-tu-cuenta', [HomeController::class, 'avisoConfirmacion']);
    $router -> match('/confirmar-cuenta', [HomeController::class, 'confirmar']);
    // Generar citas
    $router -> match('/citas', [CitaController::class, 'index']);

    //== ADMINS ==//
    $router -> match('/admin', [AdminController::class, 'index']);
    // CRUD
    $router -> match('/servicios', [ServicioController::class, 'index']);
    $router -> match('/servicios/crear', [ServicioController::class, 'crear']);
    $router -> match('/servicios/actualizar', [ServicioController::class, 'actualizar']);
    $router -> match('/servicios/eliminar', [ServicioController::class, 'eliminar']);
    

    //== APIS ==//
    // API CITAS
    $router -> match('/api/servicios', [APIController::class, 'getServicios']);
    // API SERVICIOS
    $router -> match('/api/citas', [APIController::class, 'guardarCita']);
    // Eliminar
    $router -> match('/api/eliminar', [APIController::class, 'eliminar']);


    // Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
    $router -> run();