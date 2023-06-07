<?php
    require "../includes/app.php";
    use App\Propiedad;
    // Validamos que haya una sesión iniciada
    session_start();
    $auth = $_SESSION["login"];
    if( !$auth ) {
        $_SESSION = [];
        header("Location: ./");
    }

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = $_POST["id"];
        $metadata = Propiedad::getPropiedadById($id);
        if($metadata) {
            $propiedad = new Propiedad($metadata);
            $propiedad -> delete();
        }

    }
    
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
                $propiedades = Propiedad::getAll() ?? [];
                foreach ($propiedades as $propiedad) {
                    // Reescribimos los datos del objeto a objetos de la clase Propiedad
                    $propiedad = new Propiedad($propiedad);
            ?>
                    <div class="propiedad_admin">
                        <div class="propiedad_admin__img">
                            <img src="../imagenes/<?php echo $propiedad -> getImagen(); ?>" alt="">
                        </div>
                        <div class="propiedad_admin__content">
                            <div class="campo">
                                <div class="campo__nombre">
                                    <h3>Título:</h3>
                                </div>
                                <div class="campo__value">
                                    <p><?php echo $propiedad -> getTitulo(); ?></p>
                                </div>
                            </div>
                            <div class="campo">
                                <div class="campo__nombre">
                                    <h3>Precio:</h3>
                                </div>
                                <div class="campo__value">
                                    <p>$<?php echo $propiedad -> getPrecio(); ?></p>
                                </div>
                            </div>
                            <div class="campo">
                                <div class="campo__nombre">
                                    <h3>ID:</h3>
                                </div>
                                <div class="campo__value">
                                    <p><?php echo $propiedad -> getId(); ?></p>
                                </div>
                            </div>
                            <div class="propiedad_admin__content--acciones">
                                <a href="./admin/update.php?id=<?php echo $propiedad -> getId(); ?>" class="button actualizar">
                                    Actualizar
                                </a>
                                <form action="./admin" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $propiedad -> getId(); ?>">
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