<?php 
    require '../includes/funciones.php';
    setTemplate('header');
    require '../includes/config/database.php';
    $db = connectDB();

    // Consultar para obtener
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);


    // Arreglo con mensajes de errores;
    $errores = [];

    // Información ingresada
    $titulo = "";
    $precio = "";
    $descripcion = "";
    $habitaciones = "";
    $wc = "";
    $estacionamiento = "";
    $vendedor_id = "";

    // Verificamos la respuesta
    $posted = "";


    
    // Ejecutar el código después de que el usuario envía el formulario
    if($_SERVER["REQUEST_METHOD"] === 'POST') {
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        // echo "<pre>";
        // var_dump($_FILES);
        // echo "</pre>";

        $titulo = mysqli_real_escape_string( $db, $_POST["titulo"] );
        $precio = mysqli_real_escape_string( $db, $_POST["precio"] );
        $descripcion = mysqli_real_escape_string( $db, $_POST["descripcion"] );
        $habitaciones = mysqli_real_escape_string( $db, $_POST["habitaciones"] );
        $wc = mysqli_real_escape_string( $db, $_POST["wc"] );
        $estacionamiento = mysqli_real_escape_string( $db, $_POST["estacionamiento"] );
        $vendedor_id = mysqli_real_escape_string( $db, $_POST["vendedor_id"] );
        $creado = date('Y/m/d');

        // Asignar files hacia una variable
        $imagen = $_FILES["imagen"];
        // var_dump($imagen["name"]);

        // Array de cada campo
        $campos = [
            "Titulo" => $titulo, 
            "Precio" => $precio, 
            "Descripcion" => $descripcion, 
            "Habitaciones" => $habitaciones, 
            "Baños" => $wc, 
            "Estacionamiento" => $estacionamiento, 
            "Vendedor" => $vendedor_id 
        ];
        foreach ($campos as $key => $value) {
            if(!$value) {
                $errores[] = "El campo " . $key . " es Obligatorio";
            }
        }
        if(strlen($descripcion) < 50) {
            $errores[] = "La Descripción es obligatoria y debe tener al menos 50 caracteres";
        }
        if(!$imagen["name"] || $imagen["error"]) {
            $errores[] = "La imagen es Obligatoria";
        }
        $maxSizeImage = 1000 * 100;
        if($imagen["size"] > $maxSizeImage) {
            $errores[] = "El tamaño máximo de la imagen son 100kb";
        }

        // Mostrar errores
        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";


        // Revisar que no haya errores
        if(empty($errores)) {
            // Insertar en la base de datos
            $query = " INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, creado, vendedor_id) VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedor_id') ";

            try {
                $res = mysqli_query($db, $query);
                if($res) {
                    $titulo = "";
                    $precio = "";
                    $descripcion = "";
                    $habitaciones = "";
                    $wc = "";
                    $estacionamiento = "";
                    $vendedor_id = "";
                }
                $posted = "Enviado correctamente";
            } catch (\Throwable $th) {
                echo $th;
            }
        }
    }
    
?>
    <main class="box">
        <section class="section create">
            <h1>Crear</h1>

            <a href="../admin" class="back">
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
                    if($posted != "") {
                        echo "<div class='enviado'>" . $posted . "</div>";
                    }

                ?>
            </div>

            <form action="./create.php" class="DB__form" method="POST" enctype="multipart/form-data" >
                <!-- INFORMACIÓN GENERAL -->
                <fieldset class="form__section">
                    <legend>Información General</legend>
                    <!-- TITULO DE PROPIEDAD -->
                    <div class="input">
                        <label class="input__label" for="titulo">Título:</label>
                        <input type="text" id="titulo" name="titulo" placeholder="Titulo de propiedad" require value=<?php echo $titulo; ?> >
                    </div>
                    <!-- PRECIO -->
                    <div class="input">
                        <label class="input__label" for="precio">Precio:</label>
                        <input type="number" id="precio"  name="precio" placeholder="Precio de propiedad" require value=<?php echo $precio; ?> >
                    </div>
                    <!-- IMAGENES -->
                    <div class="input">
                        <label for="imagen" class="input__label">Imagen: </label>
                        <input type="file" accept="image/jpg, image/jpeg, image/png"  id="imagen" name="imagen"  require  >
                    </div>
                    <!-- DESCRIPCIÓN -->
                    <div class="input">
                        <label for="" class="input__label">
                            Descripción: 
                        </label>
                        <textarea name="descripcion" id="descripcion" cols="30" rows="10" ><?php echo $descripcion; ?></textarea>
                    </div>
                </fieldset>
                <!-- INFORMACIÓN PROPIEDAD -->
                <fieldset class="form__section">
                    <legend>Información propiedad</legend>

                    <!-- HABITACIONES -->
                    <div class="input">
                        <label class="input__label" for="titulo">Habitaciones</label>
                        <input type="number" id="habitaciones" name="habitaciones" placeholder="Titulo de propiedad" require value=<?php echo $habitaciones; ?> >
                    </div>
                    <!-- BAÑOS -->
                    <div class="input">
                        <label for="" class="input__label">
                            Baños
                        </label>
                        <input type="number" id="wc"  name="wc" placeholder="Ej: 3" min="1" max="9" value=<?php echo $wc; ?>>
                    </div>
                    <!-- ESTACIONAMIENTO -->
                    <div class="input">
                        <label for="" class="input__label">
                            Estacionamiento
                        </label>
                        <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value=<?php echo $estacionamiento; ?> >
                    </div>

                </fieldset>
                <!-- VENDEDOR -->
                <fieldset class="form__section">
                    <legend>Vendedor</legend>

                    <!-- NOMBRE -->
                    <div class="input">
                        <label for="" class="input__label">
                            Nombre
                        </label>
                        <select name="vendedor" id="vendedor">
                            <option selected  disabled >Selecciona un vendedor</option>
                            <?php 
                                while($row = mysqli_fetch_assoc($resultado) ) { ?>
                                    <option 
                                        <?php echo $vendedor_id === $row["id"] ? "selected" : ""; ?>
                                        value="<?php echo $row["id"] ?>">
                                             <?php echo $row["nombre"] . " " . $row["apellido"] ?> 
                                    </option>    
                                <?php } 

                            ?>
                        </select>
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