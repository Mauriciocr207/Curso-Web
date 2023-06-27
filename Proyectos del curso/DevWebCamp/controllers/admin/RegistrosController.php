<?php 
namespace DevWebCamp\Controllers; 
use DevWebCamp\MVC\Router;
use DevWebCamp\Models\Ponente;
use DevWebCamp\Classes\Paginacion;
use DevWebCamp\Models\Paquete;
use DevWebCamp\Models\Regalo;
use DevWebCamp\Models\Registro;
use DevWebCamp\Models\Usuario;

class RegistrosController {
    public static function index(Router $router ) {
        // Verificamos si es administrador
        if(!isAdmin()) header('Location: /');
        // Paginación
        $pagina_actual = $_GET["page"] ?? 0;
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        if(!$pagina_actual || $pagina_actual < 0) {
            header('Location: /admin/registrados?page=1');
        }
        $registor_por_pagina = 10;
        $total = Registro::countAll();
        $paginacion = new Paginacion(
            pagina_actual: $pagina_actual,
            registros_por_pagina: $registor_por_pagina,
            total_registros: $total,
        );
        if($paginacion -> total_paginas() > 0) {
            if($paginacion -> total_paginas() < $pagina_actual) {
                header('Location: /admin/registrados?page=1');
            }
        }
        // creación de los pontentes
        $registros = array_map(function($dataPonente) {
            return new Registro($dataPonente);
        }, Registro::paginar($registor_por_pagina, $paginacion -> offset()));
        foreach($registros  as $registro) {
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

        

        $data["registros"] = $registros;
        $data["paginacion"] = $paginacion -> paginacion();
        $data["titulo"] = "Registros";
        $router -> render('admin/registros/index', $data);
    }
}


