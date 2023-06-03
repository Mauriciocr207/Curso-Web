<?php 
    // Este script es únicamente para crear un usuario y su contraseña;
    require './includes/config/database.php';
    // Importar conexión
    $db = connectDB();

    // Crear un email y password
    // USUARIO
    $email = "loopcrack@gmail.com";
    // COTRASEÑA
    $password = "123456";
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    // Query para crear usuario
    $query = "INSERT INTO usuarios (email, password) VALUES ('$email', '$passwordHashed')";
    mysqli_query($db, $query);


    // Agregarlo a la base de datos
    // $res = mysqli_query($db, $query);