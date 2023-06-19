<?php 
    namespace Controllers;

use MVC\Router;

    class CitaController {
        public static function index(Router $router) {
            session_start();
            isAuth();
            $data = [
                "nombre" => $_SESSION["nombre"],
                "id" => $_SESSION["id"]
            ];
            $router -> render('citas/index', $data);
        }
    }