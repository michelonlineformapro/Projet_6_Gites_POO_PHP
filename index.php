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
//Si $url = "accueil"
if($url === "accueil"){
    $title  = "Mic Location -ACCUEIL-";
    //On appel le fichier accueil.php
    require_once "vues/accueil.php";
}elseif ($url === "404"){
    $title  = "Mic Location -ERREUR-";
    require_once "vues/404.php";
    //Si $url est différent de tableau de valeurs [#:0-9A-Za-z]
}elseif ($url === "page-de-test"){
    $title  = "Mic Location -PAGE TEST-";
    require_once "vues/test.php";
}


elseif($url !=  '#:[\w]+)#'){
    //On redirige vers la page d'accueil
    header("Location: accueil");
}
/*
 * ob_get_clean — Lit le contenu courant du tampon de sortie puis l'efface
 */
//ici $content se situe dans le dossier template.php
$content = ob_get_clean();
require_once "template.php";
