<?php
namespace App\DAO;
use PDO;
use App\modelo\DetallePedido;
class DetallePedidoDAO
{
    private $bd;
    function __construct($bd)
    {
        $this -> bd = $bd;
    }
    
    function recuperarDetallesPedidoPorId(string $id_pedido) :?array
    {
        $sql = 'select detalle_pedido.id_pedido as id_pedido, detalle_pedido.id_plato as id_plato, detalle_pedido.unidades as unidades, '
        . 'platos.nombre as nombre_plato, platos.precio as precio_plato from detalle_pedido inner join platos on '
        . 'detalle_pedido.id_plato = platos.id_plato where detalle_pedido.id_pedido=:id_pedido';
        $stmRecuperarDetallesPedidoPorId = $this -> bd -> prepare($sql);
        $stmRecuperarDetallesPedidoPorId -> execute([':id_pedido' => $id_pedido]);
        $stmRecuperarDetallesPedidoPorId -> setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, DetallePedido::class);
        $detalles_pedido = $stmRecuperarDetallesPedidoPorId -> fetchAll() ?: null;
        return $detalles_pedido;
    }
    
    function recuperarPlatosSeleccionadosPorIdPedidoYPlato(DetallePedido $detalle_pedido, array $platos_seleccionados) :?array
    {
        $sql = 'select detalle_pedido.id_pedido as id_pedido, detalle_pedido.id_plato as id_plato, detalle_pedido.unidades as unidades, '
        . 'platos.nombre as nombre_plato, platos.precio as precio_plato from detalle_pedido inner join platos on '
        . 'detalle_pedido.id_plato = platos.id_plato where detalle_pedido.id_pedido=:id_pedido and detalle_pedido.id_plato=:id_plato';
        $stmRecuperarPlatosSeleccionadosPorIdPedidoYPlato = $this -> bd -> prepare($sql);
        $stmRecuperarPlatosSeleccionadosPorIdPedidoYPlato -> execute([':id_pedido' => $detalle_pedido -> getIdPedido(), ':id_plato' => $detalle_pedido -> getIdPlato()]);
        $plato = $stmRecuperarPlatosSeleccionadosPorIdPedidoYPlato -> fetch(PDO::FETCH_ASSOC);
        if($plato)
        {
            $platos_seleccionados[] = $plato;
        }
        return $platos_seleccionados;
    }
    
    function insertarDetallePedido(DetallePedido $detalle_pedido) :bool
    {
        $sql = 'insert into detalle_pedido (id_pedido, id_plato, unidades) values (:id_pedido, :id_plato, :unidades);';
        $stmInsertarPedido = $this -> bd -> prepare($sql);
        $stmInsertarPedido -> execute([':id_pedido' => $detalle_pedido -> getIdPedido(), ':id_plato' => $detalle_pedido -> getIdPlato(), ':unidades' => $detalle_pedido -> getUnidades()]);
        $insertado = boolval($stmInsertarPedido -> rowCount());
        return $insertado;
    } 
    
    function borrarDetallePedido(string $id_pedido) :bool
    {
        $sql = 'delete from detalle_pedido where id_pedido=:id_pedido;';
        $stmBorrarPedido = $this -> bd -> prepare($sql);
        $stmBorrarPedido -> execute([':id_pedido' => $id_pedido]);
        $borrado = boolval($stmBorrarPedido -> rowCount());
        return $borrado;
    }
}