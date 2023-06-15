<?php
    namespace Controllers;
    use Models\Vendedor;
    use MVC\Router;

    class VendedorController {
        public static function create(Router $router) {
            $camposNew["creado"] = date('Y/m/d');
            $vendedor = new Vendedor($camposNew);
            $errores = [];
            // Ejecutar el código después de que el usuario envía el formulario
            if($_SERVER["REQUEST_METHOD"] === 'POST') { 
                $camposNew = $_POST;
                $camposNew["imagen"] = $_FILES["imagen"]["tmp_name"] ?? "";
                $vendedor -> setVendedor($camposNew);
                $errores = $vendedor -> validate();
                // Revisar que no haya errores
                if(empty($errores)) {
                    // Se envían los datos
                    $res = $vendedor -> save();
                    if($res) {
                        $vendedor -> clean(); // Se limpian los datos
                        $data["resDB"] = "Datos enviados correctamente";
                    }
                }
            }
            $data["vendedor"] = $vendedor;
            $data["errores"] = $errores;

            //Enviar datos
            $router -> render('admin/vendedores/create', $data);
        }
        public static function update(Router $router) {
            $id = $_GET["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if(!$id) {
                header('Location:/admin?panel=vendedores');
            }
            $metadata = Vendedor::getById($id);
            $vendedor = new Vendedor($metadata);
            $data["fileImage"] = $vendedor -> getImagen();
            $errores = [];
            // Ejecutar el código después de que el usuario envía el formulario
            if($_SERVER["REQUEST_METHOD"] === 'POST') { 
                // Verificamos si se subió una nueva imagen
                $imageUpdated = !empty($_FILES["imagen"]["tmp_name"]);
                // Guardamos los datos nuevos
                $camposNew = $_POST;
                $camposNew["imagen"] = $imageUpdated ? $_FILES["imagen"]["tmp_name"] : $vendedor -> getImagen();
                $vendedor -> setVendedor($camposNew);
                
                // Validamos que no haya errores
                $errores = $vendedor -> validate();
                // Revisar que no haya errores
                if(empty($errores)) {
                    // Se envían los datos
                    $res = $vendedor -> update();
                    if($res) $data["resDB"] = "Datos enviados correctamente";
                }
            }
            // Enviar datos
            $data["errores"] = $errores;
            $data["vendedor"] = $vendedor;
        
            $router -> render('admin/vendedores/update', $data);
        }
    }
     