<?php

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
    //On appel le fichier accueil.php
    require_once "vues/accueil.php";
}elseif ($url === "404"){
    require_once "vues/404.php";
    //Si $url est différent de tableau de valeurs [#:0-9A-Za-z]
}elseif($url !=  '#:[\w]+)#'){
    //On redirige vers la page d'accueil
    header("Location: accueil");
}
