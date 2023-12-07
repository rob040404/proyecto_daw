<?php

namespace App\DAO;

use PDO;
use DateTime;
use App\DAO\EmpleadoDAO;
use App\modelo\Reserva;

class ReservaDAO
{
    private $bd;
    private $mesas;
    function __construct($bd)
    {
        $this->bd = $bd;
        $this->mesas = 2;
    }

    function formatearFecha($reserva)
    {
        $fecha = $reserva->getFecha_hora_reserva();
        $fecha_separada = explode(" ", $fecha);
        $ano_mes_dia = explode("-", $fecha_separada[0]);
        $hora_minutos_segundos = explode(":", $fecha_separada[1]);
        $fecha_correcta = $ano_mes_dia[2] . "/" . $ano_mes_dia[1] . "/" . $ano_mes_dia[0] . " "
            . $hora_minutos_segundos[0] . ":" . $hora_minutos_segundos[1];
        $reserva->setFecha_hora_reserva($fecha_correcta);
        return $reserva;
    }

    function formatearFecha2($reserva)
    {
        $fecha_separada = explode(" ", $reserva["fecha_hora_reserva"]);
        $ano_mes_dia = explode("-", $fecha_separada[0]);
        $hora_minutos_segundos = explode(":", $fecha_separada[1]);
        $fecha_correcta = $ano_mes_dia[2] . "/" . $ano_mes_dia[1] . "/" . $ano_mes_dia[0] . " "
            . $hora_minutos_segundos[0] . ":" . $hora_minutos_segundos[1];
        $reserva["fecha_hora_reserva"] = $fecha_correcta;
        return $reserva;
    }

    function recuperarHorarios($fecha)
    {
        $format = 'Y-m-d H:i:s';
        $fecha_inicial = DateTime::createFromFormat($format, $fecha . ' ' . '13:30:00');
        $fecha_final = DateTime::createFromFormat($format, $fecha . ' ' . '23:00:00');
        $horarios = [];
        while ($fecha_inicial != $fecha_final) {
            $fecha_reserva = clone ($fecha_inicial->modify('+30 minutes'));
            $horarios[] = $fecha_reserva->format('Y-m-d H:i:s');
        }
        return $horarios;
    }

    function buscarFechaReservasMesa($mesa, $fecha_reserva)
    {
        $sql = 'select fecha_hora_reserva from reservas where mesa=:mesa and fecha_hora_reserva=:fecha_reserva';
        $sth = $this->bd->prepare($sql);
        $sth->execute([':mesa' => $mesa, ':fecha_reserva' => $fecha_reserva]);
        $fechaRepetida = !empty($sth->fetch());
        return $fechaRepetida;
    }

    function recuperarReservasDisponibles($fecha, $mesa, $fecha_editar)
    {
        $horarios = $this->recuperarHorarios($fecha);
        $indices = [];
        $ocupada = true;
        for ($i = 0; $i < sizeof($horarios); $i++) {
            if (!is_null($mesa)) {
                if (!is_null($fecha_editar) && $horarios[$i] == $fecha_editar) {
                    $ocupada = false;
                } else {
                    $ocupada = $this->buscarFechaReservasMesa($mesa, $horarios[$i]);
                }
                if ($ocupada) {
                    $indices[] = $i;
                }
            } else {
                $mesas_ocup = 0;
                for ($mesas = 1; $mesas <= $this->mesas; $mesas++) {
                    $ocupada = $this->buscarFechaReservasMesa($mesas, $horarios[$i]);
                    if ($ocupada) {
                        $mesas_ocup++;
                    }
                    if ($mesas_ocup == $this->mesas) {
                        $indices[] = $i;
                    }
                }
            }
        }
        for ($i = 0; $i < sizeof($indices); $i++) {
            unset($horarios[$indices[$i]]);
        }
        $horarios = array_values($horarios);
        $horas_disponibles = [];
        for ($i = 0; $i < sizeof($horarios); $i++) {
            $horas_disponibles[] = substr($horarios[$i], 11, 5);
        }
        return $horas_disponibles;
    }

