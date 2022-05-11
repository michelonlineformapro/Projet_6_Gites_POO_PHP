<?php
//Appel de la classe Commentaires
require_once "modeles/Commentaires.php";
//instance (copie) de la classe stockée dans une variable
$commentaireClasse = new Commentaires();
?>


<div class="container">
    <form method="post">
        <h4 class="text-success">Ajouter un commentaire</h4>
        <?php
        //Stock de l'email de utilisateur connecter dans une variable
            $email = $_SESSION['email_user'];
            //Recup de ID du gite depuis URL
            $id = $_GET['id_gite'];
        ?>
        <div class="mb-3">
            <!--Par defaut la valeur de ce champ (et le placeholder) est = a la $_SESSION['email_user']-->
            <input type="email" value="<?= $email ?>" class="form-control"  name="auteur_commentaire" placeholder="<?= $email ?>">
        </div>

        <div class="form-group">
            <label for="contenus_commentaire">Votre commentaire : </label>
            <textarea class="form-control" id="contenus_commentaire" name="contenus_commentaire" rows="5"></textarea>
        </div>

        <!--Ce champ est caché et prend par defaut ID du gite concerner par ajout du commentaire-->
        <div class="mb-3">
            <input type="hidden" name="gites_id" value="<?= $id ?>">
        </div>

        <button type="submit" name="btn-add-comment" class="btn btn-outline-success">Ajouter un commentaire</button>

    </form>
</div>

<?php
//On recup l'attribut name du bouton et au clic
//On appel la methode addComments() de la classe Commentaires
if(isset($_POST['btn-add-comment'])){
    $commentaireClasse->addComments();
}
