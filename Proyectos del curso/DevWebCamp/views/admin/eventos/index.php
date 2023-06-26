<h2 class="dashboard__heading"><?php echo $titulo ?></h2>
<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/eventos/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Evento
    </a>
</div>
<div class="dashboard__box">
    <?php if(!empty($eventos)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Evento</th>
                    <th scope="col" class="table__th">Tipo</th>
                    <th scope="col" class="table__th">Dia y Hora</th>
                    <th scope="col" class="table__th">Ponente</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach($eventos as $evento) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $evento -> getNombre(); ?>
                        </td>
                        <td class="table__td">
                            <?php echo $evento -> getIdCategoria(); ?>
                        </td>
                        <td class="table__td">
                            <?php echo $evento -> getIdDia() . ", " . $evento -> getIdHora(); ?>
                        </td>
                        <td class="table__td">
                            <?php echo $evento -> getIdPonente(); ?>
                        </td>
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/eventos/editar?id=<?php echo $evento -> getId(); ?>">
                                <i class="fa-solid fa-user-pen"></i>
                                Editar
                            </a>
                            <form action="/admin/eventos/eliminar" class="table__form" method="POST">
                                <input type="hidden" value="<?php echo $evento -> getId(); ?>" name="id">
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