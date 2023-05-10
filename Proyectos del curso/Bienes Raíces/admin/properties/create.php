<?php 
    require '../../includes/funciones.php';
    setTemplate('header');

    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";
?>
    <main class="box">
        <section class="section create">
            <h1>Crear</h1>

            <a href="../admin" class="back">
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
            </a>
            <form action="" class="DB__form" method="POST" >
                <!-- INFORMACIÓN GENERAL -->
                <fieldset class="form__section">
                    <legend>Información General</legend>
                    <!-- TITULO DE PROPIEDAD -->
                    <div class="input">
                        <label class="input__label" for="titulo">Título:</label>
                        <input type="text" id="titulo" name="titulo" placeholder="Titulo de propiedad" require>
                    </div>
                    <!-- PRECIO -->
                    <div class="input">
                        <label class="input__label" for="precio">Precio:</label>
                        <input type="number" id="precio"  name="precio" placeholder="Precio de propiedad" require>
                    </div>
                    <!-- IMAGENES -->
                    <div class="input">
                        <label for="imagen" class="input__label">Imagen: </label>
                        <input type="file" accept="image/jpeg, image/png "  id="imagen" name="imagen"  require>
                    </div>
                    <!-- DESCRIPCIÓN -->
                    <div class="input">
                        <label for="" class="input__label">
                            Descripción: 
                        </label>
                        <input type="number" id="descripcion" name="descripcion" placeholder="Ej: 3" min="1" max="9">
                    </div>
                </fieldset>
                <!-- INFORMACIÓN PROPIEDAD -->
                <fieldset class="form__section">
                    <legend>Información propiedad</legend>

                    <!-- HABITACIONES -->
                    <div class="input">
                        <label class="input__label" for="titulo">Habitaciones</label>
                        <input type="number" id="habitaciones" name="habitaciones" placeholder="Titulo de propiedad" require>
                    </div>
                    <!-- BAÑOS -->
                    <div class="input">
                        <label for="" class="input__label">
                            Baños
                        </label>
                        <input type="number" id="wc"  name="wc" placeholder="Ej: 3" min="1" max="9">
                    </div>
                    <!-- ESTACIONAMIENTO -->
                    <div class="input">
                        <label for="" class="input__label">
                            Estacionamiento
                        </label>
                        <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9">
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
                            <option value="1">Juan</option>
                            <option value="2">Karen</option>
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
    setTemplate('footer', inAdmin: true);
?>