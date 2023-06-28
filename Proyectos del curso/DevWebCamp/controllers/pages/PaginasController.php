<?php
namespace DevWebCamp\Controllers;

use DevWebCamp\Models\Evento;
use DevWebCamp\MVC\Router;
use DevWebCamp\Models\Categoria;
use DevWebCamp\Models\Dia;
use DevWebCamp\Models\Hora;
use DevWebCamp\Models\Ponente;

class PaginasController {
    public static function index(Router $router) {
        $eventosData = Evento::ordenar('id_hora', 'ASC');
        $eventos_formateados = [];
        foreach($eventosData as $eventoData) {
            $evento = new Evento($eventoData);
            $evento -> setAll([
                "id_categoria" => Categoria::getById($evento -> getIdCategoria()),
                "id_dia" => Dia::getById($evento -> getIdDia()),
                "id_hora" => Hora::getById($evento -> getIdHora()),
                "id_ponente" => Ponente::getById($evento -> getIdPonente()),
            ]);
            if($eventoData["id_dia"] === 1 && $eventoData["id_categoria"] === 1)  {
                $eventos_formateados["conferencias"]["viernes"][] = $evento;
            }
            else if($eventoData["id_dia"] === 2 && $eventoData["id_categoria"] === 1)  {
                $eventos_formateados["conferencias"]["sabado"][] = $evento;
            }
            else if($eventoData["id_dia"] === 1 && $eventoData["id_categoria"] === 2)  {
                $eventos_formateados["workshops"]["viernes"][] = $evento;
            }
            else if($eventoData["id_dia"] === 2 && $eventoData["id_categoria"] === 2)  {
                $eventos_formateados["workshops"]["sabado"][] = $evento;
            }
        }

        // Obtener el total de cada bloque
        $totales = [
            "ponentes" => Ponente::countAll() ,
            "conferencias" => Evento::countAll("id_categoria", "1"),
            "workshops" => Evento::countAll('id_categoria', "2"),
            "asistentes" => 10,
        ];

        // Ponentes
        $ponentes = array_map(function($data) {
            return new Ponente($data);
        }, Ponente::getAll());


        $data["eventos"] = $eventos_formateados;
        $data["titulo"] = "Inicio";      
        $data["totales"] = $totales;
        $data["ponentes"] = $ponentes;
        $router -> render('pages/index', $data);
    }
    public static function evento(Router $router) {


        $data["titulo"] = "Sobre DevWebCamp";

        $router -> render('pages/devwebcamp', $data);
    }
    public static function paquetes(Router $router) {


        $data["titulo"] = "Paquetes";

        $router -> render('pages/paquetes', $data);
    }
    public static function conferencias(Router $router) {
        $eventosData = Evento::ordenar('id_hora', 'ASC');
        $eventos_formateados = [];
        foreach($eventosData as $eventoData) {
            $evento = new Evento($eventoData);
            $evento -> setAll([
                "id_categoria" => Categoria::getById($evento -> getIdCategoria()),
                "id_dia" => Dia::getById($evento -> getIdDia()),
                "id_hora" => Hora::getById($evento -> getIdHora()),
                "id_ponente" => Ponente::getById($evento -> getIdPonente()),
            ]);
            if($eventoData["id_dia"] === 1 && $eventoData["id_categoria"] === 1)  {
                $eventos_formateados["conferencias"]["viernes"][] = $evento;
            }
            else if($eventoData["id_dia"] === 2 && $eventoData["id_categoria"] === 1)  {
                $eventos_formateados["conferencias"]["sabado"][] = $evento;
            }
            else if($eventoData["id_dia"] === 1 && $eventoData["id_categoria"] === 2)  {
                $eventos_formateados["workshops"]["viernes"][] = $evento;
            }
            else if($eventoData["id_dia"] === 2 && $eventoData["id_categoria"] === 2)  {
                $eventos_formateados["workshops"]["sabado"][] = $evento;
            }
        }


        $data["eventos"] = $eventos_formateados;
        $data["titulo"] = "Conferencias";
        $router -> render('pages/workshops-conferencias', $data);
    }
    public static function error(Router $router) {
        $router -> render('pages/404', [
            "titulo" => "Página no encontrada",
        ]);
    }
}