<?php 
    namespace UpTask\Classes;
    use PHPMailer\PHPMailer\PHPMailer;

    class Email {
        protected $email;
        protected $nombre;
        protected $token;
        protected $view;
        
        public function __construct($email, $nombre, $token, $view)
        {
            $this -> email = $email;
            $this -> nombre = $nombre;
            $this -> token = $token;
            $this -> view = $view;
        }
        public function enviarConfirmacion() {
            $campos = [
                "nombre" => $this -> nombre,
                "email" => $this -> email,
                "token" => $this -> token,
                "view" => $this -> view,
            ];
            // Crear instancia de PHPMailer
            $phpmailer = new PHPMailer();
            $phpmailer -> isSMTP();
            $phpmailer -> Host = 'sandbox.smtp.mailtrap.io';
            $phpmailer -> SMTPAuth = true;
            $phpmailer -> Port = 2525;
            $phpmailer -> Username = $_ENV["MAILER_USER"];
            $phpmailer -> Password = $_ENV["MAILER_PASSWORD"];
            $phpmailer -> SMTPSecure = "tls";

            // Configurar el contenido del mail
            $phpmailer -> setFrom("cuentas@uptask.com");
            $phpmailer -> addAddress($campos["email"]);
            $phpmailer -> Subject = "Tienes un Nuevo Mensaje";

            // Habilitar HTML
            $phpmailer -> isHTML(true);
            $phpmailer -> CharSet = "UTF-8";

            // Definir el contenido
            $content = "<html>"; 
            $content .= "<style>
                            @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;500;700&display=swap');
                            * {
                                font-family: 'Roboto Mono', monospace;
                                font-weight: bold;
                            }
                            .box {
                                width: 50%;
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                margin: 0 auto;
                            }
                            .button {
                                background-color: #0da6f3;
                                color: #fff;
                                text-decoration: none;
                                font-weight: bold;
                                padding: 10px;
                                border-radius: 10px;
                                text-align: center;
                                font-size: 15px;
                                border: none;
                                outline: none;
                                cursor: pointer;
                            }   
                        </style>
                        <div class='box'>
                            <p> Hola " . $campos["nombre"] . "!</p>
                            <p>Has Creado tu cuenta en UpTask.com, confirma tu cuenta en el siguiente enlace</p>
                            <a class='button' href='http://". $_ENV["URL"] . $campos["view"] . "?token=" . $campos["token"] . "'>CONFIRMAR CUENTA</a>
                        </div>
                        </html>"; 


            $phpmailer -> Body = $content;
            $phpmailer -> AltBody = "Texto alternativo sin html";

            // Enviamos el email
            $res = $phpmailer -> send();
            return $res;
        }
    }