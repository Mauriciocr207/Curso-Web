<?php
namespace DevWebCamp\Controllers;

use DevWebCamp\Classes\Email;
use DevWebCamp\Models\Usuario;
use DevWebCamp\MVC\Router;

class LoginController {
    public static function login(Router $router) {
        $usuario = new Usuario();
        $errores = [];
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuario -> setAll($_POST);
            $errores = $usuario -> validateLogin();
            if(empty($errores)) {
                $usuario -> setAll(
                    $usuario -> where("email", $usuario -> getEmail())
                );
                // Iniciamos una sesion para el usuario
                $_SESSION = [
                    "id" => $usuario -> getId(),
                    "nombre" => $usuario -> getNombre(),
                    "apellido" => $usuario -> getApellido(),
                    "email" => $usuario -> getEmail(),
                    "admin" => $usuario -> getAdmin(),
                ];
                // Redireccionamiento
                if($usuario -> getAdmin()) {
                    header('Location: /admin/dashboard');
                } else {
                    header('Location: /finalizar-registro');
                }
            } 
        }
        $data["errores"] = $errores;
        $data["usuario"] = $usuario;
        $data["titulo"] = "Iniciar Sesión";
        $router -> render('auth/login', $data);
    }
    public static function logout(Router $router) {
        $_SESSION = [];
        header('Location: /');
    }
    public static function create(Router $router) {
        $usuario = new Usuario();
        $errores = [];
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuario -> setAll($_POST);
            $errores = $usuario -> validateCreate($_POST["password2"]);
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
        $router -> render('auth/create', $data);
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
        $router -> render('auth/forgotpassword', $data);
    }
    public static function changepassword(Router $router) {
        $usuario = new Usuario();
        $token = htmlspecialchars($_GET["token"]);
        // Verificamos si hay información de un usuario con el token especificado
        $newDataUser = $usuario -> where("token", $token);
        // Si no existe dicho token, redireccionamos
        if(!$newDataUser) header('Location: /error-cuenta');
        // Seteamos al usuario con los nuevos datos
        $usuario -> setAll($newDataUser);
        $errores = [];
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            // Seteamos al usuario con los datos de password
            $usuario -> setAll($_POST);
            // Validamos el cambio de contraseña
            $errores = $usuario -> validatePassword();
            // Si no hay errores, se verifica al usuario y cambia la contraseña
            if(empty($errores)) {
                $usuario -> setAll([
                    "password" => $usuario -> getPassword(),
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
        $router -> render('auth/changepassword', $data);
    }
    public static function confirmar_cuenta(Router $router) {
        $res = [
            "res" => false,
            "message" => "Esta cuenta no puede ser verificada porque no existe o ya ha sido verificada. Inicia sesión o crea una cuenta para iniciar"
        ];
        $token = htmlspecialchars($_GET["token"]);
        $usuario = new Usuario();
        $userData = $usuario -> where(property: "token", value: $token);
        // Si no un usuario con este token, redireccionamos
        if(!$userData) header('Location: /error-cuenta');
        // Si la cuenta existe, la verificamos
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
        $data["res"] = $res;
        $data["titulo"] = "Confirmar tu cuenta";
        $data["confirmado"] = true;
        $router -> render('auth/confirmar-cuenta', $data);
    }
    public static function confirma_tu_cuenta(Router $router) {
        $data["titulo"] = "Confirma tu cuenta";
        $router -> render('auth/confirma-tu-cuenta', $data);
    }
    public static function error_cuenta(Router $router) {
        $data["titulo"] = "error";
        $router -> render('auth/error-cuenta', $data);
    }
}