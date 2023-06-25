<h2 class="dashboard__heading"><?php echo $titulo ?></h2>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/ponentes/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Ponente
    </a>
</div>
<div class="dashboard__box">
    <?php if(!empty($ponentes)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Ubicación</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach($ponentes as $ponente) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $ponente -> getNombre() . " " . $ponente -> getApellido(); ?>
                        </td>
                        <td class="table__td">
                            <?php echo $ponente -> getCiudad() . ", " . $ponente -> getPais(); ?>
                        </td>
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/ponentes/editar?id=<?php echo $ponente -> getId(); ?>">
                                <i class="fa-solid fa-user-pen"></i>
                                Editar
                            </a>
                            <form action="/admin/ponentes/eliminar" class="table__form" method="POST">
                                <input type="hidden" value="<?php echo $ponente -> getId(); ?>" name="id">
                                <button type="submit" class="table__accion table__accion--eliminar">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    Eliminar
                                </button>
                            </form>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else {?>
        <p class="text-center">
            No hay ponentes aún
        </p>
    <?php } ?>
</div>
<?php 
    echo $paginacion;
?>