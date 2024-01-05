<?php
namespace App\DAO;
use PDO;
use DateTime;
use App\modelo\Reserva;
use App\modelo\Pedido;
use App\DAO\EmpleadoDAO;
use App\DAO\PedidoDAO;

class ReservaDAO
{

    private $bd;
    private $mesas;

    function __construct($bd)
    {
        $this -> bd = $bd;
        $this -> mesas = 10;
    }
    
    function encontrarFechaParaReservarMesa(string $mesa, string $fecha_hora_reserva) :bool
    {
        $sql = 'select fecha_hora_reserva from reservas where mesa=:mesa and fecha_hora_reserva=:fecha_hora_reserva';
        $stmEncontrarFechaParaReservarMesa = $this -> bd -> prepare($sql);
        $stmEncontrarFechaParaReservarMesa -> execute([':mesa' => $mesa, ':fecha_hora_reserva' => $fecha_hora_reserva]);
        $ocupada = !empty($stmEncontrarFechaParaReservarMesa -> fetch());
        return $ocupada;
    }
    
    function recuperarHorarios(string $fecha) :?array
    {
        $fecha_apertura = DateTime::createFromFormat('Y-m-d H:i:s', $fecha . ' ' . '13:30:00');
        $fecha_clausura = DateTime::createFromFormat('Y-m-d H:i:s', $fecha . ' ' . '23:00:00');
        $horarios = [];
        while($fecha_apertura != $fecha_clausura)
        {
            $fecha_reserva = clone ($fecha_apertura -> modify('+30 minutes'));
            $horarios[] = $fecha_reserva -> format('Y-m-d H:i:s');
        }
        return $horarios;
    }

    function recuperarReservasDisponibles(string $fecha, $mesa, $fecha_editar) :?array
    {
        $horarios = $this -> recuperarHorarios($fecha);
        $indices = [];
        $ocupada = true;
        for($i = 0; $i < sizeof($horarios); $i++)
        {
            if(!is_null($mesa))
            {
                if(!is_null($fecha_editar) && $horarios[$i] == $fecha_editar)
                {
                    $ocupada = false;
                }
                else
                {
                    $ocupada = $this -> encontrarFechaParaReservarMesa($mesa, $horarios[$i]);
                }
                if($ocupada)
                {
                    $indices[] = $i;
                }
            }
            else
            {
                $mesas_ocup = 0;
                for($mesas = 1; $mesas <= $this -> mesas; $mesas++)
                {
                    $ocupada = $this -> encontrarFechaParaReservarMesa($mesas, $horarios[$i]);
                    if($ocupada)
                    {
                        $mesas_ocup++;
                    }
                    if($mesas_ocup == $this -> mesas)
                    {
                        $indices[] = $i;
                    }
                }
            }
        }
        for($i = 0; $i < sizeof($indices); $i++)
        {
            unset($horarios[$indices[$i]]);
        }
        $horarios = array_values($horarios);
        $horas_disponibles = [];
        for($i = 0; $i < sizeof($horarios); $i++)
        {
            $horas_disponibles[] = substr($horarios[$i], 11, 5);
        }
        return $horas_disponibles;
    }

