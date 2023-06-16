<?php
    // GLOBALS
    use Dotenv\Dotenv;

    define('PROYECT__URL', dirname(dirname(__FILE__)));
    
    require PROYECT__URL . '/includes/funciones.php';
    require PROYECT__URL . '/vendor/autoload.php';
    $dotenv = Dotenv::createImmutable(PROYECT__URL);
    $dotenv -> safeload();