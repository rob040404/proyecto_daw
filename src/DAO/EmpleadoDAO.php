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

    function select($email, $pwd)
    {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $sql = 'select * from usuarios where email=:email and contrasena=:pwd';
        $sth = $this->bd->prepare($sql);
        $sth->execute([":email" => $email, ":pwd" => $pwd]);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Empleado::class);
        $usuario = ($sth->fetch()) ?: null;
        return $usuario;
    }
    
    function recuperarUsuarios()
    {
        $this -> bd -> setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $sql = 'select * from usuarios';
        $sth = $this -> bd -> prepare($sql);
        $sth -> execute();
        $sth -> setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Empleado::class);
        $usuarios = ($sth -> fetchAll()) ?: null;
        return $usuarios;
    }
    
    function recuperarUsuariosPorRol($rol)
    {
        $this -> bd -> setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $sql = 'select * from usuarios where rol=:rol';
        $sth = $this -> bd -> prepare($sql);
        $sth -> execute([':rol' => $rol]);
        $sth -> setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Empleado::class);
        $usuarios = ($sth -> fetchAll()) ?: null;
        return $usuarios;
    }

    private function existeNombre($usuario)
    {
        $this -> bd -> setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $sql = 'select * from usuarios where rol=:rol';
        $sth = $this -> bd -> prepare($sql);
        $sth -> execute([':rol' => $rol]);
        $sth -> setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Empleado::class);
        $usuarios = ($sth -> fetchAll()) ?: null;
        return $usuarios;
    }

    function selectall()
    {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $sql = 'select * from usuarios';
        $sth = $this->bd->prepare($sql);
        $sth->execute([]);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Empleado::class);
        $empleado = ($sth->fetchAll()) ?: null;
        return $empleado;
    }

    function update($empleado)
    {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $sql = 'UPDATE usuarios SET nombre=:nombre, apellidos=:apellidos, contrasena=:contrasena,
        rol=:puesto, email=:email WHERE id_usuario=:id_usuario';
        $sth = $this->bd->prepare($sql);
        return $sth->execute([
            ":nombre" => $empleado->getNombre(),
            ":apellidos" => $empleado->getApellidos(),
            ":contrasena" => $empleado->getContrasena(),
            ":puesto" => $empleado->getRol(),
            ":email" => $empleado->getEmail(),
            ":id_usuario" => $empleado->getId_usuario()
        ]);
    }

    function delete($idusuario)
    {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $sql = 'DELETE FROM usuarios WHERE id_usuario=:id_usuario AND rol<>"admin"'; //y no != porque ahorras 0,10 segundos
        $sth = $this->bd->prepare($sql);
        return $sth->execute([":id_usuario" => $idusuario]) && $sth->rowCount() > 0;
    }

    function insert($empleado)
    {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $sql = 'INSERT INTO usuarios (nombre, apellidos, contrasena, rol, email) 
        VALUES (:nombre, :apellidos, :contrasena, :rol, :email)';
        $sth = $this->bd->prepare($sql);
        return $sth->execute([
            ":nombre" => $empleado->getNombre(),
            ":apellidos" => $empleado->getApellidos(),
            ":contrasena" => $empleado->getContrasena(),
            ":rol" => $empleado->getRol(),
            ":email" => $empleado->getEmail()
        ]);
    }
}
