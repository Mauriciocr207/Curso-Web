<?php 
    function consultarVendedores() : array {
        $DB = connectDB();
        $query = "SELECT * FROM vendedores";
        $resultado = mysqli_query($DB, $query);
        $vendedores = [];
        while($row = mysqli_fetch_assoc($resultado)) {
            $vendedores[] = [
                "nombre" => $row["nombre"],
                "id" => $row["id"],
            ];
        }
        return $vendedores;
    }