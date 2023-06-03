<?php
    function getServices() {
        try {
            // Importar conexion 
            require 'database.php';

            // Escribir código SQL
            $sql = "SELECT * FROM servicios";
            $consulta = mysqli_query($DB, $sql);

            // Obtener los resultados
            // Guardaremos los resultados en un solo arreglo
            $services = [];
            while( $row = mysqli_fetch_assoc($consulta) ) {
                // Se podría ir agregando cada valor de la consulta por medio de array_push()
                // array_push($services, $row);
                // Sin embargo, hay otra forma de hacerlo:
                // utilizando la sintáxis $array[] = algo;
                $services[] = $row;
                // Esta sintáxis permite hacer referencia al final del arreglo
            }
            return $services;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }
    getServices();



?>