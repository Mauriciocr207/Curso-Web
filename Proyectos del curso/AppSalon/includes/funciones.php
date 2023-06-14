<?php

function read($var) {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}