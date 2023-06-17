<?php
    namespace Controllers;

use Models\Cita;
use MVC\Router;

    class AdminController {
        public static function index( Router $router ) {
            session_start();
            isAdmin();

            $fecha = $_GET["fecha"] ?? date('Y-m-d');
            $contieneLetras = preg_match('/[a-zA-Z]/', $fecha) ? true:false;
            if ($contieneLetras) {
                header('Location: /admin');
            } else {
                $arrayFecha = explode('-',$fecha);
                if(count($arrayFecha) !== 3) {
                    header('Location: /admin');
                } else {
                    $fechaInvalida = !checkdate($arrayFecha[1], $arrayFecha[2], $fecha[0]);
                    if($fechaInvalida) {
                        header('Location: /admin');
                    }
                }
            }           

            $data["nombre"] = $_SESSION["nombre"];
            $data["citas"] = Cita::getAllWithServices($fecha);
            $data["fecha"] = $fecha;
            $router -> render('/admin/index', $data);
        }
    }