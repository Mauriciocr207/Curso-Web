<?php
$db = mysqli_connect(
    hostname: $_ENV['DB_HOST'],
    username: $_ENV['DB_USER'], 
    password: $_ENV['DB_PASSWORD'], 
    database: $_ENV['DB_NAME'],
    port: 3306,
);

if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
