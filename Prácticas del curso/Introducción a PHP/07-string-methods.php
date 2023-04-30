<?php include 'includes/header.php';
    define("br", "<br/>");
    // Extensión de un string
    $nombreCliente = "Juan Pablo";
    echo strlen($nombreCliente);
    // Eliminar espacios en blanco
    $texto = trim($nombreCliente);
    echo strlen($texto);
    echo br;
    // Convertirlo a mayúsculas
    echo strtoupper($nombreCliente);
    echo br;
    // Convertir a minúsculas
    echo strtolower($nombreCliente);
    echo br;
    // Comparación de strings
    $email1 = "correo@correo.com";
    $email2 = "Correo@correo.com";
    var_dump(
        strtolower($email1) === strtolower($email2)
    );

include 'includes/footer.php';