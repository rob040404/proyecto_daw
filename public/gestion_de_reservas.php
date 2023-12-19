<?php
require_once '../vendor/autoload.php';
use Dotenv\Dotenv;
use eftec\bladeone\BladeOne;
use App\BD\BD;
use App\modelo\Reserva;
use App\DAO\EmpleadoDAO;
use App\DAO\ReservaDAO;

session_start();
if(!isset($_SESSION['empleado']))
{
    header('Location: login.php');
    exit;
}
else
{
    $dotenv = Dotenv::createImmutable(__DIR__ . "/../");
    $dotenv -> load();

    $views = __DIR__ . '/../views';
    $cache = __DIR__ . '/../cache';

    $blade = new BladeOne($views, $cache);

    // Establece conexión a la base de datos PDO
    try 
    {
        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $database = $_ENV['DB_DATABASE'];
        $usuario = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $bd = BD::getConection($host, $port, $database, $usuario, $password);
    } 
    catch(PDOException $error) 
    {
        echo $blade->run("errorbd", compact('error'));
        exit();
    }
    $empleadoDAO = new EmpleadoDAO($bd);
    $reservasDAO = new ReservaDAO($bd);
    $sesion_abierta = true;
    if(filter_input(INPUT_POST, 'btn_nueva_reserva') || filter_input(INPUT_POST, 'btn_modificar_reserva') || filter_input(INPUT_POST, 'btn_eliminar_reserva/s'))
    {
        $reservas = $reservasDAO -> recuperarReservas(1);
        $opcion = array_values(filter_input_array(INPUT_POST))[0];
        if($opcion != 'Eliminar reserva/s')
        {
            $usuarios = $empleadoDAO -> recuperarUsuarios();
            echo $blade -> run('gestion_de_reservas', compact('sesion_abierta', 'reservas', 'opcion', 'usuarios'));
        }
        else
        {
            echo $blade -> run('gestion_de_reservas', compact('sesion_abierta', 'reservas', 'opcion'));
        }
    }
    else if(filter_input(INPUT_POST, 'cargar_horarios'))
    {
        $fecha = filter_input(INPUT_POST, 'fecha');
        $mesa = filter_input(INPUT_POST, 'mesa');
        $fecha_editar = filter_input(INPUT_POST, 'fecha_editar');
        $horas_disponibles = $reservasDAO -> recuperarReservasDisponibles($fecha, $mesa, $fecha_editar);
        $response = compact('horas_disponibles');
        header('Content-type: application/json');
        echo (json_encode($response));
        die;
    }
    else if(filter_input(INPUT_POST, 'nueva_reserva') || filter_input(INPUT_POST, 'modificar_reserva'))
    {   
        $values = ['id_reserva' => filter_input(INPUT_POST, 'id_reserva', FILTER_UNSAFE_RAW),
        'id_usuario' => filter_input(INPUT_POST, 'id_usuario', FILTER_UNSAFE_RAW),
        'mesa' => filter_input(INPUT_POST, 'mesa', FILTER_UNSAFE_RAW),
        'nombre' => filter_input(INPUT_POST, 'nombre', FILTER_UNSAFE_RAW),
        'apellidos' => filter_input(INPUT_POST, 'apellidos', FILTER_UNSAFE_RAW),
        'telefono' => filter_input(INPUT_POST, 'telefono', FILTER_UNSAFE_RAW),
        'correo' => filter_input(INPUT_POST, 'correo', FILTER_UNSAFE_RAW),
        'fecha_hora_reserva' => filter_input(INPUT_POST, 'fecha', FILTER_UNSAFE_RAW). " " .filter_input(INPUT_POST, 'hora', FILTER_UNSAFE_RAW),
        'personas' => filter_input(INPUT_POST, 'personas', FILTER_UNSAFE_RAW)];
        $reserva = new Reserva(isset($values['id_reserva']) ? $values['id_reserva'] : null, $values['id_usuario'], $values['mesa'], 
        $values['nombre'], $values['apellidos'], $values['telefono'], $values['correo'], $values['fecha_hora_reserva'], $values['personas']);
        !isset($values['id_reserva']) ? $reservasDAO -> nuevaReserva($reserva) : $reservasDAO -> actualizarReserva($reserva);
        $reservas = $reservasDAO -> recuperarReservas(2);
        $response = compact('reservas');
        header('Content-type: application/json');
        echo (json_encode($response));
        die;
    }
    else if(filter_input(INPUT_POST, 'buscar_reserva', FILTER_UNSAFE_RAW) || filter_input(INPUT_POST, 'eliminar_reserva'))
    {
        $reserva = new Reserva(filter_input(INPUT_POST, 'id_reserva', FILTER_UNSAFE_RAW));
        if(filter_input(INPUT_POST, 'buscar_reserva', FILTER_UNSAFE_RAW))
        {
            $reserva = $reservasDAO -> recuperarReservaPorId($reserva);
            $response = compact('reserva');
        }
        else
        {
            $reservasDAO -> eliminarReserva($reserva);
            $reservas = $reservasDAO -> recuperarReservas(2);
            $response = compact('reservas');
        }
        header('Content-type: application/json');
        echo (json_encode($response));
        die;
    }
    else if(filter_input(INPUT_POST, 'eliminar_reservas'))
    {
        $reservasDAO -> eliminarReservas();
        $reservas = $reservasDAO -> recuperarReservas(1);
        $reservas_eliminadas = true;
        echo $blade -> run('gestion_de_reservas', compact('sesion_abierta', 'reservas', 'reservas_eliminadas'));
    }
    else
    {
        $reservas = $reservasDAO -> recuperarReservas(1);
        echo $blade -> run('gestion_de_reservas', compact('sesion_abierta', 'reservas'));
    }
}