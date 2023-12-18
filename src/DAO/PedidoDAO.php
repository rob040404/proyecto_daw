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
    
    function generarPedido($idReserva, $mesa, $fecha_pedido)
    {
        $sql = "insert into Pedidos (mesa, estado_pedido, fecha_pedido, id_reserva) values (:mesa, :estado_pedido, :fecha_pedido, :id_reserva)";
        $stmGenerarPedido = $this -> bd-> prepare($sql);
        $stmGenerarPedido -> execute([':mesa' => $mesa, ':estado_pedido' => 'Pendiente', ':fecha_pedido' => $fecha_pedido, ':id_reserva' => $idReserva]);
        return boolval($stmGenerarPedido -> rowCount());
    }
    
    function recuperarPedidosPorFecha($dia_actual)
    {
        $dt_dia_siguiente = DateTime::createFromFormat('Y-m-d', $dia_actual);
        $dt_dia_siguiente -> modify('+1 day');
        $dia_siguiente = $dt_dia_siguiente -> format('Y-m-d');
        $sql = 'select pedidos.id_pedido as id_pedido, usuarios.nombre as nombre_empleado, reservas.mesa as mesa, '
        . 'pedidos.estado_pedido as estado_pedido, pedidos.fecha_pedido as fecha_pedido, pedidos.id_reserva as id_reserva '
        . 'from pedidos inner join reservas on pedidos.id_reserva=reservas.id_reserva inner join usuarios on '
        . 'reservas.id_usuario = usuarios.id_usuario where pedidos.fecha_pedido BETWEEN :dia_actual AND :dia_siguiente;';
        $stmRecuperarPedidosPorFecha = $this -> bd -> prepare($sql);
        $stmRecuperarPedidosPorFecha -> execute([':dia_actual' => $dia_actual, ':dia_siguiente' => $dia_siguiente]);
        $stmRecuperarPedidosPorFecha -> setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Pedido::class);
        $pedidos = $stmRecuperarPedidosPorFecha -> fetchAll() ?: null;
        return $pedidos;
    }
    
    function actualizarEstadoPedido(Pedido $pedido)
    {
        $sql = 'update pedidos set estado_pedido=:estadoPedido where id_pedido=:id_pedido';
        $stmActualizarEstadoPedido = $this -> bd -> prepare($sql);
        $stmActualizarEstadoPedido -> execute(['id_pedido' => $pedido -> getIdPedido(), ':estadoPedido' => $pedido -> getEstadoPedido()]);
        $pedido_actualizado = boolval($stmActualizarEstadoPedido -> rowCount());
        return $pedido_actualizado;
    }
    
    function borrarPedido($idPedido)
    {
        $sql = 'delete from detalle_pedido where id_pedido=:idPedido;';
        $stmBorrarPedido = $this -> bd -> prepare($sql);
        $stmBorrarPedido -> execute([':idPedido' => $idPedido]);
        $borrado = boolval($stmBorrarPedido -> rowCount());
        return $borrado;
    }
    
    function insertarPedido($idPedido, $idPlato, $unidades)
    {
        $sql = 'insert into detalle_pedido (id_pedido, id_plato, unidades) values (:idPedido, :idPlato, :unidades);';
        $stmInsertarPedido = $this -> bd -> prepare($sql);
        $stmInsertarPedido -> execute([':idPedido' => $idPedido, ':idPlato' => $idPlato, ':unidades' => $unidades]);
        $insertado = boolval($stmInsertarPedido -> rowCount());
        return $insertado;
    } 
}