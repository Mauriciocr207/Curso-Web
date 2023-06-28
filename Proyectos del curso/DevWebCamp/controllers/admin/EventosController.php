<?php 
namespace DevWebCamp\Controllers;

use DevWebCamp\Models\Categoria;
use DevWebCamp\Models\Dia;
use DevWebCamp\Models\Evento;
use DevWebCamp\Models\Hora;
use DevWebCamp\MVC\Router;
use DevWebCamp\Classes\Paginacion;
use DevWebCamp\Models\Ponente;

class EventosController {
    public static function index(Router $router ) {
        // Verificamos si es administrador
        if(!isAdmin()) header('Location: /');
        // Paginación
        $pagina_actual = $_GET["page"] ?? 0;
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/eventos?page=1');
        }
        $registor_por_pagina = 6;
        $total = Evento::countAll();
        $paginacion = new Paginacion(
            pagina_actual: $pagina_actual,
            registros_por_pagina: $registor_por_pagina,
            total_registros: $total,
        );
        if($paginacion -> total_paginas() > 0) {
            if($paginacion -> total_paginas() < $pagina_actual) {
                header('Location: /admin/eventos?page=1');
            }
        }
        // creación de los pontentes
        $eventos = array_map(function($dataPonente) {
            return new Evento($dataPonente);
        }, Evento::paginar($registor_por_pagina, $paginacion -> offset()));
        foreach($eventos as $evento) { 
            $evento -> setAll([
                "id_categoria" => Categoria::getById($evento -> getIdCategoria())["nombre"],
                "id_dia" => Dia::getById($evento -> getIdDia())["nombre"],
                "id_hora" => Hora::getById($evento -> getIdHora())["hora"],
                "id_ponente" => Ponente::getById($evento -> getIdPonente())["nombre"],
            ]);
        }
        $data["titulo"] = "Conferencias / Workshops";
        $data["eventos"] = $eventos;
        $data["paginacion"] = $paginacion -> paginacion();
        $router -> render('admin/eventos/index', $data);
    }
    public static function crear(Router $router ) {
        if(!isAdmin()) header('Location: /');
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
        if(!isAdmin()) header('Location: /');
        $id = $_GET["id"] ?? "";
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $eventoData = Evento::getById($id);
        if(!$id || !$eventoData) header('Location: /admin/eventos');
        $evento = new Evento($eventoData);
        $errores = [];
        $categorias = Categoria::getAll();
        $dias = Dia::getAll();
        $horas = Hora::getAll();
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $evento -> setAll($_POST);
            $errores = $evento -> validate();
            if(empty($errores)) {
                $response = $evento -> update();
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
        $router -> render('admin/eventos/editar', $data);
    }
    public static function eliminar(Router $router ) {
        if(!isAdmin()) header('Location: /');
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $evento = new Evento($_POST);
            $res = $evento -> delete();
            header('Location: /admin/eventos');
        }
        $data["titulo"] = "Conferencias / Workshops";
        $router -> render('admin/eventos/eliminar', $data);
    }
}


