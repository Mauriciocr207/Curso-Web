<?php
namespace UpTask\Controllers;

use UpTask\Models\Proyecto;
use UpTask\Models\Usuario;
use UpTask\MVC\Router;

class DashboardController {
    public static function index(Router $router) {
        session_start();
        isAuth();
        $usuario = new Usuario($_SESSION);
        
        // Obtenemos todos los proyectos asociados al usuario
        // y los convertimos a objetos de la clase Proyecto
        $proyectos = array_map(function ($data) {
            return new Proyecto($data);
        }, Proyecto::belongsTo(
            "id_usuario",
            $usuario -> getId()
        ));

        
        $data["usuario"] = $usuario;
        $data["titulo"] = "Inicio";
        $data["proyectos"] = $proyectos;
        $router -> render('/dashboard/index', $data);
    }
    public static function projects(Router $router) {
        session_start();
        isAuth();
        $usuario = new Usuario($_SESSION);
        
        // Obtenemos todos los proyectos asociados al usuario
        // y los convertimos a objetos de la clase Proyecto
        $proyectos = array_map(function ($data) {
            return new Proyecto($data);
        }, Proyecto::belongsTo(
            "id_usuario",
            $usuario -> getId()
        ));

        
        $data["usuario"] = $usuario;
        $data["titulo"] = "Proyectos";
        $data["proyectos"] = $proyectos;
        $router -> render('/dashboard/projects', $data);
    }
    public static function create(Router $router) {
        session_start();
        isAuth();
        $usuario = new Usuario($_SESSION);
        $errores = [];

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $proyecto = new Proyecto($_POST);
            $errores = $proyecto -> validate();
            if(empty($errores)) {
                // Generar url
                $proyecto -> createToken();
                // Almacenar al creador del proyecto
                $proyecto -> setAll(
                    ["id_usuario" => $usuario -> getId()]
                );
                // Guardar el proyecto
                $res = ($proyecto -> save())["res"];
                
                // Redireccionar
                if($res) {
                    header('Location: /dashboard/project?url=' . $proyecto -> getUrl());
                } else {
                    $errores = ["No se pudo crear el proyecto"];
                }


            }
        }

        $data["usuario"] = $usuario;
        $data["errores"] = $errores;
        $data["titulo"] = "Crear Proyecto";
        $router -> render('/dashboard/create', $data);
    }
    public static function project(Router $router) {
        session_start();
        isAuth();
        $usuario = new Usuario($_SESSION);
        $proyecto = new Proyecto();
        $url = $_GET["url"];
        // Validar que exista el token
        $proyecto_onDB = $proyecto -> where("url", $url);
        if(!$proyecto_onDB) header('Location: /dashboard/project-not-found');
        // Revisar que el proyecto sea del usuario
        $proyecto -> setAll($proyecto_onDB);
        if( !($proyecto -> getIdUsuario() === $usuario -> getId()) ) {
            header('Location: /dashboard/project-not-found');
        }

        $data["usuario"] = $usuario;
        $data["titulo"] = "Administrar Proyecto";
        $router -> render('/dashboard/project', $data);
    }
    public static function project_not_found(Router $router) {
        session_start();
        isAuth();
        $usuario = new Usuario($_SESSION);
        $data["usuario"] = $usuario;
        $data["titulo"] = "Administrar Proyecto";
        $router -> render('/dashboard/project-not-found', $data);
    }
    public static function perfil(Router $router) {
        session_start();
        isAuth();
        $usuario = new Usuario($_SESSION);
        $data["usuario"] = $usuario;
        $data["titulo"] = "Perfil";
        $router -> render('/dashboard/perfil', $data);
    }
}