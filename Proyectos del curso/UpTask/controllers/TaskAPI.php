<?php
namespace UpTask\Controllers;

use UpTask\Models\Proyecto;
use UpTask\Models\Usuario;
use UpTask\Models\Tarea;
use UpTask\MVC\Router;

class TaskAPI {
    public static function index(Router $router) {
        session_start();
        $usuario = new Usuario($_SESSION);
        $url = $_GET["url"];
        $response = [
            "res" => false
        ];
        
        $dataProyecto = Proyecto::where("url", $url);
        // Si existe el proyecto, construimos el objeto proyecto con estos datos
        if($dataProyecto) {
            $proyecto = new Proyecto($dataProyecto);
            // Verificamos que el proyecto sea del usuario
            if($proyecto -> getIdUsuario() === $usuario -> getId()) { 
                $tareas = Tarea::belongsTo('id_proyecto', $proyecto -> getId());
                $response = [
                    "res" => true,
                    "tareas" => $tareas,
                ];
            }
        }
        
        echo json_encode(
            $response
        );

    }   
    public static function create(Router $router) {
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            session_start();
            $usuario = new Usuario($_SESSION);
            $response = [
                "res" => false
            ];
            $data = json_decode($_POST["data"], true); // usamos el true para usar el json como arreglo asociativo
            
            $dataProyecto = Proyecto::where("url", $data["proyecto"]["url"]);
            // Si existe el proyecto, construimos el objeto proyecto con estos datos
            if($dataProyecto) {
                $proyecto = new Proyecto($dataProyecto);
                // Verificamos que el proyecto sea del usuario
                if($proyecto -> getIdUsuario() === $usuario -> getId()) { 
                    $tarea = new Tarea([
                        "nombre" => $data["tarea"]["nombre"],
                        "id_proyecto" => $proyecto -> getId(),
                    ]);
                    $response = $tarea -> save();
                    if($response["res"]) {
                        $response["tarea"] = [
                            "id" => $response["id"],
                            "id_proyecto" => $proyecto -> getId(),
                        ];
                    }
                }
            }
            
            echo json_encode(
                $response
            );
        }
    }   
    public static function update(Router $router) {
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            session_start();
            $usuario = new Usuario($_SESSION);
            $response = [
                "res" => false
            ];
            $data = json_decode($_POST["data"], true); // usamos el true para usar el json como arreglo asociativo
            
            $dataProyecto = Proyecto::where("url", $data["proyecto"]["url"]);
            // Si existe el proyecto, construimos el objeto proyecto con estos datos
            if($dataProyecto) {
                $proyecto = new Proyecto($dataProyecto);
                // Verificamos que el proyecto sea del usuario
                if($proyecto -> getIdUsuario() === $usuario -> getId()) { 
                    $tarea = new Tarea(
                        Tarea::where("id", $data["tarea"]["id"])
                    );
                    $tarea -> setAll([
                        "estado" => $data["tarea"]["estado"],
                        "nombre" => $data["tarea"]["nombre"]
                    ]);
                    $response = $tarea -> update();
                    if($response["res"]) {
                        $response["tarea"] = [
                            "id" => $tarea -> getId(),
                            "estado" => $tarea -> getEstado(),
                            "id_proyecto" => $proyecto -> getId(),
                        ];
                    }
                }
            }
            
            echo json_encode(
                $response
            );
        }
    }   
    public static function delete(Router $router) {
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            session_start();
            $usuario = new Usuario($_SESSION);
            $response = [
                "res" => false
            ];
            $data = json_decode($_POST["data"], true); // usamos el true para usar el json como arreglo asociativo
            
            $dataProyecto = Proyecto::where("url", $data["proyecto"]["url"]);
            // Si existe el proyecto, construimos el objeto proyecto con estos datos
            if($dataProyecto) {
                $proyecto = new Proyecto($dataProyecto);
                // Verificamos que el proyecto sea del usuario
                if($proyecto -> getIdUsuario() === $usuario -> getId()) { 
                    $tarea = new Tarea(
                        Tarea::where("id", $data["tarea"]["id"])
                    );
                    $response = $tarea -> delete();
                    if($response["res"]) {
                        
                    }
                }
            }
            
            echo json_encode(
                $response
            );
        }
    }   
}