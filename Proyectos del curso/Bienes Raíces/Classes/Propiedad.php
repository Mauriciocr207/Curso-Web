<?php
    namespace App;
    use App\Database;
    class Propiedad {
        private $id;
        private $titulo;
        private $precio;
        private $imagen;
        private $descripcion;
        private $habitaciones;
        private $wc;
        private $estacionamiento;
        private $creado;
        private $vendedor_id;  
        
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
        // PRIVATE
        // GETTERS Y SETTERS
        private function getTitulo() {
            return $this -> titulo;
        }
        private function setTitulo($newTitulo) {
            $this -> titulo = $newTitulo;
        }
        private function getPrecio() {
            return $this -> precio;
        }
        private function setPrecio($newPrecio) {
            $this -> precio = $newPrecio;
        }
        private function getImagen() {
            return $this -> imagen;
        }
        private function setImagen($newImagen) {
            $this -> imagen = $newImagen;
        }
        private function getWc() {
            return $this -> wc;
        }
        private function setWc($newWc) {
            $this -> wc = $newWc;
        }
        private function getEstacionamiento() {
            return $this -> estacionamiento;
        }
        private function setEstacionamiento($newEstacionamiento) {
            $this -> estacionamiento = $newEstacionamiento;
        }
        private function getHabitaciones() {
            return $this -> habitaciones;
        }
        private function setHabitaciones($newHabitaciones) {
            $this -> habitaciones = $newHabitaciones;
        }
        private function getDescripcion() {
            return $this -> descripcion;
        }
        private function setDescripcion($newDescripcion) {
            $this -> descripcion = $newDescripcion;
        }
        private function createPropertyArray() : array {
            $cols = [
                "titulo" => $this -> titulo,
                "precio" => $this -> precio,
                "imagen" => $this -> imagen,
                "descripcion" => $this -> descripcion,
                "habitaciones" => $this -> habitaciones,
                "wc" => $this -> wc,
                "estacionamiento" => $this -> estacionamiento,
                "creado" => $this -> creado,
                "vendedor_id;  " => $this -> vendedor_id,
            ];
            return $cols;
        }
        private function crearArchivioImagen(string $archivo) : string {
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
        private function eliminarArchivoImagen(string $imagen) {
            $carpetaImagenes = '../imagenes';
            unlink($carpetaImagenes . "/" . $imagen);
        }
        public function validarDatos() : array {
            $errores = [];
            $cols = $this -> createPropertyArray();
            // Array de cada campo
            foreach ($cols as $key => $value) {
                if(!$value) $errores[] = "El campo " . $key . " es Obligatorio";
            }
            if(strlen($cols["descripcion"]) < 50) {
                $errores[] = "La Descripción es obligatoria y debe tener al menos 50 caracteres";
            }
            if(!isset($cols["imagen"])) {
                $errores[] = "La Imagen es obligatoria";
            }
            // $maxSizeImage = 1000 * 100;
            // if($imagen["size"] > $maxSizeImage) {
            //     $errores[] = "El tamaño máximo de la imagen son 100kb";
            // }
            return $errores;
        }
        public function sanitizarDatos() {
            $db = Database::getConnection();
            $cols = $this -> createPropertyArray();
            $cleanData = [];
            // Sanitizar datos
            foreach ($cols as $key => $value) {
                $cleanData[$key] = $db -> escape_string($value);
            }
            return $cleanData;
        }
        // PUBLIC
        public function guardar() {
            $cols = $this -> sanitizarDatos();
            $colsName = join(", ", array_keys($cols));
            $colsValues = join("', '",array_values($cols));
            $query = "INSERT INTO propiedades ( " . $colsName . " ) VALUES ( '" . $colsValues . "' );" ;
            echo $query;
            
        }
        public function actualizar() {
            
        }
        public function borrar() {
            ;
        }
        public function getInfo() {
            $cols = $this -> createPropertyArray();
            echo "<pre>";
            var_dump($cols);
            echo "</pre>";
        }
        // STATIC
        static function getPropiedades() {
            
        }

        
        


        
    }