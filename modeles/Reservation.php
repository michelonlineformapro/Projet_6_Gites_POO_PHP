<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';


class Reservation
{
    public function reserverGite(){
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Utilisation du service mail transfer protocole
            $mail->isSMTP(); //Utilisation du service mail transfer protocole
            $mail->Host = 'smtp.mailtrap.io'; //Appel du host mailtrap
            $mail->SMTPAuth = true; //Autorise et impose un user name + password
            $mail->Username = '1e9a0eeda636b9'; //Generer lors de la création du compte mailTrap = dans l'espace mailtrap roue crantée + smtp setting -> phpmailer
            $mail->Password = '64faa6d7e0bd01'; // Idem pour le mot de passe
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //La Transport Layer Security (TLS) ou « Sécurité de la couche de transport »
            $mail->Port = 2525; //Port pour mailtrap sinon ->587 ou 465 pour `PHPMailer::ENCRYPTION_SMTPS` et gmail
            $mail->setLanguage('fr', '../vendor/phpmailer/phpmailer/language/');
            $mail->CharSet = 'UTF-8';

            //Recipients
            $mail->setFrom('from@example.com', 'Mailer');
            $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
            $mail->addAddress('ellen@example.com');               //Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'test du sujet';
            $mail->Body    = 'Le contenu du mail';
            $mail->AltBody = 'Copie si ca marche pas';

            $mail->send();
            echo 'Message à bien ete envoyé (ceci s\'affiche sur la vue reservation.php)';
        } catch (Exception $e) {
            echo "Sinon on affiche une erreur : {$mail->ErrorInfo}";
        }
    }

}