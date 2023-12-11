<?php


require_once '../vendor/autoload.php';


use App\BD\BD;
use App\DAO\StockDAO;
use Dotenv\Dotenv;

session_start();

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

//solo las peticiones con ajax
header('Content-type: application/json');

set_exception_handler(function ($exception) {
    echo json_encode(["resultado" => false, "mensaje" => "Error: " . $exception->getMessage()]);
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
    //Al conveertirse en json los []->{}, =>->:
    //Ejemplo: {"resultado":true, "mensaje":"Error de conexion a la base de datos."}
    echo json_encode(["resultado" => false, "mensaje" => "Error de conexion a la base de datos."]);
}

if (isset($_SESSION['empleado'])) {
    // si la sesion esta abierta, nos tiene que redirigir a la pagina admin
    $dao = new StockDAO($bd);
    if (isset($_POST['actualizarStock'])) {
        $idproducto = $_POST['idproducto'];
        $cantidad = $_POST['cantidad'];
        $consultaok = $dao->update($idproducto, $cantidad);
        if ($consultaok) {
            $producto = $dao->selectid($idproducto);
            echo json_encode(["resultado" => true, "mensaje" => "actualizado.", "cantidad" => $producto->getCantidad()]);
        } else {
            echo json_encode(["resultado" => false, "mensaje" => "no se ha podido actualizar."]);
        }
    } elseif (isset($_POST['eliminarStock'])) {
        $idproducto = $_POST['idproducto'];
        $consultaok = $dao->delete($idproducto);
        if ($consultaok) {
            $producto = $dao->selectid($idproducto);
            echo json_encode(["resultado" => true, "mensaje" => "actualizado.", "cantidad" => $producto->getCantidad()]);
        } else {
            echo json_encode(["resultado" => false, "mensaje" => "no se ha podido borrar."]);
        }
    }
} else {
    echo json_encode(["resultado" => false, "mensaje" => "sesion caducada."]);
}
