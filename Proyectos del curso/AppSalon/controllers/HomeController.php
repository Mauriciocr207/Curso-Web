<?php
    namespace Controllers;

    use Classes\Email;
    use Models\Usuario;
    use MVC\Router;

    class HomeController {
        public static function login(Router $router) {
            $usuario = new Usuario();
            $errores = [];
            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $usuario -> setUsuario($_POST);
                $errores = $usuario -> validateLogin();
                if(empty($errores)) {
                    $usuario -> setUsuario(
                        $usuario -> where("email", $usuario -> getEmail())
                    );
                    // Iniciamos una sesion para el usuario
                    session_start();
                    $_SESSION = [
                        "id" => $usuario -> getId(),
                        "nombre" => $usuario -> getNombre() . " " . $usuario -> getApellido(),
                        "usuario" => $usuario -> getEmail(),
                        "login" => true,
                    ];
                    // Redireccionamiento
                    if($usuario -> getAdmin() === "1") {
                        $_SESSION["admin"] = true;
                        header('Location: /admin');
                    }
                    else if($usuario -> getAdmin() === "0") {
                        header('Location: /citas');
                    }
                } 
            }
            $data["usuario"] = $usuario;
            $data["errores"] = $errores;
            $data["usuario"] = $usuario;
            $router -> render('/auth/login', $data);
        }
        public static function logout() {
            session_start();
            $_SESSION = [];
            header('Location: /');
        }
        public static function olvide(Router $router) {
            $usuario = new Usuario();
            $errores = [];
            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $usuario -> setUsuario($_POST);
                $errores = $usuario -> validateEmail();
                if(empty($errores)) {
                    if($usuario -> existeUsuario()) {
                        // Guardamos los datos del usuario
                        $usuario -> setUsuario(
                            $usuario -> where("email", $usuario -> getEmail())
                        );
                        // Crear token
                        $usuario -> createToken();
                        // Establecer al usuario como no confirmado
                        $usuario -> setUsuario(["confirmado" => "0"]);
                        // Enviar Email
                        $email = new Email(
                            nombre: ($usuario -> getNombre()) . " " . ($usuario -> getApellido()),
                            email: $usuario -> getEmail(),
                            token: $usuario -> getToken(),
                            view: "/cambiar-password"
                        );
                        $email -> enviarConfirmacion();
                        // Guardar en la base de datos 
                        $res =  ($usuario -> update())["res"];
                        // Validar el resultado
                        if($res) {
                            $usuario -> clean();
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
            $router -> render('/auth/olvide-password', $data);
        }
        public static function cambiarPassword(Router $router) {
            $usuario = new Usuario();
            $token = htmlspecialchars($_GET["token"]);
            if(!$usuario -> where("token", $token)) {
                header('Location: /confirma-tu-cuenta');
            }
            $errores = [];
            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $usuario -> setUsuario($_POST);
                $errores = $usuario -> validatePassword();
                if(empty($errores)) {
                    $password = $usuario -> getPassword();
                    $usuario -> setUsuario(
                        $usuario -> where("token", $token)
                    );
                    $usuario -> setUsuario([
                        "password" => $password,
                        "confirmado" => "1",
                        "token" => "",
                    ]);
                    $usuario -> encriptPassword();
                    $res = ($usuario -> update())["res"];
                    if($res) {
                        $data["res"] = "Tu contraseña ha sido cambiada correctamente.\n Porfavor inicia sesión para comenzar.";
                        $usuario -> clean();
                    } else {
                        $errores = ["No se pudo cambiar la contraseña"];
                    }
                }
            }
            $data["errores"] = $errores;
            $data["usuario"] = $usuario;
            $data["token"] = $token;
            $router -> render('/auth/cambiar-password', $data);
        }
        // Crear cuenta
        public static function crear(Router $router) {
            $usuario = new Usuario();
            $errores = [];
            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $usuario -> setUsuario($_POST);
                $errores = $usuario -> validate();
                if(empty($errores)) {
                    if(!($usuario -> existeUsuario())) {
                        // Crear contraseña
                        $usuario -> encriptPassword();
                        // Crear token
                        $usuario -> createToken();
                        // Enviar Email
                        $email = new Email(
                            nombre: ($usuario -> getNombre()) . " " . ($usuario -> getApellido()),
                            email: $usuario -> getEmail(),
                            token: $usuario -> getToken(),
                            view: "/confirmar-cuenta"
                        );
                        $email -> enviarConfirmacion();
                        // Guardar en la base de datos 
                        $res =  ($usuario -> save())["res"];
                        // Validar el resultado
                        if($res) {
                            $usuario -> clean();
                            header('Location: /confirma-tu-cuenta');
                        }
                        else $errores = ["No se pudo crear la cuenta"];
                    } else {
                        $errores = ["Ya existe un usuario con este correo"];
                    }
                }
            }
            $data["usuario"] = $usuario;
            $data["errores"] = $errores;
            $router -> render('/auth/crear-cuenta', $data);
        }
        public static function avisoConfirmacion(Router $router) {
            $router -> render('/auth/confirma-tu-cuenta');
        }
        public static function confirmar(Router $router) {
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
                $usuario -> setUsuario($userData);
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
            $router -> render('/auth/confirmar-cuenta', $data);
        }
        

    }