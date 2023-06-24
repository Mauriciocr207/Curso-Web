<?php 

require_once __DIR__ . '/../includes/app.php';

use DevWebCamp\Controllers\DashboardController;
use DevWebCamp\Controllers\EventosController;
use DevWebCamp\MVC\Router;
use DevWebCamp\Controllers\LoginController;
use DevWebCamp\Controllers\PonentesController;
use DevWebCamp\Controllers\RegalosController;
use DevWebCamp\Controllers\RegistrosController;

$router = new Router();

//== AUTENTICACIÓN ==//
// Login
$router->get('/', [LoginController::class, 'login']);
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->post('/logout', [LoginController::class, 'logout']);

// Crear Cuenta
$router->get('/create', [LoginController::class, 'create']);
$router->post('/create', [LoginController::class, 'create']);

// Formulario de olvide mi password
$router->get('/forgotpassword', [LoginController::class, 'forgotpassword']);
$router->post('/forgotpassword', [LoginController::class, 'forgotpassword']);

// Colocar el nuevo password
$router->get('/changepassword', [LoginController::class, 'changepassword']);
$router->post('/changepassword', [LoginController::class, 'changepassword']);

// Confirmación de Cuenta
$router->get('/confirma-tu-cuenta', [LoginController::class, 'confirma_tu_cuenta']);
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar_cuenta']);

// Error al confirmar
$router->get('/error-cuenta', [LoginController::class, 'error_cuenta']);


//== ADMINISTRACIÓN ==//    
// Dashboard
$router->get('/admin/dashboard', [DashboardController::class, 'index']);
// Ponentes
$router->get('/admin/ponentes', [PonentesController::class, 'index']);
$router->get('/admin/ponentes/crear', [PonentesController::class, 'crear']);
$router->post('/admin/ponentes/crear', [PonentesController::class, 'crear']);
// Eventos
$router->get('/admin/eventos', [EventosController::class, 'index']);
// Registrados
$router->get('/admin/registrados', [RegistrosController::class, 'index']);
// Regalos
$router->get('/admin/regalos', [RegalosController::class, 'index']);



$router->comprobarRutas();