<div class="alert">
    <?php  
        if(isset($errores)) {
            foreach($errores as $err) { ?>
                <div class="err">
                    <?php echo $err; ?>
                </div>
    <?php         
            }
        }
        if(isset($res["res"])) {
            if($res["res"]) {
                echo "<div class='enviado'>" . $res["message"] . "</div>";
            } else {
                echo "<div class='err'>" . $res["message"] . "</div>";  
            }
        }
    ?>
</div>