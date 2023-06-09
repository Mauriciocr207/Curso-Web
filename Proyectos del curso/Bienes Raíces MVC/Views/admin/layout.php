<?php
    // Validamos que haya una sesión iniciada
    session_start();
    $auth = $_SESSION["login"] ?? null;
    if( !$auth ) {
        $_SESSION = [];
        // header("Location: ./");
    }  
?>
<main class="box">
    <section class="section admin">
        <h1>Administrador de Bienes Raíces</h1>
        <div class="panel">
            <?php 
                $panels = ["propiedades", "vendedores"];
                foreach ($panels as $value) {
                    if($value == $panel) {
                        ?>
                            <a href="/admin?panel=<?php echo $value ?>" class="panel__option active">
                                <?php echo $value; ?>
                            </a>
                        <?php
                    } 
                    else {
                        ?>
                            <a href="/admin?panel=<?php echo $value ?>" class="panel__option nonactive">
                                <?php echo $value; ?>
                            </a>
                        <?php
                    }
                }
            ?>
        </div>
        <?php 
          include "../Views/admin/$panel/panel.php";
        ?>
    </section>
</main>