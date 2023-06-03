<?php include 'includes/header.php';
    // Definimos un espaciado para no duplicar tanto códiga
    define("br", "<br/>");
    $num1 = 20;
    $num2 = 30;
    $num3 = 30;
    $num4 = "30";
    // Operadores lógicos
    var_dump($num1 > $num2);
    echo br;
    var_dump($num1 < $num2);
    echo br;
    var_dump($num1 >= $num2);
    echo br;
    var_dump($num1 <= $num2);
    echo br;
    var_dump($num2 == $num3);
    echo br;
    var_dump($num3 === $num4);
    echo br;
    // Este operador 
    // -1 -> izquierda mayor
    // 0 -> iguales
    // 1 -> izquierda mayor 
    var_dump($num2 <=> $num1);
    
include 'includes/footer.php';