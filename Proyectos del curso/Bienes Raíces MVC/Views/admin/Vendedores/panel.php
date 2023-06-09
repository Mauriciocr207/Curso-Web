<?php
    use Models\Vendedor;
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = $_POST["id"];
        $metadata = Vendedor::getById($id);
        if($metadata) {
            $propiedad = new Vendedor($metadata);
            $propiedad -> delete();
        }
    }
?>
    <a class="button" href="./Vendedores/create.php">
        Agregar vendedor
    </a>
    <div class="vendedores">
        <?php

            foreach ($vendedores as $data) {
                // Reescribimos los datos del objeto a objetos de la clase Propiedad
                $vendedor = new Vendedor($data);
        ?>
            <div class="panel_admin">
                <div class="panel_admin__img">
                    <img src="../imagenes/Vendedores/<?php echo $vendedor -> getImagen(); ?>" alt="">
                </div>
                <div class="panel_admin__content">
                    <div class="campo">
                        <div class="campo__nombre">
                            <h3>Nombre Completo:</h3>
                        </div>
                        <div class="campo__value">
                            <p><?php echo $vendedor -> getNombre() .  " " . $vendedor -> getApellido(); ?></p>
                        </div>
                    </div>
                    <div class="campo">
                        <div class="campo__nombre">
                            <h3>Teléfono:</h3>
                        </div>
                        <div class="campo__value">
                            <p><?php echo $vendedor -> getTelefono(); ?></p>
                        </div>
                    </div>
                    <div class="campo">
                        <div class="campo__nombre">
                            <h3>ID:</h3>
                        </div>
                        <div class="campo__value">
                            <p><?php echo $vendedor -> getId(); ?></p>
                        </div>
                    </div>
                    <div class="panel_admin__content--acciones">
                        <a href="./Vendedores/update.php?id=<?php echo $vendedor -> getId(); ?>" class="button actualizar">
                            Actualizar
                        </a>
                        <form action="./?panel=Vendedores" method="POST">
                            <input type="hidden" name="id" value="<?php echo $vendedor -> getId(); ?>">
                            <input type="submit" value="Eliminar" class="button eliminar">
                        </form>
                    </div>
                </div>
            </div>
        <?php
            }
        ?>
    </div>