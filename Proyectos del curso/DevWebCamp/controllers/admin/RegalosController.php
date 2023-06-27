<?php 
namespace DevWebCamp\Controllers; 
use DevWebCamp\MVC\Router;

class RegalosController {
    public static function index(Router $router ) {
        isAdmin();
        $data["titulo"] = "Regalos";
        $router -> render('admin/regalos/index', $data);
    }
}


