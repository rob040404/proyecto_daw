<?php
require_once '../vendor/autoload.php';

use Dotenv\Dotenv;
use eftec\bladeone\BladeOne;
use App\BD\BD;
use App\modelo\Pedido;
use App\modelo\DetallePedido;
use App\DAO\PedidoDAO;
use App\DAO\DetallePedidoDAO;
use App\DAO\EmpleadoDAO;
use App\DAO\PlatoDAO;
use App\DAO\RestarDAO;
use App\modelo\Restar;
use App\DAO\StockDAO;
use App\modelo\Stock;

session_start();
if (!isset($_SESSION['empleado'])) {
    header('Location: login.php');
    exit;
} else {
    $dotenv = Dotenv::createImmutable(__DIR__ . "/../");
    $dotenv->load();

    $views = __DIR__ . '/../views';
    $cache = __DIR__ . '/../cache';

    $blade = new BladeOne($views, $cache);

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
        exit();
    }
    $empleadoDAO = new EmpleadoDAO($bd);
    $pedidoDAO = new PedidoDAO($bd);
    $platoDAO = new PlatoDAO($bd);
    $sesion_abierta = true;
    $detallePedidoDAO = new DetallePedidoDAO($bd);
    $fecha_pedido = filter_input(INPUT_POST, 'fecha_pedido');
    if (!isset($fecha_pedido)) {
        $dt_actual = new DateTime();
        $fecha_pedido = $dt_actual->format('Y-m-d');
    }
    $pedidos = $pedidoDAO->recuperarPedidosPorFecha($fecha_pedido);
    if (filter_input(INPUT_POST, 'btn_retroceder') || filter_input(INPUT_POST, 'btn_avanzar')) {
        $id_pedido = filter_input(INPUT_POST, 'id_pedido');
        $estado_pedido = filter_input(INPUT_POST, 'estado_pedido');
        if (filter_input(INPUT_POST, 'btn_retroceder')) {
            if ($estado_pedido == 'Pendiente') {
                $borrado = $detallePedidoDAO->borrarDetallePedido($id_pedido);
            }
            $pedidoDAO->actualizarEstadoPedido(new Pedido($id_pedido, null, $estado_pedido));
        } else {
            error_log($estado_pedido);
            if ($estado_pedido == 'Completado') {
                $platos = $platoDAO->recuperarPlatos();
                $platos_seleccionados = [];
                for ($i = 0; $i < sizeof($platos); $i++) {
                    $platos_seleccionados = $detallePedidoDAO->recuperarPlatosSeleccionadosPorIdPedidoYPlato(new DetallePedido($id_pedido, $platos[$i]['id_plato']), $platos_seleccionados);
                }
                if (!empty($platos_seleccionados)) {
                    $pedidoDAO->actualizarEstadoPedido(new Pedido($id_pedido, null, $estado_pedido));
                } else {
                    $estado_pedido = 'Confirmado';
                }
            } elseif ($estado_pedido == 'Confirmado') {
                $restarDAO = new RestarDAO($bd);
                $stockDAO = new StockDAO($bd);
                $restar = $restarDAO->obtenerIngredientes($id_pedido);
                error_log(print_r($restar, true));
                foreach ($restar as $item) {
                    $stockDAO->update(
                        $item->getId_producto(),
                        (-1) * $item->getCantidad()
                    );
                }
                $pedidoDAO->actualizarEstadoPedido(new Pedido($id_pedido, null, "Confirmado"));
            } else {
                $pedidoDAO->actualizarEstadoPedido(new Pedido($id_pedido, null, $estado_pedido));
            }
        }
        $pedido['id_pedido'] = $id_pedido;
        $pedido['estado_pedido'] = $estado_pedido;
        $response = compact('pedido');
        header('Content-type: application/json');
        echo (json_encode($response));
        die;
    } else if (filter_input(INPUT_POST, 'cargar_platos') || filter_input(INPUT_POST, 'cargar_platos_guardados')) {
        $id_pedido = filter_input(INPUT_POST, 'idPedido');
        $platos = $platoDAO->recuperarPlatos();
        $platos_seleccionados = [];
        for ($i = 0; $i < sizeof($platos); $i++) {
            $platos_seleccionados = $detallePedidoDAO->recuperarPlatosSeleccionadosPorIdPedidoYPlato(new DetallePedido($id_pedido, $platos[$i]['id_plato']), $platos_seleccionados);
        }
        if (filter_input(INPUT_POST, 'cargar_platos')) {
            $response = compact('platos', 'platos_seleccionados');
        } else {
            $response = compact('platos_seleccionados');
        }
        $response = compact('platos', 'platos_seleccionados');
        header('Content-type: application/json');
        echo (json_encode($response));
        die;
    } else if (filter_input(INPUT_POST, 'guardar_pedido')) {
        $id_pedido = filter_input(INPUT_POST, 'idPedido');
        $pedido_data = filter_input_array(INPUT_POST)['pedido_data'];
        $borrado = $detallePedidoDAO->borrarDetallePedido($id_pedido);
        $platos_seleccionados = [];
        if (!empty($pedido_data)) {
            for ($i = 0; $i < sizeof($pedido_data); $i++) {
                $detalle_pedido = new DetallePedido($id_pedido, $pedido_data[$i]['id_plato'], $pedido_data[$i]['unidades']);
                $detallePedidoDAO->insertarDetallePedido($detalle_pedido);
                $platos_seleccionados = $detallePedidoDAO->recuperarPlatosSeleccionadosPorIdPedidoYPlato($detalle_pedido, $platos_seleccionados);
            }
        }
        $response = compact('platos_seleccionados');
        header('Content-type: application/json');
        echo (json_encode($response));
        die;
    } else {
        if (!is_null($pedidos)) {
            for ($i = 0; $i < sizeof($pedidos); $i++) {
                $detalles_pedido = $detallePedidoDAO->recuperarDetallesPedidoPorId($pedidos[$i]->getIdPedido());
                if (!is_null($detalles_pedido)) {
                    $pedidos[$i]->setDetallesPedido($detalles_pedido);
                }
            }
        }
        echo $blade->run('gestion_de_pedidos', compact('sesion_abierta', 'pedidos', 'fecha_pedido'));
    }
}
