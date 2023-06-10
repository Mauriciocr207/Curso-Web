<?php  
    function setRootUrl(string $dir_url = __DIR__) {
        $dirs_to_root = substr_count(PROYECT__URL, "\\");
        $dirs_to_actual = substr_count($dir_url, "\\");
        $diference_dirs = $dirs_to_actual - $dirs_to_root - 1;
        $root_to_css = str_repeat("../", $diference_dirs);
        return $root_to_css;
    };
    function setTemplate(string $template, bool $inHome = false) {
        include TEMPLATES_URL . "/$template.php";
    };
    function read($var) {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }





