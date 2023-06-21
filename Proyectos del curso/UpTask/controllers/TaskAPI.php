<?php
namespace UpTask\Controllers;

use UpTask\Models\Proyecto;
use UpTask\Models\Usuario;
use UpTask\Models\Tarea;
use UpTask\MVC\Router;

class TaskAPI {
    public static function index(Router $router) {
        
    }   
    public static function create(Router $router) {
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            session_start();
            $usuario = new Usuario($_SESSION);
            $respuesta = [
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
                        "nombre" => $data["tarea"],
                        "id_proyecto" => $proyecto -> getId(),
                    ]);
                    
                    $respuesta = [
                        "res" => true,
                        "id" => $tarea -> getId(),
                        "nombre" => $tarea -> getNombre(),
                        "estado" => $tarea -> getEstado(),
                        "id_proyecto" => $tarea -> getIdProyecto(),
                    ];
                }
            }
            
            echo json_encode(
                $respuesta
            );
        }
    }   
    public static function update(Router $router) {
        if($_SERVER["REQUEST_METHOD"] === "POST") {

        }
    }   
    public static function delete(Router $router) {
        if($_SERVER["REQUEST_METHOD"] === "POST") {

        }
    }   
}