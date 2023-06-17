<?php
    namespace Models;
    class CitaServicio extends ActiveRecord {
        protected static $table = "citas__servicios";
        protected $id;
        protected $id_cita;
        protected $id_servicio;
        public function __construct($args = [])
        {
            $this -> id = $args["id"] ?? null;
            $this -> id_cita = $args["id_cita"] ?? "";
            $this -> id_servicio = $args["id_servicio"] ?? "";
        }

    }