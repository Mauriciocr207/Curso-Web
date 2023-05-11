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


    