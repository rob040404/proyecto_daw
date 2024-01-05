<?php

namespace App\modelo;

// PDO se usa para interaccionar con la base de datos relacional
use \PDO as PDO;

class Restar
{
    private $id_pedido;
    private $id_producto;
    private $cantidad;
    private $ok;

    public function __construct($id_pedido = null, $id_producto = null, $cantidad = null, $ok = null)
    {
        $this->id_pedido = $id_pedido;
        $this->id_producto = $id_producto;
        $this->cantidad = $cantidad;
        $this->ok = $ok;
    }

    /**
     * Get the value of id_pedido
     */
    public function getId_pedido()
    {
        return $this->id_pedido;
    }

    /**
     * Set the value of id_pedido
     *
     * @return  self
     */
    public function setId_pedido($id_pedido)
    {
        $this->id_pedido = $id_pedido;

        return $this;
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

    public function getOk()
    {
        return $this->ok;
    }

    public function setOk($ok)
    {
        $this->ok = $ok;

        return $this;
    }
}
