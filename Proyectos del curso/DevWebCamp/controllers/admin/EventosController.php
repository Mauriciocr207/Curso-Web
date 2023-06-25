<?php 
namespace DevWebCamp\Controllers;

use DevWebCamp\Models\Categoria;
use DevWebCamp\Models\Dia;
use DevWebCamp\Models\Evento;
use DevWebCamp\Models\Hora;
use DevWebCamp\MVC\Router;

class EventosController {
    public static function index(Router $router ) {
        isAdmin();
        $data["titulo"] = "Conferencias / Workshops";
        $router -> render('admin/eventos/index', $data);
    }
    public static function crear(Router $router ) {
        isAdmin();
        $errores = [];
        $categorias = Categoria::getAll();
        $dias = Dia::getAll();
        $horas = Hora::getAll();
        $evento = new Evento();

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $evento -> setAll($_POST);
            $errores = $evento -> validate();
            if(empty($errores)) {
                $response = $evento -> save();
                if($response["res"]) {
                    header('Location: /admin/eventos');
                }
            }
        }



        $data["titulo"] = "Registrar Evento";
        $data["errores"] = $errores;
        $data["categorias"] = $categorias;
        $data["dias"] = $dias;
        $data["horas"] = $horas;
        $data["evento"] = $evento;
        $router -> render('admin/eventos/crear', $data);
    }
    public static function editar(Router $router ) {
        isAdmin();
        $data["titulo"] = "Conferencias / Workshops";
        $router -> render('admin/eventos/editar', $data);
    }
    public static function eliminar(Router $router ) {
        isAdmin();
        $data["titulo"] = "Conferencias / Workshops";
        $router -> render('admin/eventos/eliminar', $data);
    }
}


