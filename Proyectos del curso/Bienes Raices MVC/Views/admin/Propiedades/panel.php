<a class="button " href="admin/propiedades/create">
    Agregar Propiedad
</a>
<div class="propiedades">
    <?php
        foreach ($propiedades as $propiedad) {
    ?>
            <div class="panel_admin">
                <div class="panel_admin__img">
                    <img src="/imagenes/Propiedades/<?php echo $propiedad -> getImagen(); ?>" alt="">
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
                        <a href="/admin/propiedades/update?id=<?php echo $propiedad -> getId(); ?>" class="button actualizar">
                            Actualizar
                        </a>
                        <form action="/admin?panel=propiedades" method="POST">
                            <input type="hidden" name="object" value="propiedad">
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