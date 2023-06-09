<?php
    require "../includes/app.php";
    // Validamos que haya una sesión iniciada
    if( !isset($_GET["panel"]) ) {
        header('Location: ./admin/?panel=Propiedades');
    }
    session_start();
    $auth = $_SESSION["login"];
    if( !$auth ) {
        $_SESSION = [];
        header("Location: ./");
    }    
    setTemplate('header');
?>
<main class="box">
    <section class="section admin">
        <h1>Administrador de Bienes Raíces</h1>
        <?php 
            $panel = ["Propiedades", "Vendedores"];
            $activePanel = ""; 
        ?>
        <div class="panel">
            <?php 
                foreach($panel as $value) {
                    if($_GET["panel"] == $value) {
                        $activePanel = $value;
                        ?>
                            <a href="./?panel=<?php echo $value ?>" class="panel__option active">
                                <?php echo $value; ?>
                            </a>
                        <?php
                    } else {
                        ?>
                            <a href="./?panel=<?php echo $value ?>" class="panel__option nonactive">
                                <?php echo $value; ?>
                            </a>
                        <?php
                    }
                }
            ?>
        </div>
        <?php 
          require "./" . $activePanel . "/panel.php";
        ?>
    </section>
</main>

<?php
setTemplate('footer');
?>