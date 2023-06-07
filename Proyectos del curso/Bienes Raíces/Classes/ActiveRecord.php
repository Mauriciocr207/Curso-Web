<?php 
    namespace App;
    use App\Database;
    class ActiveRecord {
        protected static $table = "";
        public static function getAll() : array {
            // Conexión a la DB
            Database::open();
            // Creación del query
            $query = "SELECT * FROM " . static::$table;
            $propiedades = Database::read($query) ?? [];
            Database::close();
            return $propiedades;
        }
    }