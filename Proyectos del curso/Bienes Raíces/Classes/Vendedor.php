<?php
    namespace App;
    use App\ActiveRecord;
    class Vendedor extends ActiveRecord {
        private $id;
        private $nombre;
        private $apellido;
        private $telefono;
        protected static $table = "vendedores";

        // CONSTRUCTOR
        public function __construct($args = [])
        {
            $this -> id = $args["id"] ?? "";
            $this -> nombre = $args["nombre"] ?? "";
            $this -> apellido = $args["apellido"] ?? "";
            $this -> telefono = $args["telefono"] ?? "";
        }
        // GETTERS
        public function getId() : string {
            return $this -> id;
        }
        public function getNombre() : string {
            return $this -> nombre;
        }
        public function getApellido() : string {
            return $this -> apellido;
        }
        public function gettelefono() : string {
            return $this -> telefono;
        }
    }