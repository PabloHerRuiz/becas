<?php
use PHPMailer\PHPMailer\PHPMailer;

require "vendor/autoload.php";

class ServicioCorreos
{
    public static function enviarCorreo($correo,$contenido)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        // introducir usuario de google
        $mail->Username = "pherrui680@g.educaand.es";
        // introducir clave
        $mail->Password = "naji ecbh impa axzi";
        $mail->SetFrom('pherrui680@g.educaand.es', 'Prueba');
        // asunto
        $mail->Subject = "Solicitud de beca";
        // cuerpo
        $html_message = "Has realizado la solicitud correctamente";
        $mail->MsgHTML($html_message);
        $filename = "Solicitud.pdf";
        file_put_contents($filename, $contenido);
        $mail->addAttachment($filename);
        // destinatario
        $address = $correo;
        $mail->AddAddress($address, "Solicitud");
        // enviar
        $resul = $mail->Send();
        if (!$resul) {
            return "Error al enviar: " . $mail->ErrorInfo;
        } else {
            return "Enviado";
        }
    }
}
?>