<?php include 'includes/header.php';
    define("br", "</br>");
    define("prei", "<pre>");
    define("pref", "</pre>");

    $cliente = [
        'nombre' => 'Juan',
        'saldo' => 200,
        'info' => [
            'tipo' => 'premium'
        ],
        'arr' => [1,1,1]
    ];
    echo prei;
    var_dump($cliente);
    echo pref;
    echo br;
    echo $cliente['nombre'];
    echo br;
    echo $cliente['info']['tipo'];
    // Agregando propiedades a un arreglo asociativo
    $cliente["codigo"] = 12312412;
    echo prei;
    var_dump($cliente);
    echo pref;
    echo br;



include 'includes/footer.php';