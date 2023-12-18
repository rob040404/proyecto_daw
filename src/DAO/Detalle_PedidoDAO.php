<?php
namespace App\DAO;
use PDO;
use App\modelo\Detalle_Pedido;
class Detalle_PedidoDAO
{
    private $bd;
    function __construct($bd)
    {
        $this -> bd = $bd;
    }
    
    function recuperarDetallesPedidoPorId($idPedido)
    {
        $sql = 'select detalle_pedido.id_pedido as id_pedido, detalle_pedido.id_plato as id_plato, platos.nombre as nombre_plato, '
        . 'detalle_pedido.unidades as unidades, platos.precio as precio_plato from detalle_pedido inner join platos on detalle_pedido.id_plato = platos.id_plato '
        . 'where detalle_pedido.id_pedido=:idPedido';
        $stmRecuperarDetallesPedidoPorId = $this -> bd -> prepare($sql);
        $stmRecuperarDetallesPedidoPorId -> execute([':idPedido' => $idPedido]);
        $stmRecuperarDetallesPedidoPorId -> setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Detalle_Pedido::class);
        $detalles_pedido = $stmRecuperarDetallesPedidoPorId -> fetchAll() ?: null;
        return $detalles_pedido;
    }
    
    function recuperarPlatosSeleccionadosPorIdPedidoYPlato($idPedido, $idPlato, $platos_seleccionados)
    {
        $sql = 'select detalle_pedido.id_pedido as id_pedido, detalle_pedido.id_plato as id_plato, platos.nombre as nombre_plato, '
        . 'platos.precio as precio_plato, detalle_pedido.unidades as unidades from detalle_pedido inner join platos on '
        . 'detalle_pedido.id_plato = platos.id_plato where detalle_pedido.id_pedido=:idPedido and '
        . 'detalle_pedido.id_plato=:idPlato';
        $stmRecuperarPlatosSeleccionadosPorIdPedidoYPlato = $this -> bd -> prepare($sql);
        $stmRecuperarPlatosSeleccionadosPorIdPedidoYPlato -> execute([':idPedido' => $idPedido, ':idPlato' => $idPlato]);
        $plato = $stmRecuperarPlatosSeleccionadosPorIdPedidoYPlato -> fetch(PDO::FETCH_ASSOC);
        if($plato)
        {
            $platos_seleccionados[] = $plato;
        }
        return $platos_seleccionados;
    }
}