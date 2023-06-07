<?php 
    require "../includes/app.php";
    use App\Propiedad;
    use App\Vendedor;
    $camposNew = $_POST;
    $camposNew["imagen"] = $_FILES["imagen"]["tmp_name"] ?? "";
    $camposNew["creado"] = date('Y/m/d');
    $propiedad = new Propiedad($camposNew);
    $errores = [];
    $resDB = "";

    // Ejecutar el código después de que el usuario envía el formulario
    if($_SERVER["REQUEST_METHOD"] === 'POST') { 
        $errores = $propiedad -> validateData();
        // Revisar que no haya errores
        if(empty($errores)) {
            // Se envían los datos
            $res = $propiedad -> save();
            if($res) {
                $propiedad -> clean(); // Se limpian los datos
                $resDB = "Datos enviados correctamente";
            }
        }
    }
    setTemplate('header');
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
                    if(!empty($resDB)) {
                        echo "<div class='enviado'>" . $resDB . "</div>";
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
                        <input type="text" id="titulo" name="titulo" placeholder="Titulo de propiedad" require value="<?php echo $propiedad -> getTitulo(); ?>" >
                    </div>
                    <!-- PRECIO -->
                    <div class="input">
                        <label class="input__label" for="precio">Precio:</label>
                        <input type="number" id="precio"  name="precio" placeholder="Precio de propiedad" require value="<?php echo $propiedad -> getPrecio(); ?>" >
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
                        <textarea name="descripcion" id="descripcion" cols="30" rows="10" placeholder="Ingresa una descripcion"><?php echo $propiedad -> getDescripcion(); ?></textarea>
                    </div>
                </fieldset>
                <!-- INFORMACIÓN PROPIEDAD -->
                <fieldset class="form__section">
                    <legend>Información propiedad</legend>

                    <!-- HABITACIONES -->
                    <div class="input">
                        <label class="input__label" for="titulo">Habitaciones</label>
                        <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" require value="<?php echo $propiedad -> getHabitaciones(); ?>" >
                    </div>
                    <!-- BAÑOS -->
                    <div class="input">
                        <label for="" class="input__label">
                            Baños
                        </label>
                        <input type="number" id="wc"  name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $propiedad -> getWc(); ?>" >
                    </div>
                    <!-- ESTACIONAMIENTO -->
                    <div class="input">
                        <label for="" class="input__label">
                            Estacionamiento
                        </label>
                        <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $propiedad -> getEstacionamiento(); ?>" >
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
                        <select name="vendedor_id" id="vendedor">
                            <option selected value="" disabled>Selecciona un vendedor</option>
                            <?php
                                // VENDEDORES
                                $vendedoresData = Vendedor::getAll();
                                $vendedores = [];
                                foreach($vendedoresData as $data) {
                                    $vendedores[] = new Vendedor($data);
                                }
                                foreach( $vendedores as $vendedor ) { ?>
                                     <option 
                                        <?php echo $propiedad -> getVendedor() == $vendedor -> getId() ? "selected" : ""; ?>
                                        value="<?php echo $vendedor -> getId() ?>"
                                     > <?php echo $vendedor -> getNombre() . " " . $vendedor -> getApellido(); ?> </option>
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