<?php
require_once '../vendor/autoload.php';

use App\modelo\Mailer;
$correo='robert704@outlook.com';
$nombre= 'Robert';
$apellidos= 'Green';
$fecha= '20/02/2024';
$hora= '21:00';
$personas= 2;

$mail= new Mailer();
$mail->setCorreo($correo);
$mail->setNombre($nombre);
$mail->setApellidos($apellidos);
$mail->setFecha($fecha);
$mail->setHora($hora);
$mail->setPersonas($personas);

$enviado=$mail->enviarReserva();

$nah=0;