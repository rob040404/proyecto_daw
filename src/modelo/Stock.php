<?php

namespace App\modelo;

// PDO se usa para interaccionar con la base de datos relacional
use \PDO as PDO;

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



    /**
     * Get the value of id_producto
     */
    public function getId_producto()
    {
        return $this->id_producto;
    }

    /**
     * Set the value of id_producto
     *
     * @return  self
     */
    public function setId_producto($id_producto)
    {
        $this->id_producto = $id_producto;

        return $this;
    }

    /**
     * Get the value of nombre_producto
     */
    public function getNombre_producto()
    {
        return $this->nombre_producto;
    }

    /**
     * Set the value of nombre_producto
     *
     * @return  self
     */
    public function setNombre_producto($nombre_producto)
    {
        $this->nombre_producto = $nombre_producto;

        return $this;
    }

    /**
     * Get the value of precio
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of cantidad
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set the value of cantidad
     *
     * @return  self
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }
}
