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
    // 349. Métodos estáticos
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
            public static $imagenPlaceHolder = "imagen.jpg";

            public function __construct(protected string $nombre, public int $precio, public bool $disponible, public string $imagen)
            {    
                if($imagen) {
                    self::$imagenPlaceHolder = $imagen;
                }
            }
            // Los métodos estáticos no requieren instanciarse
            public static function showImg() {
                return self::$imagenPlaceHolder;
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
            public function setName(string $nuevo_nombre) {
                $this -> nombre = $nuevo_nombre;
            }
        }
        $atos = new Automovil("Yamaha", 23000, true, "");
        try {
            // $atos -> nombre = "nuevo nombre";
        } catch (\Throwable $th) {
            echo $th; // Error: Cannot access protected property Automovil::$nombre     
            // El objeto no se puede modificar;
        }
        echo br;
        try {
            // echo $atos -> nombre;
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

        // para llamar métodos estáticos lo hacemos de la siguiente forma:
        echo Automovil::showImg();
        $versa = new Automovil("Versa", 20000, false, "versa.jpg");
        echo br;
        $city = new Automovil("City", 201020, true, "city.jpg");
        echo $atos -> showImg();
        echo $versa -> showImg();
        echo $city -> showImg();
        // Vemos que al modificar la variable static en la clase, no importa qué valor le pongamos a cada automóvil, el valor final de imagen en cada automóvil dependerá de la ultima modificación hecha. 
        // Como el último que se creo y modificó fue city, entonces, los tres muestran "city.jpg";


        

    }
    // modificadores();

    // 350. Herencia;
    function herencia() {
        class Transporte {
            public function __construct(protected int $ruedas, protected int $capacidad)
            {
                
            }

            public function getInfo() : string {
                return "El transporte tiene " . $this -> ruedas . " ruedas y una capacidad de " . $this -> capacidad;
            }
        }

        class Bicicleta extends Transporte {

            // Como nombramos una función con el mismo nombre en Bicicleta y en Transporte, tenemos un método que se repite, por lo tanto, el método en Bicicleta se sobreescribe
            public function getInfo() : string {
                return "El transporte tiene " . $this -> ruedas . " ruedas y una capacidad de " . $this -> capacidad . " Y NO GASTA GASOLINA.";
            }
        }

        class Auto extends Transporte {
            public function __construct(protected int $ruedas, protected int $capacidad, protected string $transmision)
            {
                
            }

            public function getTransmision() : string {
                return $this -> transmision;
            }
        }

        $bicicleta = new Bicicleta(2, 2);
        echo $bicicleta -> getInfo();
        echo br;
        $auto = new Auto(4, 5, "Manual");
        echo $auto -> getInfo();
        echo $auto -> getTransmision();

    }
    // herencia();

    // 351. Clases Abstractas
    function clasesAbstractas() {
        //== NOTA ==//
        // Las Clases Abstractas son clases que no se pueden instansear, sólamente heredar
        abstract class Transporte_ { // con abstract ya no podemos isntansear esta clase, sólamente heredarla.
            public function __construct(protected int $ruedas, protected int $capacidad)
            {
                
            }
            public function getInfo() : string {
                return "El transporte tiene " . $this -> ruedas . " ruedas y una capacidad de " . $this -> capacidad;
            }
        }

        class Bicicleta_ extends Transporte_ {
            // Como nombramos una función con el mismo nombre en Bicicleta y en Transporte, tenemos un método que se repite, por lo tanto, el método en Bicicleta se sobreescribe
            public function getInfo() : string {
                return "El transporte tiene " . $this -> ruedas . " ruedas y una capacidad de " . $this -> capacidad . " Y NO GASTA GASOLINA.";
            }
        }

        class Auto_ extends Transporte_ {
            public function __construct(protected int $ruedas, protected int $capacidad, protected string $transmision)
            {
                
            }
            public function getTransmision() : string {
                return $this -> transmision;
            }
        }

        // $transporte = new Transporte_(2, 5); // Error. Cannot instantiate abstract class Transporte_
        // echo $transporte -> getInfo();
        echo br;
        $bicicleta = new Bicicleta_(3, 4);
        echo br;
        echo $bicicleta -> getInfo();
        $auto = new Auto_(3,1,"Manual");
        echo $auto -> getInfo();
        echo $auto -> getTransmision();
    }
    // clasesAbstractas();

    // 352. Interfaces
    function interfaces() {
        interface LibroeInterfaz {
            public function getInfo() : string;
            public function getNumPag() : int;
        }
        class Libro implements LibroeInterfaz {
            public function __construct(protected string $nombre, protected int $numPag, protected int $isbn)
            {
            }

            public function getInfo() : string {
                return "Nombre: " . $this -> nombre . " NumPág: " . $this -> numPag . " ISBN: " . $this -> isbn;
            }
            public function getNumPag(): int {
                return $this -> numPag;
            }
        }
        $libro = new Libro("El principito", 100, 123128192);
        echo $libro -> getInfo();
    }
    // interfaces();

    //  353. Polimorfismo
    function polimorfismo() {
        // El polimorfismo es la capacidad de una clase abstracta o un objeto determinado para responder a un mismo método con su propio comportamiento
        interface LibroeInterfaz_ {
            public function getInfo() : string;
            public function getNumPag() : int;
        }
        class Libro_ implements LibroeInterfaz_ {
            public function __construct(protected string $nombre, protected int $numPag, protected int $isbn)
            {
            }

            public function getInfo() : string {
                return "Nombre: " . $this -> nombre . " NumPág: " . $this -> numPag . " ISBN: " . $this -> isbn;
            }
            public function getNumPag(): int {
                return $this -> numPag;
            }
        }
        $libro = new Libro_("El principito", 100, 123128192);
        echo $libro -> getInfo();
        
        class Libreta extends Libro_ implements LibroeInterfaz_ {
            public function __construct(protected string $nombre, protected int $numPag, protected int $isbn, private bool $cuadros, private string $color)
            {
            }

            public function getInfo() : string {
                return "Nombre: " . $this -> nombre . " NumPág: " . $this -> numPag . " ISBN: " . $this -> isbn . "Cuadros?: " . $this -> cuadros;
            }

            // Se pueden implementar métodos que no están definidos en la interfaz, siempre y cuando todos los métodos de la interfaz se estén implementando, de lo contrario, habrán errores
            public function getColor() : string {
                return "El color es: " . $this -> color;
            }
        }

        $libreta = new Libreta("Z++", 100, 123123, true, "rojo");

        echo "<pre>";
        var_dump($libro);
        var_dump($libreta);
        echo "</pre>";
        echo $libreta -> getColor();
    }
    // polimorfismo();

    // 354. Autoload de clases
    function autoLoad() {
        // require './Classes/Clientes.php';
        // require './Classes/Detalles.php';   
        // En vez de utilizar require podemos utilizar AutoLoad
        function mi_autoload($clase) {
            require __DIR__ . "/Classes/" . $clase . ".php";
        }
        spl_autoload_register('mi_autoload');
        // El código anterior, carga las clases conforme se van requiriendo
        $detalles = new Detalles();
        $clientes = new Clientes();
    }
    // autoLoad();

    // 355. Namespaces
    // use App\UsuarioPro;
    // use App\UsuarioDefault;
    function nameSpaces() {
        // require './Classes/UsuarioPro.php';
        // require './Classes/UsuarioDefault.php'; 
        function autoload_($clase) {
            $cleanClass = explode("\\", $clase); //Separa un string por cada "\" que encuentre
            $cleanClass = $cleanClass[1];
            require __DIR__ . "/Classes/" . $cleanClass . ".php";
            // Otra forma de organizar el código, sería crear una carpeta con el nombre del namespace creado y crear archivos con las clases dentro de esa carpeta, así al llamar a la clase, no habría problemas con la ruta
        }
        spl_autoload_register('autoload_');
        // Podemos crear una clase que tenga el mismo nombre pero sin un namespace
        class UsuarioPro {
            public function __construct()
            {
                echo "Desde Usuario Pro en index";
            }
        }
        
        
        $pro = new App\UsuarioPro();
        echo br;
        $normal = new App\UsuarioDefault();
        echo br;
        $pro2 = new UsuarioPro();
    }
    // nameSpaces();

    // 358. Autoload con Composer
    use App\Vendedor;
    function namespacesComposer() {
        // Podemos incluir clases de namespaces con el autoload por composer
        require './vendor/autoload.php';
        $vendedor = new Vendedor();
    }
    // namespacesComposer();

    // 359. Consultar la Base de datos con POO y MySQLI
    function POO_mysqli() {
        // Conexión a la DB
        $db = new mysqli("localhost", "root", "root", "bienesraices_crud");
        // Creación del query
        $query = "SELECT titulo FROM propiedades";
        // $res = $db -> query($query);
        // En vez de utilizar $db -> query, pdemos utilizar $db -> prepare;
        // Ventajas: * seguridad, * performance;
        // Se prepara el query
        $stmt = $db -> prepare($query);
        // Ejecución del query
        $stmt -> execute();
        // Creamos la variable
        $stmt -> bind_result($res);
        // Asignamos el resultado
        $stmt -> fetch();
        echo "<pre>";
        var_dump($res);
        while($stmt -> fetch()) {
            var_dump($res);
        }
        echo "</pre>";
    }
    // POO_mysqli();

    // 360. Consultar la Base de datos con POO y PDO
    function POO_PDO() {
        // PDO soporta varias bases de datos, no sólo mysql
        $db = new PDO("mysql:host=localhost; dbname=bienesraices_crud", "root", "root");
        $query = "SELECT * FROM propiedades";
        $stmt = $db -> prepare($query);
        $stmt -> execute();
        $propiedades = $stmt -> fetchAll( PDO::FETCH_ASSOC );
        // Para "despreparar la declaración se puede usar:
        // $stmt -> closeCursor();
        // De modo que podemos volver a utilizar el stmt, incluso, si se quiere, con algún parámetro
        // $stmt -> execute();
        // PDOStatement::closeCursor() libera la conexión al servidor, 
        // por lo que otras sentencias SQL podrían ejecutarse, pero deja la sentencia 
        // en un estado que la habilita para ser ejecutada otra vez.

    }
    POO_PDO();

include 'includes/footer.php';