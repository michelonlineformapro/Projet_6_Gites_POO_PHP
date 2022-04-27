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
else if($url === "administration" && isset($_SESSION['connecter']) && $_SESSION['connecter'] === true){
    $title = "Mic location -Adminsitration-";
    require_once "vues/administration.php";
}

//Si la route $url n'est pas formée de [#: A-Z a-z O-9] soit index.php?url=NON VALIDE
//On effectue une redirection
elseif($url !=  '#:[\w]+)#'){
    //On redirige vers la page d'accueil
    header("Location: accueil");
}
/*
 * ob_get_clean — Lit le contenu courant du tampon (du cache)de sortie puis l'efface
 */
//ici $content se situe dans le dossier template.php
$content = ob_get_clean();
require_once "template.php";
