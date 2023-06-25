<?php 
namespace DevWebCamp\Controllers;

use DevWebCamp\Models\EventoHorario;
use DevWebCamp\MVC\Router;

class ApiEventosHorariosController {
    public static function index(Router $router ) {
        $id_dia = $_GET["id_dia"] ?? "";
        $id_dia = filter_var($id_dia, FILTER_VALIDATE_INT);
        $id_categoria = $_GET["id_categoria"] ?? "";
        $id_categoria = filter_var($id_categoria, FILTER_VALIDATE_INT);

        if(!$id_dia || !$id_categoria) {
            echo json_encode([]);
        } else {
            // Consultar base de datos
            $eventoshorarios = EventoHorario::whereArray([
                "id_dia" => $id_dia,
                "id_categoria" => $id_categoria,
            ]);
            echo json_encode($eventoshorarios);
        }



    }
}


