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

    function obtenerIngredientes($id_pedido)
    {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $sql = 'select pe.id_pedido as id_pedido,
	            re.id_producto as id_producto,
                sum(re.cantidad) as cantidad
                from pedidos pe, platos pl, detalle_pedido d, restar re
                where pe.id_pedido=d.id_pedido and
                    d.id_plato=pl.id_plato and
                    re.id_plato=pl.id_plato and
                    pe.id_pedido=:id_pedido
	            group by re.id_producto';
        $sth = $this->bd->prepare($sql);
        $sth->execute([':id_pedido' => $id_pedido]);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Restar::class);
        $restar = ($sth->fetchAll()) ?: null;
        return $restar;
    }

    function insertar($id_plato, $id_producto, $cantidad)
    {
        $consulta = 'INSERT INTO restar (id_plato, id_producto, cantidad) VALUES(:ipl, :ipr, :c)';
        $stm = $this->bd->prepare($consulta);
        $resultado = $stm->execute([':ipl' => $id_plato, ':ipr' => $id_producto, ':c' => $cantidad]);

        if ($resultado) {
            return true;
        } else {
            return false;
        }
    }
    
    function ingredientesDelPlato($id_plato){
        $consulta="SELECT * FROM restar WHERE id_plato=:i";
        $stm=$this->bd->prepare($consulta);
        $stm->execute([':i'=>$id_plato]);
        $numFilas=$stm->rowCount();
        
        if($numFilas===0){
            return false;
        }else{
            $resultados= $stm->fetchAll(PDO::FETCH_OBJ);
            return $resultados;
        }
        
    }
    
    function borrar($id_plato){
        $consulta= 'DELETE FROM restar WHERE id_plato= :id_plato';
        $stm= $this->bd->prepare($consulta);
        $resultado= $stm->execute([':id_plato'=>$id_plato]);
        
        return $resultado;
        
    }
}
