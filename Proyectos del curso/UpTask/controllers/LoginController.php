<?php
namespace UpTask\Controllers;

use UpTask\Classes\Email;
use UpTask\Models\Usuario;
use UpTask\MVC\Router;

class LoginController {
    public static function login(Router $router) {
        if($_SERVER["REQUEST_METHOD"] === "POST") {

        }
        $data["titulo"] = "Iniciar Sesión";
        $router -> render('/login/index', $data);
    }
    public static function logout(Router $router) {
        
        if($_SERVER["REQUEST_METHOD"] === "POST") {

        }
        $data["titulo"] = "Crear cuenta";
        $router -> render('/login/logout', $data);
    }
    public static function create(Router $router) {
        $usuario = new Usuario();
        $errores = [];
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuario -> setAll($_POST);
            $errores = $usuario -> validate($_POST["password2"]);
            if(empty($errores)) {
                // Si no hay errores, se crea un nuevo usuario
                // Crear contraseña
                $usuario -> encriptPassword();
                // Crear token
                $usuario -> createToken();
                // Enviar Email
                $email = new Email(
                    nombre: $usuario -> getNombre(),
                    email: $usuario -> getEmail(),
                    token: $usuario -> getToken(),
                    view: "/confirmar-cuenta"
                );
                $email -> enviarConfirmacion();
                // Guardar en la base de datos 
                $res =  $usuario -> save();
                // Validar el resultado
                if($res["res"]) {
                    header('Location: /confirma-tu-cuenta');
                }
                else $errores = ["No se pudo crear la cuenta"];
            }
        }
        $data["titulo"] = "Crear cuenta";
        $data["usuario"] = $usuario;
        $data["errores"] = $errores;
        $router -> render('/login/create', $data);
    }
    public static function forgotpassword(Router $router) {
        $usuario = new Usuario();
        $errores = [];
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuario -> setAll($_POST);
            $errores = $usuario -> validateEmail();
            if(empty($errores)) {
                if($usuario -> existeUsuario()) {
                    // Guardamos los datos del usuario
                    $usuario -> setAll(
                        $usuario -> where("email", $usuario -> getEmail())
                    );
                    // Crear token
                    $usuario -> createToken();
                    // Establecer al usuario como no confirmado
                    $usuario -> setAll(["confirmado" => "0"]);
                    // Enviar Email
                    $email = new Email(
                        nombre: $usuario -> getNombre(),
                        email: $usuario -> getEmail(),
                        token: $usuario -> getToken(),
                        view: "/changepassword"
                    );
                    $email -> enviarConfirmacion();
                    // Guardar en la base de datos 
                    $res =  ($usuario -> update())["res"];
                    // Validar el resultado
                    if($res) {
                        header('Location: /confirma-tu-cuenta');
                    }
                    else $errores = ["No se puede reestablecer la contraseña"];
                } else {
                    $errores = ["El usuario no existe"];
                }
            }
        }
        $data["usuario"] = $usuario;
        $data["errores"] = $errores;
        $data["titulo"] = "forgotpassword";
        $router -> render('/login/forgotpassword', $data);
    }
    public static function changepassword(Router $router) {
        $usuario = new Usuario();
        $token = htmlspecialchars($_GET["token"]);
        if(!$usuario -> where("token", $token)) {
            header('Location: /error-cuenta');
        }
        $errores = [];
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuario -> setAll($_POST);
            $errores = $usuario -> validatePassword($_POST["password2"]);
            if(empty($errores)) {
                $password = $usuario -> getPassword();
                $usuario -> setAll(
                    $usuario -> where("token", $token)
                );
                $usuario -> setAll([
                    "password" => $password,
                    "confirmado" => 1,
                    "token" => "",
                ]);
                $usuario -> encriptPassword();
                $result = ($usuario -> update())["res"];
                if($result) {
                    $data["res"] = [
                        "res" => true,
                        "message" => "Tu contraseña ha sido cambiada correctamente.\n Porfavor inicia sesión para comenzar."
                    ];
                    $usuario -> clean();
                }
            }
        }
        $data["errores"] = $errores;
        $data["usuario"] = $usuario;
        $data["token"] = $token;
        $data["titulo"] = "changepassword";
        $router -> render('/login/changepassword', $data);
    }
    public static function confirmar_cuenta(Router $router) {
        $res = [
            "res" => false,
            "message" => "Esta cuenta no puede ser verificada porque no existe o ya ha sido verificada. Inicia sesión o crea una cuenta para iniciar"
        ];
        $token = htmlspecialchars($_GET["token"]);
        $usuario = new Usuario();
        $userData = $usuario -> where(property: "token", value: $token);
        if($userData) {
            $userData["confirmado"] = 1;
            $userData["token"] = "";
            $usuario -> setAll($userData);
            $result = ($usuario -> update())["res"];
            if($result) {
                $res = [
                    "res" => true,
                    "message" => "Tu cuenta ha sido verificada correctamente"
                ];
            } else {
                $res["message"] = "No pudimos verificar tu cuenta, inténtalo de nuevo más tarde";
            }
        }
        $data["res"] = $res;
        $data["titulo"] = "Confirmar tu cuenta";
        $router -> render('/login/confirmar-cuenta', $data);
    }
    public static function confirma_tu_cuenta(Router $router) {
        $data["titulo"] = "confirm";
        $router -> render('/login/confirma-tu-cuenta', $data);
    }
    public static function error_cuenta(Router $router) {
        $data["titulo"] = "error";
        $router -> render('/login/error-cuenta', $data);
    }
}