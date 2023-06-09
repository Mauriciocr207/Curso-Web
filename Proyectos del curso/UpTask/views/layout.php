<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UpTask : <?php echo $titulo ?? "" ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=Open+Sans&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="/build/css/app.css">
    <!-- FONTAWESOME -->
    <script src="https://kit.fontawesome.com/d10d1e89d5.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php 
        echo $content;
        echo "<div>";
        if(isset($script)) {
            $script .= "<script src='/build/js/theme.js'></script>";
            echo $script;
        }
        echo "</div>";
    ?>

</body>
</html>