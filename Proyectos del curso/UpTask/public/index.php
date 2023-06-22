<?php
require_once '../includes/app.php';

use UpTask\Controllers\DashboardController;
use UpTask\Controllers\LoginController;
use UpTask\Controllers\TaskAPI;
use UpTask\MVC\Router;

$router = new Router;

// Login
$router -> match('/', [LoginController::class, 'login']);
$router -> match('/logout', [LoginController::class, 'logout']);
$router -> match('/create', [LoginController::class, 'create']);
$router -> match('/forgotpassword', [LoginController::class, 'forgotpassword']);
$router -> match('/changepassword', [LoginController::class, 'changepassword']);
$router -> match('/confirma-tu-cuenta', [LoginController::class, 'confirma_tu_cuenta']);
$router -> match('/confirmar-cuenta', [LoginController::class, 'confirmar_cuenta']);
$router -> match('/error-cuenta', [LoginController::class, 'error_cuenta']);

// Proyectos
$router -> match('/dashboard', [DashboardController::class, 'index']);
$router -> match('/dashboard/projects', [DashboardController::class, 'projects']);
$router -> match('/dashboard/create', [DashboardController::class, 'create']);
$router -> match('/dashboard/project', [DashboardController::class, 'project']);
$router -> match('/dashboard/project-not-found', [DashboardController::class, 'project_not_found']);
$router -> match('/dashboard/perfil', [DashboardController::class, 'perfil']);
$router -> match('/dashboard/change_password', [DashboardController::class, 'change_password']);

// TareasAPI
$router -> match('/api/task', [TaskAPI::class, 'index']);
$router -> match('/api/task/create', [TaskAPI::class, 'create']);
$router -> match('/api/task/update', [TaskAPI::class, 'update']);
$router -> match('/api/task/delete', [TaskAPI::class, 'delete']);


$router -> run();
    