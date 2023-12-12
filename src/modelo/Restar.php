<?php

namespace App\modelo;

// PDO se usa para interaccionar con la base de datos relacional
use \PDO as PDO;

class Restar
{
    private $id_reserva;
    private $id_producto;
    private $cantidad;

    public function __construct($id_reserva=null, $id_producto=null, $cantidad=null)
    {
        $this->id_reserva=$id_reserva;
        $this->id_producto=$id_producto;
        $this->cantidad=$cantidad;
    }

    /**
     * Get the value of id_reserva
     */
    public function getId_reserva()
    {
        return $this->id_reserva;
    }

    /**
     * Set the value of id_reserva
     *
     * @return  self
     */
    public function setId_reserva($id_reserva)
    {
        $this->id_reserva = $id_reserva;

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
}