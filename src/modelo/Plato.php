<?php

namespace App\modelo;

class Plato{
    private $id_plato= null;
    private $nombre= null;
    private $ingredientes= null;
    private $categoria= null;
    private $subcategoria= null;
    private $precio= null;
    private $estado =null;
    
    public function __construct() {
        
    }
    
    public function getId_plato() {
        return $this->id_plato;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getIngredientes() {
        return $this->ingredientes;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getSubcategoria() {
        return $this->subcategoria;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setId_plato($id_plato): void {
        $this->id_plato = $id_plato;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setIngredientes($ingredientes): void {
        $this->ingredientes = $ingredientes;
    }

    public function setCategoria($categoria): void {
        $this->categoria = $categoria;
    }

    public function setSubcategoria($subcategoria): void {
        $this->subcategoria = $subcategoria;
    }

    public function setPrecio($precio): void {
        $this->precio = $precio;
    }

    public function setEstado($estado): void {
        $this->estado = $estado;
    }


}

