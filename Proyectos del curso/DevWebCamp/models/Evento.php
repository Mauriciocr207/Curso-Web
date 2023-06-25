<?php
namespace DevWebCamp\Models;
class Evento extends ActiveRecord{
    protected $id;
    protected $nombre;
    protected $descripcion;
    protected $disponibles;
    protected $id_categoria;
    protected $id_dia;
    protected $id_hora;
    protected $id_ponente;    
    protected static $table = "eventos";

    public function __construct($args = [])
    {
        $this -> id = $args["id"] ?? null;
        $this -> nombre = $args["nombre"] ?? "";
        $this -> descripcion = $args["descripcion"] ?? "";
        $this -> disponibles = $args["disponibles"] ?? "";
        $this -> id_categoria = $args["id_categoria"] ?? "";
        $this -> id_dia = $args["id_dia"] ?? "";
        $this -> id_hora = $args["id_hora"] ?? "";
        $this -> id_ponente = $args["id_ponente"] ?? "";
    }
    // Setters
    public function setAll($args = []) {
        $this -> id = $args["id"] ?? $this -> id;
        $this -> nombre = $args["nombre"] ?? $this -> nombre;
        $this -> descripcion = $args["descripcion"] ?? $this -> descripcion;
        $this -> disponibles = $args["disponibles"] ?? $this -> disponibles;
        $this -> id_categoria = $args["id_categoria"] ?? $this -> id_categoria;
        $this -> id_dia = $args["id_dia"] ?? $this -> id_dia;
        $this -> id_hora = $args["id_hora"] ?? $this -> id_hora;
        $this -> id_ponente = $args["id_ponente"] ?? $this -> id_ponente;
    }
    // Getters
    public function getNombre() {
        return $this -> nombre;
    }
    public function getDescripcion() {
        return $this -> descripcion;
    }
    public function getDisponibles() {
        return $this -> disponibles;
    }
    public function getIdCategoria() {
        return $this -> id_categoria;
    }
    public function getIdDia() {
        return $this -> id_dia;
    }
    public function getIdHora() {
        return $this -> id_hora;
    }
    public function getIdPonente() {
        return $this -> id_ponente;
    }
}