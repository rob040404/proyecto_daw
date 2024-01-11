<?php
require_once '../vendor/autoload.php';
use Dotenv\Dotenv;
use App\modelo\Mailer;
use App\modelo\Reserva;
use eftec\bladeone\BladeOne;
use App\BD\BD;
use App\DAO\ReservaDAO;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

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
catch (PDOException $error) 
{
    echo $blade -> run("errorbd", compact('error'));
    exit();
}
session_start();
$sesion_abierta = isset($_SESSION['empleado']); 
$reservasDAO = new ReservaDAO($bd);
const MESAS_RESTAURANTE = 10;
if(filter_input_array(INPUT_POST))
{
    if(filter_input(INPUT_POST, 'cargar_horarios'))
    {
        $fecha = filter_input(INPUT_POST, 'fecha');
        $horas_disponibles = $reservasDAO -> recuperarReservasDisponibles($fecha, null, null);
        $response = compact('horas_disponibles');
        header('Content-type: application/json');
        echo (json_encode($response));
        die;
    }
    else
    {
        $values = ['mesa' => filter_input(INPUT_POST, 'mesa', FILTER_UNSAFE_RAW),
        'nombre' => filter_input(INPUT_POST, 'nombre', FILTER_UNSAFE_RAW),
        'apellidos' => filter_input(INPUT_POST, 'apellidos', FILTER_UNSAFE_RAW),
        'telefono' => filter_input(INPUT_POST, 'telefono', FILTER_UNSAFE_RAW), 
        'correo' => filter_input(INPUT_POST, 'correo', FILTER_UNSAFE_RAW),
        'personas' => filter_input(INPUT_POST, 'personas', FILTER_UNSAFE_RAW)];
        $fecha_hora = [filter_input(INPUT_POST, 'fecha', FILTER_UNSAFE_RAW), filter_input(INPUT_POST, 'hora', FILTER_UNSAFE_RAW)];
        $id_usuario = $reservasDAO -> seleccionarCamarero(filter_input(INPUT_POST, 'fecha', FILTER_UNSAFE_RAW));
        $mesa = $reservasDAO -> seleccionarMesa(MESAS_RESTAURANTE, filter_input(INPUT_POST, 'fecha', FILTER_UNSAFE_RAW), $fecha_hora);
        $reserva = new Reserva(null, $id_usuario, $mesa, $values['nombre'], $values['apellidos'], $values['telefono'], $values['correo'], implode(' ', $fecha_hora), $values['personas'], null);
        $reservasDAO -> nuevaReserva($reserva);
        $mail = new Mailer();
        $mail -> setCorreo($values['correo']);
        $mail -> setNombre(htmlentities($values['nombre']));
        $mail -> setApellidos(htmlentities($values['apellidos']));
        $fecha_hora_formateada = $reservasDAO -> formatearFecha(["fecha_hora_reserva" => implode(' ', $fecha_hora)], 2);
        $mail -> setFecha(explode(' ', $fecha_hora_formateada["fecha_hora_reserva"])[0]);
        $mail -> setHora(explode(' ', $fecha_hora_formateada["fecha_hora_reserva"])[1]);
        $mail -> setPersonas($values['personas']);
        //$enviado = $mail -> enviarReserva();
        echo $blade -> run('reservar', compact('sesion_abierta', 'reserva', 'fecha_hora'));
    }
}
else
{
    echo $blade -> run('reservar', compact('sesion_abierta'));
}