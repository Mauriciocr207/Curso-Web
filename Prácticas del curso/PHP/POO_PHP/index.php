<?php 
declare(strict_types = 1);
include 'includes/header.php';
define("br", "</br>");
    // Se guardará todo el código en funciones, para una mejor organización


    // 344. Creando una Clase e instanciándola
    // 345. Atributos de la clase y Constructores
    function clases() {
        // Declaración de clases en versiones anteriores a PHP 8
        class Producto {
            public $nombre;
            public $precio;
            public $disponible;
            // Crear constructor de la clase
            public function __construct(string $nombre, int $precio, bool $disponible) {
                $this -> nombre = $nombre;
                $this -> precio = $precio;
                $this -> disponible = $disponible;
            }
        }
        // Instanciar clases
        $producto = new Producto("Televisión", 12312, true);
        $producto2 = new Producto("Monitor", 3132, false);
        // Acceder a los atributos del nuevo objeto
        echo "El Producto es: " . $producto -> nombre;
        echo "El precio es: " . $producto -> precio;
        echo "Disponible ? : " . $producto -> disponible;
    } 
    // clases();

    // 346. Atributos de la Clase en PHP 8
    function clasesPHP8() {
        // Declaración de clases en PHP 8
        class Producto_PHP8 {
            public function __construct(public string $nombre, public int $precio, public bool $disponible)
            {
            }
        }
        // Instanciar la clase
        $producto = new Producto_PHP8("Teclado", 1230, true);
        // Acceder a los atributos del nuevo objeto
        echo "Producto: " . $producto -> nombre;
    }
    // clasesPHP8();

    // 347. Métodos en clases
    function metodos() {
        class Electronica {
            public function __construct(public string $nombre, public int $precio, public bool $disponible)
            {    
            }
    
            public function mostrarProducto() {
                echo "Nombre: " . $this -> nombre . ", Precio: " . $this -> precio . ", Disponible? : " . ($this -> disponible ? "Sí" : "No");
            }
        }
        $arduino = new Electronica("Arduino Uno", 15222, true);
        $Esp32 = new Electronica("ESP32", 220, false);
        $arduino -> mostrarProducto();
        $Esp32 -> mostrarProducto();
    }
    // metodos();

    // 348. Modificadores de Acceso public y protected
    function modificadores() {
        class Motocicleta {
            public function __construct(public string $nombre, public int $precio, public bool $disponible)
            {    
            }
    
            public function mostrarProducto() {
                echo "Nombre: " . $this -> nombre . ", Precio: " . $this -> precio . ", Disponible? : " . ($this -> disponible ? "Sí" : "No");
            }
        }
        $yamaha = new Motocicleta("Yamaha", 23000, true);
        $yamaha -> nombre = "nuevo nombre"; // -> En este punto, las propiedades de los objetos pueden ser modificados
        $yamaha -> mostrarProducto();
        echo br;

        //== MODIFICADORES ==//
        //  -> public : Se puede acceder y modificar en cualquier lugar;
        // -> protected : Se puede acceder únicamente en la clase
        //  -> private: Sólo miembros de la misma clase pueden acceder a él
        class Automovil {
            public function __construct(protected string $nombre, public int $precio, public bool $disponible)
            {    
            }
    
            public function mostrarProducto() {
                echo "Nombre: " . $this -> nombre . ", Precio: " . $this -> precio . ", Disponible? : " . ($this -> disponible ? "Sí" : "No");
            }

            // GETTERS 
            // Colocamos un método donde sólo la clase tiene acceso a las propiedades private
            public function getName() {
                return $this -> nombre;
            }

            // SETTERS
            public function setName($nuevo_nombre) {
                $this -> nombre = $nuevo_nombre;
            }
        }
        $atos = new Automovil("Yamaha", 23000, true);
        try {
            $atos -> nombre = "nuevo nombre";   
        } catch (\Throwable $th) {
            echo $th; // Error: Cannot access protected property Automovil::$nombre     
            // El objeto no se puede modificar;
        }
        echo br;
        try {
            echo $atos -> nombre;
        } catch (\Throwable $th) {
            echo $th; // Error: Cannot access protected property Automovil::$nombre
        }
        echo br;
        $atos -> mostrarProducto();
        echo br;

        // Para poder acceder a las propiedades protected, tenemos que utilizar getters y setters
        // Para obtener una propiedad utilizamos el getter
        echo $atos -> getName(); // Yamaha
        echo br;
        // Para poder modificar una propiedad utilizamos el setter
        $atos -> setName("nuevo nombre");
        echo $atos -> getName();
        echo br;
        $atos -> mostrarProducto();
        echo br;

    }
    modificadores();




include 'includes/footer.php';