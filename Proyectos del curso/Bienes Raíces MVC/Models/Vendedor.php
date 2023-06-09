<?php
    namespace Models;
    use Models\Database;
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
        public function isRestricted() : bool {
            // Constricción del query
            $id = $this -> id;
            $query = "SELECT COUNT(vendedor_id) AS total FROM bienesraices_crud.propiedades WHERE vendedor_id = $id;";
            Database::open();
            $res = Database::read($query);
            Database::close();
            // Definimos que el vendedor estará restrigido por default
            $isRestricted = true; 
            // Si el vendedor no tiene alguna propiedad asociada,
            // entonces no está restringido
            if($res[0]["total"] === 0) {
                $isRestricted = false;
            }
            return $isRestricted;
        }

        
    }