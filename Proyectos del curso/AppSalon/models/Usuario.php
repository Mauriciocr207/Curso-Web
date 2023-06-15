<?php
    namespace Models;
    class Usuario extends ActiveRecord {
        protected static $table = "usuarios";
        protected $id;
        protected $nombre;
        protected $apellido;
        protected $email;
        protected $password;
        protected $telefono;
        protected $admin;
        protected $confirmado;
        protected $token;
        
        public function __construct($args = [])
        {
            $this -> id = $args["id"] ?? null;
            $this -> nombre = $args["nombre"] ?? "";
            $this -> apellido = $args["apellido"] ?? "";
            $this -> email = $args["email"] ?? "";
            $this -> password =  $args["password"] ?? "";
            $this -> telefono = $args["telefono"] ?? "";
            $this -> admin = $args["admin"] ?? '0';
            $this -> confirmado = $args["confirmado"] ?? '0';
            $this -> token = $args["token"] ?? "";
        }
        // GETTERS
        public function getId() : string {
            return $this -> id;
        }
        public function getNombre() : string {
            return $this -> nombre;
        }
        public function getApellido() : string {
            return $this -> apellido;
        }
        public function getEmail() : string {
            return $this -> email;
        }
        public function getTelefono() : string {
            return $this -> telefono;
        }
        public function getPassword() : string {
            return $this -> password;
        }
        public function getAdmin() : string {
            return $this -> admin;
        }
        public function getToken() : string {
            return $this -> token;
        }
        // HELP METHODS
        
        // PUBLIC
        public function setUsuario($args = []) : void {
            $this -> id = $args["id"] ?? $this -> id;
            $this -> nombre = $args["nombre"] ?? $this -> nombre;
            $this -> apellido = $args["apellido"] ?? $this -> apellido;
            $this -> email = $args["email"] ?? $this -> email;
            $this -> password = $args["password"] ?? $this -> password ;
            $this -> telefono = $args["telefono"] ?? $this -> telefono;
            $this -> admin = $args["admin"] ?? $this -> admin;
            $this -> confirmado = $args["confirmado"] ?? $this -> confirmado;
            $this -> token = $args["token"] ?? $this -> token;
        }
        public function validate() : array {
            $errores = [];
            $cols = $this -> getPropertyArray(ignore_id: true);
            // Variables a ignorar
            unset($cols["admin"]);
            unset($cols["confirmado"]);
            unset($cols["token"]);
            // Array de cada campo
            foreach ($cols as $key => $value) {
                if(!$value) $errores[] = "El campo '" . $key . "' es Obligatorio";
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
        public function validateLogin() : array {
            $errores = [];
            $cols = [
                "email" => $this -> email,
                "password" => $this -> password
            ];
            foreach ($cols as $key => $value) {
                if(!$value) $errores[] = "El campo '" . $key . "' es Obligatorio";
            }
            // Si no hay errores en los datos ingresados,
            // se verifica la cuenta
            if(empty($errores)) {
                if($this -> existeUsuario()) {
                    if($this -> confirmedAccount()) {
                        if(!$this -> verifyPassword()) $errores = ["Contraseña incorrecta"];
                    } else $errores = ["Confirma tu cuenta antes de iniciar sesión.\n Revisa tu correo para verificar tu cuenta"];
                } else $errores = ["El usuario no existe"];
            }
            return $errores;
        }
        public function existeUsuario() : bool {
            // $email = ($this -> escape_string())["email"];
            // Crear query
            $email = $this -> email;
            $query = "SELECT * FROM " . self::$table . " WHERE email = '$email' LIMIT 1";
            Database::open();
            $res = Database::read($query);
            Database::close();
            return !empty($res) ? true : false;
        }
        public function verifyPassword() : bool {
            $password_onDB = $this -> where("email", $this -> email)["password"];
            $password = $this -> password;
            $verified = password_verify($password, $password_onDB);
            return $verified;
        }
        public function confirmedAccount() : bool {
            $confirmed = $this -> where("email", $this -> email)["confirmado"] === 1 ? true : false;
            return $confirmed;
        }
        public function createToken() {
            $this -> token = uniqid();
        }
        public function encriptPassword() { 
            $this -> password = password_hash($this -> password, PASSWORD_BCRYPT);
        }
        public function clean() {
            $this -> nombre = "";
            $this -> apellido = "";
            $this -> email = "";
            $this -> password =  "";
            $this -> telefono = "";
        }
    }