    function recuperarporIdUsuarioYFecha($id_usuario, $fecha)
    {
        $dt_dia_siguiente = new DateTime($fecha);
        $dt_dia_siguiente->modify('+1 day');
        $dia_siguiente = $dt_dia_siguiente->format('Y-m-d');
        $sql = 'select * from reservas where id_usuario=:id_usuario and fecha_hora_reserva between :dia_actual and :dia_siguiente;';
        $sth = $this->bd->prepare($sql);
        $sth->execute([':id_usuario' => $id_usuario, ':dia_actual' => $fecha, ':dia_siguiente' => $dia_siguiente]);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Reserva::class);
        $reservas = ($sth->fetchAll()) ?: null;
        return $reservas;
    }

    function seleccionarCamarero($fecha)
    {
        $usuarioDao = new EmpleadoDAO($this->bd);
        $camareros = $usuarioDao->recuperarUsuariosPorRol('camarero');
        $id_camarero_mesa = null;
        $min_reservas_camarero = !null;
        for ($i = 0; $i < sizeof($camareros); $i++) {
            $id_camarero = $camareros[$i]->getId_Usuario();
            $reservas = $this->recuperarporIdUsuarioYFecha($id_camarero, $fecha);
            $num_reservas_camarero = !is_null($reservas) ? sizeof($reservas) : 0;
            if ($i == 0 || $num_reservas_camarero < $min_reservas_camarero) {
                $min_reservas_camarero = $num_reservas_camarero;
                $id_camarero_mesa = $id_camarero;
            }
        }
        return $id_camarero_mesa;
    }

    function recuperarPorMesayFechaReserva($mesa, $fecha_hora)
    {
        $sql = 'select * from reservas where mesa=:mesa and fecha_hora_reserva=:fecha_hora;';
        $sth = $this->bd->prepare($sql);
        $fecha_hora = $fecha_hora[0] . " " . $fecha_hora[1] . ":00";
        $sth->execute([':mesa' => $mesa, ':fecha_hora' => $fecha_hora]);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Reserva::class);
        $reservas = ($sth->fetch()) ?: null;
        return $reservas;
    }

    function recuperarPorMesayFecha($mesa, $dia_actual)
    {
        $dt_dia_siguiente = new DateTime($dia_actual);
        $dt_dia_siguiente->modify('+1 day');
        $dia_siguiente = $dt_dia_siguiente->format('Y-m-d');
        $sql = 'select * from reservas where mesa=:mesa and fecha_hora_reserva between :dia_actual and :dia_siguiente;';
        $sth = $this->bd->prepare($sql);
        $sth->execute([':mesa' => $mesa, ':dia_actual' => $dia_actual, ':dia_siguiente' => $dia_siguiente]);
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Reserva::class);
        $reservas = ($sth->fetchAll()) ?: null;
        return $reservas;
    }

    function seleccionarMesa($mesas, $dia_actual, $fecha_hora)
    {
        $mesas_disp = null;
        for ($i = 1; $i < intval($mesas); $i++) {
            $reserva = $this->recuperarPorMesayFechaReserva($i, $fecha_hora);
            if ($reserva == null) {
                $mesas_disp[] = $i;
            }
        }
        $min_reservas_mesa = null;
        $mesa = null;
        for ($i = 0; $i < sizeof($mesas_disp); $i++) {
            $reservas_mesa_dia = $this->recuperarPorMesayFecha($mesas_disp[$i], $dia_actual);
            $num_reservas_mesa = !is_null($reservas_mesa_dia) ? sizeof($reservas_mesa_dia) : 0;
            if ($i == 0 || $num_reservas_mesa < $min_reservas_mesa) {
                $min_reservas_mesa = $num_reservas_mesa;
                $mesa = $mesas_disp[$i];
            }
        }
        return $mesa;
    }

    function recuperarReservas()
    {
        $sql = 'select reservas.id_reserva as id_reserva, reservas.id_usuario as id_usuario, reservas.mesa as mesa,'
            . 'reservas.nombre as nombre, reservas.apellidos as apellidos, reservas.fecha_hora_reserva as fecha_hora_reserva,'
            . 'reservas.telefono as telefono, reservas.correo as correo, reservas.personas as personas,'
            . 'reservas.fecha_hora_llegada as fecha_hora_llegada, reservas.estado as estado, reservas.observaciones as observaciones,'
            . 'usuarios.nombre as nombre_empleado from reservas inner join usuarios ON reservas.id_usuario = usuarios.id_usuario '
            . 'order by reservas.fecha_hora_reserva desc;';
        $sth = $this->bd->prepare($sql);
        $sth->execute();
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Reserva::class);
        $reservas = $sth->fetchAll() ?: null;
        if ($reservas != null) {
            for ($i = 0; $i < count($reservas); $i++) {
                $reserva = $this->formatearFecha($reservas[$i]);
                $reservas[$i] = $reserva;
            }
        }
        return $reservas;
    }

    function recuperarReservas2()
    {
        $sql = 'select reservas.id_reserva as id_reserva, usuarios.nombre as nombre_usuario, reservas.mesa as mesa,'
            . 'reservas.fecha_hora_reserva as fecha_hora_reserva, concat(reservas.nombre, \' \', reservas.apellidos) as nombre_completo,'
            . 'reservas.personas as personas, reservas.telefono as telefono, reservas.correo as correo from reservas '
            . 'inner join usuarios on reservas.id_usuario = usuarios.id_usuario order by reservas.fecha_hora_reserva desc;';
        $sth = $this->bd->prepare($sql);
        $sth->execute();
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $reservas = $sth->fetchAll() ?: null;
        if ($reservas != null) {
            for ($i = 0; $i < count($reservas); $i++) {
                $reserva = $this->formatearFecha2($reservas[$i]);
                $reservas[$i] = $reserva;
            }
        }
        return $reservas;
    }

    function recuperarReservaPorId($id)
    {
        $sql = 'select reservas.id_reserva as id_reserva, reservas.id_usuario as id_usuario, usuarios.nombre as nombre_usuario, reservas.mesa as mesa,'
            . 'reservas.fecha_hora_reserva as fecha_hora_reserva, reservas.nombre as nombre, reservas.apellidos as apellidos,'
            . 'reservas.telefono as telefono, reservas.correo as correo, reservas.personas as personas from reservas '
            . 'inner join usuarios on reservas.id_usuario = usuarios.id_usuario where reservas.id_reserva=:id';
        $sth = $this->bd->prepare($sql);
        $sth->execute([':id' => $id]);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $reserva = $sth->fetch() ?: null;
        return $reserva;
    }

    function nuevaReserva(Reserva $reserva)
    {
        $sql = 'insert into reservas (id_usuario, mesa, nombre, apellidos, fecha_hora_reserva, telefono, correo, Personas) '
            . 'VALUES (:id_usuario, :mesa, :nombre, :apellidos, :fecha, :telefono, :correo, :personas)';
        $sth = $this->bd->prepare($sql);
        $sth->execute([
            ':id_usuario' => $reserva->getId_usuario(), ':mesa' => $reserva->getMesa(),
            ':nombre' => $reserva->getNombre(), ':apellidos' => $reserva->getApellidos(), ':fecha' => $reserva->getFecha_hora_reserva(),
            ':telefono' => $reserva->getTelefono(), ':correo' => $reserva->getCorreo(), ':personas' => $reserva->getPersonas()
        ]);
        $nueva_reserva = boolval($sth->rowCount());
        return $nueva_reserva;
    }

    function actualizarReserva(Reserva $reserva)
    {
        $sql = 'update reservas set id_usuario=:id_usuario, mesa=:mesa, nombre=:nombre, apellidos=:apellidos, fecha_hora_reserva=:fecha,'
            . 'telefono=:telefono, correo=:correo, personas=:personas where id_reserva=:id_reserva';
        $sth = $this->bd->prepare($sql);
        $sth->execute([
            'id_reserva' => $reserva->getId_reserva(), 'id_usuario' => $reserva->getId_usuario(),
            ':mesa' => $reserva->getMesa(), ':fecha' => $reserva->getFecha_hora_reserva(), ':nombre' => $reserva->getNombre(),
            ':apellidos' => $reserva->getApellidos(), ':telefono' => $reserva->getTelefono(), ':correo' => $reserva->getCorreo(),
            ':personas' => $reserva->getPersonas()
        ]);
        $actualizar_reserva = boolval($sth->rowCount());
        return $actualizar_reserva;
    }

    function eliminarReserva($id)
    {
        $sql = 'delete from reservas where id_reserva=:id';
        $sth = $this->bd->prepare($sql);
        $sth->execute([':id' => $id]);
        $eliminada = boolval($sth->rowCount());
        return $eliminada;
    }

    function eliminarReservas()
    {
        $sql = 'delete from reservas';
        $sth = $this->bd->prepare($sql);
        $sth->execute();
        $eliminadas = $sth->rowCount() != 0;
        return $eliminadas;
    }
}
