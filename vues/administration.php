<?php
require_once "modeles/Gites.php";

//Instance = copie de la stockée dans une vaiable
$giteClasse = new Gites();

//On stocke dans une variable le resulatat de la requètes SQL

$gites = $giteClasse->getGites();

?>
<div class="container-fluid bg-primary mt-3 rounded p-3">
    <div class="text-center">
        <h2 class="text-warning p-3">ESPACE ADMINISTRATION : Liste de nos gites</h2>
        <div class="text-center">
            <a href="ajouter-gite" class="btn btn-danger">AJOUTER UN GITE</a>
        </div>

    </div>
    <div class="row">
        <?php
        foreach ($gites as $row){
            ?>

            <div class="col-4 mt-3">
                <div class="card">
                    <img  src="<?= $row['img_gite'] ?>" class="card-img-top img-fluid" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-info"><?= $row['nom_gite'] ?></h5>
                        <p class="card-text"><b>Description : </b></p>
                        <p><?= $row['description_gite'] ?></p>
                        <p><b>Type de logement :</b><b class="text-info"><?= $row['type_gite'] ?></b></p>
                        <p><b>Nombre de chambre : </b><b class="text-danger"><?= $row['nbr_chambre'] ?></b></p>
                        <p><b>Nombre de salle de bains : </b><b class="text-danger"><?= $row['nbr_sdb'] ?></b></p>
                        <p><b>Zone géographique : </b><b class="text-info"><?= $row['nom_region'] ?></b></p>
                        <p><b>Prix à la semaine : </b><b class="text-success"><?= $row['prix_gite'] ?> €</b></p>

                        <?php
                        $dispo = $row['disponible'];
                        if($dispo == false){
                            $dispo =  "NON";
                        }else{
                            $dispo = "OUI";
                        }
                        ?>

                        <p><b>Disponible : </b><b class="text-warning"><?= $dispo ?></b></p>
                        <?php

                        $date_d = new DateTime($row['date_depart']);
                        ?>

                        <p><b>Date du dernier depart : </b></p>
                        <p class="alert-info p-2 text-center text-white font-weight-bold"> <?=  $date_d->format('d-m-Y')?></p>
                        <a href="details_gite?id_gite=<?= $row['id_gite'] ?>" class="btn btn-outline-info">Plus d'infos</a>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>



