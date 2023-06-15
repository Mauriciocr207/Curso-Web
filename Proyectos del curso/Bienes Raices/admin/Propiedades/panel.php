<?php
    use App\Propiedad;
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = $_POST["id"];
        $metadata = Propiedad::getById($id);
        if($metadata) {
            $propiedad = new Propiedad($metadata);
            $propiedad -> delete();
        }
    }
?>
    <a class="button " href="./Propiedades/create.php">
        Agregar Propiedad
    </a>
    <div class="propiedades">
        <?php
            $propiedades = Propiedad::getAll() ?? [];
            foreach ($propiedades as $propiedad) {
                // Reescribimos los datos del objeto a objetos de la clase Propiedad
                $propiedad = new Propiedad($propiedad);
        ?>
                <div class="panel_admin">
                    <div class="panel_admin__img">
                        <img src="../imagenes/Propiedades/<?php echo $propiedad -> getImagen(); ?>" alt="">
                    </div>
                    <div class="panel_admin__content">
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
                        <div class="panel_admin__content--acciones">
                            <a href="./Propiedades/update.php?id=<?php echo $propiedad -> getId(); ?>" class="button actualizar">
                                Actualizar
                            </a>
                            <form action="./?panel=Propiedades" method="POST">
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