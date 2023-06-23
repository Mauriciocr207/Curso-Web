<?php 

use Dotenv\Dotenv;
use Model\ActiveRecord;
require __DIR__ . '/../vendor/autoload.php';
define('PROYECT__URL', dirname(dirname(__FILE__)));

// Añadir Dotenv
$dotenv = Dotenv::createImmutable(PROYECT__URL);
$dotenv->safeLoad();

require 'funciones.php';
require 'database.php';

// Conectarnos a la base de datos
ActiveRecord::setDB($db);