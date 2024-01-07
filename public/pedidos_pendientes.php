<?php

require_once '../vendor/autoload.php';

use eftec\bladeone\BladeOne;
use App\BD\BD;
use App\DAO\PedidoDAO;
use App\modelo\Pedido;
use App\DAO\RestarDAO;
use App\modelo\Restar;
use App\DAO\StockDAO;
use App\modelo\Stock;
use Dotenv\Dotenv;

session_start();

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

if (isset($_SESSION['empleado'])) {
    // si la sesion esta abierta, nos tiene que redirigir a la pagina admin
    $sesion_abierta = true;
} else {
    $sesion_abierta = false;
    header('Location: index.php');
    exit;
}
$pedidoDAO = new PedidoDAO($bd);
$faltan = "";
$stock = [];

if (isset($_POST['cocinar'])) {
    $id_pedido = $_POST['id_pedido'];
    $pedidoDAO->actualizarEstadoPedido(
        new Pedido($id_pedido, null, 'Confirmado')
    );
    header('Location: pedidos_pendientes.php?ok=confirmado');
    exit;
} elseif (isset($_POST['servir'])) {
    $id_pedido = $_POST['id_pedido'];
    $restarDAO = new RestarDAO($bd);
    $stockDAO = new StockDAO($bd);
    $restar = $restarDAO->obtenerIngredientes($id_pedido);
    error_log(print_r($restar, true));
    if (null == $restar) {
        header('Location: pedidos_pendientes.php?ok=NoHayPlatosPedidos');
        exit;
    } else {
        if ($restarDAO->hayStock($restar)) {
            foreach ($restar as $item) {
                $stockDAO->update(
                    $item->getId_producto(),
                    (-1) * $item->getCantidad()
                );
            }
            $pedidoDAO->actualizarEstadoPedido(new Pedido($id_pedido, null, "Completado"));
            header('Location: pedidos_pendientes.php?ok=completado');
            exit;
        } else {
            error_log('no hay stock');
            $pedidoDAO->actualizarEstadoPedido(
                new Pedido($id_pedido, null, 'Pendiente')
            );
            $restar = $restarDAO->obtenerIngredientesSinStock($id_pedido);
            foreach ($restar as $item) {
                $stock[] = $stockDAO->selectid($item->getId_producto())->getNombre_producto();
            }
            //con el implode el array se convierte en un string separado por comas
            header('Location: pedidos_pendientes.php?ok=faltaStock&faltan=' . implode(",", $stock));
            exit;
        }
    }
}

if (isset($_GET['ok'])) {
    $ok = $_GET['ok'];
    if (isset($_GET['faltan'])) {
        $faltan = $_GET['faltan'];
    }
} else {
    $ok = null;
}


$dt_actual = new DateTime();
$fecha_pedido = $dt_actual->format('Y-m-d');
//$reservasDAO = new ReservaDAO($bd);
//$reservas = $reservasDAO->recuperarReservas();
$pedidos = $pedidoDAO->recuperarPedidosPorFecha($fecha_pedido);
if (null == $pedidos) {
    $pedidos = array();
}
error_log(print_r($pedidos, true));

echo $blade->run('pedidos_pendientes', compact('sesion_abierta', 'pedidos', 'ok', 'faltan'));
