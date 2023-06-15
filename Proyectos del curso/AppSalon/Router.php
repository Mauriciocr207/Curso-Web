<?php 
    namespace MVC;
    class Router {
        public $routs = [];
        protected $adminRouts = ["/admin", "/admin/propiedades/create", "/admin/propiedades/update", "/admin/vendedores/create", "/admin/vendedores/update"];

        public function match($url, $function) {
            $this -> routs[$url] = $function;
        }
        public function run() {
            $url = $_SERVER['PATH_INFO'] ?? "/";
            $function = $this -> routs[$url] ?? null;
            if(isset($function)) {
                call_user_func($function, $this);
            } else {
                echo "página no encontrada";
            }
        }
        public function render($view, $data = []) {
            $auth = $this -> authenticate();
            ob_start(); // Comenzamos almacenar datos en buffer
            foreach($data as $key => $value) {
                $$key = $value;
            }
            include PROYECT__URL . "/views/$view.php"; // se almacena el include
            $content = ob_get_clean(); // Guardamos lo que esté en buffer y definimos la variable
            include PROYECT__URL . "/Views/layout.php"; // incluimos la plantilla
        }
        protected function authenticate() {
            // Comprobar la sesión de las rutas
            // Validamos que haya una sesión iniciada
            $url = $_SERVER['PATH_INFO'] ?? "/";
            session_start();
            $auth = $_SESSION["login"] ?? null;
            // Si cerró la sesión
            if(isset($_GET["logout"])) {;
                $_SESSION = [];
                header("Location: /");
            }
            // Si está en una ruta privada y no está autenticado
            if(in_array($url, $this -> adminRouts)) {
                if( !$auth ) {
                    $_SESSION = [];
                    header("Location: /");
                }
            }
            return $auth;
        }
    }