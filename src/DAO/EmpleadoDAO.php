<?php

namespace App\DAO;

use PDO;
use App\modelo\Empleado;

class EmpleadoDAO
{

    private $bd;

    function __construct($bd)
    {
        $this->bd = $bd;
    }

    
    /*private function existeNombre($usuario)
    {
        $consulta = $this->bd->prepare('SELECT * FROM usuarios WHERE nombre=:nombre');
        $nombre = $usuario->getNombre();
        $consulta->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $consulta->execute();
        if ($consulta->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    private function existeEmail($usuario)
    {
        $consulta = $this->bd->prepare('SELECT * FROM usuarios WHERE email=:email');
        $email = $usuario->getEmail();
        $consulta->bindParam(':email', $email, PDO::PARAM_STR);
        $consulta->execute();
        if ($consulta->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    function crea($usuario)
    {
        if ($this->existeNombre($usuario) || $this->existeEmail($usuario)) {
            return false;
        } else {
            $consulta = $this->bd->prepare('INSERT INTO usuarios (nombre, clave, email) ' .
                'VALUES (:nombre, :clave, :email)');
            $nombre = $usuario->getNombre();
            $clave = $usuario->getClave();
            $email = $usuario->getEmail();
            $consulta->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $consulta->bindParam(':clave', $clave, PDO::PARAM_STR);
            $consulta->bindParam(':email', $email, PDO::PARAM_STR);
            return $consulta->execute();
        }
    }

    function modifica($usuario)
    {
        /*if ($this->existeEmail($usuario)) {
            return false;
        } else { 
        $consulta = $this->bd->prepare('UPDATE usuarios SET clave=:clave, email=:email WHERE id=:id');
        $clave = $usuario->getClave();
        $email = $usuario->getEmail();
        $id = $usuario->getId();
        $consulta->bindParam(':clave', $clave, PDO::PARAM_STR);
        $consulta->bindParam(':email', $email, PDO::PARAM_STR);
        $consulta->bindParam(':id', $id, PDO::PARAM_STR);
        return $consulta->execute();
    }

    function elimina($usuario)
    {
        $consulta = $this->bd->prepare('DELETE FROM usuarios WHERE  id=:id');
        $id = $usuario->getId();
        $consulta->bindParam(':id', $id, PDO::PARAM_STR);
        return $consulta->execute();
    }*/

    function select ($email, $pwd)
    {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $sql = 'select * from usuarios where email=:email and contrasena=:pwd';
        $sth = $this->bd->prepare($sql);
        $sth->execute([":email" => $email, ":pwd" => $pwd]);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Empleado::class);
        $usuario = ($sth->fetch()) ?: null;
        return $usuario;
    }
}
