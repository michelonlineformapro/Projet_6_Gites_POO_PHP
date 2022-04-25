<?php
//Appel du fichier de la classe Gites.php
require_once "modeles/Gites.php";

//Instance de la classe Gites = copie de la classe stockée dans une variable
$gitesClasse = new Gites();
//On stock dans une seconde variable l'appel a la methode getGites() = le resultat de la requète SQL
$gites = $gitesClasse->getGites();
//Debug
//var_dump($gites);

?>
<h3 class="text-danger">Liste de nos gites</h3>
<div class="row">

<?php
//On parcours les resultats à l'aide d'une boucle foreach et un alias
foreach ($gites as $row) {
    ?>
    <div class="col-md-3 col-sm-12">
        <div class="card">
            <img  src="<?= $row['img_gite'] ?>" class="card-img-top img-fluid" alt="...">
            <div class="card-body">
                <h5 class="card-title text-info"><?= $row['nom_gite'] ?></h5>
                <p class="card-text"><b>Description : </b></p>
                <p><?= $row['description_gite'] ?></p>
                <p><b>Nombre de chambre : </b><b class="text-danger"><?= $row['nbr_chambre'] ?></b></p>
                <p><b>Nombre de salle de bains : </b><b class="text-danger"><?= $row['nbr_sdb'] ?></b></p>
                <p><b>Prix à la semaine : </b><b class="text-success"><?= $row['prix_gite'] ?> €</b></p>

                <?php
                //Si $row['disponible'] = tinyint retourne 0 ou 1
                $dispo = $row['disponible'];
                if($dispo == false){
                    $dispo =  "NON";
                }else{
                    $dispo = "OUI";
                }
                ?>

                <p><b>Disponible : </b><b class="text-warning"><?= $dispo ?></b></p>
                <?php
                //Instance de la classe DateTime()
                $date_d = new DateTime($row['date_depart']);
                ?>

                <p><b>Disponible depuis le : </b></p>
                <!--Appel de la methode ->format de la classe DateTime-->
                <p class="alert-info p-2 text-center text-white font-weight-bold"> <?=  $date_d->format('d-m-Y')?></p>

            </div>
        </div>
    </div>

    <?php
}
?>
</div>



