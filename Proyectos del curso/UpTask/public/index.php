<?php
require_once '../includes/app.php';
use UpTask\Controllers\LoginController;
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




$router -> run();
    