<?php 
namespace DevWebCamp\Controllers; 
use DevWebCamp\MVC\Router;

class RegistrosController {
    public static function index(Router $router ) {
        if(!isAdmin()) header('Location: /');
        $data["titulo"] = "Registros";
        $router -> render('admin/registros/index', $data);
    }
}


