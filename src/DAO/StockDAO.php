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

    function delete($stock)
    {
        $consulta = $this->bd->prepare('DELETE FROM stock WHERE  id_producto=:id_producto');
        $id_producto = $stock->getId_producto();
        $consulta->bindParam(':id_producto', $id_producto, PDO::PARAM_STR);
        return $consulta->execute();
    }
}
