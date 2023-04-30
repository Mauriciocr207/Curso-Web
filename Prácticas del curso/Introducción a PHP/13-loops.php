<?php include 'includes/header.php';
    define("br", "</br>");

    // while
    $i = 0;

    while($i < 10) {
        echo $i;
        $i++;
    }
    echo br;

    // do-while
    $a = 0;
    do {
        echo $a;
        $a++;
    } while ($a <= 10);
    echo br;

    // ¿Que ocurrirá si hacemos lo siguiente?
    $j = 100;
    $k = 100;
    
    while ($j <10) {
        echo  $j  . " en while" . br;   
    }

    do {
        echo  $k . " en do-while" . br;   
    } while ($k <10);

    // Lo que ocurre es que se imprime 100 en el do-while, debido a que el do realiza la accion y luego revisa la condicion


    // For-loops
    for( $i = 0; $i < 10; $i++) {
        if($i % 3 == 0 && $i % 5 == 0) echo "FIZZ BUZZ";
        else if($i % 3 == 0) echo "Fizz";
        else if($i % 5 == 0) echo "Buzz";
        echo $i;
        echo br;
    }

    // For Each -> para arreglos
    $clientes = ["Pedro", "Juan", "Karen"];
    foreach($clientes as $cliente) {
        echo $cliente . br;
    }

    $cliente_2 = [
        "name" => "Juan",
        "saldo" => 200,
        "tipo" => "premium"
    ];
    // sobre los valores del arreglo
    foreach($cliente_2 as $p) {
        echo $p . br;
    }  
    // sobre las propiedades del arreglo
    foreach($cliente_2 as $key => $p) {
        echo $key . " => " . $p . br;
    }

include 'includes/footer.php';