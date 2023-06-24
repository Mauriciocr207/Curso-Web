<?php 
namespace DevWebCamp\Controllers;

use DevWebCamp\Models\Ponente;
use DevWebCamp\MVC\Router;

class PonentesController {
    public static function index(Router $router ) {
        $data["titulo"] = "Ponentes / Conferencistas";
        $router -> render('admin/ponentes/index', $data);
    }
    public static function crear(Router $router ) {
        $ponente = new Ponente();
        $errores = [];
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            // Leemos los valores del formulario y la imagen
            $ponente -> setAll($_POST);
            $ponente -> setAll(["imagen" => $_FILES["imagen"]["tmp_name"]]);

            $errores = $ponente -> validate();
            if(empty($errores)) {
                $ponente -> createUniqueNameImg();
            }
        }
        $data["ponente"] = $ponente;
        $data["errores"] = $errores;
        $data["titulo"] = "Registrar Ponente";
        $router -> render('admin/ponentes/crear', $data);
    }
}


