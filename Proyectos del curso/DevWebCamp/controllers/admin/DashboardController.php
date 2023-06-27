<?php 
namespace DevWebCamp\Controllers; 
use DevWebCamp\MVC\Router;

class DashboardController {
    public static function index(Router $router ) {
        isAdmin();
        $data["titulo"] = "Panel de Administración";
        $router -> render('admin/dashboard/index', $data);
    }
}


