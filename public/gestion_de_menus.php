<?php

require_once '../vendor/autoload.php';
use eftec\bladeone\BladeOne;
use App\BD\BD;
use App\modelo\Plato;
use App\DAO\PlatoDAO;
use Dotenv\Dotenv;

session_start();

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$views= __DIR__.'/../views';
$cache= __DIR__.'/../cache';

$blade= new BladeOne($views, $cache);

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

$plato1= new Plato();
$plato1DAO= new PlatoDAO($bd);

$antiguo_nom="Tacos al pastor";
$plato1->setNombre("tacos al pastor");
$plato1->setIngredientes('Carne a la brasa, cilantro, lima, tortita de maiz');
$plato1->setCategoria('principal');
$plato1->setSubcategoria('tacos');
$plato1->setPrecio(8.9);
$plato1->setEstado('activado');


$modificacion= $plato1DAO->modificar($antiguo_nom, $plato1->getNombre(), $plato1->getIngredientes(), $plato1->getCategoria(), $plato1->getSubcategoria(), $plato1->getPrecio(), $plato1->getEstado());
/*


$insercion= $plato1DAO->insertarPlato($plato1->getNombre(), $plato1->getIngredientes(), $plato1->getCategoria(), $plato1->getSubcategoria(), $plato1->getPrecio(), $plato1->getEstado());

$activacion=$plato1DAO->activar_desactivar("Taco al pastor", "activado");


$registro=$plato1DAO->buscarPorNombre("Taco al pastor");
$idPlato= $registro->id_plato;
$nombrePlato= $registro->nombre;
$precioPlato=$registro->precio;

$platos=$plato1DAO->buscarPorCategoría("principal");
$registro=$plato1DAO->buscarPorId("2");
$borrado=$plato1DAO->borrarPorNombre("Taco al pastor");
*/


$nah=null;
echo $blade->run('gestion_de_menus', compact('sesion_abierta'));

