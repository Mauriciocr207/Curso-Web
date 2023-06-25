<?php
namespace DevWebCamp\Models;
use Intervention\Image\ImageManagerStatic as Image;
class Ponente extends ActiveRecord{
    protected $id;
    protected $nombre;
    protected $apellido;
    protected $ciudad;
    protected $pais;
    protected $imagen;
    protected $tags;
    protected $redes;
    protected static $table = "ponentes";

    public function __construct($args = [])
    {
        $this -> id = $args["id"] ?? null;
        $this -> nombre = $args["nombre"] ?? "";
        $this -> apellido = $args["apellido"] ?? "";
        $this -> ciudad = $args["ciudad"] ?? "";
        $this -> pais = $args["pais"] ?? "";
        $this -> imagen = $args["imagen"] ?? "";
        $this -> tags = $args["tags"] ?? "";
        $this -> redes = isset($args["redes"]) ? $this -> redesJsonEncode($args["redes"]) : "";
    }
    // Protected
    protected function redesJsonEncode($redes) {
        $json = "";
        // Eliminamos las propiedades que estén vacías
        if(is_array($redes)) {
            $redesUsadas = array_filter($redes, function($red) {
                if(!(empty($red))) return $red;
            });
            $json = json_encode($redesUsadas, JSON_UNESCAPED_SLASHES);
            if(empty($redesUsadas)) $json = "";
        } else {
            // Para el caso donde se obtenga directamente el json de la base de datos
            $json = $redes;
        }
        return $json;
    }
    // Getters
    public function getNombre() {
        return $this -> nombre;
    }
    public function getApellido() {
        return $this -> apellido;
    }
    public function getCiudad() {
        return $this -> ciudad;
    }
    public function getPais() {
        return $this -> pais;
    }
    public function getImagen() {
        return $this -> imagen;
    }
    public function getTags() {
        return $this -> tags;
    }
    public function getRedes() {
        return json_decode($this -> redes, true);
    }
    // Setters
    public function setAll($args = []) {
        $this -> id = $args["id"] ?? $this -> id;
        $this -> nombre = $args["nombre"] ?? $this -> nombre;
        $this -> apellido = $args["apellido"] ?? $this -> apellido;
        $this -> ciudad = $args["ciudad"] ?? $this -> ciudad;
        $this -> pais = $args["pais"] ?? $this -> pais;
        $this -> imagen = $args["imagen"] ?? $this -> imagen;
        $this -> tags = $args["tags"] ?? $this -> tags;
        $this -> redes = isset($args["redes"]) ? $this -> redesJsonEncode($args["redes"]) : $this -> redes;
    }
    public function createUniqueNameImg() {
        $this -> imagen = md5( uniqid( rand(), true ) );
    }
    public function imageChanged() {
        // Si hay un archivo nuevo, la imagen va a cambiar
        return !empty($_FILES["imagen"]["tmp_name"]) ? true : false;
    }
    public function saveImg() {
        if(!empty($this -> imagen)) {
            $carpeta_imagenes = PROYECT__URL . '/public/img/speakers';

            // Crear carpeta si no existe
            if(!is_dir($carpeta_imagenes)) {
                mkdir($carpeta_imagenes, 0777, true);
            }

            // Crear los formatos de imagem
            $imagen_png = Image::make($_FILES["imagen"]["tmp_name"]) -> fit(800,800) -> encode('png', 80);
            $imagen_webp = Image::make($_FILES["imagen"]["tmp_name"]) -> fit(800,800) -> encode('webp', 80);

            // Guardar imagenes
            $imagen_png -> save(
                path: $carpeta_imagenes . "/" . $this -> imagen . ".png"
            );
            $imagen_webp -> save(
                path: $carpeta_imagenes . "/" . $this -> imagen . ".webp"
            );
        }
    }
    public function updateImg($oldImage) {
        // Borramos la imagen anterior
        $carpeta_imagenes = PROYECT__URL . '/public/img/speakers';
        $imagen_png = $carpeta_imagenes . "/$oldImage.png";
        $imagen_webp = $carpeta_imagenes . "/$oldImage.webp";
        unlink($imagen_png);
        unlink($imagen_webp);
        $this -> saveImg();
    }
    public function clean() {
        $this -> id = null;
        $this -> nombre = "";
        $this -> apellido = "";
        $this -> ciudad = "";
        $this -> pais = "";
        $this -> imagen = "";
        $this -> tags = "";
        $this -> redes = "";
    }
}