<?php
//Appel du fichier Gites classe
require_once "modeles/Gites.php";
//Instance = copie de la classe stockee dans une variable
$giteClasse = new Gites();
//Appel de la methode getGiteById()
$details = $giteClasse->getGiteById();

?>
<div class="container-fluid bg-warning mt-3 rounded p-3">
<h1 class="text-center text-danger"><b>DÉTAILS DU GITE</b></h1>
<div id="gite-by-id">
    <h2 class="text-center text-warning"><?= $details['nom_gite'] ?></h2>
    <h3 class="text-center text-info">Type : <?= $details['type_gite'] ?></h3>
    <div class="row mt-5">
        <div class="col-6">
            <img width="100%" class="img-fluid rounded" src="<?= $details['img_gite'] ?>" alt="<?= $details['nom_gite']  ?>" title="<?= $details['nom_gite']  ?>"/>

            <br>
            <?php
            //On demarre la session
            //si session connecter retourne la page d'accueil
            if(isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true){
                ?>
                <a href="administration" class="btn btn-danger mt-3">RETOUR</a>
                <form method="post" class="mt-3">
                    <button name="bnt-delete-gite" class="btn btn-success">Supprimer le gite</button>
                </form>

                <?php
                if(isset($_POST['bnt-delete-gite'])){
                    var_dump("test de clic");
                    $giteClasse->deleteGite();
                }
            }else{
                ?>
                <a href="accueil" class="btn btn-danger mt-2">RETOUR</a>
                <?php

            }

            //Si utilisateur est connecté on peu ajouter un commentaire
            if(isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true){
                ?>
                <a href="ajouter_commentaire?id=<?= $details['id_gite'] ?>" class="btn btn-outline-danger mt-2">Ajouter un commentaire</a>
                <a href="reservation?id_gite=<?= $details['id_gite'] ?>" class="btn btn-outline-info mt-2">RESERVER</a>
                <?php
            }else{
                ?>
                <p></p>
                <?php
            }
            ?>
        </div>
        <div class="col-6">
            <p class="card-text"><b>Description : </b></p>
            <p><?= $details['description_gite'] ?></p>
            <p><b>Nombre de chambre : </b><b class="text-danger"><?= $details['nbr_chambre'] ?></b></p>
            <p><b>Nombre de salle de bains : </b><b class="text-danger"><?= $details['nbr_sdb'] ?></b></p>
            <p><b>Zone géographique : </b><b class="text-info"><?= $details['zone_geo'] ?></b></p>
            <p><b>Prix à la semaine : </b><b class="text-success"><?= $details['prix_gite'] ?> €</b></p>

            <?php
            $dispo = $details['disponible'];
            if($dispo == false){
                echo $dispo =  "NON";
            }else{
                echo  $dispo = "OUI";
            }
            ?>

            <p><b>Disponible : </b><b class="text-warning"><?= $dispo ?></b></p>
            <?php
            $date_a = new DateTime($details['date_arrivee']);
            $date_d = new DateTime($details['date_depart']);
            ?>
            <p><b>Date debut de la dernière location : </b> </p>
            <p class="alert-success p-2"><?=  $date_a->format('d-m-Y')?></p>

            <p><b>Date du dernier depart : </b></p>
            <p class="alert-info p-2"> <?=  $date_d->format('d-m-Y')?></p>
        </div>
    </div>
</div>
</div>


