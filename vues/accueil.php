<?php
//appel de la classe gites
require_once "modeles/Gites.php";
//Instance de la classe Gites = copie de la classe stockée dans une variable
$giteClasse = new Gites();
//On stock dans une seconde variable l'appel a la methode getGiteDisponible() = le resultat de la requète SQL
//cette methode affiche les gites dont la date de depart < a la date du jour
$gites = $giteClasse->getGiteDisponible();

//On stock dans une seconde variable l'appel a la methode getGiteIndisponible() = le resultat de la requète SQL
//cette methode affiche les gites dont la date de depart > a la date du jour
$gitesIndisponible = $giteClasse->getGiteIndisponible();
?>
<h3 data-heading="Slide" class="text-danger">Liste de nos gites</h3>
<div class="row">
    <?php
        foreach ($gites as $row){
            ?>
            <div class="mt-3 p-3 col-md-3 col-sm-12">
                <div class="card">
                    <img  src="<?= $row['img_gite'] ?>" class="card-img-top img-fluid" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-info"><?= $row['nom_gite'] ?></h5>
                        <h6 class="text-success">Regions : <?= $row['nom_region'] ?></h6>
                        <p><b>Nombre de chambre : </b><b class="text-danger"><?= $row['nbr_chambre'] ?></b></p>
                        <div class="text-center">
                            <a href="details_gite?id_gite=<?= $row['id_gite'] ?>" class="btn btn-danger">Plus d'infos</a>
                        </div>

                    </div>
                </div>
            </div>
            <?php
        }
    ?>

    <?php
    //On parcours les resultats à l'aide d'une boucle foreach et un alias pour les gites indisponible
    foreach ($gitesIndisponible as $row) {
        //Pour les gites insponible on ajoute un fond rouge + titre + la date de depart bien visible
        ?>
        <div class="mt-3 p-3 col-md-3 col-sm-12 bg-danger">
            <div class="card">
                <div class="text-center p-3">
                    <h4 class="text-warning">INDISPONIBLE</h4>
                </div>

                <img  src="<?= $row['img_gite'] ?>" class="card-img-top img-fluid" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-info"><?= $row['nom_gite'] ?></h5>
                    <h6 class="text-success">Regions : <?= $row['nom_region'] ?></h6>
                    <p><b>Nombre de chambre : </b><b class="text-danger"><?= $row['nbr_chambre'] ?></b></p>
                    <?php

                    $date_d = new DateTime($row['date_depart']);

                    ?>

                    <h5 class="text-danger">Ce gite sera disponible à partir du : </h5>
                    <h4 class="alert-info p-2 text-center text-white font-weight-bold"> <?=  $date_d->format('d-m-Y')?></h4>
                    <div class="text-center">
                        <a href="details_gite?id_gite=<?= $row['id_gite'] ?>" class="btn btn-danger">Plus d'infos</a>
                    </div>

                </div>
            </div>
        </div>
        <?php
    }
    ?>



</div>
