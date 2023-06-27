<?php
namespace DevWebCamp\Models;
class Registro extends ActiveRecord{
    protected $id;
    protected $token;
    protected $id_paquete;
    protected $id_pago;
    protected $id_usuario;
    protected $id_regalo;
    protected static $table = "registros";

    public function __construct($args = [])
    {
        $this -> id = $args["id"] ?? null;
        $this -> token = $args["token"] ?? "";
        $this -> id_paquete = $args["id_paquete"] ?? "";
        $this -> id_pago = $args["id_pago"] ?? "";
        $this -> id_usuario = $args["id_usuario"] ?? "";
        $this -> id_regalo = $args["id_regalo"] ?? "";
    }
    // Getters
    public function getToken() {
        return $this -> token;
    }
    public function getIdPaquete() {
        return $this -> id_paquete;
    }
    public function getIdPago() {
        return $this -> id_pago;
    }
    public function getIdUsuario() {
        return $this -> id_usuario;
    }
    public function getIdRegalo() {
        return $this -> id_regalo;
    }
    // Setters
    public function setAll($args = []) {
        $this -> id = $args["id"] ?? $this -> id;
        $this -> token = $args["token"] ?? $this -> token;
        $this -> id_paquete = $args["id_paquete"] ?? $this -> id_paquete;
        $this -> id_pago = $args["id_pago"] ?? $this -> id_pago;
        $this -> id_usuario = $args["id_usuario"] ?? $this -> id_usuario;
        $this -> id_regalo = $args["id_regalo"] ?? $this -> id_regalo;
    }
}