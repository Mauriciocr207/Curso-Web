<h2 class="dashboard__heading"><?php echo $titulo ?></h2>
<div class="dashboard__box">
    <?php if(!empty($registros)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Email</th>
                    <th scope="col" class="table__th">Plan</th>
                    <th scope="col" class="table__th">PayPal Payment Id</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach($registros as $registro) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $registro -> getIdUsuario()["nombre"] . " " . $registro -> getIdUsuario()["apellido"]; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $registro -> getIdUsuario()["email"]; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $registro -> getIdPaquete()["nombre"]; ?>
                        </td>
                        <td class="table__td">
                            <?php echo empty($registro -> getIdPago()) ? "N/A" : $registro -> getIdPago(); ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else {?>
        <p class="text-center">
            No hay registros aún
        </p>
    <?php } ?>
</div>
<?php 
    echo $paginacion;
?>