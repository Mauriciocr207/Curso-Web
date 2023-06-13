<?php
    namespace Controllers;
    use Models\Propiedad;
    use MVC\Router;
    use Models\Usuario;

    class HomeController {
        public static function index(Router $router) {
            $limitAnuncios = 3;
            $propiedades = array_map(function($data) {
                return new Propiedad($data);
            }, Propiedad::getAll(limit: $limitAnuncios));
            $data = [
                "propiedades" => $propiedades,
                "inHome" => true
            ];
            $router -> render('/home/home', $data);
        }
        public static function nosotros (Router $router) {
            $data = [];
            $router -> render('/home/nosotros', []);
        }
        public static function anuncios (Router $router) {
            $limitAnuncios = 3;
            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $limitAnuncios = 0;
            }
            $propiedades = array_map(function($data) {
                return new Propiedad($data);
            }, Propiedad::getAll(limit: $limitAnuncios));
            $data = [
                "propiedades" => $propiedades,
            ];
            $router -> render('/home/anuncios', $data);
        }
        public static function propiedad (Router $router) {
            $id = $_GET["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if(!$id) header('Location: /');
            $metadata = Propiedad::getById($id);
            $propiedad = new Propiedad($metadata);
            $data["propiedad"] = $propiedad;
            $router -> render('/home/anuncio', $data);
        }
        public static function blog (Router $router) {
            $data = [];
            $router -> render('/home/blog', []);
        }
        public static function entrada (Router $router) {
            $data = [];
            $router -> render('/home/entrada', []);
        }
        public static function contacto (Router $router) {
            $data = [];
            $router -> render('/home/contacto', []);
        }
        public static function login (Router $router) {
            $errores = [];
            $usuario = new Usuario($_POST);
            // Autenticar usuario
            if($_SERVER["REQUEST_METHOD"] === "POST") {
                // Validamos los campos
                $errores = $usuario -> validate();
                if(empty($errores)) {
                    // Validar si el usuario existe y si su contraseña es correcta
                    $auth = $usuario -> signUp();
                    if($auth["validated"]) {
                        session_start();
                        $_SESSION["user"] = $usuario -> getEmail();
                        $_SESSION["login"] = true;
                        header('Location: /admin');
                    } else {
                        $errores = [$auth["error"]];
                    }
                }
            }
            $data = [
                "errores" => $errores,
                "usuario" => $usuario
            ];
            $router -> render('/home/login', $data);
        }
    }