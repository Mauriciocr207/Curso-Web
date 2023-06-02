<?php 
    require './includes/config/database.php';
    // Importar conexión
    $db = connectDB();

    // Crear un email y password
    $email = "mauriciocr123@outlook.com";
    $password = "rojoyazul123";
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    // Query para crear usuario
    $query = "INSERT INTO usuarios (email, password) VALUES ('$email', '$passwordHashed')";
    mysqli_query($db, $query);


    // Agregarlo a la base de datos
    // $res = mysqli_query($db, $query);