<?php
    namespace Controllers;

    use Models\CitaServicio;
    use Models\Cita;
    use Models\Servicio;

    class APIController {
        public static function getServicios() {
            $servicios = Servicio::getAll();
            echo json_encode($servicios);
        }
        public static function guardarCita() {
            // Almacena la cita y devuelve
            $cita = new Cita($_POST);
            $response = $cita -> save();
            $resCita = $response["res"];
            
            // Almacena los servicios con el id de la cita
            $id_cita = $response["id"];
            $servicios = explode(",", $_POST["servicios"]);
            foreach ($servicios as $id_servicio) {
                $cita_servicio = new CitaServicio([
                    "id_cita" => $id_cita,
                    "id_servicio" => $id_servicio,
                ]);
                $cita_servicio -> save();
            }

            echo json_encode($resCita);
        }
        public static function eliminar() {
            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $cita = new Cita($_POST);
                $cita -> delete();
                header('Location: ' . $_SERVER["HTTP_REFERER"]);
            }
        }
    }