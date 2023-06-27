<?php
namespace DevWebCamp\Controllers;

use DevWebCamp\Models\Paquete;
use DevWebCamp\Models\Registro;
use DevWebCamp\Models\Usuario;
use DevWebCamp\Models\Categoria;
use DevWebCamp\Models\Dia;
use DevWebCamp\Models\Hora;
use DevWebCamp\Models\Ponente;
use DevWebCamp\MVC\Router;
use DevWebCamp\Models\Evento;
use DevWebCamp\Models\EventoRegistro;
use DevWebCamp\Models\Regalo;

class RegistroController {
    public static function crear(Router $router) {
        if(!isAuth()) {
            header('Location: /');
            return;
        };

        // Verificar si el usuario ya se ha registrado
        $registro = Registro::where('id_usuario', $_SESSION["id"]);
        if($registro && $registro["id_paquete"] === 3 || $registro && $registro["id_paquete"] === 2) {
            header('Location: /boleto?id=' . urlencode($registro["token"]));
            return;
        }
        if($registro && $registro["id_paquete"] === 3) {
            header('Location: /boleto?id=' . urlencode($registro["token"]));
            return;
        }
        if($registro && $registro["id_paquete"] === 1) {
            header('Location: /finalizar-registro/conferencias');
            return;
        }

        $data["titulo"] = "Registrarse";
        $router -> render('/registro/crear', $data);
    }
    public static function gratis() {
        if(!isAuth()) {
            header('Location: /');
            return;
        };
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $token = substr(md5(uniqid( rand(), true )), 0, 8);
            // Crear registro
            $registro = new Registro([
                "id_paquete" => 3,
                "id_pago" => "",
                "token" => $token,
                "id_usuario" => $_SESSION["id"],
            ]);
            $response = $registro -> save();
            if($response["res"]) {
                header('Location: /boleto?id=' . urlencode($registro -> getToken()));
                return;
            }
        }
    }
    public static function pagar() {
        if(!isAuth()) {
            header('Location: /');
            return;
        };
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            // Validar que post no venga vacío
            if(empty($_POST)) {
                echo json_encode([]);
                return;
            }
            // Crear registro
            $datos = $_POST;
            $datos["token"] = substr( md5(uniqid(rand(), true)), 0, 8); 
            $datos["id_usuario"] = $_SESSION["id"];
            try {
                $registro = new Registro($datos);
                $resultado = $registro -> save();
                echo json_encode($resultado);
            } catch (\Throwable $th) {
                echo json_encode([
                    "resultado" => "error"
                ]);
            }
        }
    }
    public static function boleto(Router $router) {
        // Validar la url
        $id = $_GET["id"] ?? "";
        if(!$id || !strlen($id) === 8 ) {
            // header('Location: /');
        }
        $registroData = Registro::where('token', $id);
        if(!$registroData) {
            header('Location: /');
            return;
        };

        // Llenar las tablas de referencio
        $registro = new Registro($registroData);
        $registro -> setAll([
            "id_usuario" => Usuario::getById($registro -> getIdUsuario()),
            "id_paquete" => Paquete::getById($registro -> getIdPaquete()),
        ]);
        
        $data["registro"] = $registro;
        $data["titulo"] = "Asistencia a DevWebCamp";
        $router -> render('/registro/boleto', $data);
    }
    public static function conferencias(Router $router) {
        if(!isAuth()) {
            header('Location: /');
            return;
        };
        // Validar que el usuario tenga el plan presencial
        $id_usuario = $_SESSION["id"];
        $registro = Registro::where('id_usuario', $id_usuario);
        if($registro && $registro["id_paquete"] === 2) {
            header('Location: /boleto?id=' . urlencode($registro["token"]));
            return;
        };
        if(!$registro || $registro["id_paquete"] !== 1) {
            header('Location: /');
            return;
        };

        // Redireccionar al boleto virtual en caso de haber finalizado el registro
        if($registro["id_regalo"] && $registro["id_paquete"] === 1) {
            header('Location: /boleto?id=' . urlencode($registro["token"]));
            return;
        }

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

        $regalos = array_map(function($data) {
            return new Regalo($data);
        }, Regalo::getAll());

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            // Revisar que el usuario esté autenticado
            if(!isAuth()) header('Location: /');
            $eventosId = explode(',', $_POST["id_eventos"]);
            if(empty($eventosId)) {
                echo json_encode(["resultado" => false]);
                return;
            }
            // Obtener el registro del usuario
            $registroData = Registro::where('id_usuario', $_SESSION["id"]);
            if(!$registroData || $registroData["id_paquete"] != 1) {
                echo json_encode(["resultado" => false]);
                return;
            }

            // Validar la disponibilidad de los eventos seleccionados
            $eventos_array = [];
            foreach($eventosId as $eventoId) {
                $eventoData = Evento::getById($eventoId);
                // Comprobar que el evento exista
                if(!$eventoData || $eventoData["disponibles"] === 0) {
                    echo json_encode(["resultado" => false]);
                    return;
                }
                $eventos_array[] = $eventoData;
            }
            foreach($eventos_array as $eventoData) {
                $eventoData["disponibles"] -= 1;
                $evento = new Evento($eventoData);
                $evento -> update();

                // Almacenar el registro
                $datos = [
                    "id_evento" => (int)$evento -> getId(),
                    "id_registro" => (int)$registro["id"],
                ];
                $registro_usuario = new EventoRegistro($datos);
                $registro_usuario -> save();
            }
            // Almacenar el regalo
            $registroData["id_regalo"] = $_POST["id_regalo"];
            $registro = new Registro($registroData);
            $resultado = $registro -> update();
            if($resultado["res"]) {
                echo json_encode([
                    "resultado" => $resultado,
                    "token" => $registro -> getToken(),
                ]);
            } else {
                echo json_encode(["resultado" => false]); 
                return;
            }     

            exit;
        }

        $data["regalos"] = $regalos;
        $data["titulo"] = "Elige Workshops y Conferencias";
        $data["eventos"] = $eventos_formateados;
        $router -> render('/registro/conferencias', $data);
    }
    
}