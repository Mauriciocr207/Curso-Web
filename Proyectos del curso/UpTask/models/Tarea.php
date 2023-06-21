<?php
namespace UpTask\Models;
class Tarea extends ActiveRecord {
    protected $id;
    protected $nombre;
    protected $estado;
    protected $id_proyecto;
    protected static $table = "tareas";

    public function __construct($args = [])
    {
        $this -> id = $args["id"] ?? null;
        $this -> nombre = $args["nombre"] ?? "";
        $this -> estado = $args["estado"] ?? 0;
        $this -> id_proyecto = $args["id_proyecto"] ?? "";
    }
    // Getters
    public function getNombre() : string {
        return $this -> nombre;
    }
    public function getEstado() : string {
        return $this -> estado;
    }
    public function getIdProyecto() : string {
        return $this -> id_proyecto;
    }
    public function setAll($args = []) : void {
        $this -> id = $args["id"] ?? $this -> id;
        $this -> nombre = $args["nombre"] ?? $this -> nombre;
        $this -> estado = $args["estado"] ?? $this -> estado;
        $this -> id_proyecto = $args["id_proyecto"] ?? $this -> id_proyecto;
    }
    public function clean() : void {
        $this -> id = "";
        $this -> nombre = "";
        $this -> estado = "";
        $this -> id_proyecto = "";
    }
    // public function validate() : array {
    //     $errores = [];
    //     if(!$this -> nombre) $errores[] = "El nombre del proyecto es obligatorio";
    //     return $errores;
    // }
    // public function createToken() : void {
    //     $this -> url = md5(uniqid());
    // }
}