<?php
namespace DevWebCamp\Controllers;

use DevWebCamp\Models\Ponente;
use DevWebCamp\MVC\Router;
class ApiPonentesController {
    public static function index(Router $router ) {
        $ponentes = Ponente::getAll();
        echo json_encode($ponentes);
    }
}