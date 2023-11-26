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

    /*function select($email, $pwd)
    {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $sql = 'select * from usuarios where email=:email and contrasena=:pwd';
        $sth = $this->bd->prepare($sql);
        $sth->execute([":email" => $email, ":pwd" => $pwd]);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Empleado::class);
        $usuario = ($sth->fetch()) ?: null;
        return $usuario;
    }*/
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
}
