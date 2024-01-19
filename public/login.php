<?php

require_once '../vendor/autoload.php';

use eftec\bladeone\BladeOne;
use Dotenv\Dotenv;
use App\BD\BD;
use App\DAO\EmpleadoDAO;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

// Inicializa el acceso a las variables de entorno

$views = __DIR__ . '/../views';
$cache = __DIR__ . '/../cache';
$blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG);

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

$empleado = null;
$dao = new EmpleadoDAO($bd);
$sesion_abierta = false;
session_start();
if (isset($_SESSION['empleado'])) {
    // si la sesion esta abierta, nos tiene que redirigir a la pagina admin
    $sesion_abierta = true;
    header("Location: index.php");
    exit;
} else if (isset($_POST['confirmar'])) {
    // si alguien ha pulsado el boton confirmar, hay que comprobar si el usuario y la pass son correctos
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $empleado = $dao->select($usuario, $password);
    if ($empleado) {
        //Login correcto
        $_SESSION['empleado'] = $empleado;
        $sesion_abierta = true;
        header("Location: index.php");
        exit;
    } else {
        $test = "Usuario/password incorrectos!";
    }
} else {
    // si no hay nada, nos quedamos en la pagina login
    $test = "";
}
echo $blade->run("login2", compact('test', 'sesion_abierta'));
