<?php
    namespace Models;
    class Propiedad extends ActiveRecord {
        protected $id;
        protected $titulo;
        protected $precio;
        protected $imagen;
        protected $descripcion;
        protected $habitaciones;
        protected $wc;
        protected $estacionamiento;
        protected $creado;
        protected $vendedor_id;  
        protected static $table = "propiedades";
        protected static $folderImages = "Propiedades";
        
        // CONSTRUCT
        public function __construct($args = [])
        {
            $this -> id = $args["id"] ?? "";
            $this -> titulo = $args["titulo"] ?? "";
            $this -> precio = $args["precio"] ?? "";
            $this -> imagen = $args["imagen"] ?? "imagen.jpg";
            $this -> descripcion = $args["descripcion"] ?? "";
            $this -> habitaciones = $args["habitaciones"] ?? "";
            $this -> wc = $args["wc"] ?? "";
            $this -> estacionamiento = $args["estacionamiento"] ?? "";
            $this -> creado = $args["creado"] ?? "";
            $this -> vendedor_id = $args["vendedor_id"] ?? "";
            $this -> imagen = $args["imagen"] ?? "";
        }
        //== METHODS ==//
        // GETTERS
        public function getTitulo() : string {
            return $this -> titulo;
        }
        public function getPrecio() : string {
            return $this -> precio;
        }
        public function getWc() : string {
            return $this -> wc;
        }
        public function getEstacionamiento() : string {
            return $this -> estacionamiento;
        }
        public function getHabitaciones() : string {
            return $this -> habitaciones;
        }
        public function getDescripcion() : string {
            return $this -> descripcion;
        }
        public function getVendedor() : string {
            return $this -> vendedor_id;
        }
        // PUBLIC METHODS
        public function setPropiedad($args) : void {
            $this -> titulo = $args["titulo"] ?? $this -> titulo;
            $this -> precio = $args["precio"] ?? $this -> precio;
            $this -> imagen = $args["imagen"] ?? $this -> imagen;
            $this -> descripcion = $args["descripcion"] ?? $this -> descripcion;
            $this -> habitaciones = $args["habitaciones"] ?? $this -> habitaciones;
            $this -> wc = $args["wc"] ?? $this -> wc;
            $this -> estacionamiento = $args["estacionamiento"] ?? $this -> estacionamiento;
            $this -> creado = $args["creado"] ?? $this -> creado;
            $this -> vendedor_id = $args["vendedor_id"] ?? $this -> vendedor_id;
            $this -> imagen = $args["imagen"] ?? $this -> imagen;
        }
        public function clean() : void {
            $this -> titulo = "";
            $this -> precio = "";
            $this -> descripcion = "";
            $this -> habitaciones = "";
            $this -> wc = "";
            $this -> estacionamiento = "";
            $this -> vendedor_id = "";
            $this -> imagen = "";
        } 
    }