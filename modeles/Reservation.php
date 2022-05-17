<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
require_once "modeles/Gites.php";

class Reservation extends Gites
{
    public function reserverGite(){
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
            //Configurauin du server SMTP avec les infos du compte mailTrap
            $mail->isSMTP(); //Utilisation du service mail transfer protocole
            $mail->Host = 'smtp.mailtrap.io'; //Appel du host (hote) mailtrap
            $mail->SMTPAuth = true; //Autorise et impose un user name + password
            $mail->Username = '1e9a0eeda636b9'; //Generer lors de la création du compte mailTrap = dans l'espace mailtrap roue crantée + smtp setting -> phpmailer
            $mail->Password = '64faa6d7e0bd01'; // Idem pour le mot de passe
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //La Transport Layer Security (TLS) ou « Sécurité de la couche de transport »
            $mail->Port = 2525; //Port pour mailtrap sinon ->587 ou 465 pour `PHPMailer::ENCRYPTION_SMTPS` et gmail
            $mail->setLanguage('fr', '../vendor/phpmailer/phpmailer/language/');//Traduction en francais
            //Encodage des charactères latins
            $mail->CharSet = 'UTF-8';

            //Connexiona pdo via la classe mere Database.php methode publique getPDO()
            $giteDetails = $this->getGiteById();

            //Recipients
            $mail->setFrom($_POST['email_user'], 'Administration');
            $mail->addAddress($_POST['email_user'], 'Administrateur');     //Add a recipient
            $mail->addAddress($_POST['email_user']);               //Name is optional
            $mail->addReplyTo($_POST['email_user'], 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');

            //Attachments = piece jointe
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Contenus HTML de l'email
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "Demade de reservation";

            $mail->AltBody = 'Copie si ca marche pas';

            //Le destinataire et les 2 dates
            $destinataire = $_POST['email_user'];
            $dateArrivee = $_POST['date_arrivee'];
            $dateDepart = $_POST['date_depart'];

            //Le booleen pour valider l'envoi du mail

            //On stock la date du jour
            $today = date("Y-m-d");

            //Appel de la methode de mise a jour de la classe gite
            $this->updateEmailDateGite();

            $emailID = $giteDetails['id_gite'];
            //Url de retour sur notre site
            $url = "http://localhost/Gites_Poo_PHP/confirmer-reservation?id=$emailID";
            $mail->Body    = '
               <!DOCTYPE html>
                    <html lang="fr">
                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="Content-Type" content="text/html">
                        <title>Votre reservation chez locagite.com</title>
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    </head>
                    <body style="color: #6cc3d5;">
                    <div style="color: #6cc3d5; padding: 20px;">
                        <img src="https://qiwo-indie-games.alwaysdata.net/assets/images/2.jpg" style="display: block; border-radius: 100%" width="50px" height="50px">
                        <h3 style="color: #1D2326">LOCA-GITES.COM</h3>
                        <!--INFOS DE DEBUG -->
                        <p>ICI ID DU GITE A RESERVER: ' . $destinataire . '  </p>
                    </div>
                    <div style="padding: 20px;">
                        <h1>Loca-gite.com</h1>
                        <h2>Vous : '.$destinataire.'</h2>
                        <p>Vous avez déposé une demande de reservation (ET C BIEN)  avec le liens suivant</p><br />
                        <p>Recapitulatif de votre commande</p>
                        <p>Nom du gite :<b style="color: #2c4f56">'.$giteDetails['nom_gite'].'</b></p>
                        <p>Description du gite :<b style="color: #2c4f56"> '.$giteDetails['description_gite'].'</b></p>
                        <p>Image du gite :<img width="25%" src="https://upload.wikimedia.org/wikipedia/fr/thumb/7/7c/G%C3%AEtes_de_France_%28logo%29.svg/1200px-G%C3%AEtes_de_France_%28logo%29.svg.png"/></p>
                        <p>Prix par semaine du gite :<b style="color: #2c4f56"> '.$giteDetails['prix_gite'].' €</b></p>
                        <p>Nombre de chambre :<b style="color: #2c4f56"> '.$giteDetails['nbr_chambre'].'</b></p>
                        <p>Nombre de salle de bain :<b style="color: #2c4f56"> '.$giteDetails['nbr_sdb'].'</b></p>
                        <p>Zone géographique :<b style="color: #2c4f56"> '.$giteDetails['zone_geo'].'</b></p>
                        <p>Date arrivée :<b style="color: #2c4f56"> '.$dateArrivee.'</b></p>
                        <p>Date départ :<b style="color: #2c4f56"> '.$dateDepart.'</b></p>
                        <p>Description du gite :<b style="color: #2c4f56"> '.$giteDetails['type_gite'].'</b></p>
                        <p>Toutes fois vous avez la possibilité d\'annuler ou de confirmer votre commande</p>
                        <br /><br />
                        <a href="' . $url . '" style="background-color: darkred; color: #F0F1F2; padding: 20px; text-decoration: none;">Confimer la reservation de votre gite</a><br />
                        <br />
                        <p>Merci d\'utiliser notre site web</p>
                        <p>Cordialement : Loca-gite.com: Michael MICHEL : Administrateur</p>    
                    </div>
                    </body>
                    </html>
                    ';
            //Pour le MIME = https://www.commentcamarche.net/contents/175-standard-mime-multipurpose-internet-mail-extensions
            $mail->body = "MIME-Version: 1.0";
            //Options de l'en-tete
            //https://developer.mozilla.org/fr/docs/Web/HTTP/Headers/Content-Type
            $mail->body = "Content-type: text/html;charset=utf8";

            //La d'arrivee doit etre > a la date du jour
            if($dateArrivee < $today){
                echo "<p class='alert alert-danger'>erreur : la date d'arrivée' doit etre > a la date du jour !</p>";
            }elseif($dateDepart < $dateArrivee) {
                echo "<p class='alert alert-danger'>erreur : la date de depart doit etre > a la date d'arrivée !</p>";
            }else{
                //Si les dates sont correct = on evoie email
                //Avec la classe PhpMailer
                $mail->send();
                //On cache le formulaire
                ?>
                <style>
                    #reservation-form{
                        display: none;
                    }
                </style>
                <?php
                //Message de reussite
                echo '<p class="mt-3 alert alert-success">Votre réservation à bien été validé : un email de validation vous à été envoyé !</p>';
            }
        } catch (Exception $e) {
            echo "Sinon on affiche une erreur : {$mail->ErrorInfo}";
        }
    }

}