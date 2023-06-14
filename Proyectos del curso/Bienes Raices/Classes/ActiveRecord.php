<?php 
    namespace App;
    use App\Database;
    use Intervention\Image\ImageManagerStatic as Image;
    class ActiveRecord {
        protected $id;
        protected $imagen;
        protected static $table = ""; 
        protected static $folderImages = "";
        // GETTERS
        public function getId() : string {
            return $this -> id;
        }
        public function getImagen() : string {
            return $this -> imagen;
        }
        // PROTECTED METHODS
        protected function getPropertyArray(bool $ignore_id = true) : array {
            $cols = get_object_vars($this);
            if($ignore_id) unset($cols["id"]);
            return $cols;
        }
        protected function escape_string() : array {
            $cleanProperties = $this -> getPropertyArray(ignore_id: true); //Valor inicial de $cleanProperties
            $db = Database::open();
            foreach ($cleanProperties as $key => $value) {
                $cleanProperties[$key] = $db -> escape_string($value);
            }
            Database::close();
            return $cleanProperties;
        }
        // HELP METHODS
        private function createFileImage(string $name, string $file) : void {
            $imagesFolder = PROYECT__URL . "/Imagenes";
            // Crear carpeta si no existe
            if( !is_dir($imagesFolder) ) {
                mkdir($imagesFolder);
            }
            $imagesFolder = $imagesFolder . "/" . static::$folderImages;
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
            $imagesFolder = PROYECT__URL . "/Imagenes/" . static::$folderImages;
            $file = $imagesFolder . "/$name";
            unlink($file);
        }
        // PUBLIC METHODS
        public static function getAll() : array {
            // Creación del query
            $query = "SELECT * FROM " . static::$table;
            // Conexión a la DB
            Database::open();
            $propiedades = Database::read($query) ?? [];
            Database::close();
            return $propiedades;
        }
        public static function getById($id) : array | bool {
            // Conexión a la DB
            Database::open();
            // Creación del query
            $query = "SELECT * FROM " . static::$table ." WHERE id = $id";
            $propiedad = Database::read($query)[0] ?? false;
            Database::close();
            return $propiedad;
        }
        public function save() : bool {
            // Creamos la variable que guarda la dirección del archivo de la imagen
            $imageFile = $this -> imagen;
            // Creamos un nombre de imagen único para guardar en la DB
            // y reescribimos imagen con el nuevo nombre único
            $this -> imagen = $this -> generateUniqueNameImage();
            // Creamos un arreglo con las propiedades, ignorando el 'id'
            $cols = $this -> escape_string(); // Limpia las propiedades
            // Creamos un string que contiene las propiedades a la base de datos
            $colsNames = join(", ", array_keys($cols));
            // Creamos un string que contiene los valores por cada propiedad
            $colsValues = join("', '",array_values($cols));
            // Construcción del query
            $query = "INSERT INTO " . static::$table . " ( " . $colsNames . " ) VALUES ( '" . $colsValues . "' );" ;
            // Subir datos a la DB  
            Database::open(); // no necesitamos retornar la DB, por eso no la guardamos
            $res = Database::create($query);
            Database::close(); // Cerramos la DB
            if($res) $this -> createFileImage($this -> imagen, $imageFile);
            return $res;
        }
        public function update() : bool {
            // Guardamos la imagen actual y la imagen en la DB
            $image = [
                "fileImage" => $this -> imagen,
                "onDB" => self::getById($this -> id)["imagen"]
            ];
            // Verificamos si la imagen actual está en la DB
            $imageUpdated = $image["fileImage"] != $image["onDB"];
            if($imageUpdated) {
                $this -> imagen = $this -> generateUniqueNameImage();
            }
            $object_onDB = self::getById($this -> id);
            $object = $this -> escape_string(); // Limpia las propiedades
            $object_changed = []; // Guardamos los datos cambiados
            foreach ($object as $key => $value) {
                if($object[$key] != $object_onDB[$key]) {
                    $object_changed[$key] = $value; 
                }
            }
            $res = false;
            if(!empty($object_changed)) {
                // Construcción del query
                $colsAndValues = []; // Generaremos un arreglo con valores "key='value'";
                foreach ($object_changed as $key => $value) {
                    $colsAndValues[] = "$key='$value'";
                }
                $colsAndValues = join(", ", $colsAndValues); // Reescribimos colsAndValues para que sea un sólo string
                $id = $this -> id; // guardamos id en una variable dado que no es posible colocar $this en un string
                $query = "UPDATE " . static::$table . " SET " . $colsAndValues . " WHERE id = $id";
                // Subir datos a la DB
                Database::open(); // no necesitamos retornar la DB, por eso no la guardamos
                $res = Database::update($query);
                Database::close(); // Cerramos la DB
            }     
            if($imageUpdated && $res) {
                $this -> deleteFileImage($image["onDB"]); // Borramos la imagen
                $imageFile = $image["fileImage"]; // Guardamos el archvio de la imagen
                $imageNameNew = $this -> imagen;
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
        public function validate() : array {
            $errores = [];
            // Creamos un arreglo con las propiedades, ignorando el 'id' y 'campos'
            $cols = $this -> getPropertyArray(ignore_id: true);
            // Variables a ignorar
            unset($cols["creado"]); // ignorar para cualquier clase (la tenga o no)
            if(!isset($cols["imagen"])) unset($cols["imagen"]); // Si una clase tiene la propiedad imagen en NULL, la elimina
            // Array de cada campo
            foreach ($cols as $key => $value) {
                if(!$value) $errores[] = "El campo '" . $key . "' es Obligatorio";
            }
            // Validación extra de Propiedades
            if(isset($cols["descripcion"]) && strlen($cols["descripcion"]) < 50) {
                $errores[] = "La Descripción es obligatoria y debe tener al menos 50 caracteres";
            }
            // Validación extra de Vendedores
            if(isset($cols["telefono"]) && !preg_match("/^\d{10}/", $cols["telefono"])) {
                $errores[] = "Número de teléfono inválido";
            }
            // Validación extra de Usuario
            if(isset($cols["email"]) && !empty($cols["email"]) && !filter_var($cols["email"], FILTER_VALIDATE_EMAIL)) {
                $errores[] = "Email Inválido" ;
            }
            return $errores;
        }
        public function getInfo() : void {
            $cols = $this -> getPropertyArray(ignore_id: true);
            // Variables a ignorar
            unset($cols["creado"]);
            echo "<pre>";
            var_dump($cols);
            echo "</pre>";
        }
    }