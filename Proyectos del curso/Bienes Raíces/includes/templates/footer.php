<?php 
    $root = setRootUrl(__FILE__);
?>
    <!-- FOOTER -->
    <footer class="footer">
        <div class="box footer__box">
            <nav class="footer__box-nav">
                <a href= <?php echo $root . "nosotros.php" ?> >Nosotros</a>
                <a href= <?php echo $root . "anuncios.php" ?> >Anuncios</a>
                <a href= <?php echo $root . "blog.php" ?> >Blog</a>
                <a href= <?php echo $root . "contacto.php" ?> >Contacto</a>
            </nav>
            <p class="copyrigth">Todos los derechos reservados 2021 &copy; </p>
        </div>
    </footer>
    <!-- SCRIPTS -->
    <script src=<?php echo $root . "build/js/modernizr.js" ?> ></script>
    <script src=<?php echo $root . "build/js/app.js" ?> ></script>
</body>

</html>