    function recuperarPorIdUsuarioYFecha(int $id_usuario, string $dia_actual) :?array
    {
        $dt_dia_siguiente = new DateTime($dia_actual);
        $dt_dia_siguiente -> modify('+1 day');
        $dia_siguiente = $dt_dia_siguiente -> format('Y-m-d');
        $sql = 'select * from reservas where id_usuario=:id_usuario and fecha_hora_reserva between :dia_actual and :dia_siguiente;';
        $stmRecuperarPorIdUsuarioYFecha = $this -> bd -> prepare($sql);
        $stmRecuperarPorIdUsuarioYFecha -> execute([':id_usuario' => $id_usuario, ':dia_actual' => $dia_actual, ':dia_siguiente' => $dia_siguiente]);
        $stmRecuperarPorIdUsuarioYFecha -> setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Reserva::class);
        $reservas = ($stmRecuperarPorIdUsuarioYFecha -> fetchAll()) ?: null;
        return $reservas;
    }

    function seleccionarCamarero($fecha) :int
    {
        $usuarioDao = new EmpleadoDAO($this -> bd);
        $camareros = $usuarioDao -> recuperarUsuariosPorRol('camarero');
        $id_camarero_mesa = null;
        $min_reservas_camarero = null;
        for($i = 0; $i < sizeof($camareros); $i++)
        {
            $id_camarero = $camareros[$i] -> getId_Usuario();
            $reservas = $this -> recuperarporIdUsuarioYFecha($id_camarero, $fecha);
            $num_reservas_camarero = !is_null($reservas) ? sizeof($reservas) : 0;
            if($i == 0 || $num_reservas_camarero < $min_reservas_camarero)
            {
                $min_reservas_camarero = $num_reservas_camarero;
                $id_camarero_mesa = $id_camarero;
            }
        }
        return $id_camarero_mesa;
    }
    
    function recuperarPorMesayFecha($mesa, string $dia_actual) :?array
    {
        $dt_dia_siguiente = new DateTime($dia_actual);
        $dt_dia_siguiente -> modify('+1 day');
        $dia_siguiente = $dt_dia_siguiente -> format('Y-m-d');
        $sql = 'select * from reservas where mesa=:mesa and fecha_hora_reserva between :dia_actual and :dia_siguiente;';
        $stmRecuperarPorMesayFecha = $this -> bd -> prepare($sql);
        $stmRecuperarPorMesayFecha -> execute([':mesa' => $mesa, ':dia_actual' => $dia_actual, ':dia_siguiente' => $dia_siguiente]);
        $stmRecuperarPorMesayFecha -> setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Reserva::class);
        $reservas = ($stmRecuperarPorMesayFecha -> fetchAll()) ?: null;
        return $reservas;
    }
    
    function recuperarPorMesayFechaReserva($mesa, array $fecha_hora)
    {
        $sql = 'select * from reservas where mesa=:mesa and fecha_hora_reserva=:fecha_hora;';
        $stmRecuperarPorMesayFechaReserva = $this -> bd -> prepare($sql);
        $fecha_hora = $fecha_hora[0] . " " . $fecha_hora[1] . ":00";
        $stmRecuperarPorMesayFechaReserva -> execute([':mesa' => $mesa, ':fecha_hora' => $fecha_hora]);
        $stmRecuperarPorMesayFechaReserva -> setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Reserva::class);
        $reservas = ($stmRecuperarPorMesayFechaReserva -> fetch()) ?: null;
        return $reservas;
    }

    function seleccionarMesa(int $mesas, string $dia_actual, array $fecha_hora) :int
    {
        $mesas_disp = null;
        for($i = 1; $i < intval($mesas); $i++)
        {
            $reserva = $this -> recuperarPorMesayFechaReserva($i, $fecha_hora);
            if($reserva == null)
            {
                $mesas_disp[] = $i;
            }
        }
        $min_reservas_mesa = null;
        $mesa = null;
        for($i = 0; $i < sizeof($mesas_disp); $i++)
        {
            $reservas_mesa_dia = $this -> recuperarPorMesayFecha($mesas_disp[$i], $dia_actual);
            $num_reservas_mesa = !is_null($reservas_mesa_dia) ? sizeof($reservas_mesa_dia) : 0;
            if($i == 0 || $num_reservas_mesa < $min_reservas_mesa)
            {
                $min_reservas_mesa = $num_reservas_mesa;
                $mesa = $mesas_disp[$i];
            }
        }
        return $mesa;
    }
    
    function formatearFecha($reserva, int $option)
    {
        $fecha_hora = explode(" ", $option == 1 ? $reserva -> getFechaHoraReserva() : $reserva["fecha_hora_reserva"]);
        $fecha = explode("-", $fecha_hora[0]);
        $hora = explode(":", $fecha_hora[1]);
        $fecha_formateada = $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0] . " " . $hora[0] . ":" . $hora[1];
        $option == 1 ? $reserva -> setFechaHoraReserva($fecha_formateada) : $reserva["fecha_hora_reserva"] = $fecha_formateada;
        return $reserva;
    }

    function recuperarReservas(int $option) :?array
    {
        if($option == 1)
        {
             $sql = 'select reservas.id_reserva as id_reserva, reservas.id_usuario as id_usuario, reservas.mesa as mesa, '
            . 'reservas.nombre as nombre, reservas.apellidos as apellidos, reservas.telefono as telefono, '
            . 'reservas.correo as correo, reservas.fecha_hora_reserva as fecha_hora_reserva, reservas.personas as personas, '
            . 'usuarios.nombre as nombre_empleado from reservas inner join usuarios on reservas.id_usuario = usuarios.id_usuario '
            . 'order by reservas.fecha_hora_reserva desc;';
        }
        else
        {
            $sql = 'select reservas.id_reserva as id_reserva, usuarios.nombre as nombre_usuario, reservas.mesa as mesa,'
            . 'reservas.fecha_hora_reserva as fecha_hora_reserva, concat(reservas.nombre, \' \', reservas.apellidos) as nombre_completo,'
            . 'reservas.personas as personas, reservas.telefono as telefono, reservas.correo as correo from reservas '
            . 'inner join usuarios on reservas.id_usuario = usuarios.id_usuario order by reservas.fecha_hora_reserva desc;';
        }
        $stmRecuperarReservas = $this -> bd -> prepare($sql);
        $stmRecuperarReservas -> execute();
        if($option == 1)
        {
            $stmRecuperarReservas -> setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Reserva::class);
        }
        else
        {
            $stmRecuperarReservas -> setFetchMode(PDO::FETCH_ASSOC);
        }
        $reservas = $stmRecuperarReservas -> fetchAll() ?: null;
        if($reservas != null)
        {
            for($i = 0; $i < count($reservas); $i++)
            {
                $reserva = $this -> formatearFecha($reservas[$i], $option == 1 ? 1 : 2);
                $reservas[$i] = $reserva;
            }
        }
        return $reservas;
    }

    function recuperarReservaPorId(Reserva $reserva) :?array
    {
        $sql = 'select reservas.id_reserva as id_reserva, reservas.id_usuario as id_usuario, reservas.mesa as mesa, '
        . 'reservas.nombre as nombre, reservas.apellidos as apellidos, reservas.telefono as telefono, reservas.correo as correo, '
        . 'reservas.fecha_hora_reserva as fecha_hora_reserva, reservas.personas as personas, usuarios.nombre as nombre_usuario '
        . 'from reservas inner join usuarios on reservas.id_usuario = usuarios.id_usuario where reservas.id_reserva=:id_reserva';
        $stmRecuperarReservaPorId = $this -> bd -> prepare($sql);
        $stmRecuperarReservaPorId -> execute([':id_reserva' => $reserva -> getIdReserva()]);
        return $stmRecuperarReservaPorId -> fetch(PDO::FETCH_ASSOC) ?: null;
    }

    function nuevaReserva(Reserva $reserva) :bool
    {
        $sql = 'insert into reservas (id_usuario, mesa, nombre, apellidos, telefono, correo, fecha_hora_reserva, personas) '
        . 'values (:id_usuario, :mesa, :nombre, :apellidos, :telefono, :correo, :fecha_hora_reserva, :personas)';
        $stmNuevaReserva = $this -> bd -> prepare($sql);
        $stmNuevaReserva -> execute([
        ':id_usuario' => $reserva -> getIdusuario(), ':mesa' => $reserva -> getMesa(),
        ':nombre' => $reserva -> getNombre(), ':apellidos' => $reserva -> getApellidos(),
        ':telefono' => $reserva -> getTelefono(), ':correo' => $reserva -> getCorreo(), 
        ':fecha_hora_reserva' => $reserva -> getFechaHoraReserva(), ':personas' => $reserva -> getPersonas()
        ]);
        $nueva_reserva = boolval($stmNuevaReserva -> rowCount());
        if($nueva_reserva)
        {
            //Generar un pedido asociado a la reserva
            $pedido = new Pedido(null, $reserva -> getMesa(), 'Pendiente', $reserva -> getFechaHoraReserva(), $this -> bd -> lastInsertId());
            $pedidoDAO = new PedidoDAO($this -> bd);
            $nuevo_pedido = $pedidoDAO -> generarPedido($pedido);
        }
        return $nueva_reserva && isset($nuevo_pedido) && $nuevo_pedido;
    }

    function actualizarReserva(Reserva $reserva) :bool
    {
        $sql = 'update reservas set id_usuario=:id_usuario, mesa=:mesa, nombre=:nombre, apellidos=:apellidos, '
        . 'telefono=:telefono, correo=:correo, fecha_hora_reserva=:fecha_hora_reserva, personas=:personas where id_reserva=:id_reserva';
        $stmActualizarReserva = $this -> bd -> prepare($sql);
        $stmActualizarReserva -> execute([
        'id_reserva' => $reserva -> getIdReserva(), 'id_usuario' => $reserva -> getIdUsuario(),
        ':mesa' => $reserva -> getMesa(), ':nombre' => $reserva -> getNombre(), 
        ':apellidos' => $reserva -> getApellidos(), ':telefono' => $reserva -> getTelefono(), 
        ':correo' => $reserva -> getCorreo(), ':fecha_hora_reserva' => $reserva -> getFechaHoraReserva(),
        ':personas' => $reserva -> getPersonas()
        ]);
        $reserva_actualizada = boolval($stmActualizarReserva -> rowCount());
        return $reserva_actualizada;
    }

    function eliminarReserva(Reserva $reserva) :bool
    {
        $sql = 'delete from reservas where id_reserva=:id_reserva';
        $stmEliminarReserva = $this -> bd -> prepare($sql);
        $stmEliminarReserva -> execute([':id_reserva' => $reserva -> getIdReserva()]);
        $reserva_eliminada = boolval($stmEliminarReserva -> rowCount());
        return $reserva_eliminada;
    }

    function eliminarReservas() :bool
    {
        $sql = 'delete from reservas';
        $stmEliminarReservas = $this -> bd -> prepare($sql);
        $stmEliminarReservas -> execute();
        $reservas_eliminadas = $stmEliminarReservas -> rowCount() != 0;
        return $reservas_eliminadas;
    }
}