<?php

require_once '../vendor/autoload.php';
use eftec\bladeone\BladeOne;
use App\BD\BD;
use App\modelo\Plato;
use App\DAO\PlatoDAO;
use App\DAO\RestarDAO;
use App\DAO\StockDAO;
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

if(!empty($_POST) && isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['categoria']) && isset($_POST['precio']) && isset($_POST['estado'])){
    $nombre=trim(filter_input(INPUT_POST, 'nombre', FILTER_UNSAFE_RAW));
    $descripcion=filter_input(INPUT_POST, 'descripcion', FILTER_UNSAFE_RAW);
    $categoria=filter_input(INPUT_POST, 'categoria', FILTER_UNSAFE_RAW);
    $subcategoria=filter_input(INPUT_POST, 'subcategoria', FILTER_UNSAFE_RAW);
    $precio=filter_input(INPUT_POST, 'precio', FILTER_UNSAFE_RAW);
    $estado=filter_input(INPUT_POST, 'estado', FILTER_UNSAFE_RAW);
    $ingredientes=$_POST['ingredientes'];
    $errores=false;
    $existe=false;
    $errorIngredientes=false;
    $plato1= new Plato();
    $plato1DAO= new PlatoDAO($bd);
    $stock1DAO= new StockDAO($bd);
    $restar1DAO=new RestarDAO($bd);

    
    $plato1->setNombre($nombre);
    $plato1->setIngredientes($descripcion);
    $plato1->setCategoria($categoria);
    if($subcategoria){
        $plato1->setSubcategoria($subcategoria);
    }
    $plato1->setPrecio($precio);
    $plato1->setEstado($estado);
    
    $respuesta=$plato1DAO->insertarPlato($plato1->getNombre(), $plato1->getIngredientes(), $plato1->getCategoria(), $plato1->getSubcategoria(), $plato1->getPrecio(), $plato1->getEstado());
    
    if($respuesta==='existe'){
        $existe=true;
    }else if($respuesta===false){
        $errores=true;
    }else{
        $id_plato=$plato1DAO->obtener_id($plato1->getNombre());
        foreach ($ingredientes as $ingrediente){
            $ing=$ingrediente[0];
            $cantidad=$ingrediente[1];
            $id_producto=$stock1DAO->obtener_id($ing);
            if($id_producto){
                $resultado=$restar1DAO->insertar($id_plato, $id_producto, $cantidad);
                if($resultado===false){
                    $errorIngredientes=true;
                }
            } else {
                $errorIngredientes=true;
            }
        }
    }
    
    $response= compact('existe', 'errores', 'errorIngredientes');
    header('Content-type: application/json');
    echo json_encode($response);
    die;
}







/*

$antiguo_nom="Tacos al pastor";

$modificacion= $plato1DAO->modificar($antiguo_nom, $plato1->getNombre(), $plato1->getIngredientes(), $plato1->getCategoria(), $plato1->getSubcategoria(), $plato1->getPrecio(), $plato1->getEstado());



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

