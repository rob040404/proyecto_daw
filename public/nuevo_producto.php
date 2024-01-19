<?php

require_once '../vendor/autoload.php';

use eftec\bladeone\BladeOne;
use Dotenv\Dotenv;
use App\BD\BD;
use App\modelo\Stock;
use App\DAO\StockDAO;

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
    $dao = new StockDAO($bd);
    if (isset($_POST['anadir'])) {
        $nombre_producto = $_POST['nombre_producto'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        //El id 0 se ignora, pero hay que ponerlo para que funcione el constructor
        $stock = new Stock(0, $nombre_producto, $precio, $cantidad);
        $consultaok = $dao->insert($stock);
        if ($consultaok) {
            header('Location: pagina_de_inventario.php?anadido=1');
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
echo $blade->run('nuevo_producto', compact('sesion_abierta', 'error'));