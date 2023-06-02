<?php include 'includes/header.php';
    define("br", "</br>");
    define("prei", "<pre>");
    define("pref", "</pre>");

    $carrito = ['Tablet', 'Television', 'Computadora'];
    echo prei;
    var_dump($carrito);
    echo pref;
    // Accedeer a un elemento del array
    echo $carrito[1];
    echo br;
    // Agregar elementos al arreglo
    $carrito[5] = 'Teclado';
    echo prei;
    var_dump($carrito);
    echo pref;
    var_dump($carrito[3], $carrito[5]);
    // Añadir elemento nuevo al final
    array_push($carrito, 'Audifonos');
    echo prei;
    var_dump($carrito);
    echo pref;
    echo br;
    // Añadir al inicio
    array_unshift($carrito, 'SmartWatch');
    echo prei;
    var_dump($carrito);
    echo pref;
    echo br;
    // Algo interesante hasta este punto es que al hacer el push el ultimo índice era 6, pero al hacer un unshift, todo el array se devolvió ordenado, de modo que ahora el indice va del 0 al 5, ya no como 0,1,2,5,6;  omo originalmente había quedado antes del unshift

    // Ora forma de crear arreglos
    $clientes = array('1','2','3');
    echo prei;
    var_dump($clientes);
    echo pref;
    echo br;
    echo $clientes[1];
    echo br;

include 'includes/footer.php';