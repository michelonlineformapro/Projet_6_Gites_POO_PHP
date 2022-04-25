<?php
require_once "modeles/Gites.php";

//Instance de la classe Gites = copie de la classe stockée dans une variable
$gitesClasse = new Gites();

$gites = $gitesClasse->getGites();
var_dump($gites);

?>
<div class="row">
<?php
foreach ($gites as $gite) {
    ?>
    <div class="col-md-3 col-sm-12">
        <p>NOM du gites ! <?= $gite['nom_gite'] ?></p>
    </div>

    <?php
}
?>
</div>



