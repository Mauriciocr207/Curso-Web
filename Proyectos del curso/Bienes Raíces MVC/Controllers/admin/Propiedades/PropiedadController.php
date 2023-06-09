<?php
    namespace Controllers;
    use Models\Propiedad;
    use Models\Vendedor;
    use MVC\Router;

    class PropiedadController {
        public static function create(Router $router) {
            // GET
            // Creamos un objeto propiedad que contendrá la fecha actual
            $campos["creado"] = date('Y/m/d');
            $propiedad = new Propiedad($campos);
            // Creamos un arreglo que contiene a todos los vendedores en objeto
            $vendedoresData = Vendedor::getAll();
            $vendedores = [];
            foreach ($vendedoresData as $data) {
                $vendedores[] = new Vendedor($data);
            }
            // POST
            if($_SERVER["REQUEST_METHOD"] === 'POST') { 
                $camposNew = $_POST;
                $camposNew["imagen"] = $_FILES["imagen"]["tmp_name"] ?? "";
                $propiedad -> setPropiedad($camposNew);
                $errores = $propiedad -> validate();
                $data["errores"] = $errores;
                // Revisar que no haya errores
                if(empty($errores)) {
                    // Se envían los datos
                    $res = $propiedad -> save();
                    if($res) {
                        $propiedad -> clean(); // Se limpian los datos
                        $data["resDB"] = "Datos enviados correctamente";
                    }
                }
            }
            $data["propiedad"] = $propiedad;
            $data["vendedores"] = $vendedores;
            // Enviar los datos a la vista
            $router -> render('admin/propiedades/create', $data);
        }
        public static function update(Router $router) {
            $data = [];
            $router -> render('admin/propiedades/create', $data);
        }
    }
     