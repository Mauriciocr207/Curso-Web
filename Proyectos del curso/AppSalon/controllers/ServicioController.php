<?php
    namespace Controllers;

use Models\Servicio;
use MVC\Router;

    class ServicioController {
        public static function index(Router $router) {
            session_start();
            isAdmin();
            $servicios = array_map(function($data) {
                return new Servicio($data);
            }, Servicio::getAll());
            $router -> render('/servicios/index', [
                "nombre" => $_SESSION["nombre"],
                "servicios" => $servicios,
            ]);
        }
        public static function crear(Router $router) {
            session_start();
            isAdmin();
            $servicio = new Servicio();
            $errores = [];
            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $servicio -> setServicio($_POST);
                $errores = $servicio -> validate();
                if(empty($errores)) {
                    $response = $servicio -> save();
                    if($response["res"]) {
                        $data["res"] = "Se Creo correctamente el servicio";
                    } else {
                        $errores = ["No se pudo crear el servicio"];
                    }
                }
            }

            $data["nombre"] = $_SESSION["nombre"];
            $data["servicio"] = $servicio;
            $data["errores"] = $errores;
            $router -> render('/servicios/crear', $data);
        }
        public static function actualizar(Router $router) {
            session_start();
            isAdmin();
            $id = $_GET["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if(!$id) {
                header('Location:/servicios');
            }
            $servicio = new Servicio(
                Servicio::getById($id)
            );
            $errores = [];
            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $servicio -> setServicio($_POST);
                $errores = $servicio -> validate();
                if(empty($errores)) {
                    $response = $servicio -> update();
                    if($response["res"]) {
                        $data["res"] = "Se actualizó correctamente el servicio";
                    } else {
                        $errores = ["Edita los campos para poder actualizar el servicio"];
                    }
                }
            }

            $data["nombre"] = $_SESSION["nombre"];
            $data["servicio"] = $servicio;
            $data["errores"] = $errores;
            $router -> render('/servicios/actualizar', $data);
        }
        public static function eliminar() {
            session_start();
            $isAdmin = isAdmin();
            $id = $_GET["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if(!$id) {
                header('Location:/servicios');
            }
            $servicio = new Servicio(["id" => $id]);
            // Verificamos que el usuario registrado sea un admin
            // Esto lo hacemos dado que no hicimos el delete con un method "POST"
            // sino con un "GET", lo cual nos genera ciertas brechas de seguridad
            // pues con únicamente poner la ruta podríamos borrar servicios de la DB, 
            // con lo siguiente, evitamos eso
            if($isAdmin) {
                $servicio -> delete();
            }
            header('Location: /servicios');
        }
    }