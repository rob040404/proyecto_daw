<?php

require_once '../vendor/autoload.php';

use eftec\bladeone\BladeOne;
use App\modelo\Mailer;



$views= __DIR__.'/../views';
$cache= __DIR__.'/../cache';

$blade= new BladeOne($views, $cache);



if(!empty($_POST) && isset($_POST['nom']) && isset($_POST['ap']) && isset($_POST['tel']) && isset($_POST['cor']) && isset($_POST['as']) && isset($_POST['men'])){
    $nombre= filter_input(INPUT_POST, 'nom', FILTER_UNSAFE_RAW);
    $apellidos= filter_input(INPUT_POST, 'ap', FILTER_UNSAFE_RAW);
    $telefono= filter_input(INPUT_POST, 'tel', FILTER_UNSAFE_RAW);
    $correo= filter_input(INPUT_POST, 'cor', FILTER_SANITIZE_EMAIL);
    $asunto= filter_input(INPUT_POST, 'as', FILTER_UNSAFE_RAW);
    $mensaje= filter_input(INPUT_POST, 'men', FILTER_UNSAFE_RAW);
    $cuerpo_correo="<b>Remitente: </b>$nombre $apellidos <br><b>Correo:</b> $correo <br><b>Mensaje:</b><br> ".$mensaje;
    $correo_receptor= 'crunchy.restaurante@gmail.com';
    $errores= false;
    
    
    if(!$nombre || !$apellidos || !$telefono || !$correo || !$asunto || !$mensaje){
        $errores=true;
    }else{
        
            $nuevoMail= new Mailer();
            $nuevoMail->setNombre($nombre);
            $nuevoMail->setApellidos($apellidos);
            $nuevoMail->setTelefono($telefono);
            $nuevoMail->setCorreo($correo);
            $nuevoMail->setAsunto($asunto);
            $nuevoMail->setMensaje($mensaje);
            $enviado=$nuevoMail->mandarMensaje();
            /*$enviado=$nuevoMail->intermedia();*/
            
            if(!$enviado){
                $errores=true;
            }
            
            $response= compact('errores');
            header('Content-type: application/json');
            echo json_encode($response);
            die;
        
    }
       
    
}
echo $blade->run('contacto');


       