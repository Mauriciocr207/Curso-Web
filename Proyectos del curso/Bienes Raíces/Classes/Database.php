<?php
    namespace App;

    use mysqli;

    class Database {
        private static ?mysqli $connection = null;
        static function getConnection() {
            if(self::$connection === null) self::$connection = new mysqli('localhost', 'root', 'root', 'bienesraices_crud');
            return self::$connection;
        }
        static function create() {
        }
        static function read() {
            return;
        }
        static function update() {
            return; 
        }
        static function delete() {
            return; 
        }

    }