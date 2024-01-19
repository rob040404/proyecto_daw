<?php

require_once '../vendor/autoload.php';

use eftec\bladeone\BladeOne;
use PHPMailer\PHPMailer\PHPMailer;
use App\modelo\Mailer;

$views= __DIR__.'/../views';
$cache= __DIR__.'/../cache';
$blade= new BladeOne($views, $cache);

session_start();
if (isset($_SESSION['empleado'])) {
    // si la sesion esta abierta, nos tiene que redirigir a la pagina admin
    $sesion_abierta = true;
} else {
    $sesion_abierta = false;
}

if(!empty($_POST) && !empty($_FILES) && isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['telefono']) && isset($_POST['correo']) && isset($_POST['mensaje']) && $_FILES['archivo']){
    $nombre= filter_input(INPUT_POST, 'nombre', FILTER_UNSAFE_RAW);
    $apellidos= filter_input(INPUT_POST, 'apellidos', FILTER_UNSAFE_RAW);
    $telefono= filter_input(INPUT_POST, 'telefono', FILTER_UNSAFE_RAW);
    $correo= filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
    $men= filter_input(INPUT_POST, 'mensaje', FILTER_UNSAFE_RAW);
    $mensaje=str_replace( "\n", '<br />', $men );
    $ext = PHPMailer::mb_pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);
    $uploadfile = tempnam(sys_get_temp_dir(), hash('sha256', $_FILES['archivo']['name'])) . '.' . $ext;
    $archivoNombre= $_FILES['archivo']['name'];
    $archivotmp=$_FILES['archivo']['tmp_name'];
    $errores= false;
    if(!$nombre || !$apellidos || !$telefono || !$correo || !$archivoNombre ||!$archivotmp || !$mensaje){
        $errores=true;
    }else{
        if (move_uploaded_file($_FILES['archivo']['tmp_name'], $uploadfile)) {
            $nuevoMail= new Mailer();
            $nuevoMail->setNombre($nombre);
            $nuevoMail->setApellidos($apellidos);
            $nuevoMail->setTelefono($telefono);
            $nuevoMail->setCorreo($correo);
            $nuevoMail->setMensaje($mensaje);
            $nuevoMail->setArchivoNombre($archivoNombre);
            $nuevoMail->setArchivotmp($uploadfile);
            $enviado=$nuevoMail->mandarMensaje();
            if(!$enviado){
                $errores=true;
            }
            $response= compact('errores');
            header('Content-type: application/json');
            echo json_encode($response);
            die;
        }
    }
}
echo $blade->run('trabaja_con_nosotros', compact('sesion_abierta'));