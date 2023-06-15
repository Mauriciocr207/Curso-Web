<?php 
    namespace Controllers;

use MVC\Router;

    class CitaController {
        public static function index(Router $router) {
            session_start();
            $data = [
                "nombre" => $_SESSION["nombre"]
            ];
            $router -> render('citas/index', $data);
        }
    }