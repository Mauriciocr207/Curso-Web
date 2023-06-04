<?php
    function signUp(string $email, string $password) : array {
        // Importar conexión
        $db = connectDB();
        // Obtener correo y contraseña. Validar contraseña
        $validatedEmail = mysqli_real_escape_string(
            $db,
            $email
        );
        // Validar si existe el usuario
        $query = "SELECT email, password FROM usuarios WHERE email = '$validatedEmail' ";
        $res = mysqli_query($db, $query);
        $auth = [];
        $auth["validated"] = false;
        // Validamos si el usario existe
        if( $res -> num_rows ) {
            $usuario = mysqli_fetch_assoc($res);
            // Validamos si la contraseña del usuario es correcta
            $passwordVerified = password_verify($password, $usuario["password"]);
            if( $passwordVerified ){
                $auth["validated"] = true;
            } else {
                $auth["errores"][] = "La contraseña es incorrecta";
            }
        } else {
            $auth["errores"][] = "El usuario no existe";
        }
        return $auth;
    }
    function validarDatosUsuario(array $campos) : array {
        $errores = [];
        // Array de cada campo
        // foreach ($campos as $key => $value) {
        //     if(!$value) $errores[] = "El campo " . $key . " es Obligatorio";
        // }
        if(!$campos["email"]) $errores[] = "El Email es Obligatorio";
        else {
            if(!filter_var($campos["email"], FILTER_VALIDATE_EMAIL)) $errores[] = "Email inválido";
        }
        if(!$campos["password"]) $errores[] = "La Contraseña es Obligatoria";
        return $errores;
    }

?>