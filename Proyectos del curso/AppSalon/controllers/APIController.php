<?php
    namespace Controllers;

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
            $resCita = $cita -> save();

            // Almacena la cita y el servicio
            // $idServicios = explode(",", $_POST["servicios"]);

            echo json_encode($resCita);
        }
    }