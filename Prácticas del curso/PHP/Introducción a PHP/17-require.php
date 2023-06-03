<?php include 'includes/header.php';

    // ¿Cuándo usar require o include?
    // require -> Al utilizar funciones críticas para la aplicacion
    // include -> Cuando se quiera incluir templates
    // El include podría tener la capacidad de segir a pesar de no tener un archivo del include.

    // require_once
    // Revisa si el archvio ya fue incluido, si es así se ignora el require

    require 'funciones.php';
    initApp();


include 'includes/footer.php';