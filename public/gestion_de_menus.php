<?php

require_once '../vendor/autoload.php';
require_once 'tablas_platos.php';
use eftec\bladeone\BladeOne;
use App\BD\BD;
use App\modelo\Plato;
use App\modelo\Stock;
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

//Recibe la señal por ajax para obtener todos los ingredientes de stock para luego pasarlos al cliente e imprimirlos en el formulario añadir y puedan ser seleccionados
if(!empty($_POST) && isset($_POST['obtenerStock'])){
    $rescepcion=trim(filter_input(INPUT_POST, 'obtenerStock', FILTER_UNSAFE_RAW));
    $ingredientes= array();
    $stock1DAO= new StockDAO($bd);
    
    $resultados=$stock1DAO->obtener_nombres();
    
    if($resultados){
        foreach ($resultados as $resultado){
            $ingredientes[]=$resultado->nombre_producto;
        }
    }
    
    $response= compact('ingredientes');
    header('Content-type: Application/json');
    echo json_encode($response);
    die;
    
}
//Recibe los datos por ajax, para insertar un plato con los valores dados
else if(!empty($_POST) && isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['categoria']) && isset($_POST['precio']) && isset($_POST['estado'])){
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
    $plato1->setSubcategoria($subcategoria);
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
//Recibe detos por ajax para buscar un plato por nombre. Viene del ajax, donde se le pasa el nombre del plato
else if(!empty($_POST) && isset($_POST['operacion']) && isset($_POST['por_categoria'])){
    $nombre=trim(filter_input(INPUT_POST, 'nombreBuscar', FILTER_UNSAFE_RAW));
    $operacion=trim(filter_input(INPUT_POST, 'operacion', FILTER_UNSAFE_RAW));
    $categoria=trim(filter_input(INPUT_POST, 'categoria', FILTER_UNSAFE_RAW));
    $por_categoria= json_decode($_POST['por_categoria']);
    $error=false;
    $plato1DAO= new PlatoDAO($bd);
    $fila=false;
    
    if($por_categoria){
        $registro=$plato1DAO->buscar_por_cat($categoria);
    }else{
        $registro= $plato1DAO->buscarPorNombre($nombre);
    }
    
    $id_plato=false;
    $nom=false;
    $des=false;
    $cat=false;
    $sub=false;
    $pre=false;
    $es=false;
    
    if($registro===false){
        $error=true;
    } else if(!$por_categoria){
        $id_plato=$registro->id_plato;
        $nom=$registro->nombre;
        $des=$registro->ingredientes;
        $cat=$registro->categoria;
        $sub=$registro->subcategoria;
        $pre=$registro->precio;
        $es=$registro->estado;
        if($operacion!=='modificar'){
            $fila= tabla($registro, $operacion);
        }
    }else if($por_categoria===true){
        $fila= tabla_larga($registro, $operacion);
    }
    
    $response= compact('error', 'fila', 'operacion', 'id_plato', 'nom', 'des', 'cat', 'sub', 'pre', 'es');
    header('Content-type: application/json');
    echo json_encode($response);
    die;
}
//Recibe datos del ajax para modificar
else if(!empty($_POST) && isset($_POST['id_platoMod']) && isset($_POST['nombreMod']) && isset($_POST['descripcionMod']) && isset($_POST['categoriaMod']) && isset($_POST['precioMod']) && isset($_POST['estadoMod'])){
    $id_plato=trim(filter_input(INPUT_POST, 'id_platoMod', FILTER_UNSAFE_RAW));
    $nombre=trim(filter_input(INPUT_POST, 'nombreMod', FILTER_UNSAFE_RAW));
    $descripcion=filter_input(INPUT_POST, 'descripcionMod', FILTER_UNSAFE_RAW);
    $categoria=filter_input(INPUT_POST, 'categoriaMod', FILTER_UNSAFE_RAW);
    $subcategoria=filter_input(INPUT_POST, 'subcategoriaMod', FILTER_UNSAFE_RAW);
    $precio=filter_input(INPUT_POST, 'precioMod', FILTER_UNSAFE_RAW);
    $estado=filter_input(INPUT_POST, 'estadoMod', FILTER_UNSAFE_RAW);
    
    $inexistente=false;
    $errores=false;
    $plato1= new Plato();
    $plato1DAO= new PlatoDAO($bd);
    //$stock1DAO= new StockDAO($bd);
    //$restar1DAO=new RestarDAO($bd);

    $plato1->setId_plato($id_plato);
    $plato1->setNombre($nombre);
    $plato1->setIngredientes($descripcion);
    $plato1->setCategoria($categoria);
    $plato1->setSubcategoria($subcategoria);
    $plato1->setPrecio($precio);
    $plato1->setEstado($estado);
    
    $resultado=$plato1DAO->modificar_por_id($plato1->getId_plato(), $plato1->getNombre(), $plato1->getIngredientes(), $plato1->getCategoria(), $plato1->getSubcategoria(), $plato1->getPrecio(), $plato1->getEstado());
    
    if($resultado==='No existe'){
        $inexistente=true;
    }else if($resultado===false){
        $errores=true;
    }
    
    $response= compact('inexistente', 'errores');
    header('Content-type: Application/json');
    echo json_encode($response);
    die;
    
    
}
//Recibe datos del ajax para cambiar de estado de los platos
else if(!empty ($_POST) && isset ($_POST['estadoCambiar']) && isset ($_POST['nombreCambiar'])){
    $estadoActual= trim(filter_input(INPUT_POST, 'estadoCambiar', FILTER_UNSAFE_RAW));
    $nombre=trim(filter_input(INPUT_POST, 'nombreCambiar', FILTER_UNSAFE_RAW));
    $estadoNuevo=null;
    $error=false;
    if($estadoActual==='activado'){
        $estadoNuevo='desactivado';
    }else if($estadoActual==='desactivado'){
        $estadoNuevo='activado';
    }
    
    $plato1DAO= new PlatoDAO($bd);
    
    $resultadoActivar=$plato1DAO->activar_desactivar($nombre, $estadoNuevo);
    
    if(!$resultadoActivar){
        $error=true;
    }
    $response= compact('error', 'estadoNuevo');
        header('Content-type: application/json');
        echo json_encode($response);
        die;
    
}
else if(!empty ($_POST) && isset ($_POST['idCambiarPorTabla'])){
    $id=trim(filter_input(INPUT_POST, 'idCambiarPorTabla', FILTER_UNSAFE_RAW));
    $plato1DAO= new PlatoDAO($bd);
    $error=false;
    $filaActual=$plato1DAO->buscarPorId($id);
    $estadoActual=$filaActual->estado;
    
    if($estadoActual==='activado'){
        $estadoNuevo='desactivado';
    }else{
        $estadoNuevo='activado';
    }
    
    $resultadoActivar=$plato1DAO->activar_desactivar_por_id($id, $estadoNuevo);
    
    if(!$resultadoActivar){
        $error=true;
    }
    
    $response= compact('error', 'estadoNuevo');
        header('Content-type: application/json');
        echo json_encode($response);
        die;
}
//Ricibe detos por ajax para borrar un plato
else if(!empty ($_POST) && isset ($_POST['nombreBorrar'])){
    $nombre= trim(filter_input(INPUT_POST, 'nombreBorrar', FILTER_UNSAFE_RAW));
    $plato1DAO= new PlatoDAO($bd);
    $error=false;
    
    $resultado= $plato1DAO->borrarPorNombre($nombre);
    
    if($resultado===false || $resultado==='No existe'){
        $error=true;
    }
    $response= compact('error');
        header('Content-type: application/json');
        echo json_encode($response);
        die;
}
else if(!empty ($_POST) && isset ($_POST['idBorrarPorTabla'])){
    $id= trim(filter_input(INPUT_POST, 'idBorrarPorTabla', FILTER_UNSAFE_RAW));
    $plato1DAO= new PlatoDAO($bd);
    $error=false;
    
    $fila=$plato1DAO->buscarPorId($id);
    $nombre=$fila->nombre;
    
    $resultado= $plato1DAO->borrarPorNombre($nombre);
    
    if($resultado===false || $resultado==='No existe'){
        $error=true;
    }
    $response= compact('error');
        header('Content-type: application/json');
        echo json_encode($response);
        die;
    
}
else{
    echo $blade->run('gestion_de_menus', compact('sesion_abierta'));
}



