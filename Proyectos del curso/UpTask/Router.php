<?php 
    namespace UpTask\MVC;
    class Router {
        public $routs = [];

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
            ob_start(); // Comenzamos almacenar datos en buffer
            foreach($data as $key => $value) {
                $$key = $value;
            }
            include PROYECT__URL . "/views/$view.php"; // se almacena el include
            $content = ob_get_clean(); // Guardamos lo que esté en buffer y definimos la variable
            include PROYECT__URL . "/Views/layout.php"; // incluimos la plantilla
        }
    }