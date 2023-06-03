<?php
    require '../includes/funciones.php';
    require '../includes/manageDB/propiedades.php';
    
    // Validamos que haya una sesión iniciada
    session_start();
    $auth = $_SESSION["login"];
    if( !$auth ) {
        $_SESSION = [];
        header("Location: ./");
    }

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = $_POST["id"];
        $imagen = $_POST["imagen"];
        borrarPropiedad($id);
        eliminarArchivoImagen($imagen);
    }
    $propiedades = obtenerPropiedades();

    setTemplate('header');
?>
<main class="box">
    <section class="section admin">
        <h1>Administrador de Bienes Raíces</h1>

        <a class="button " href="../admin/create.php">
            Nueva Propiedad
        </a>
        <div class="propiedades">
            <?php
                foreach ($propiedades as $propiedad) {
            ?>
                    <div class="propiedad_admin">
                        <div class="propiedad_admin__img">
                            <img src="../imagenes/<?php echo $propiedad["imagen"]; ?>" alt="">
                        </div>
                        <div class="propiedad_admin__content">
                            <div class="campo">
                                <div class="campo__nombre">
                                    <h3>Título:</h3>
                                </div>
                                <div class="campo__value">
                                    <p><?php echo $propiedad["titulo"]; ?></p>
                                </div>
                            </div>
                            <div class="campo">
                                <div class="campo__nombre">
                                    <h3>Precio:</h3>
                                </div>
                                <div class="campo__value">
                                    <p>$<?php echo $propiedad["precio"]; ?></p>
                                </div>
                            </div>
                            <div class="campo">
                                <div class="campo__nombre">
                                    <h3>ID:</h3>
                                </div>
                                <div class="campo__value">
                                    <p><?php echo $propiedad["id"]; ?></p>
                                </div>
                            </div>
                            <div class="propiedad_admin__content--acciones">
                                <a href="./admin/update.php?id=<?php echo $propiedad["id"]; ?>" class="button actualizar">
                                    Actualizar
                                </a>
                                <form action="./admin" method="POST">
                                    <input type="hidden" name="imagen" value="<?php echo $propiedad["imagen"]; ?>">
                                    <input type="hidden" name="id" value="<?php echo $propiedad["id"]; ?>">
                                    <input type="submit" value="Eliminar" class="button eliminar">
                                </form>
                            </div>
                        </div>
                    </div>
            <?php
                }
            ?>
        </div>
    </section>
</main>

<?php
setTemplate('footer');
?>