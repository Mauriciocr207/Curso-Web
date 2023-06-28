<main class="pagina">
    <h2 class="pagina__heading"><?php echo $titulo; ?></h2>
    <p class="pagina__descripcion">
        Tu Boleto - Te recomendamos almacenarlo, puedes compartirlo en redes sociales.
    </p>
    <div class="boleto-virtual boletos__grid">
        <div class="boleto boleto--acceso boleto--<?php echo strtolower($registro -> getIdPaquete()["nombre"]); ?>">
            <div class="boleto__contenido">
                <h4 class="boleto__logo">&#60;DevWebCamp/></h4>
                <p class="boleto__plan"><?php echo $registro -> getIdPaquete()["nombre"]; ?></p>
                <p class="boleto__nombre"><?php echo $registro -> getIdUsuario()["nombre"] . " " . $registro -> getIdUsuario()["apellido"]; ?></p>
            </div>
            <div class="boleto__codigo">
                #<?php echo $registro -> getToken(); ?>    
            </div>
        </div>
    </div>
</main>