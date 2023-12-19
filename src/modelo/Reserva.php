<?php
namespace App\modelo;
class Reserva
{
    private $id_reserva;
    private $id_usuario;
    private $mesa;
    private $nombre;
    private $apellidos;
    private $telefono;
    private $correo;
    private $fecha_hora_reserva;
    private $personas;
    private $nombre_empleado;

    public function __construct($id_reserva = null, $id_usuario = null, $mesa = null, $nombre = null, $apellidos = null, $telefono = null, $correo = null, $fecha_hora_reserva = null, $personas = null, $nombre_empleado = null)
    {
        if(!is_null($id_reserva))
        {
            $this -> id_reserva = $id_reserva;
        }
        if(!is_null($id_usuario))
        {
            $this -> id_usuario = $id_usuario;
        }
        if(!is_null($mesa))
        {
            $this -> mesa = $mesa;
        }
        if(!is_null($nombre))
        {
            $this -> nombre = $nombre;
        }
        if(!is_null($apellidos))
        {
            $this -> apellidos = $apellidos;
        }
        if(!is_null($telefono))
        {
            $this -> telefono = $telefono;
        }
        if(!is_null($correo))
        {
            $this -> correo = $correo;
        }
        if(!is_null($fecha_hora_reserva))
        {
            $this -> fecha_hora_reserva = $fecha_hora_reserva;
        }
        if(!is_null($personas))
        {
            $this -> personas = $personas;
        }
        if(!is_null($nombre_empleado))
        {
            $this -> nombre_empleado = $nombre_empleado;
        }
    }
    
    public function setIdReserva($id_reserva): void
    {
        $this -> id_reserva = $id_reserva;
    }
    
    public function getIdReserva()
    {
        return $this -> id_reserva;
    }
    
    public function setIdUsuario($id_usuario): void
    {
        $this -> id_usuario = $id_usuario;
    }

    public function getIdUsuario()
    {
        return $this -> id_usuario;
    }
    
    public function setMesa($mesa): void
    {
        $this -> mesa = $mesa;
    }

    public function getMesa()
    {
        return $this -> mesa;
    }
    
    public function setNombre($nombre): void
    {
        $this -> nombre = $nombre;
    }

    public function getNombre()
    {
        return $this -> nombre;
    }
    
    public function setApellidos($apellidos): void
    {
        $this -> apellidos = $apellidos;
    }

    public function getApellidos()
    {
        return $this -> apellidos;
    }
    
    public function setTelefono($telefono): void
    {
        $this -> telefono = $telefono;
    }

    public function getTelefono()
    {
        return $this -> telefono;
    }
    
    public function setCorreo($correo): void
    {
        $this -> correo = $correo;
    }

    public function getCorreo()
    {
        return $this -> correo;
    }
    
    public function setFechaHoraReserva($fecha_hora_reserva): void
    {
        $this -> fecha_hora_reserva = $fecha_hora_reserva;
    }

    public function getFechaHoraReserva()
    {
        return $this -> fecha_hora_reserva;
    }
    
    public function setPersonas($personas): void
    {
        $this -> personas = $personas;
    }

    public function getPersonas()
    {
        return $this -> personas;
    }
    
    public function setNombreEmpleado($nombre_empleado): void
    {
        $this -> nombre_empleado = $nombre_empleado;
    }
    
    public function getNombreEmpleado()
    {
        return $this -> nombre_empleado;
    }
}