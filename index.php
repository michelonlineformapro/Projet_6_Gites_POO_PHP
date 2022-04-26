<?php
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





//Si $url = "accueil"
if($url === "accueil"){
    $title  = "Mic Location -ACCUEIL-";
    //On appel le fichier accueil.php
    require_once "vues/accueil.php";
}elseif ($url === "404"){
    $title  = "Mic Location -ERREUR-";
    require_once "vues/404.php";
    //Si $url [\w] est différent de tableau de valeurs [#:@0-9A-Za-z]
}elseif ($url === "connexion"){
    $title = "Mic location -Connexion-";
    require_once "vues/connexion.php";
    //ici on check que la session de connexion existe et retoune true
}elseif ($url === "deconnexion"){
    require_once "vues/deconnexion.php";
}


else if($url === "administration" && $_SESSION['connecter'] && $_SESSION['connecter'] === true){
    require_once "vues/administration.php";
}
elseif($url !=  '#:[\w]+)#'){
    //On redirige vers la page d'accueil
    header("Location: accueil");
}elseif ($url === "mic"){
    require_once "vues/mic.php";
}
/*
 * ob_get_clean — Lit le contenu courant du tampon (du cache)de sortie puis l'efface
 */
//ici $content se situe dans le dossier template.php
$content = ob_get_clean();
require_once "template.php";
