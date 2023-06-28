<?php
namespace DevWebCamp\Controllers;
use DevWebCamp\Models\Regalo;
use DevWebCamp\Models\Registro;

class ApiRegalosController {
    public static function index() {
        $regalos = array_map(function($regalo) {
            $total = Registro::countArray([
                "id_regalo" => $regalo["id"],
                "id_paquete" => 1,
            ])[0]["total"];
            $regalo["total"] = $total;
            return $regalo;
        }, Regalo::getAll());
        echo json_encode($regalos);
    }
}