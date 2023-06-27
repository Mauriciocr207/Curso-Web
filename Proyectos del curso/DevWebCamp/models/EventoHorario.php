<?php
namespace DevWebCamp\Models;
class EventoHorario extends ActiveRecord{
    protected $id;
    protected $id_categoria;
    protected $id_dia;
    protected $id_hora;
    protected static $table = "eventos";
}