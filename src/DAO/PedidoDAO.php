<?php
namespace App\DAO;
use PDO;
use DateTime;
use App\modelo\Pedido;
class PedidoDAO
{
    private $bd;
    function __construct($bd)
    {
        $this -> bd = $bd;
    }
    
    function generarPedido(Pedido $pedido) :bool
    {
        $sql = "insert into pedidos (mesa, estado_pedido, fecha_hora_pedido, id_reserva) values (:mesa, :estado_pedido, :fecha_hora_pedido, :id_reserva)";
        $stmGenerarPedido = $this -> bd-> prepare($sql);
        $stmGenerarPedido -> execute([':mesa' => $pedido -> getMesa(), ':estado_pedido' => $pedido -> getEstadoPedido(), ':fecha_hora_pedido' => $pedido -> getFechaHoraPedido(), ':id_reserva' => $pedido -> getIdReserva()]);
        return boolval($stmGenerarPedido -> rowCount());
    }
    
    function recuperarPedidosPorFecha(string $dia_actual) :?array
    {
        $dt_dia_siguiente = DateTime::createFromFormat('Y-m-d', $dia_actual);
        $dt_dia_siguiente -> modify('+1 day');
        $dia_siguiente = $dt_dia_siguiente -> format('Y-m-d');
        $sql = 'select pedidos.id_pedido as id_pedido, reservas.mesa as mesa, pedidos.estado_pedido as estado_pedido, '
        . 'pedidos.fecha_hora_pedido as fecha_hora_pedido, pedidos.id_reserva as id_reserva, usuarios.nombre as nombre_empleado '
        . 'from pedidos inner join reservas on pedidos.id_reserva=reservas.id_reserva inner join usuarios on '
        . 'reservas.id_usuario = usuarios.id_usuario where pedidos.fecha_hora_pedido between :dia_actual and :dia_siguiente;';
        $stmRecuperarPedidosPorFecha = $this -> bd -> prepare($sql);
        $stmRecuperarPedidosPorFecha -> execute([':dia_actual' => $dia_actual, ':dia_siguiente' => $dia_siguiente]);
        $stmRecuperarPedidosPorFecha -> setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Pedido::class);
        $pedidos = $stmRecuperarPedidosPorFecha -> fetchAll() ?: null;
        return $pedidos;
    }
    
    function actualizarEstadoPedido(Pedido $pedido) :bool
    {
        $sql = 'update pedidos set estado_pedido=:estado_pedido where id_pedido=:id_pedido';
        $stmActualizarEstadoPedido = $this -> bd -> prepare($sql);
        $stmActualizarEstadoPedido -> execute([':estado_pedido' => $pedido -> getEstadoPedido(), ':id_pedido' => $pedido -> getIdPedido()]);
        $pedido_actualizado = boolval($stmActualizarEstadoPedido -> rowCount());
        return $pedido_actualizado;
    }
}