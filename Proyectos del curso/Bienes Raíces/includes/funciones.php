<?php   
    require 'app.php';
    function setTemplate(string $template, bool $inHome = false) {
        include TEMPLATES_URL . "/$template.php";
    };

