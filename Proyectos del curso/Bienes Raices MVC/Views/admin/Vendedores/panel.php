<a class="button" href="/admin/vendedores/create">
    Agregar Vendedor
</a>
<?php 
    if(isset($error)) { ?>
        <div class="alert" style="margin-top: 2rem;">
            <div class="err"><?php echo $error ?></div>
        </div>
    <?php
    }
?>
<div class="vendedores">
    <?php
        foreach ($vendedores as $vendedor) {
    ?>
        <div class="panel_admin">
            <div class="panel_admin__img">
                <img src="/Imagenes/vendedores/<?php echo $vendedor -> getImagen(); ?>" alt="">
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
                    <a href="/admin/vendedores/update?id=<?php echo $vendedor -> getId(); ?>" class="button actualizar">
                        Actualizar
                    </a>
                    <form action="/admin?panel=vendedores" method="POST">
                        <input type="hidden" name="object" value="vendedor">
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