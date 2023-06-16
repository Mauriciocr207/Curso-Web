<?php
    namespace Models;
    class Cita extends ActiveRecord {
        protected $id;
        protected $fecha;
        protected $hora;
        protected $id_usuario;
        protected static $table = "citas";
        
        public function __construct($args = [])
        {
            $this -> id = $args["id"] ?? null;
            $this -> fecha = $args["fecha"] ?? "";
            $this -> hora = $args["hora"] ?? "";
            $this -> id_usuario = $args["id_usuario"] ?? "";
        }
    }