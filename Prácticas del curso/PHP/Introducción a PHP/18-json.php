<?php include 'includes/header.php';

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

    echo "<pre>";
    var_dump($empleados);
    $json = json_encode($empleados, JSON_UNESCAPED_UNICODE);
    var_dump($json);
    $json_array = json_decode($json);
    var_dump($json_array);
    echo "</pre>";




include 'includes/footer.php';