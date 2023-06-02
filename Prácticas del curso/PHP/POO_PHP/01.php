<?php 
declare(strict_types = 1);
include 'includes/header.php';
// Definir clase
class Producto {
    // Crear constructor de la clase
    public function __construct(public string $nombre, public int $precio, public bool $disponible) {
    }
}
// Instanciar clases
$producto = new Producto("Televisión", 12312, true);
$producto2 = new Producto("Monitor", 3132, false);

// echo "El Producto es: " . $producto -> nombre;
// echo "El precio es: " . $producto -> precio;
// echo "Disponible ? : " . $producto -> disponible;

// Crear métodos para Clases
class Electronica {
    public function __construct(public string $nombre, public int $precio, public bool $disponible)
    {    
    }

    public function mostrarProducto() {
        echo "<pre>";
        var_dump($this -> nombre);
        var_dump($this -> precio);
        var_dump($this -> disponible);
        echo "</pre>";
        echo "Nombre: " . $this -> nombre . "hola";
    }
}

$arduino = new Electronica("Arduino Uno", 150, true);
$Esp32 = new Electronica("ESP32", 200, false);

$arduino -> mostrarProducto();

include 'includes/footer.php';