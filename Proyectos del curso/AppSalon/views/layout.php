<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Salón</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="build/css/app.css">
    <script src="https://kit.fontawesome.com/d10d1e89d5.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="contenedor-app">
        <div class="imagen">
            <picture>
                <source srcset="build/img/1.avif" type="image/avif">
                <source srcset="build/img/1.webp" type="image/webp">
                <img loading="lazy" src="build/img/1.jpg" alt="imagen corte de barba">
            </picture>
        </div>
        <div class="appContainer">
            <?php echo $content; ?>
        </div>
    </div>

    <?php
        echo $script ?? '';
    ?>
    <script src="build/js/app.js"></script>
</body>

</html>