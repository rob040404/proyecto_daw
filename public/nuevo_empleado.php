<?php

require_once '../vendor/autoload.php';

use eftec\bladeone\BladeOne;
use Dotenv\Dotenv;
use App\BD\BD;
use App\DAO\EmpleadoDAO;
use App\modelo\Empleado;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$views = __DIR__ . '/../views';
$cache = __DIR__ . '/../cache';
$blade = new BladeOne($views, $cache);

set_exception_handler(function ($exception) use ($blade) {
    error_log($exception);
    echo $blade->run('error', compact('exception'));
    exit;
});

// Establece conexión a la base de datos PDO
try {
    $host = $_ENV['DB_HOST'];
    $port = $_ENV['DB_PORT'];
    $database = $_ENV['DB_DATABASE'];
    $usuario = $_ENV['DB_USERNAME'];
    $password = $_ENV['DB_PASSWORD'];
    $bd = BD::getConection($host, $port, $database, $usuario, $password);
} catch (PDOException $error) {
    echo $blade->run("errorbd", compact('error'));
    exit;
}
$error = null;
session_start();
if (isset($_SESSION['empleado'])) {
    // si la sesion esta abierta, nos tiene que redirigir a la pagina admin
    $sesion_abierta = true;
    $dao = new EmpleadoDAO($bd);
    if (isset($_POST['alta'])) {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $contrasena = $_POST['contrasena'];
        $rol = $_POST['rol'];
        $email = $_POST['email'];
        //El id 0 se ignora, pero hay que ponerlo para que funcione el constructor
        $empleado = new Empleado(0, $nombre, $apellidos, $contrasena, $rol, $email);
        $consultaok = $dao->insert($empleado);
        if ($consultaok) {
            header('Location: pagina_de_personal.php?anadido=1');
            exit;
        } else {
            $error = "Algo ha fallado...";
        }
    }
} else {
    $sesion_abierta = false;
    header('Location: index.php');
    exit;
}
echo $blade->run('nuevo_empleado', compact('sesion_abierta', 'error'));