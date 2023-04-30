<?php include 'includes/header.php';
    define("br", "</br>");
    $admin = true;
    $auth = true;
    if($auth) {
        echo "auth correctamente";
    } else {
        echo "acceso denegado";
    }
    echo br;

    if($auth && $admin) {
        echo "Acceso total";
    } else {
        echo "No acceso total";
    }
    echo br;

    // if anidados x_x
    $cliente = [
        "nombre" => "Juan",
        "saldo" => 200,
        "info" => [
            "tipo" => "Premium"
        ]
    ];
    if(!empty($cliente)) {
        echo "no-empty";
        echo br;
        if($cliente["saldo"] > 0) {
            echo "saldo disponible";
        } else {
            echo "sin saldo";
        }
    }
    else echo "empty";
    echo br;

    if($cliente["saldo"] > 0) {
        echo "saldo disponible 2";
    } else if($cliente["info"]["tipo"] === "Premium") {
        echo "Premium client";
    } else {
        echo "sin data";
    }
    echo br;


    // switch
    $tech = "php";
    switch ($tech) {
        case 'php':
            echo "php, nice tech";
            echo br;
            break;
        case 'nextjs':
            echo "but nextjs, this... this is all you need";
            echo br;
            break;
        default:
            echo "u know, js first";
            break;
    }

include 'includes/footer.php';