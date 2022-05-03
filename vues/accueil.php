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
                <p><b>Nombre de chambre : </b><b class="text-danger"><?= $row['nbr_chambre'] ?></b></p>

            </div>
        </div>
    </div>

    <?php
}
?>
</div>



