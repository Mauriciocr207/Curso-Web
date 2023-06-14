<?php 
    require "../../includes/app.php";
    use App\Propiedad;
    use App\Vendedor;

    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id) {
        header('Location:../admin?panel=Propiedades');
    }
    $metadata = Vendedor::getById($id);
    $vendedor = new Vendedor($metadata);
    $errores = [];
    $resDB = "";
    // Ejecutar el código después de que el usuario envía el formulario
    if($_SERVER["REQUEST_METHOD"] === 'POST') { 
        // Verificamos si se subió una nueva imagen
        $imageUpdated = !empty($_FILES["imagen"]["tmp_name"]);
        // Guardamos los datos nuevos
        $camposNew = $_POST;
        $camposNew["imagen"] = $imageUpdated ? $_FILES["imagen"]["tmp_name"] : $vendedor -> getImagen();
        $vendedor -> setVendedor($camposNew);
        
        // Validamos que no haya errores
        $errores = $vendedor -> validate();
        // Revisar que no haya errores
        if(empty($errores)) {
            // Se envían los datos
            $res = $vendedor -> update();
            if($res) $resDB = "Datos enviados correctamente";
        }
    }
    setTemplate('header');
    
?>
    <main class="box">
        <section class="section create">
            <h1>Actualizar</h1>

            <a href="../?panel=Vendedores" class="back">
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
            </a>

            <div class="alert">
                <?php  
                    foreach($errores as $err) { ?>
                        <div class="err">
                            <?php echo $err; ?>
                        </div>
                <?php         
                    }
                    if(!empty($resDB)) {
                        echo "<div class='enviado'>" . $resDB . "</div>";
                    }
                ?>
            </div>

            <form action="./update.php?id=<?php echo $id;  ?>"" class="DB__form" method="POST" enctype="multipart/form-data" >
                <!-- INFORMACIÓN GENERAL -->
                <fieldset class="form__section">
                    <legend>Información General</legend>
                    <!-- NOMBRE DEL VENDEDOR -->
                    <div class="input">
                        <label class="input__label" for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre del vendedor" require value="<?php echo $vendedor -> getNombre(); ?>" >
                    </div>
                    <!-- APELLIDO DEL VENDEDOR -->
                    <div class="input">
                        <label class="input__label" for="apellido">Apellido:</label>
                        <input type="text" id="apellido" name="apellido" placeholder="Apellido del vendedor" require value="<?php echo $vendedor -> getApellido(); ?>" >
                    </div>
                    <!-- TELÉFONO -->
                    <div class="input">
                        <label class="input__label" for="telefono">Teléfono (sin Lada):</label>
                        <input type="tel" id="telefono"  name="telefono" placeholder="Teléfono del vendedor" require value="<?php echo $vendedor -> getTelefono(); ?>" >
                    </div>
                    <!-- IMAGENES -->
                    <div class="input">
                        <label for="imagen" class="input__label">Imagen: </label>
                        <input type="file" accept="image/jpg, image/jpeg, image/png"  id="imagen" name="imagen"  require  >
                        <?php 
                            $fileImage = Vendedor::getById($id)["imagen"];
                        ?>
                        <img src="../../imagenes/Vendedores/<?php echo $fileImage; ?>" alt="" class="input__imagen">
                    </div>
                </fieldset>
                <div class="submit">
                    <input type="submit" class="button">
                </div>
            </form>
        </section>
    </main>
<?php 
    setTemplate('footer');
?>