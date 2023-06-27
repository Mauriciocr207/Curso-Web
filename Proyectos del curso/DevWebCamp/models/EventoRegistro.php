<?php
namespace DevWebCamp\Models;
class EventoRegistro extends ActiveRecord{
    protected $id;
    protected $id_evento;
    protected $id_registro;
    protected static $table = "eventos_registros";
    
    public function __construct($args = [])
    {
        $this -> id = $args["id"] ?? null;
        $this -> id_evento = $args["id_evento"] ?? "";
        $this -> id_registro = $args["id_registro"] ?? "";
    }

}