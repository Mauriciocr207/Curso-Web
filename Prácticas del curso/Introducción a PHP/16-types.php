<?php declare(strict_types = 1);
    include 'includes/header.php';

    // Declarando funciones y el tipo de dato que retornan
    function usuarioAuth(bool $auth) : string | int {
        if ($auth) return "Autenticado";
        else return 0;
    }

    $usuario = usuarioAuth(false);

    echo $usuario;




include 'includes/footer.php';