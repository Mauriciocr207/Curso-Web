<?php include 'includes/header.php';

    // Variables modificables
    $nombre = "Juan";
    $nombre = "Juan 2";
    // echo $nombre;
    // var_dump($nombre);
    // Variables no modificables
    define("constante", "Este es un valor constante"); //-> Más utilizada
    echo constante;
    const constante_2 = 100;
    echo constante_2;

    // Formas de crear variables
    $persona_nombre = "Juan"; //-> más utilizada
    $personaApellido = "Cabrera"; 

include 'includes/footer.php';