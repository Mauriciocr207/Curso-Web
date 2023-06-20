<?php
namespace UpTask\Models;
class Usuario extends ActiveRecord {
    protected $id;
    protected $nombre;
    protected $email;
    protected $password;
    protected $token;
    protected $confirmado;
    protected static $table = "usuarios";

    public function __construct($args = [])
    {
        $this -> id = $args["id"] ?? null;
        $this -> nombre = $args["nombre"] ?? "";
        $this -> email = $args["email"] ?? "";
        $this -> password = $args["password"] ?? "";
        $this -> token = $args["token"] ?? "";
        $this -> confirmado = $args["confirmado"] ?? "0";
    }

    // Getters
    public function getNombre() {
        return $this -> nombre;
    }
    public function getEmail() {
        return $this -> email;
    }
    public function getPassword() {
        return $this -> password;
    }
    public function getToken() {
        return $this -> token;
    }
    // Setters
    public function setAll($args = [])
    {
        $this -> id = $args["id"] ?? $this -> id;
        $this -> nombre = $args["nombre"] ?? $this -> nombre;
        $this -> email = $args["email"] ?? $this -> email;
        $this -> password = $args["password"] ?? $this -> password;
        $this -> token = $args["token"] ?? $this -> token;
        $this -> confirmado = $args["confirmado"] ?? $this -> confirmado;
    }
    // PROTECTED
    public function existeUsuario() : bool {
        // $email = ($this -> escape_string())["email"];
        // Crear query
        $email = $this -> email;
        $res = $this -> where("email", $email);
        return !empty($res) ? true : false;
    }
    protected function verifyPassword() : bool {
        $password_onDB = $this -> where("email", $this -> email)["password"];
        $password = $this -> password;
        $verified = password_verify($password, $password_onDB);
        return $verified;
    }
    protected function confirmedAccount() : bool {
        $confirmed = $this -> where("email", $this -> email)["confirmado"] === 1 ? true : false;
        return $confirmed;
    }
    // PUBLIC
    public function validate($password2) : array {
        $errores = [];
        $cols = $this -> getPropertyArray(ignore_id: true);
        // Variables a ignorar
        unset($cols["confirmado"]);
        unset($cols["token"]);
        // Array de cada campo
        foreach ($cols as $key => $value) {
            if(!$value) $errores[] = "El campo '" . $key . "' es Obligatorio";
        }
        // if(!preg_match("/^\d{10}/", $cols["telefono"])) {
        //     $errores[] = "Número de teléfono inválido";
        // }
        if(empty($password2)) $errores[] = "Repite la contraseña";
        if($cols["password"] !== $password2) $errores[] = "Las contraseñas no son iguales";
        if(strlen($cols["password"]) < 6) {
            $errores[] = "La contraseña debe tener al menos 6 caracteres";
        }
        if(!empty($cols["email"]) && !filter_var($cols["email"], FILTER_VALIDATE_EMAIL)) {
            $errores[] = "Email Inválido" ;
        }
        if($this -> existeUsuario()) $errores = ["Este email ya se encuentra registrado"];
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
    public function validateEmail() : array {
        $errores = [];
        $email = $this -> email;
        if(empty($email)) $errores[] = "Ingresa un email";
        if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores[] = "Email Inválido" ;
        }
        return $errores;
    }
    public function validatePassword($password2) : array {
        $errores = [];
        $password = $this -> password;
        if(empty($password)) $errores[] = "Ingresa una contraseña";
        if(strlen($password) < 6) {
            $errores[] = "La contraseña debe tener al menos 6 caracteres";
        }
        if($password !== $password2) $errores[] = "Las contraseñas no son iguales";
        return $errores;
    }
    public function createToken() {
        $this -> token = uniqid();
    }
    public function encriptPassword() { 
        $this -> password = password_hash($this -> password, PASSWORD_BCRYPT);
    }
    public function clean() {
        $this -> id = "";
        $this -> nombre = "";
        $this -> email = "";
        $this -> password = "";
    }
}