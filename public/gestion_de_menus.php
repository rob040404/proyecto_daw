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

//Insertar platos. Recibe los datos por ajax
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
//Para activar o desactivar un plato. Viene del ajax, donde se le pasa el nombre del plato
else if(!empty($_POST) && isset($_POST['nombreBuscar']) && isset($_POST['operacion'])){
    $nombre=trim(filter_input(INPUT_POST, 'nombreBuscar', FILTER_UNSAFE_RAW));
    $operacion=trim(filter_input(INPUT_POST, 'operacion', FILTER_UNSAFE_RAW));
    $error=false;
    $plato1DAO= new PlatoDAO($bd);
    
    $registro= $plato1DAO->buscarPorNombre($nombre);
    
    if($registro===false){
        $error=true;
    } else if(!$operacion==='modificar'){
        $fila= tabla($registro, $operacion);
    }else{
        $fila=false;
    }
    $response= compact('error', 'fila', 'operacion' );
    header('Content-type: application/json');
    echo json_encode($response);
    die;
}
//
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
else{
    echo $blade->run('gestion_de_menus', compact('sesion_abierta'));
}


function tabla($registro, $operacion){
    $contenido='<table class="tabla">
            <thead>
                <tr>
                    <th>Nombre</th>';
    
    
                    if($operacion==='ver'|| $operacion==='borrar'){
    $contenido.=        '<th>Descripción</th>';
                    }
                    
                    
    $contenido.=    '<th>Categoría</th>
                    <th>Subcategoría</th>
                    <th>Precio</th>
                    <th>Estado</th>';
    
                    if($operacion==='activar'){
    $contenido.=   '<th>Cambiar estado<th>';                   
                    }else if($operacion==='borrar'){
    $contenido.=    '<th>Eliminar plato<th>';     
                    }
    
    
    $contenido.='</tr>
            </thead>
            <tbody>
                <tr>
                    <td id="nombre">'.$registro->nombre.'</td>';
    
    
                    if($operacion==='ver'|| $operacion==='borrar'){
    $contenido.=        '<td id="descripcion">'.$registro->ingredientes.'</td>';
                    }
                    
                    
                    
    $contenido.=                '<td id="categoria">'.$registro->categoria.'</td>
                    <td id="subcategoria">'.$registro->subcategoria.'</td>
                    <td id="precio">'.$registro->precio.'</td>
                    <td id="estado">'.$registro->estado.'</td>';
    
    
                    if($operacion==='activar'){
    $contenido.=        '<td>
                            <button type="button" class="boton-tabla" name="cambiar-estado" id="cambiar-estado">
                                <div class="guardar" >Cambiar</div>
                            </button>
                        </td>';
                    }else if($operacion==='borrar'){
    $contenido.=        '<td>
                            <button type="button" class="boton-tabla" name="borrar-plato" id="borrar-plato">
                                <div class="guardar" >Borrar</div>
                            </button>
                        </td>';
                    }
                    
                    
                    
    $contenido.=       '</tr>
                    </tbody>
                </table>';
    
    return $contenido;
}
