<?php
namespace App\modelo;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Mailer{
    private $nombre= null;
    private $apellidos= null;
    private $telefono=null;
    private $correo= null;
    private $asunto= null;
    private $mensaje= null;
    private $archivoNombre= null;
    private $archivotmp=null;


    public function __construct() {
        
    }
    
    public function getNombre() {
        return $this->nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function getAsunto() {
        return $this->asunto;
    }

    public function getMensaje() {
        return $this->mensaje;
    }
    
    public function getArchivoNombre() {
        return $this->archivoNombre;
    }
    
    public function getArchivotmp() {
        return $this->archivotmp;
    }
    
    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setApellidos($apellidos): void {
        $this->apellidos = $apellidos;
    }

    public function setTelefono($telefono): void {
        $this->telefono = $telefono;
    }

    public function setCorreo($correo): void {
        $this->correo = $correo;
    }

    public function setAsunto($asunto): void {
        $this->asunto = $asunto;
    }

    public function setMensaje($mensaje): void {
        $this->mensaje = $mensaje;
    }
    
    public function setArchivoNombre($archivoNombre): void {
        $this->archivoNombre = $archivoNombre;
    }
    
    public function setArchivotmp($archivotmp): void {
        $this->archivotmp = $archivotmp;
    }

    public function mandarMensaje(){
        $cuerpo_correo="<b>Remitente: </b>$this->nombre $this->apellidos <br><b>Correo:</b> $this->correo <br><b>Mensaje:</b><br> ".$this->mensaje;
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug =0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'crunchy.restaurante@gmail.com';                     //SMTP username
            $mail->Password   = 'vyrf pgcx vbdf ardo ';                               //SMTP password
            $mail->SMTPSecure = 'ssl';//PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($this->correo, 'App');
            $mail->addAddress('crunchy.restaurante@gmail.com', 'Restaurante Crunchy');     //Add a recipient
            //$mail->addAddress('ellen@example.com');               //Name is optional
            $mail->addReplyTo($this->correo);
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            if($this->archivoNombre && $this->archivotmp){
                $mail->addAttachment($this->archivotmp, $this->archivoNombre);         //Add attachments
            }
            
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            
            if($this->asunto){
                $mail->Subject = 'Contacto: '.$this->asunto;
            } else {
                $mail->Subject = 'Empleo';
            }    
            $mail->Body    = $cuerpo_correo;
            
            
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $resultado=$mail->send();
            
            if($resultado){
                return true;
            }else{
                return false;
            }
            //echo 'Message has been sent';
        } catch (Exception $e) {
            return false;
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    
}


