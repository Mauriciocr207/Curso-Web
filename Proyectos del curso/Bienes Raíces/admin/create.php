<?php 
    require '../includes/funciones.php';
    require '../includes/config/database.php';
    require '../includes/manageDB/propiedades.php';
    require '../includes/manageDB/vendedores.php';
    setTemplate('header');
    // Información ingresada
    $campos = [
        "titulo" => "",
        "precio" => "",
        "descripcion" => "",
        "habitaciones" => "",
        "wc" => "",
        "estacionamiento" => "",
        "vendedor" => "",
        "creado" => "",
        "imagen" => "",
    ]; 
    $respuesta = "";
    // Ejecutar el código después de que el usuario envía el formulario
    if($_SERVER["REQUEST_METHOD"] === 'POST') {
        $campos["titulo"] = $_POST["titulo"];
        $campos["precio"] = $_POST["precio"];
        $campos["descripcion"] = $_POST["descripcion"];
        $campos["habitaciones"] = $_POST["habitaciones"];
        $campos["wc"] = $_POST["wc"];
        $campos["estacionamiento"] = $_POST["estacionamiento"];
        $campos["vendedor"] = $_POST["vendedor"];
        $campos["creado"] = date('Y/m/d');
        // Asignar files hacia una variable
        $campos["imagen"] = $_FILES["imagen"];

        // Validamos datos
        $errores = validarDatos($campos);
        // Revisar que no haya errores
        if(empty($errores)) {
            // Se envían los datos
            $res = enviarDatos($campos);
            if($res) {
                $respuesta = "Datos enviados correctamente";
                foreach ($campos as $key => $value) {
                    $campos[$key] = "";
                }
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
                    if($respuesta != "") {
                        echo "<div class='enviado'>" . $respuesta . "</div>";
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
                        <input type="text" id="titulo" name="titulo" placeholder="Titulo de propiedad" require value=<?php echo $campos["titulo"]; ?> >
                    </div>
                    <!-- PRECIO -->
                    <div class="input">
                        <label class="input__label" for="precio">Precio:</label>
                        <input type="number" id="precio"  name="precio" placeholder="Precio de propiedad" require value=<?php echo $campos["precio"]; ?> >
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
                        <textarea name="descripcion" id="descripcion" cols="30" rows="10" placeholder="Ingresa una descripcion"><?php echo $campos["descripcion"]; ?></textarea>
                    </div>
                </fieldset>
                <!-- INFORMACIÓN PROPIEDAD -->
                <fieldset class="form__section">
                    <legend>Información propiedad</legend>

                    <!-- HABITACIONES -->
                    <div class="input">
                        <label class="input__label" for="titulo">Habitaciones</label>
                        <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" require value=<?php echo $campos["habitaciones"]; ?> >
                    </div>
                    <!-- BAÑOS -->
                    <div class="input">
                        <label for="" class="input__label">
                            Baños
                        </label>
                        <input type="number" id="wc"  name="wc" placeholder="Ej: 3" min="1" max="9" value=<?php echo $campos["wc"]; ?>>
                    </div>
                    <!-- ESTACIONAMIENTO -->
                    <div class="input">
                        <label for="" class="input__label">
                            Estacionamiento
                        </label>
                        <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value=<?php echo $campos["estacionamiento"]; ?> >
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
                                $vendedores = consultarVendedores();
                                foreach( $vendedores as $vendedor ) { ?>
                                    <?php  
                                        echo $campos["vendedor"];
                                    ?>
                                     <option 
                                        <?php echo $campos["vendedor"] == $vendedor["id"] ? "selected" : ""; ?>
                                        value=<?php echo $vendedor["id"] ?>
                                     > <?php echo $vendedor["nombre"]; ?> </option>
                                <?php  
                                }
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