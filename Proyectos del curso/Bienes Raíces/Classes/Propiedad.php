<?php
    namespace App;
    use App\ActiveRecord;
    use App\Database;
    use Intervention\Image\ImageManagerStatic as Image;
    class Propiedad extends ActiveRecord {
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
        protected static $table = "propiedades";
        
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
        public function getId() : string {
            return $this -> id;
        }
        public function getTitulo() : string {
            return $this -> titulo;
        }
        public function getPrecio() : string {
            return $this -> precio;
        }
        public function getImagen() : string {
            return $this -> imagen;
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
        // SETTERS
        private function setTitulo(string $newValue) : void {
            $this -> titulo = $newValue;
        }
        private function setPrecio(string $newValue) : void {
            $this -> precio = $newValue;
        }
        private function setImagen(string $newValue) : void {
            $this -> imagen = $newValue;
        }
        private function setWc(string $newValue) : void {
            $this -> wc = $newValue;
        }
        private function setEstacionamiento(string $newValue) : void {
            $this -> estacionamiento = $newValue;
        }
        private function setHabitaciones(string $newValue) : void {
            $this -> habitaciones = $newValue;
        }
        private function setDescripcion(string $newValue) : void {
            $this -> descripcion = $newValue;
        }
        private function setVendedor(string $newValue) : void {
            $this -> vendedor_id = $newValue;
        }
        private function setCreado(string $newValue) : void {
            $this -> creado = $newValue;
        }
        // HELP METHODS
        private function createPropertyArray(bool $ignore_id = true, bool $ignore_creado = true) : array {
            $cols = [
                "id" => $this -> id,
                "titulo" => $this -> titulo,
                "precio" => $this -> precio,
                "imagen" => $this -> imagen,
                "descripcion" => $this -> descripcion,
                "habitaciones" => $this -> habitaciones,
                "wc" => $this -> wc,
                "estacionamiento" => $this -> estacionamiento,
                "creado" => $this -> creado,
                "vendedor_id" => $this -> vendedor_id,
            ];            
            if($ignore_id) unset($cols["id"]);
            if($ignore_creado) unset($cols["creado"]);
            return $cols;
        }
        private function createFileImage(string $name, string $file) : void {
            $imagesFolder = PROYECT__URL . "/imagenes";
            // Crear carpeta si no existe
            if( !is_dir($imagesFolder) ) {
                mkdir($imagesFolder);
            }
            // Cargar el archivo a la carpeta imagenes
            $image = Image::make($file) -> fit(800, 600);
            $image -> save($imagesFolder . "/" . $name);
        }
        private function generateUniqueNameImage() : string {
            // Generar nombre único
            return md5( uniqid( rand(), true ) ) . ".jpg";
        }
        private function deleteFileImage(string $name) : void {
            $imagesFolder = PROYECT__URL . "/imagenes";
            $file = $imagesFolder . "/$name";
            unlink($file);
        }
        private function cleanData() :void {
            // Crear conexión
            $db = Database::open();
            // Sanitizar datos
            $this -> titulo = $db -> escape_string($this -> titulo);
            $this -> precio = $db -> escape_string($this -> precio);
            $this -> descripcion = $db -> escape_string($this -> descripcion);
            $this -> habitaciones = $db -> escape_string($this -> habitaciones);
            $this -> wc = $db -> escape_string($this -> wc);
            $this -> estacionamiento = $db -> escape_string($this -> estacionamiento);
            $this -> creado = $db -> escape_string($this -> creado);
            $this -> vendedor_id = $db -> escape_string($this -> vendedor_id);
            $this -> imagen = $db -> escape_string($this -> imagen);
            // Cerrar conexión
            Database::close();
        }
        // PUBLIC METHODS
        public function save() : bool {
            // Sanitizamos los datos
            $this -> cleanData();
            // Creamos la variable que guarda la dirección del archivo de la imagen
            $imageFile = $this -> imagen;
            // Creamos un nombre de imagen único para guardar en la DB
            // y reescribimos imagen con el nuevo nombre único
            $this -> imagen = $this -> generateUniqueNameImage();
            // Creamos un arreglo con las propiedades, ignorando el 'id'
            $cols = $this -> createPropertyArray(ignore_id: true, ignore_creado: false);
            // Creamos un string que contiene las propiedades a la base de datos
            $colsNames = join(", ", array_keys($cols));
            // Creamos un string que contiene los valores por cada propiedad
            $colsValues = join("', '",array_values($cols));
            // Construcción del query
            $query = "INSERT INTO" . static::$table . "( " . $colsNames . " ) VALUES ( '" . $colsValues . "' );" ;
            // Subir datos a la DB  
            Database::open(); // no necesitamos retornar la DB, por eso no la guardamos
            $res = Database::create($query);
            Database::close(); // Cerramos la DB
            // Si los datos se guardaron correctamente, creamos el archivo de la imagen
            // y se guarda en la carpeta Imagenes
            if($res) $this -> createFileImage($this -> imagen, $imageFile);
            return $res;
        }
        public function update(bool $imageUpdated) : bool {
            // Sanitizamos los datos
            $this -> cleanData();
            $imageNameNew = $this -> generateUniqueNameImage(); // Creamos una nuevo nombre de imagen
            $imageNameOld = self::getPropiedadById($this -> id)["imagen"]; // Obtenemos la imagen antigua
            // Construcción del query
            $cols = $this -> createPropertyArray(ignore_id: true, ignore_creado: true);
            // Ignorar cols["imagen"];
            unset($cols["imagen"]);
            $colsAndValues = []; // Generaremos un arreglo con valores "key='value'";
            foreach ($cols as $key => $value) {
                $colsAndValues[] = "$key='$value'";
            }
            $colsAndValues = join(", ", $colsAndValues); // Reescribimos colsAndValues para que sea un sólo string
            $id = $this -> id; // guardamos id en una variable dado que no es posible colocar $this en un string
            $query = "UPDATE " . static::$table . " SET " . $colsAndValues . ($imageUpdated ? ", imagen = '$imageNameNew'" : "") . " WHERE id = $id";
            // Subir datos a la DB
            Database::open(); // no necesitamos retornar la DB, por eso no la guardamos
            $res = Database::update($query);
            Database::close(); // Cerramos la DB
            // Si los datos se guardaron correctamente, creamos el archivo de la imagen
            // y se guarda en la carpeta Imagenes
            if($imageUpdated && $res) {
                $this -> deleteFileImage($imageNameOld); // Borramos la imagen
                $imageFile = $this -> imagen; // Guardamos el archvio de la imagen
                $this -> createFileImage($imageNameNew, $imageFile); // Guardamos la nueva imagen
            }
            return $res;
        }
        public function delete() : bool {
            $id = $this -> id;
            $query = "DELETE FROM " . static::$table . " WHERE id = $id";
            Database::open();
            $res = Database::delete($query);
            Database::close();
            if($res) $this -> deleteFileImage($this -> imagen);
            return $res;
        }
        public function getInfo() : void {
            $cols = $this -> createPropertyArray();
            echo "<pre>";
            var_dump($cols);
            echo "</pre>";
        }
        public function setPropiedad($args) : void {
            $this -> id = $args["id"] ?? $this -> id;
            $this -> titulo = $args["titulo"] ?? $this -> titulo;
            $this -> precio = $args["precio"] ?? $this -> precio;
            $this -> imagen = $args["imagen"] ?? $this -> imagen;
            $this -> descripcion = $args["descripcion"] ?? $this -> descripcion;
            $this -> habitaciones = $args["habitaciones"] ?? $this -> habitaciones;
            $this -> wc = $args["wc"] ?? $this -> wc;
            $this -> estacionamiento = $args["estacionamiento"] ?? $this -> estacionamiento;
            $this -> creado = $args["creado"] ?? $this -> creado;
            $this -> vendedor_id = $args["vendedor"] ?? $this -> vendedor_id;
            $this -> imagen = $args["imagen"] ?? $this -> imagen;
        }
        public function clean() : void {
            $this -> setTitulo("");
            $this -> setPrecio("");
            $this -> setDescripcion("");
            $this -> setHabitaciones("");
            $this -> setWc("");
            $this -> setEstacionamiento("");
            $this -> setCreado("");
            $this -> setVendedor("");
            $this -> setImagen("");
        }
        public function validateData() : array {
            $errores = [];
            // Creamos un arreglo con las propiedades, ignorando el 'id' y 'campos'
            $cols = $this -> createPropertyArray(ignore_id: true, ignore_creado: true);
            // Array de cada campo
            foreach ($cols as $key => $value) {
                if(!$value) $errores[] = "El campo '" . $key . "' es Obligatorio";
            }
            if(strlen($cols["descripcion"]) < 50) {
                $errores[] = "La Descripción es obligatoria y debe tener al menos 50 caracteres";
            }
            // $maxSizeImage = 1000 * 100;
            // if($imagen["size"] > $maxSizeImage) {
            //     $errores[] = "El tamaño máximo de la imagen son 100kb";
            // }
            return $errores;
        }
        // STATIC
        static function getPropiedadById($id) : array | bool {
            // Conexión a la DB
            Database::open();
            // Creación del query
            $query = "SELECT * FROM " . static::$table ." WHERE id = $id";
            $propiedad = Database::read($query)[0] ?? false;
            Database::close();
            return $propiedad;
        }
        
        

        
        


        
    }