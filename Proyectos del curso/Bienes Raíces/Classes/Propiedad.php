<?php
    namespace App;
    class Propiedad {
        private $cols = [
            "id" => "",
            "titulo" => "",
            "precio" => "",
            "imagen" => "",
            "descripcion" => "",
            "habitaciones" => "",
            "wc" => "",
            "estacionamiento" => "",
            "creado" => "",
            "vendedor_id" => "",
        ];        
        public function __construct($args = [])
        {
            $this -> cols["id"] = $args["id"] ?? "";
            $this -> cols["titulo"] = $args["titulo"] ?? "";
            $this -> cols["precio"] = $args["precio"] ?? "";
            $this -> cols["imagen"] = $args["imagen"] ?? "";
            $this -> cols["descripcion"] = $args["descripcion"] ?? "";
            $this -> cols["habitaciones"] = $args["habitaciones"] ?? "";
            $this -> cols["wc"] = $args["wc"] ?? "";
            $this -> cols["estacionamiento"] = $args["estacionamiento"] ?? "";
            $this -> cols["creado"] = $args["creado"] ?? "";
            $this -> cols["vendedor_id"] = $args["vendedor_id"] ?? "";
            echo "propiedad creada";
        }

        public function getInfo() {
            echo "<pre>";
            var_dump($this -> cols);
            echo "</pre>";
        }
    }