<?php include 'includes/header.php';

    $productos = [
        [
            "nombre" => "Tablet",
            "precio" => 200,
            "disponible" => true
        ],
        [
            "nombre" => "Television",
            "precio" => 300,
            "disponible" => false
        ],
        [
            "nombre" => "Laptop",
            "precio" => 256,
            "disponible" => false
        ],
        [
            "nombre" => "Monitor",
            "precio" => 370,
            "disponible" => true
        ]
    ];

    foreach($productos as $p) {
        ?>
        <li>
            <?php  
                foreach($p as $key => $v) {
                    ?>
                        <p>
                    <?php
                            if($key == "disponible") {
                                echo $v ? "Disponible" : "No disponible";
                            } else {
                                echo $key . ": " . $v;
                            }
                    ?>
                        </p>
                    <?php
                }  
            ?>
        </li>
        <?php
    }



include 'includes/footer.php';