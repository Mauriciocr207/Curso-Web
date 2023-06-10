<?php
    namespace Models;
    class Usuario extends ActiveRecord{
        protected $id;
        protected $email;
        protected $password;
        protected static $table = "usuarios";

        // CONSTRUCT
        public function __construct($args = [])
        {
            $this -> id = $args["id"] ?? "";
            $this -> email = $args["email"] ?? "";
            $this -> password = $args["password"] ?? "";
        }
        public function getEmail() {
            return $this -> email;
        }
        public function signUp() {
            $email = $this -> email;
            $validated = false;
            $error = "";
            // Preparamos el query
            $query = "SELECT email, password FROM usuarios WHERE email = '$email' ";
            // Abrimos la DB
            Database::open();
            $res = Database::read($query)[0] ?? false;
            Database::close();
            echo "<pre>";
            var_dump($res);
            echo "</pre>";
            // Validamos que el usuario exista y que la contraseña sea correcta
            if($res) {
                // Verificamos si existe un usuario con la contraseña especificada
                $passwordVerified = password_verify($this -> password, $res["password"]);
                var_dump($passwordVerified);
                if($passwordVerified) $validated = true;
                else $error = "Contraseña incorrecta";
            } else {
                $error = "El usuario no existe";
            }
            return [
                "validated" => $validated,
                "error" => $error
            ];
        }
        
    }