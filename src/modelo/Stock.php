<?php

namespace App\modelo;

class Stock
{
    private $id_producto;
    private $nombre_producto;
    private $precio;
    private $cantidad;

    public function __construct($id_producto = null, $nombre_producto = null, $precio = null, $cantidad = null)
    {
        if (!is_null($id_producto)) {
            $this->id_producto = $id_producto;
        }
        if (!is_null($nombre_producto)) {
            $this->nombre_producto = $nombre_producto;
        }
        if (!is_null($precio)) {
            $this->precio = $precio;
        }
        if (!is_null($cantidad)) {
            $this->cantidad = $cantidad;
        }
    }

    public function getId_producto()
    {
        return $this->id_producto;
    }

    public function setId_producto($id_producto)
    {
        $this->id_producto = $id_producto;

        return $this;
    }

    public function getNombre_producto()
    {
        return $this->nombre_producto;
    }

    public function setNombre_producto($nombre_producto)
    {
        $this->nombre_producto = $nombre_producto;

        return $this;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }
}
