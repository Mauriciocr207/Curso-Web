<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raíces</title>
    <link rel="stylesheet" href="build/css/app.css">
    <script src="https://kit.fontawesome.com/d10d1e89d5.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- HEADER -->
    <header class="header <?php echo $inHome ? 'home' : ''; ?>">
        <div class="box header__box">
            <div class="header__box--bar ">
                <a class="bar__logo" href="./">
                    <img src="build/img/logo.svg" alt="">
                </a>
                <nav class="bar__nav">
                    <a href="nosotros.php">Nosotros</a>
                    <a href="anuncios.php">Anuncios</a>
                    <a href="blog.php">Blog</a>
                    <a href="contacto.php">Contacto</a>
                    <div class="theme__button">
                        <i class="icon fa-solid fa-sun"></i>
                        <input class="checkbox" type="checkbox">
                    </div>
                    <div class="responsive__button">
                        <i class="fa-solid fa-bars-staggered"></i>
                        <input class="checkbox" type="checkbox">
                    </div>
                </nav>
            </div>
            <?php echo $inHome ? '<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>' : ''; ?>
        </div>
    </header>