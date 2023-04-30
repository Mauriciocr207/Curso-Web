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
    // Reemplazar cadenas dentro de un string
    echo str_replace("Juan", "J", $nombreCliente);
    echo br;
    // Revisar si un string existe o no
    // strpos() -> da la posicion de la cadena buscada;
    echo strpos($nombreCliente, "Juan");
    echo br;
    $tipoCliente = "Premium";
    echo "El Cliente " . $nombreCliente . " es " . $tipoCliente;
    echo br;
    echo "El Cliente {$nombreCliente} es ${tipoCliente}"; // advertencia de vscode -> using ${} in strings is deprecated

include 'includes/footer.php';