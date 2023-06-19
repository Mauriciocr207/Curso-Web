<?php
    namespace Models;
    class Servicio extends ActiveRecord{
        protected $id;
        protected $nombre;
        protected $precio;
        protected static $table = "servicios";
        public function __construct($args = [])
        {
            $this -> id = $args["id"] ?? null;
            $this -> nombre = $args["nombre"] ?? "";
            $this -> precio = $args["precio"] ?? "";
        }
        public function getNombre() : string {
            return $this -> nombre;
        }
        public function getPrecio() : string {
            return $this -> precio;
        }
        public function setServicio($args = []) : void {
            $this -> id = $args["id"] ?? $this -> id;
            $this -> nombre = $args["nombre"] ?? $this -> nombre;
            $this -> precio = $args["precio"] ?? $this -> precio;
        }
        public function validate() : array {
            $errores = [];
            $cols = [
                "nombre" => $this -> nombre,
                "precio" => $this -> precio
            ];
            foreach ($cols as $key => $value) {
                if(!$value) $errores[] = "El campo '" . $key . "' es Obligatorio";
            }
            if(!is_numeric($cols["precio"])) {
                $errores[] = "EL precio no es válido";
            }
            return $errores;
        }
    }