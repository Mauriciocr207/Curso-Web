<?php 

require_once __DIR__ . '/../includes/app.php';

use DevWebCamp\Controllers\ApiEventosHorariosController;
use DevWebCamp\Controllers\ApiPonentesController;
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
$router->get('/admin/ponentes/editar', [PonentesController::class, 'editar']);
$router->post('/admin/ponentes/editar', [PonentesController::class, 'editar']);
$router->post('/admin/ponentes/eliminar', [PonentesController::class, 'eliminar']);
// Eventos
$router->get('/admin/eventos', [EventosController::class, 'index']);
$router->get('/admin/eventos/crear', [EventosController::class, 'crear']);
$router->post('/admin/eventos/crear', [EventosController::class, 'crear']);
$router->get('/admin/eventos/editar', [EventosController::class, 'editar']);
$router->post('/admin/eventos/editar', [EventosController::class, 'editar']);
$router->post('/admin/eventos/eliminar', [EventosController::class, 'eliminar']);
// Registrados
$router->get('/admin/registrados', [RegistrosController::class, 'index']);
// Regalos
$router->get('/admin/regalos', [RegalosController::class, 'index']);

//== API ==//
// Eventos-Horario
$router->get('/api/eventos-horarios', [ApiEventosHorariosController::class, 'index']);
$router->get('/api/ponentes', [ApiPonentesController::class, 'index']);



$router->comprobarRutas();