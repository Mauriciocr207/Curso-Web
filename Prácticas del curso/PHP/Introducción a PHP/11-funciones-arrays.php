<?php include 'includes/header.php';
    define("br", "</br>");
    // in_array -> buscar elementos en un arreglo
    $carrito = ['Tablet', 'Computadora', 'Television'];
    var_dump( in_array('Tablet', $carrito) );
    var_dump( in_array('Audífonos', $carrito) );

    // Ordenar elementos de un arreglo
    $numeros = [1,3,4,5,1,2];
    // De menor a mayor
    sort($numeros);
    echo "<pre>";
    var_dump($numeros);
    echo "</pre>";
    echo br;
    // De mayor a menor
    rsort($numeros);
    echo "<pre>";
    var_dump($numeros);
    echo "</pre>";
    echo br;

    // Ordenando arreglos asociativos
    $cliente = [
        "saldo" => 200,
        "tipo" => "Premmium",
        "nombre" => "Juan",
        "val" => [
            "tres" => 3,
            "dos" => 2,
            "uno" => 1
        ],
        "a" => "A"
    ];
    // -> asort() para arreglos asociativos
    // -> ordena por sus valores no por sus propiedades
    asort($cliente); 
    echo "<pre>";
    var_dump($cliente);
    echo "</pre>";
    echo br;

    // igual que asort() pero ordena al revés
    arsort($cliente);
    echo "<pre>";
    var_dump($cliente);
    echo "</pre>";
    echo br;


    //  -> ksort() para arreglos asociativos
    //  -> para ordenar las propiedades de un arreglo asociativo
    ksort($cliente);
    echo "<pre>";
    var_dump($cliente);
    echo "</pre>";
    echo br;

    // Igual que ksort() pero ordena al revés
    krsort($cliente);
    echo "<pre>";
    var_dump($cliente);
    echo "</pre>";
    echo br;

include 'includes/footer.php';