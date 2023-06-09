<?php
    namespace Controllers;
    use Models\Propiedad;
    use Models\Vendedor;
    use MVC\Router;

use function PHPSTORM_META\map;

    class AdminController {
        public static function index(Router $router) {
            // SESSION
            // Validamos que haya una sesión iniciada
            session_start();
            $auth = $_SESSION["login"] ?? null;
            if( !$auth ) {
                $_SESSION = [];
                // header("Location: /");
            } 
            
            // GET -> en caso de borrar propiedad
            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $id = $_POST["id"] ?? null;
                $object = $_POST["object"] ?? null;
                $id = filter_var($id, FILTER_VALIDATE_INT);
                if(!$id && !$object) {
                    header('Location:/admin?panel=propiedades');
                }
                if($object === "propiedad") {
                    $metadata = Propiedad::getById($id);
                    if($metadata) {
                        $propiedad = new Propiedad($metadata);
                        $propiedad -> delete();
                    }
                }
                else if($object === "vendedor") {
                    $metadata = Vendedor::getById($id);
                    if($metadata) {
                        $vendedor = new Vendedor($metadata);
                        // si tenemos in vendedor asociado a las propiedades,
                        // hay que obligar a que este vendedor no se pueda borrar
                        // hasta que las propiedades asociadas a él se borren
                        // Esto es debido a cómo se construyó la base de datos
                        if($vendedor -> isRestricted()) {
                            $data["error"] = "El Vendedor tiene propiedades asociadas. Por favor elimina las propiedades asociadas antes de eliminar a este vendedor";
                        } else {
                            $vendedor -> delete();
                        }
                        
                    }
                }
                
            }

            // GET al cargar la página
            $data["panel"] = $_GET["panel"] ?? "propiedades";
            if($data["panel"] !== "propiedades" && $data["panel"] !== "vendedores") {
                $data["panel"] = "propiedades";
            }
            if($data["panel"] === "propiedades") {
                $propiedades = array_map(function ($data) {
                    return new Propiedad($data);
                }, Propiedad::getAll());
                $data["propiedades"] = $propiedades;
            }
            else if($data["panel"] === "vendedores") {
                $vendedores = array_map(function ($data) {
                    return new Vendedor($data);
                }, Vendedor::getAll());
                $data["vendedores"] = $vendedores;
            }       
            $router -> render('admin/layout', $data);
        }
    }