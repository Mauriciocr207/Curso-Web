<?php
namespace DevWebCamp\Models;
class Regalo extends ActiveRecord{
    protected $id;
    protected $nombre;
    protected static $table = "regalos";

    public function __construct($args = [])
    {
        $this -> id = $args["id"] ?? null;
        $this -> nombre = $args["nombre"] ?? "";
    }
    public function getNombre() {
        return $this -> nombre;
    }
    
}