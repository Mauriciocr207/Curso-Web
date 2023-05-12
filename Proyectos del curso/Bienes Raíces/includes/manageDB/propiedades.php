<?php 
    function enviarDatos(array $campos) {
        $result = false;
        $db = connectDB();
        // campos
        $titulo = mysqli_real_escape_string( $db, $campos["titulo"] );
        $precio = mysqli_real_escape_string( $db, $campos["precio"] );
        $descripcion = mysqli_real_escape_string( $db, $campos["descripcion"] );
        $habitaciones = mysqli_real_escape_string( $db, $campos["habitaciones"] );
        $wc = mysqli_real_escape_string( $db, $campos["wc"] );
        $estacionamiento = mysqli_real_escape_string( $db, $campos["estacionamiento"] );
        $creado = mysqli_real_escape_string( $db, $campos["creado"] );
        $vendedor_id = mysqli_real_escape_string( $db, $campos["vendedor"] );
        // Insertar en la base de datos
        $query = " INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, creado, vendedor_id) 
                    VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedor_id')" ;
        try {
            $res = mysqli_query($db, $query);
            if($res) {
                $result = true;
            }
        } catch (\Throwable $th) {
            echo $th;
        }
        return $result;
    }

    function validarDatos(array $campos) : array {
        $errores = [];
        // Array de cada campo
        foreach ($campos as $key => $value) {
            if(!$value) {
                $errores[] = "El campo " . $key . " es Obligatorio";
            }
        }
        if(strlen($campos["descripcion"]) < 50) {
            $errores[] = "La Descripción es obligatoria y debe tener al menos 50 caracteres";
        }
        if(!$campos["imagen"]["name"] || $campos["imagen"]["error"]) {
            $errores[] = "La imagen es Obligatoria";
        }
        // $maxSizeImage = 1000 * 100;
        // if($imagen["size"] > $maxSizeImage) {
        //     $errores[] = "El tamaño máximo de la imagen son 100kb";
        // }
        return $errores;
    }