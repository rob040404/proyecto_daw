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
        $sql = 'select * from stock';
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
}
