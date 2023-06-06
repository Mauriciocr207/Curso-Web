<?php 
    function crearArchivioImagen(string $archivo) : string {
        $carpetaImagenes = '../imagenes';
        // Crear carpeta si no existe
        if( !is_dir($carpetaImagenes) ) {
            mkdir($carpetaImagenes);
        }
        // Generar nombre único
        $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

        // Cargar el archivo a la carpeta imagenes
        move_uploaded_file($archivo, $carpetaImagenes . "/" . $nombreImagen);

        return $nombreImagen;
    }
    function eliminarArchivoImagen(string $imagen) {
        $carpetaImagenes = '../imagenes';
        unlink($carpetaImagenes . "/" . $imagen);
    }
    function validarDatosPropiedades(array $campos) : array {
        $errores = [];
        // Array de cada campo
        foreach ($campos as $key => $value) {
            if(!$value) $errores[] = "El campo " . $key . " es Obligatorio";
        }
        if(strlen($campos["descripcion"]) < 50) {
            $errores[] = "La Descripción es obligatoria y debe tener al menos 50 caracteres";
        }
        if(!isset($campos["imagen"]["tmp_name"])) {
            $errores[] = "La Imagen es obligatoria";
        }
        // $maxSizeImage = 1000 * 100;
        // if($imagen["size"] > $maxSizeImage) {
        //     $errores[] = "El tamaño máximo de la imagen son 100kb";
        // }
        return $errores;
    }
    function enviarPropiedad(array $campos) : bool {
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
        $imagen = crearArchivioImagen(archivo: $campos["imagen"]["tmp_name"]);
        // Insertar en la base de datos
        $query = " INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedor_id) 
                    VALUES ('$titulo', '$precio', '$imagen',  '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedor_id')" ;
        try {
            $res = mysqli_query($db, $query);
            if($res) {
                $result = true;
            }
        } catch (\Throwable $th) {
            echo $th;
        }
        $db -> close();
        return $result;
    }
    function obtenerPropiedades() {
        $db = connectDB();
        $query = "SELECT * FROM propiedades";
        $resultado = mysqli_query($db, $query);
        $propiedades = [];
        while($propiedad = mysqli_fetch_assoc($resultado)) {
            $propiedades[] = [
                "id" => $propiedad["id"],
                "titulo" => $propiedad["titulo"],
                "precio" => $propiedad["precio"],
                "imagen" => $propiedad["imagen"],
                "wc" => $propiedad["wc"],
                "estacionamiento" => $propiedad["estacionamiento"],
                "habitaciones" => $propiedad["habitaciones"],
                "descripcion" => $propiedad["descripcion"],
            ];
        }
        return $propiedades;
    }
    function obtenerPropiedadPorId(string $id) {
        $db = connectDB();
        $query = "SELECT * FROM propiedades WHERE id = $id";
        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);
        return $propiedad;
        $db -> close();
    }
    function actualizarPropiedad(array $campos, string $id, bool $actualizoImg) : bool {
        $result = false;
        $db = connectDB();
        // campos
        $titulo = mysqli_real_escape_string( $db, $campos["titulo"] );
        $precio = mysqli_real_escape_string( $db, $campos["precio"] );
        $descripcion = mysqli_real_escape_string( $db, $campos["descripcion"] );
        $habitaciones = mysqli_real_escape_string( $db, $campos["habitaciones"] );
        $wc = mysqli_real_escape_string( $db, $campos["wc"] );
        $estacionamiento = mysqli_real_escape_string( $db, $campos["estacionamiento"] );
        $vendedor_id = mysqli_real_escape_string( $db, $campos["vendedor"] );
        $imagen = "";

        // Insertar en la base de datos
        $queryImg = "";
        if($actualizoImg) {
            // Eliminar imagen anterior
            eliminarArchivoImagen($campos["imagen"]);
            // Crear imagen nueva
            $imagen = crearArchivioImagen(archivo: $campos["imagen_nueva"]["tmp_name"]);
            $queryImg = ",imagen = '$imagen' ";
        }
        $query = "UPDATE propiedades SET 
                    titulo = '$titulo',
                    precio = '$precio',
                    descripcion = '$descripcion',
                    habitaciones = '$habitaciones',
                    wc = '$wc',
                    estacionamiento = '$estacionamiento',
                    vendedor_id = '$vendedor_id'" . $queryImg . 
                    "WHERE id = '$id'";
        try {
            $res = mysqli_query($db, $query);
            if($res) {
                $result = true;
            }
        } catch (\Throwable $th) {
            echo $th;
        }
        $db -> close();
        return $result;
    }
    function borrarPropiedad(string $id) {
        $db = connectDB();
        $query = "DELETE FROM propiedades WHERE id = $id";
        $resultado = mysqli_query($db, $query); 
        $db -> close();
    }

    

