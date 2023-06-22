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
        $data["titulo"] = $proyecto -> getNombre();
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
        $usuario -> setAll(
            Usuario::where("id", $usuario -> getId())
        );

        $errores = [];
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuario -> setAll($_POST);
            $errores = $usuario -> validar_perfil();
            if(empty($errores)) {
                $res = $usuario -> update();
                if($res["res"]) $res["message"] = "Actualizado correctamente";
                else {
                    $res["message"] = "No se pudo actualizar";
                }
                $data["res"] = $res;
            }
        }



        $data["usuario"] = $usuario;
        $data["titulo"] = "Perfil";
        $data["errores"] = $errores;
        $router -> render('/dashboard/perfil', $data);
    }
    public static function change_password(Router $router) {
        session_start();
        isAuth();
        $usuario = new Usuario($_SESSION);

        $errores = [];
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuario -> setAll($_POST);
            $password_new = $_POST["password_new"];

            $errores = $usuario -> validar_nuevo_password($password_new);
            if(empty($errores)) {
                $usuario -> setAll(
                    Usuario::where("id", $usuario -> getId())
                );
                $usuario -> setAll([
                    "password" => $password_new
                ]);
                $usuario -> encriptPassword();
                $res = $usuario -> update();
                if($res["res"]) $res["message"] = "Contraseña actualizada correctamente";
                else {
                    $res["message"] = "No se pudo actualizar la contraseña";
                }
                $data["res"] = $res;
            }
            
        }

        $data["errores"] = $errores;
        $data["titulo"] = "Cambiar contraseña";
        $data["usuario"] = $usuario;
        $router -> render('/dashboard/change_password', $data);
    }
}