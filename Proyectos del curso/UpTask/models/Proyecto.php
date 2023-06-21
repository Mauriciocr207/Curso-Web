<?php
namespace UpTask\Models;
class Proyecto extends ActiveRecord {
    protected $id;
    protected $nombre;
    protected $url;
    protected $id_usuario;
    protected static $table = "proyectos";

    public function __construct($args = [])
    {
        $this -> id = $args["id"] ?? null;
        $this -> nombre = $args["nombre"] ?? "";
        $this -> url = $args["url"] ?? "";
        $this -> id_usuario = $args["id_usuario"] ?? "";
    }
    // Getters
    public function getUrl() : string {
        return $this -> url;
    }
    public function getIdUsuario() : string {
        return $this -> id_usuario;
    }
    public function getNombre() : string {
        return $this -> nombre;
    }
    public function setAll($args = []) : void {
        $this -> id = $args["id"] ?? $this -> id;
        $this -> nombre = $args["nombre"] ?? $this -> nombre;
        $this -> url = $args["url"] ?? $this -> url;
        $this -> id_usuario = $args["id_usuario"] ?? $this -> url;
    }
    public function clean() : void {
        $this -> id = "";
        $this -> nombre = "";
        $this -> url = "";
        $this -> id_usuario = "";
    }
    public function validate() : array {
        $errores = [];
        if(!$this -> nombre) $errores[] = "El nombre del proyecto es obligatorio";
        return $errores;
    }
    public function createToken() : void {
        $this -> url = md5(uniqid());
    }
}