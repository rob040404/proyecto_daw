<?php

namespace App\modelo;

class Empleado
{
    private $id_usuario;
    private $nombre;
    private $apellidos;
    private $contrasena;
    private $rol;
    private $email;

    public function __construct($id_usuario = null, $nombre = null, $apellidos = null, $contrasena = null, $rol = null, $email = null)
    {
        if (!is_null($id_usuario)) {
            $this->id_usuario = $id_usuario;
        }
        if (!is_null($nombre)) {
            $this->nombre = $nombre;
        }
        if (!is_null($apellidos)) {
            $this->apellidos = $apellidos;
        }
        if (!is_null($contrasena)) {
            $this->contrasena = $contrasena;
        }
        if (!is_null($rol)) {
            $this->rol = $rol;
        }
        if (!is_null($email)) {
            $this->email = $email;
        }
    }

    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getContrasena()
    {
        return $this->contrasena;
    }

    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;

        return $this;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
}