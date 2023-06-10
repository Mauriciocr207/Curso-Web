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
            $vendedores = array_map(function ($data) {
                return new Vendedor($data);
            }, Vendedor::getAll());
            // POST
            $errores = [];
            if($_SERVER["REQUEST_METHOD"] === 'POST') { 
                $camposNew = $_POST;
                $camposNew["imagen"] = $_FILES["imagen"]["tmp_name"] ?? "";
                $propiedad -> setPropiedad($camposNew);
                $errores = $propiedad -> validate();
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
            $data["errores"] = $errores;
            $data["propiedad"] = $propiedad;
            $data["vendedores"] = $vendedores;
            // Enviar los datos a la vista
            $router -> render('admin/propiedades/create', $data);
        }
        public static function update(Router $router) {
            // GET
            $id = $_GET["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if(!$id) {
                header('Location:/admin?panel=propiedades');
            }
            $metadata = Propiedad::getById($id);
            $propiedad = new Propiedad($metadata);
            $data["fileImage"] = $propiedad -> getImagen();
            // Creamos un arreglo que contiene a todos los vendedores en objeto
            $vendedores = array_map(function ($data) {
                return new Vendedor($data);
            }, Vendedor::getAll());
            
            // POST
            $errores = [];
            if($_SERVER["REQUEST_METHOD"] === 'POST') { 
                // Verificamos si se subió una nueva imagen
                $imageUpdated = !empty($_FILES["imagen"]["tmp_name"]);
                // Guardamos los datos nuevos
                $camposNew = $_POST;
                $camposNew["imagen"] = $imageUpdated ? $_FILES["imagen"]["tmp_name"] : $propiedad -> getImagen(); 
                $propiedad -> setPropiedad($camposNew);
                // Validamos que no haya errores
                $errores = $propiedad -> validate();
                // Revisar que no haya errores
                if(empty($errores)) {
                    // Se envían los datos
                    $res = $propiedad -> update();
                    if($res) $data["resDB"] = "Actualizado Correctamente";
                }
            }

            // Enviar datos
            $data["errores"] = $errores;
            $data["propiedad"] = $propiedad;
            $data["vendedores"] = $vendedores;
        
            $router -> render('admin/propiedades/update', $data);
        }
    }
     