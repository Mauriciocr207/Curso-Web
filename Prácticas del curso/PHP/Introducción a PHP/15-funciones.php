<?php 
    declare(strict_types = 1);
    include 'includes/header.php';
    define("br", "</br>");

    // Declarar una funcion
    function sum() {
        echo 2+2;
    };

    function sum2($num1, $num2) {
        echo $num1;
        echo $num1 + $num2;
    };
    sum2(num2: 4, num1: 10);
    // Funciones con argumentos
    function sayHi($name) {
        echo "Hi " . $name . "!!!" . br;
    };
    // Crear arreglo asociativo con nombre, puesto y edad
    $empleados = array(
        array("nombre" => "Juan", "puesto" => "Gerente", "edad" => 35),
        array("nombre" => "María", "puesto" => "Contadora", "edad" => 28),
        array("nombre" => "Pedro", "puesto" => "Vendedor", "edad" => 22),
        array("nombre" => "Sofía", "puesto" => "Administradora", "edad" => 40),
        array("nombre" => "Jorge", "puesto" => "Analista", "edad" => 30),
        array("nombre" => "Ana", "puesto" => "Secretaria", "edad" => 25),
        array("nombre" => "Luis", "puesto" => "Ingeniero", "edad" => 27),
        array("nombre" => "Karla", "puesto" => "Diseñadora", "edad" => 33),
        array("nombre" => "Roberto", "puesto" => "Programador", "edad" => 29),
        array("nombre" => "Mónica", "puesto" => "Analista de sistemas", "edad" => 31)
    );
    
    // Utilizar la función que creamos para el arreglo asociativo
    foreach($empleados as $e) {
        sayHi($e["nombre"]);
    }

    
    // Funciones con tipado
    function chatGptAnswer(string $pregunta) {
        echo "seguramente tengo una respuesta para tu pregunta: " . $pregunta;
    }
    // Se muestra un error al haber ingresado un entero y no un string como lo requiere la funcion y esta no se ejecuta;
    // chatGptAnswer(12);
    chatGptAnswer("¿Qué es el tiempo?");

    




include 'includes/footer.php';