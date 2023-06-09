<?php
    namespace Controllers;
    use Models\Propiedad;
    use Models\Vendedor;
    use MVC\Router;

    class AdminController {
        public static function index(Router $router) {
            $data["panel"] = $_GET["panel"] ?? "propiedades";
            if($data["panel"] !== "propiedades" && $data["panel"] !== "vendedores") {
                $data["panel"] = "propiedades";
            }
            if($data["panel"] === "propiedades") {
                $propiedades = Propiedad::getAll();
                $data["propiedades"] = $propiedades;
            }
            else if($data["panel"] === "vendedores") {
                $vendedores = Vendedor::getAll();
                $data["vendedores"] = $vendedores;
            }

            // POST
            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $id = $_POST["id"];
                $metadata = Propiedad::getById($id);
                if($metadata) {
                    $propiedad = new Propiedad($metadata);
                    $propiedad -> delete();
                }
                echo "post";
            }
            $router -> render('admin/layout', $data);
        }
    }