<?php

namespace App\DAO;

use PDO;
use App\modelo\Restar;

class RestarDAO
{
    private $bd;

    function __construct($bd)
    {
        $this->bd = $bd;
    }

    function obtenerIngredientes($id_reserva)
    {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $sql = 'select r.id_reserva as id_reserva,
            re.id_producto as id_producto,
            sum(re.cantidad) as cantidad
            from reservas r, platos p, pedir pe, restar re
            where r.id_reserva=pe.id_reserva and
                pe.id_plato=p.id_plato and
                re.id_plato=p.id_plato and
                r.id_reserva=:id_reserva
            group by re.id_producto';
        $sth = $this->bd->prepare($sql);
        $sth->execute([':id_reserva' => $id_reserva]);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Restar::class);
        $restar = ($sth->fetchAll()) ?: null;
        return $restar;
    }
}
