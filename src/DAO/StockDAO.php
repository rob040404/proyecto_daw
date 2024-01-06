<?php

namespace App\DAO;

use PDO;
use App\modelo\Stock;

class StockDAO
{
    private $bd;

    function __construct($bd)
    {
        $this->bd = $bd;
    }

    function selectall()
    {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $sql = 'select * from stock order by nombre_producto';
        $sth = $this->bd->prepare($sql);
        $sth->execute([]);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Stock::class);
        $stock = ($sth->fetchAll()) ?: null;
        return $stock;
    }

    function update($idproducto, $cantidad)
    {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $sql = 'UPDATE stock SET cantidad=cantidad+:cantidad WHERE id_producto=:id_producto';
        $sth = $this->bd->prepare($sql);
        return $sth->execute([":cantidad" => $cantidad, ":id_producto" => $idproducto]);
    }

    function selectid($id)
    {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $sql = 'SELECT * from stock WHERE id_producto=:id_producto';
        $sth = $this->bd->prepare($sql);
        $sth->execute([':id_producto' => $id]);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Stock::class);
        $stock = ($sth->fetch()) ?: null;
        return $stock;
    }

    function delete($idproducto)
    {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $sql = 'UPDATE stock SET cantidad=0 WHERE id_producto=:id_producto';
        $sth = $this->bd->prepare($sql);
        return $sth->execute([":id_producto" => $idproducto]);
    }

    function insert($stock)
    {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $sql = 'INSERT INTO stock (nombre_producto, precio, cantidad)
        VALUES (:nombre_producto, :precio, :cantidad)';
        $sth = $this->bd->prepare($sql);
        return $sth->execute([
            ":nombre_producto" => $stock->getNombre_producto(),
            ":precio" => $stock->getPrecio(),
            ":cantidad" => $stock->getCantidad()
        ]);
    }

    function obtener_id($nombre_producto)
    {
        $sql = 'SELECT * from stock WHERE nombre_producto=:np';
        $sth = $this->bd->prepare($sql);
        $registro = $sth->execute([':np' => $nombre_producto]);

        if ($registro) {
            $registro = $sth->fetch(PDO::FETCH_OBJ);
            $id = $registro->id_producto;
            return $id;
        } else {
            return false;
        }
    }

    function obtener_nombres()
    {
        $consulta = "SELECT nombre_producto FROM stock ORDER BY nombre_producto";
        $registros = $this->bd->query($consulta);
        $resultados = $registros->fetchAll(PDO::FETCH_OBJ);
        return $resultados;
    }

    function obtener_porId($id)
    {
        $consulta = "SELECT nombre_producto FROM stock WHERE id_producto=:i";
        $stm = $this->bd->prepare($consulta);
        $registro = $stm->execute([':i' => $id]);
        if ($registro) {
            $registro = $stm->fetch(PDO::FETCH_OBJ);
            $nombre = $registro->nombre_producto;
            return $nombre;
        } else {
            return false;
        }
    }
}
