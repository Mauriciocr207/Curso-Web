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
        public static function getAllWithServices(string $fecha = "") : array {
            $queryCitas = "
                SELECT 
                citas.id,
                citas.fecha,
                citas.hora,
                usuarios.nombre,
                usuarios.apellido,
                usuarios.email,
                usuarios.telefono
                FROM citas
                LEFT JOIN usuarios ON citas.id_usuario = usuarios.id
            ";
            // Si no hay ninguna fecha como parámetro, trae todas las citas
            $queryCitas .= (!empty($fecha) ? "WHERE citas.fecha = '$fecha'" : "");
            $citas = array_map(function($cita) {
                // Obtenemos el id de la cita
                $citaId = $cita["id"];
                // Creamos query para obtener los servicios de la cita
                $queryServicios = "
                    SELECT 
                    servicios.nombre as servicio,
                    servicios.precio
                    FROM citas
                    LEFT JOIN citas__servicios ON citas__servicios.id_cita = citas.id
                    LEFT JOIN servicios ON servicios.id = citas__servicios.id_servicio
                    WHERE citas.id = '$citaId'
                ";
                // Obtenemos los servicios
                $servicios = self::SQL($queryServicios);
                // Hallamos el total de los servicios
                $precios = array_map(function($servicio) {
                    return $servicio["precio"];
                },$servicios);
                $total = array_sum($precios);

                // Retornamos la cita y sus servicios
                return [
                    "id" => $cita["id"],
                    "fecha" => $cita["fecha"],
                    "hora" => $cita["hora"],
                    "nombre" => $cita["nombre"],
                    "apellido" => $cita["apellido"],
                    "email" => $cita["email"],
                    "telefono" => $cita["telefono"],
                    "servicios" => $servicios,
                    "total" => $total
                ];
            }, self::SQL($queryCitas));
            return $citas;
        }

        
    }