<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }


    public function enviarConfrimacionEmail(){
        //crear el objeto de email

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'appsalon.com');
        $mail->Subject = 'Confrimar tu cuenta';

        //sethtml

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong> Hola ". $this->nombre . "</strong> Has creado tu cuenta en APPSalon, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='". $_ENV['APP_URL'] ."/confirmar-cuenta?token=" . $this->token ."'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, Puedes ignorar este mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        $mail->send();
    }

    public function enviarInstrucciones(){
        //crear el objeto de email

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'appsalon.com');
        $mail->Subject = 'Restablece tu Password';

        //sethtml

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong> Hola ". $this->nombre . "</strong> Has solicitado un restablecimiento de password sigue el siguiente enlace para hacerlo</p>";
        $contenido .= "<p>Presiona aqui: <a href='". $_ENV['APP_URL'] ."/recuperar?token=" . $this->token ."'>Restablecer Password</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, Puedes ignorar este mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        $mail->send();
    }
}
