<h1 class="nombre-pagina">Confirmar Cuenta</h1>
<div class="alert">
    <?php       
        if($res["res"]) {
            echo "<div class='enviado'>" . $res["message"] . "</div>";
        } else {
            echo "<div class='err'>" . $res["message"] . "</div>";  
        }
    ?>
    <div class="acciones">
        <div class="accion">
            <a href="/">Iniciar Sesión</a>
        </div>
    </div> 
</div>