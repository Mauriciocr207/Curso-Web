<?php
    namespace Controllers;
    use Models\Propiedad;
    use MVC\Router;
    use Models\Usuario;
    use PHPMailer\PHPMailer\PHPMailer;

    class HomeController {
        public static function index(Router $router) {
            $limitAnuncios = 3;
            $propiedades = array_map(function($data) {
                return new Propiedad($data);
            }, Propiedad::getAll(limit: $limitAnuncios));
            $data = [
                "propiedades" => $propiedades,
                "inHome" => true
            ];
            $router -> render('/home/home', $data);
        }
        public static function nosotros (Router $router) {
            $data = [];
            $router -> render('/home/nosotros', []);
        }
        public static function anuncios (Router $router) {
            $limitAnuncios = 3;
            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $limitAnuncios = 0;
            }
            $propiedades = array_map(function($data) {
                return new Propiedad($data);
            }, Propiedad::getAll(limit: $limitAnuncios));
            $data = [
                "propiedades" => $propiedades,
            ];
            $router -> render('/home/anuncios', $data);
        }
        public static function propiedad (Router $router) {
            $id = $_GET["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if(!$id) header('Location: /');
            $metadata = Propiedad::getById($id);
            $propiedad = new Propiedad($metadata);
            $data["propiedad"] = $propiedad;
            $router -> render('/home/anuncio', $data);
        }
        public static function blog (Router $router) {
            $data = [];
            $router -> render('/home/blog', []);
        }
        public static function entrada (Router $router) {
            $router -> render('/home/entrada', []);
        }
        public static function contacto (Router $router) {
            $result = null; // Confirmación de respuesta
            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $campos = $_POST;
                // Crear instancia de PHPMailer
                $phpmailer = new PHPMailer();
                $phpmailer -> isSMTP();
                $phpmailer -> Host = 'sandbox.smtp.mailtrap.io';
                $phpmailer -> SMTPAuth = true;
                $phpmailer -> Port = 2525;
                $phpmailer -> Username = '4802521943f79c';
                $phpmailer -> Password = '41fb14aeeb67c1';
                $phpmailer -> SMTPSecure = "tls";
                $phpmailer -> Port = 2525;

                // Configurar el contenido del mail
                $phpmailer -> setFrom("admin@bienesraices.com");
                $phpmailer -> addAddress("admin@bienesraices.com", "BienesRaices.com");
                $phpmailer -> Subject = "Tienes un Nuevo Mensaje";

                // Habilitar HTML
                $phpmailer -> isHTML(true);
                $phpmailer -> CharSet = "UTF-8";

                // Definir el contenido
                $content = "<html>"; 
                $content .= "<p>  Tienes un nuevo mensaje  </p>";
                $content .= "<p> Nombre: " . $campos['nombre'] . " </p>";
                $content .= "<p> Email: " . $campos['email'] . " </p>";
                $content .= "<p> Telefono: " . $campos['telefono'] . " </p>";
                $content .= "<p> Mensaje: " . $campos['mensaje'] . " </p>";
                // Campos opcionales de contacto
                $content .= "<p> Operacion: " . $campos['contacto'] . " </p>";
                if($campos["contacto"] === "telefono") {
                    $content .= "<p> Telefono para contacto: " . $campos['contacto_telefono'] . " </p>";
                }
                else if($campos["contacto"] === "email") {
                    $content .= "<p> Email para contacto: " . $campos['contacto_email'] . " </p>";
                }
                $content .= "<p> Precio: $" . $campos['precio'] . " </p>";
                $content .= "<p> Contacto: " . $campos['contacto'] . " </p>";
                $content .= "<p> Fecha: " . $campos['fecha'] . " </p>";
                $content .= "<p> Hora: " . $campos['hora'] . " </p>";
                $content .= "</html>"; 

    
                $phpmailer -> Body = $content;
                $phpmailer -> AltBody = "Texto alternativo sin html";

                // Enviamos el email
                $res = $phpmailer -> send($content);
                if($res) {
                    $result = [
                        "status" => true,
                        "message" => "Mensaje enviado correctamente"
                    ];
                } else {
                    $result = [
                        "status" => true,
                        "message" => "El mensaje no se pudo enviar"
                    ];
                }
            }


            $data["result"] = $result;
            $router -> render('/home/contacto', $data);
        }
        public static function login (Router $router) {
            $errores = [];
            $usuario = new Usuario($_POST);
            // Autenticar usuario
            if($_SERVER["REQUEST_METHOD"] === "POST") {
                // Validamos los campos
                $errores = $usuario -> validate();
                if(empty($errores)) {
                    // Validar si el usuario existe y si su contraseña es correcta
                    $auth = $usuario -> signUp();
                    if($auth["validated"]) {
                        session_start();
                        $_SESSION["user"] = $usuario -> getEmail();
                        $_SESSION["login"] = true;
                        header('Location: /admin');
                    } else {
                        $errores = [$auth["error"]];
                    }
                }
            }
            $data = [
                "errores" => $errores,
                "usuario" => $usuario
            ];
            $router -> render('/home/login', $data);
        }
    }