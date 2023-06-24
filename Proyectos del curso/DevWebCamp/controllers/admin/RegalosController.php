<?php 
namespace DevWebCamp\Controllers; 
use DevWebCamp\MVC\Router;

class RegalosController {
    public static function index(Router $router ) {
        $data["titulo"] = "Regalos";
        $router -> render('admin/regalos/index', $data);
    }
}


