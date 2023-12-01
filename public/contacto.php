<?php

require_once '../vendor/autoload.php';
use eftec\bladeone\BladeOne;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$views= __DIR__.'/../views';
$cache= __DIR__.'/../cache';

$blade= new BladeOne($views, $cache);

echo $blade->run('contacto');

if(!empty($_POST) && isset($_POST['nom']) && isset($_POST['ap']) && isset($_POST['tel']) && isset($_POST['cor']) && isset($_POST['as']) && isset($_POST['men'])){
    $nombre= filter_input(INPUT_POST, 'nom', FILTER_UNSAFE_RAW);
    $apellidos= filter_input(INPUT_POST, 'ap', FILTER_UNSAFE_RAW);
    $telefono= filter_input(INPUT_POST, 'tel', FILTER_UNSAFE_RAW);
    $correo= filter_input(INPUT_POST, 'cor', FILTER_SANITIZE_EMAIL);
    $asunto= filter_input(INPUT_POST, 'as', FILTER_UNSAFE_RAW);
    $mensaje= filter_input(INPUT_POST, 'men', FILTER_UNSAFE_RAW);
    $cuerpo_correo="Nombre: $nombre $apellidos ".$mensaje;
    $correo_receptor= 'crunchy.restaurante@gmail.com';
    $errores= false;
    
    
    if(!$nombre || !$apellidos || !$telefono || !$correo || !$asunto || !$mensaje){
        $errores=true;
    }else{
        
        try {
            
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'crunchy.restaurante@gmail.com';                     //SMTP username
            $mail->Password   = 'vyrf pgcx vbdf ardo ';                               //SMTP password
            $mail->SMTPSecure = 'ssl';//PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('leah@gmail.com', 'Mailer');
            $mail->addAddress('crunchy.restaurante@gmail.com', 'Joe User');     //Add a recipient
            //$mail->addAddress('ellen@example.com');               //Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Contacto: '.$asunto;
            $mail->Body    = $cuerpo_correo;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    
    
}