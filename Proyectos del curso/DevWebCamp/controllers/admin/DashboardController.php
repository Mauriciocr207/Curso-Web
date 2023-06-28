<?php 
namespace DevWebCamp\Controllers;

use DevWebCamp\Models\Evento;
use DevWebCamp\Models\Registro;
use DevWebCamp\MVC\Router;
use DevWebCamp\Models\Paquete;
use DevWebCamp\Models\Usuario;
use DevWebCamp\Models\Regalo;

class DashboardController {
    public static function index(Router $router ) {
        if(!isAdmin()) header('Location: /');

        // Calcular total
        $ingresosGenerados = 0;

        // Obtener los últimos registros
        $registros = array_map(function($dataPonente) {
            return new Registro($dataPonente);
        }, Registro::ordenar("id", "DESC", 5));
        foreach($registros  as $registro) {
            if($registro -> getIdPaquete() === 1) $ingresosGenerados += 189.54;
            if($registro -> getIdPaquete() === 2) $ingresosGenerados += 46.41;
            $registro -> setAll([
                "id_paquete" => Paquete::getById($registro -> getIdPaquete()),
                "id_usuario" => Usuario::getById($registro -> getIdUsuario()),
            ]);
            if($registro -> getIdRegalo() !== null) {
                $registro -> setAll([
                    "id_regalo" => Regalo::getById($registro -> getIdRegalo()),
                ]);
            }
        }

        // Ordenar y obtener eventos
        $menos_disponibles = Evento::ordenar("disponibles", "ASC", 5);
        $mas_disponibles = Evento::ordenar("disponibles", "DESC", 5);
        

        
        
        $data["registros"] = $registros;
        $data["ingresos"] = $ingresosGenerados;
        $data["menos_disponibles"] = $menos_disponibles;
        $data["mas_disponibles"] = $mas_disponibles;
        $data["titulo"] = "Panel de Administración";
        $router -> render('admin/dashboard/index', $data);
    }
}


