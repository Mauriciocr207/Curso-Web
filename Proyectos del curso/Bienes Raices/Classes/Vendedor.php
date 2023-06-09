<?php
    namespace App;
    use App\ActiveRecord;
    class Vendedor extends ActiveRecord {
        protected $id;
        protected $nombre;
        protected $apellido;
        protected $telefono;
        protected $imagen;
        protected static $table = "vendedores";
        protected static $folderImages = "Vendedores";

        // CONSTRUCTOR
        public function __construct($args = [])
        {
            $this -> id = $args["id"] ?? "";
            $this -> nombre = $args["nombre"] ?? "";
            $this -> apellido = $args["apellido"] ?? "";
            $this -> telefono = $args["telefono"] ?? "";
            $this -> imagen = $args["imagen"] ?? "";
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
        public function getTelefono() : string {
            return $this -> telefono;
        }
        // PUBLIC METHODS
        public function setVendedor($args) : void {
            $this -> nombre = $args["nombre"] ?? $this -> nombre;
            $this -> apellido = $args["apellido"] ?? $this -> apellido;
            $this -> telefono = $args["telefono"] ?? $this -> telefono;
            $this -> imagen = $args["imagen"] ?? $this -> imagen;
        }
        public function clean() : void {
            $this -> nombre = "";
            $this -> apellido = "";
            $this -> telefono = "";
        }

        
    }