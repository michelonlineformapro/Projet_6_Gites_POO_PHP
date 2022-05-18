<?php

//Appel du fichier model
require_once "modeles/Gites.php";
//Instance de la classe gite
$gites = new Gites();
$details = $gites->getGiteById();
?>
<h1 class="alert-success p-5 text-center text-dark mt-3">Votre réservation est validée !</h1>
<h2 class="text-center text-danger"><b>Récapitulatif de votre réservation :</b></h2>
<?php
$date_a = new DateTime($details['date_arrivee']);
$date_d = new DateTime($details['date_depart']);
?>
<p><b>Votre de d'arrivée : </b></p>
<h4 class="alert alert-success p-2 text-center text-white"><?= $date_a->format('d-m-Y') ?></h4>

<p><b>Votre date de depart : </b></p>
<h4 class="alert alert-info p-2 text-center text-danger"> <?= $date_d->format('d-m-Y') ?></h4>
<a href="accueil" class="btn btn-info">ACCUEIL</a>



<div id="gite-by-id">
        <h2 class="text-center text-info"><?= $details['nom_gite'] ?></h2>
<h3 class="text-center text-info">Type : <?= $details['type_gite'] ?></h3>
<div class="row mt-5">
    <div class="col-6">
        <img width="100%" class="img-fluid rounded" src="<?= $details['img_gite'] ?>"
             alt="<?= $details['nom_gite'] ?>" title="<?= $details['nom_gite'] ?>"/>
    </div>
    <!--On affiche le reste des details pour tous le monde-->
    <div class="col-6">
        <p class="card-text"><b>Description : </b></p>
        <p><?= $details['description_gite'] ?></p>
        <p><b>Nombre de chambre : </b><b class="text-danger"><?= $details['nbr_chambre'] ?></b></p>
        <p><b>Nombre de salle de bains : </b><b class="text-danger"><?= $details['nbr_sdb'] ?></b></p>
        <p><b>Zone géographique : </b><b class="text-info"><?= $details['zone_geo'] ?></b></p>
        <p><b>Prix à la semaine : </b><b class="text-success"><?= $details['prix_gite'] ?> €</b></p>
    </div>
</div>
</div>

?>
