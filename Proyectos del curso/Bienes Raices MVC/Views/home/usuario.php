<?php 
    // Acceder a la página para crear un nuevo usuario
    // El usuario en este archivo ya está creado en la db
    // Importar conexión
    use Models\Database;
    // Crear un email y password
    // USUARIO
    $email = "loopcrack@gmail.com";
    // COTRASEÑA
    $password = "123456";
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
    // Query para crear usuario
    $query = "INSERT INTO usuarios (email, password) VALUES ('$email', '$passwordHashed')";
    mysqli_query($db, $query);
    Database::open();
    Database::read($query);
    Database::close();


    // Agregarlo a la base de datos
    // $res = mysqli_query($db, $query);