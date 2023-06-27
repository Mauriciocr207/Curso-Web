<?php 
namespace DevWebCamp\Models;
use DevWebCamp\Models\Database;
class ActiveRecord {
    protected $id;
    protected static $table = "";
    // GETTERS
    public function getId() : string | null {
        return $this -> id;
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
            if(is_string($cleanProperties[$key])) $cleanProperties[$key] = $db -> escape_string($value);
        }
        Database::close();
        return $cleanProperties;
    }
    // PUBLIC METHODS
    public static function getAll(int $limit = 0) : array {
        // Creación del query
        $query = "SELECT * FROM " . static::$table . ($limit > 0 ? " LIMIT $limit" : "");
        // Conexión a la DB
        Database::open();
        $objects = Database::read($query) ?? [];
        Database::close();
        return $objects;
    }
    public static function getById($id) : array | bool {
        // Conexión a la DB
        Database::open();
        // Creación del query
        $query = "SELECT * FROM " . static::$table ." WHERE id = $id";
        $object = Database::read($query)[0] ?? false;
        Database::close();
        return $object;
    }
    public static function where($property, $value) {
        // Conexión a la DB
        Database::open();
        // Creación del query
        $query = "SELECT * FROM " . static::$table ." WHERE $property = '$value'";
        $object = Database::read($query)[0] ?? false;
        Database::close();
        return $object;
    }
    // Búsqueda where con multiples opciones
    public static function whereArray($array = []) {
        
        $keysAndValues = [];
        foreach($array as $key => $value) {
            $keysAndValues[] = "$key = '$value'";
        }
        $keysAndValuesString = join(" AND ", array_values($keysAndValues));

        // Conexión a la DB
        $query = "SELECT * FROM " . static::$table ." WHERE " . $keysAndValuesString;
        Database::open();
        // // Creación del query
        $object = Database::read($query) ?? false;
        Database::close();
        return $object;
    }
    public static function belongsTo($property, $value) {
        // Conexión a la DB
        Database::open();
        // Creación del query
        $query = "SELECT * FROM " . static::$table ." WHERE $property = '$value'";
        $object = Database::read($query) ?? false;
        Database::close();
        return $object;
    }
    public static function SQL($query) {
        // Conexión a la DB
        Database::open();
        // Creación del query
        $object = Database::read($query) ?? false;
        Database::close();
        return $object;
    }
    public static function countAll($columna = "", $valor = "") {
        $query = "SELECT COUNT(*) AS 'total' FROM " . static::$table;
        if($columna) {
            $query .= " WHERE $columna = $valor";
        }
        // Conexión a la DB
        Database::open();
        // Creación del query
        $res = Database::read($query)[0]["total"] ?? 0;
        Database::close();
        return $res;
    }
    public static function ordenar($columna, $orden) {
        $query = "SELECT * FROM " . static::$table . " ORDER BY $columna $orden ";
        Database::open();
        $object = Database::read($query);
        Database::close();
        return $object;
    }
    // Paginar registros
    public static function paginar($registros_por_pagina = 0, $offset = 0) {
        // Creación del query
        $query = "SELECT * FROM " . static::$table 
                . ($registros_por_pagina > 0 ? " LIMIT $registros_por_pagina " : "")
                . ($offset > 0 ? " OFFSET $offset" : "");
        // Conexión a la DB
        Database::open();
        $objects = Database::read($query) ?? [];
        Database::close();
        return $objects;
    }
    public function save() : array {
        // Creamos un arreglo con las propiedades, ignorando el 'id'
        $cols = $this -> escape_string(); // Limpia las propiedades
        // Creamos un string que contiene las propiedades a la base de datos
        $colsNames = join(", ", array_keys($cols));
        // Creamos un string que contiene los valores por cada propiedad
        $colsValues = join("', '", array_values($cols));
        // Construcción del query
        $query = "INSERT INTO " . static::$table . " ( " . $colsNames . " ) VALUES ( '" . $colsValues . "' );" ;
        //Subir datos a la DB  
        Database::open(); // no necesitamos retornar la DB, por eso no la guardamos
        $res = Database::create($query);
        Database::close(); // Cerramos la DB
        return $res;
    }
    public function update() : array {
        $object_onDB = self::getById($this -> id);
        $object = $this -> escape_string(); // Limpia las propiedades
        $object_changed = []; // Guardamos los datos cambiados
        foreach ($object as $key => $value) {
            if($object[$key] != $object_onDB[$key]) {
                $object_changed[$key] = $value; 
            }
        }
        $res = ["res" => false];
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
        return $res;
    }
    public function delete() : array {
        $id = $this -> id;
        $query = "DELETE FROM " . static::$table . " WHERE id = $id";
        Database::open();
        $res = Database::delete($query);
        Database::close();
        return $res;
    }
    public function validate($ignore_image = false) : array {
        $errores = [];
        // Creamos un arreglo con las propiedades, ignorando el 'id'
        $cols = $this -> getPropertyArray(ignore_id: true);
        if($ignore_image) unset($cols["imagen"]);
        // Array de cada campo
        foreach ($cols as $key => $value) {
            if(strpos($key, "id_") === 0) {
                $key = str_replace("id_", "", $key);
            };
            if(!$value) $errores[] = "El campo '" . $key . "' es Obligatorio";
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