<?php 
    require '../../includes/funciones.php';
    setTemplate('header');
?>
    <main class="box">
        <section class="section create">
            <h1>Crear</h1>

            <a class="button" href="../admin">
                Voler
            </a>
            <form action="" class="DB__form">
                <fieldset class="form__section">
                    <legend>Información General</legend>
                    <!-- TITULO DE PROPIEDAD -->
                    <div class="input">
                        <label class="input__label" for="titulo">Título:</label>
                        <input type="email" id="title" placeholder="Titulo de propiedad" require>
                    </div>
                    <!-- PRECIO -->
                    <div class="input">
                        <label class="input__label" for="precio">Precio:</label>
                        <input type="number" id="precio" placeholder="Precio de propiedad" require>
                    </div>
                    <!-- IMAGENES -->
                    <div class="input">
                        <label for="imagen" class="input__label">
                        
                        </label>
                        <input type="file" accept="image/jpeg, image/png " require>
                    </div>
                    <!-- DESCRIPCIÓN -->
                    <div class="input">
                        <label for="" class="input__label">
                            Descripción
                        </label>
                        <textarea name="" id="" cols="30" rows="10" require></textarea>
                    </div>

                </fieldset>
            </form>
        </section>
    </main>

<?php 
    setTemplate('footer', inAdmin: true);
?>