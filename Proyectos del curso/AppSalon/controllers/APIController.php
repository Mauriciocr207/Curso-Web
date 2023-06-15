<?php
    namespace Controllers;

use Models\Servicio;

    class APIController {
        public static function getServicios() {
            $servicios = Servicio::getAll();
            echo json_encode($servicios);
        }
    }