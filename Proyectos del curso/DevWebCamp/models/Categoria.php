<?php
namespace DevWebCamp\Models;
class Categoria extends ActiveRecord{
    protected $id;
    protected $nombre;
    protected static $table = "categorias";
}