<?php 
namespace DevWebCamp\Controllers; 
use DevWebCamp\MVC\Router;

class EventosController {
    public static function index(Router $router ) {
        $data["titulo"] = "Conferencias / Workshops";
        $router -> render('admin/eventos/index', $data);
    }
}


