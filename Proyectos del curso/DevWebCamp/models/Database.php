<?php
    namespace DevWebCamp\Models;
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
        static function create($query) : array {
            $isCreate = strpos($query, "INSERT");
            $response = [
                "res" => false
            ];
            if($isCreate !== false) {
                $stmt = self::$connection -> prepare($query);
                $response["res"] = $stmt -> execute(); // Guardamos la respuesta de la base de datos   
                $response["id"] = self::$connection -> insert_id;
            }
            return $response;
        }
        static function update($query) : array {
            $isUpdate = strpos($query, "UPDATE");
            $response = [
                "res" => false
            ];
            if($isUpdate !== false) {
                $stmt = self::$connection -> prepare($query);
                $response["res"] = $stmt -> execute(); // Guardamos la respuesta de la base de datos   
                $response["id"] = self::$connection -> insert_id;
            }
            return $response;
        }
        static function delete($query) : array {
            $isDelete = strpos($query, "DELETE");
            $response = [
                "res" => false
            ];
            if($isDelete !== false) {
                $stmt = self::$connection -> prepare($query);
                $response["res"] = $stmt -> execute(); // Guardamos la respuesta de la base de datos    
            }
            return $response;
        }
    }