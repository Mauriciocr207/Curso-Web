<?php

function read($var) {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}

// Functión que revisa que el usuario esté autenticado

session_start();
function isAuth() {
    $isAuth = false;
    if( (isset($_SESSION["nombre"])) ) {
        $isAuth = true;
    }
    return $isAuth;
}
function isAdmin() {
    $isAdmin = false;
    if( isAuth() && $_SESSION["admin"]) {
        $isAdmin = true;
    }
    return $isAdmin;
}
function pagina_actual($path) {
    return str_contains($_SERVER['PATH_INFO'], $path);
}