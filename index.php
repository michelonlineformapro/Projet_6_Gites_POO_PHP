<?php
session_start();
/*
 * ob_start() démarre la temporisation de sortie.
 *  Tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon.
 */
ob_start();
//Les options passées dans URL
////Si dans url, un paramètre $_GET['url'] existe
/// Soit index.php?url="quelquechose"
if(isset($_GET['url'])){
    $url = $_GET['url'];
}else{
    $url = "accueil";
}
//Si $url retourne une chaine de caractères vide
if($url === ""){
    //On redirige vers la page d'accueil
    $url = "accueil";
}


//Liste des routes:
//accueil = vues/accueil.php


//Si la route $url : index.php?url=accueil
if($url === "accueil"){
    $title  = "Mic Location -ACCUEIL-";
    //On appel le fichier accueil.php
    require_once "vues/accueil.php";

}
//Si la route $url : index.php?url=connexion
elseif ($url === "connexion"){
    $title = "Mic location -Connexion-";
    require_once "vues/connexion.php";
    //ici on check que la session de connexion existe et retoune true
}
//Si la route $url : index.php?url=deconnexion
elseif ($url === "deconnexion"){
    //On appel le fichier deconnexion.php
    require_once "vues/deconnexion.php";
}
////Si la route $url : index.php?url=administration et on est connecter en tant qu'admin
else if($url === "administration" && isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true){
    $title = "Mic location -Adminsitration-";
    require_once "vues/administration.php";
    //Si la routes details gites et id_gite existe + id_gite > 0
    //Dans la page administration.php <a href="details_gite?id_gite=<?= $gite['id_gite'] ? >" class="btn btn-info">Details du gite</a>
}elseif($url === "details_gite" && isset($_GET['id_gite']) && $_GET['id_gite'] > 0){
    $title = "Mic location -Adminsitration Details Gite-";
    require_once "vues/details_gite.php";
    //Pour ajouter un gite => on impose une connexion $_SESSION['']
}elseif($url === "ajouter-gite" && isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true){
    $title = "Mic location -Adminsitration Ajouter un Gite-";
    require_once "vues/ajouter-gite.php";
    //IDEM pour la page de confirmation d'ajout
}elseif ($url === "confirmer-ajout-gite" && isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true){
    $title = "Mic location -Confirmer Ajouter un Gite-";
    require_once "vues/confirmer-ajout-gite.php";
    //IDEM pour la page de confirmation de supression
}elseif($url === "supprimer-gite" && isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true){
    $title = "Mic location -Supprimer Ajouter un Gite-";
    require_once "vues/supprimer-gite.php";
}elseif($url === "confirmer-maj-gite" && isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true){
    $title = "Mic location -Mise a jour d' un Gite-";
    require_once "vues/confirmer-maj-gite.php";

}
//////////////////INSCRIPTION DES UTILISATEURS///////////
elseif($url === "inscription"){
    require_once "vues/inscription.php";
}elseif($url === "ajouter_commentaire" && isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true){
    $title = "Mic location -Ajouter commentaire-";
    require_once "vues/ajouter_commentaire.php";
}

//Page de reservation
elseif($url === "reservation"){
    require_once "vues/reservation.php";
}


//Si la route $url n'est pas formée de [#: A-Z a-z O-9] soit index.php?url=NON VALIDE
//On effectue une redirection

elseif($url !=  '#:@&-[\w]+)#'){
    //On redirige vers la page d'accueil
    header("Location: accueil");
}
/*
 * ob_get_clean — Lit le contenu courant du tampon (du cache)de sortie puis l'efface
 */
//ici $content se situe dans le dossier template.php
$content = ob_get_clean();
require_once "template.php";
