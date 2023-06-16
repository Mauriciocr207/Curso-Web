<?php
    namespace Models;
    use mysqli;
    class Database {
        private static ?mysqli $connection = null;
        static function open() {
            if(self::$connection === null) self::$connection = new mysqli(
                hostname: $_ENV["DB_HOST"],
                username: $_ENV["DB_USER"],
                password: $_ENV["DB_PASSWORD"],
                database: $_ENV["DB_NAME"],
                port: $_ENV["DB_PORT"]
            );
            return self::$connection;
        }
        static function close() {
            self::$connection -> close();
            self::$connection = null;
        }
        static function create($query) : bool {
            $isCreate = strpos($query, "INSERT");
            $res = false;
            if($isCreate !== false) {
                $stmt = self::$connection -> prepare($query);
                $res = $stmt -> execute(); // Guardamos la respuesta de la base de datos    
            }
            return $res;
        }
        static function read($query) : array {
            $isRead = strpos($query, "SELECT");
            $objects = [];
            if($isRead !== false) {
                $stmt = self::$connection -> prepare($query);
                $stmt -> execute();
                $res = $stmt -> get_result();
                while($object = $res -> fetch_assoc()) {
                    $objects[] = $object;
                }    
            }
            return $objects;
        }
        static function update($query) : bool {
            $isUpdate = strpos($query, "UPDATE");
            $res = false;
            if($isUpdate !== false) {
                $stmt = self::$connection -> prepare($query);
                $res = $stmt -> execute(); // Guardamos la respuesta de la base de datos   
            }
            return $res;
        }
        static function delete($query) : bool {
            $isDelete = strpos($query, "DELETE");
            $res = false;
            if($isDelete !== false) {
                $stmt = self::$connection -> prepare($query);
                $res = $stmt -> execute(); // Guardamos la respuesta de la base de datos    
            }
            return $res;
        }

    }