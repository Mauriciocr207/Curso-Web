<?php 
namespace DevWebCamp\Controllers;

use DevWebCamp\Classes\Paginacion;
use DevWebCamp\Models\Ponente;
use DevWebCamp\MVC\Router;

class PonentesController {
    public static function index(Router $router ) {
        // Verificamos si es administrador
        if(!isAdmin()) header('Location: /');
        // Paginación
        $pagina_actual = $_GET["page"] ?? 0;
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        if(!$pagina_actual || $pagina_actual < 0) {
            header('Location: /admin/ponentes?page=1');
        }
        $registor_por_pagina = 5;
        $total = Ponente::countAll();
        $paginacion = new Paginacion(
            pagina_actual: $pagina_actual,
            registros_por_pagina: $registor_por_pagina,
            total_registros: $total,
        );
        if($paginacion -> total_paginas() > 0) {
            if($paginacion -> total_paginas() < $pagina_actual) {
                header('Location: /admin/ponentes?page=1');
            }
        }
        // creación de los pontentes
        $ponentes = array_map(function($dataPonente) {
            return new Ponente($dataPonente);
        }, Ponente::paginar($registor_por_pagina, $paginacion -> offset()));
        $data["titulo"] = "Ponentes / Conferencistas";
        $data["ponentes"] = $ponentes;
        $data["paginacion"] = $paginacion -> paginacion();
        $router -> render('admin/ponentes/index', $data);
    }
    public static function crear(Router $router ) {
        if(!isAdmin()) header('Location: /');
        $ponente = new Ponente();
        $errores = [];
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            // Leemos los valores del formulario y la imagen
            $ponente -> setAll($_POST);
            $ponente -> setAll(["imagen" => $_FILES["imagen"]["tmp_name"]]);
            $errores = $ponente -> validate();
            if(empty($errores)) {
                $ponente -> createUniqueNameImg();
                $response = $ponente -> save();
                if($response["res"]) {
                    $ponente -> saveImg();
                    header('Location: /admin/ponentes');
                }
            }
        }
        $data["ponente"] = $ponente;
        $data["errores"] = $errores;
        $data["titulo"] = "Registrar Ponente";
        $router -> render('admin/ponentes/crear', $data);
    }
    public static function editar(Router $router ) {
        if(!isAdmin()) header('Location: /');
        $id = $_GET["id"] ?? "";
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $ponenteData = Ponente::getById($id);
        $imagenActual = $ponenteData["imagen"];
        if(!$id || !$ponenteData) header('Location: /admin/ponentes');
        $ponente = new Ponente($ponenteData);
        $errores = [];
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            // Leemos los valores del formulario y la imagen
            $ponente -> setAll($_POST);
            $errores = $ponente -> validate(ignore_image: true);
            if(empty($errores)) {
                // Actualizamos el ponente
                $ponente -> createUniqueNameImg();
                $response = $ponente -> update();
                // Si la imagen cambia, se actualiza en la carpeta de imagenes
                if($response["res"]) {
                    if($ponente -> imageChanged()) {
                        // Actualización de la imagen
                        $ponente -> updateImg($imagenActual);
                        $imagenActual = $ponente -> getImagen();
                    }
                    header('Location: /admin/ponentes');
                }
            }
        }
        $data["imagen"] = $imagenActual;
        $data["ponente"] = $ponente;
        $data["errores"] = $errores;
        $data["titulo"] = "Actualizar Ponente";
        $router -> render('admin/ponentes/editar', $data);
    }
    public static function eliminar(Router $router) {
        if(!isAdmin()) header('Location: /');
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $ponente = new Ponente($_POST);
            $ponente -> delete();
            header('Location: /admin/ponentes');
        }
    }
}


