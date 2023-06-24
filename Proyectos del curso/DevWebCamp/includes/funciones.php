<?php

function read($var) {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}

// Functión que revisa que el usuario esté autenticado
function isAuth() : void {
    if(!isset($_SESSION["login"])) {
        header('Location: /');
    }
}
function isAdmin(): bool {
    $isAdmin = false;
    if(!isset($_SESSION["admin"])) {
        header('Location: /citas');
    } else {
        $isAdmin = true;
    }
    return $isAdmin;
}
function pagina_actual($path) {
    return str_contains($_SERVER['PATH_INFO'], $path);
}