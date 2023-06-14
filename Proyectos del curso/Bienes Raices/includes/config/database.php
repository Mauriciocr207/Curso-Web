<?php 
    function connectDB() : mysqli {
        $DB = mysqli_connect(
            'localhost',
            'root',
            'root',
            'bienesraices_crud'
        );
        if(!$DB) {
            echo "Failed to connect";
            exit;
        };
        return $DB;
    };
    // function closeDB(mysqli $DB) : bool {
    //     $resultado = false;
    //     // try {
    //     //     mysqli_close($DB);

    //     // } catch (\Throwable $th) {
            
    //     // }
    //     if(mysqli_close($DB)) {
    //         $resultado = true;
    //     }

    //     return $resultado;
    // }


    