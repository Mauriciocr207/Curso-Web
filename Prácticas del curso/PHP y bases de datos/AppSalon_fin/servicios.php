<?php require 'includes/funciones.php';
    // Obteniendo servicios y mostrándolos
    $services = getServices();
    echo json_encode($services);
?>