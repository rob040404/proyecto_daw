<?php

namespace App\modelo;

class Pedido
{
    public $id_pedido;
    public $mesa;
    public $estado_pedido;
    public $fecha_hora_pedido;
    public $id_reserva;
    public $nombre_empleado;
    public $detalles_pedido;
    
    public function __construct($id_pedido = null, $mesa = null, $estado_pedido = null, $fecha_hora_pedido = null, $id_reserva = null, $nombre_empleado = null, $detalles_pedido = null)
    {
        if(!is_null($id_pedido))
        {
            $this -> id_pedido = $id_pedido;
        }
        if(!is_null($mesa))
        {
            $this -> mesa = $mesa;
        }
        if(!is_null($estado_pedido))
        {
            $this -> estado_pedido = $estado_pedido;
        }
        if(!is_null($fecha_hora_pedido))
        {
            $this -> fecha_hora_pedido = $fecha_hora_pedido;
        }
        if(!is_null($id_reserva))
        {
            $this -> id_reserva = $id_reserva;
        }
        if(!is_null($nombre_empleado))
        {
            $this -> nombre_empleado = $nombre_empleado;
        }
        if(!is_null($detalles_pedido))
        {
            $this -> detalles_pedido = $detalles_pedido;
        }
    }
    
    public function getIdPedido()
    {
        return $this -> id_pedido;
    }
    
    public function setMesa($mesa)
    {
        $this -> mesa = $mesa;
    }

    public function getMesa()
    {
        return $this -> mesa;
    }
    
    public function setEstadoPedido($estadoPedido)
    {
        $this -> estado_pedido = $estadoPedido;
    }

    public function getEstadoPedido()
    {
        return $this -> estado_pedido;
    }
    
    public function setFechaHoraPedido($fecha_pedido)
    {
        $this -> fecha_hora_pedido = $fecha_pedido;
    }

    public function getFechaHoraPedido()
    {
        return $this -> fecha_hora_pedido;
    }

    public function setIdReserva($idReserva)
    {
        $this -> id_reserva = $idReserva;
    }

    public function getIdReserva()
    {
        return $this -> id_reserva;
    }
    
    public function setNombreEmpleado($nombre_empleado)
    {
        $this -> nombre_empleado = $nombre_empleado;
    }

    public function getNombreEmpleado()
    {
        return $this -> nombre_empleado;
    }
    
    public function setDetallesPedido($detalles_pedido)
    {
        $this -> detalles_pedido = $detalles_pedido;
    }

    public function getDetallesPedido()
    {
        return $this -> detalles_pedido;
    }
}