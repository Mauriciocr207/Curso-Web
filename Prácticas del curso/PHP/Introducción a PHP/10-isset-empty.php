<?php include 'includes/header.php';
    $clientes = [];
    $clientes_2 = array();
    $clientes_3 = array('Pedro', 'Juan', 'Karen');
    $clientes_5 = [
        'nombre' => 'Juan',
        'saldo' => 200
    ];

    // Verificar si un array está vacío
    var_dump( empty($clientes) );
    var_dump( empty($clientes_2) );
    var_dump( empty($clientes_3) );
    
    // Revisar si un arreglo está creado o una propiedad definida
    var_dump( isset($clientes_4) );
    var_dump( isset($clientes_2) );
    var_dump( isset($clientes_5['nombre']) );
    var_dump( isset($clientes_5['apellido']) );
    var_dump( isset($clientes_3[3]) );


include 'includes/footer.php';