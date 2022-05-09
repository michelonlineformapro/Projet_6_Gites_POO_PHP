<?php
//Appel de la classe Utilisateurs
require_once "modeles/Utilisateurs.php";
$userClasse = new Utilisateurs();
?>

<div class="text-center">
    <h3>INSCRIPTION</h3>
    <form method="post" id="form-register-user">
        <div class="mb-3">
            <label for="email_utilisateur">Email</label>
            <input class="form-control" type="email" placeholder="email@email.fr" required name="email_user" id="email_utilisateur">
        </div>

        <div class="mb-3">
            <label for="password_utilisateur">Mot de passe</label>
            <input class="form-control" type="password" placeholder="Mot2P@sse" required name="password_user" id="password_utilisateur">
        </div>

        <div class="mb-3">
            <label for="password_utilisateur">Mot de passe repeter</label>
            <input class="form-control" type="password" placeholder="Mot2P@sse" required name="password_repeat" id="password_utilisateur">
        </div>

        <div class="mb-3">
            <button class="btn btn-success" name="btn-add_user">S'inscire</button>
        </div>


        <a href="accueil" class="btn btn-danger">Annuler</a>
    </form>
</div>

<?php
if(isset($_POST['btn-add_user'])){
    var_dump("ok click");
    $userClasse->inscriptionUtilisateur();
}
