<?php
    // Definir tu zona horaria
    $miZonaHoraria = 'America/Mexico_City'; // Cambia esto a tu zona horaria

    // Crear un objeto DateTime con la zona horaria definida
    $fechaHora = new DateTime('now', new DateTimeZone($miZonaHoraria));

    // Obtener la hora actual en tu zona horaria
    $horaActual = $fechaHora->format('H');
    $saludo = "Buenos días";
    if($horaActual >= 12 && $horaActual <=18) {
        $saludo = "Buenas Tardes";
    }
    else if($horaActual >= 18 && $horaActual <= 24) {
        $saludo = "Buenas Noches";
    }
?>
<div class="barra">
    <p><?php echo $saludo ?> <span><?php echo $usuario -> getNombre(); ?></span></p>
    <a class="logout" href="/logout" class="cerrar-sesion">
        <i class="fa-solid fa-right-from-bracket"></i>
    </a>
</div>