<?php
    namespace App;
    use App\Database;
    class Usuario {
        private $email;
        private $password;

        // CONSTRUCT
        public function __construct($args = [])
        {
            $this -> email = $args["email"] ?? "";
            $this -> password = $args["password"] ?? "";
        }
        private function cleanData() :void {
            // Crear conexión
            $db = Database::open();
            // Sanitizar datos
            $this -> email = $db -> escape_string($this -> email);
            $this -> password = $db -> escape_string($this -> password);
            // Cerrar conexión
            Database::close();
        }
        public function validateData() {
            $errores = [];
            if(empty($this -> email)) $errores[] = "El Email es Obligatorio";
            else {
                if(!filter_var($this -> email, FILTER_VALIDATE_EMAIL)) $errores[] = "Email Inválido" ;
            }
            if(empty($this -> password)) $errores[] = "La Contraseña es Obligatoria";
            return $errores;
        }
        public function signUp() {
            $this -> cleanData();
            $email = $this -> email;
            // Preparamos el query
            $query = "SELECT email, password FROM usuarios WHERE email = '$email' ";
            // Abrimos la DB
            Database::open();
            $validated = false;
            $error = "";
            $res = Database::read($query)[0] ?? false;
            echo "<pre>";
            var_dump($res);
            echo "</pre>";
            if($res) {
                // Verificamos si existe un usuario con la contraseña especificada
                $passwordVerified = password_verify($this -> password, $res["password"]);
                var_dump($passwordVerified);
                if($passwordVerified) $validated = true;
                else $error = "Contraseña incorrecta";
            } else {
                $error = "El usuario no existe";
            }
            Database::close();
            return [
                "validated" => $validated,
                "error" => $error
            ];
        }
        public function getInfo() {
            return [
                "email" => $this -> email,
                "password" => $this -> password,
            ];
        }
        public function getEmail() {
            return $this -> email;
        }
    }