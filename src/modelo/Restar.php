<?php

namespace App\modelo;

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

    public function getId_pedido()
    {
        return $this->id_pedido;
    }

    public function setId_pedido($id_pedido)
    {
        $this->id_pedido = $id_pedido;
        return $this;
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

    public function getCantidad()
    {
        return $this->cantidad;
    }

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