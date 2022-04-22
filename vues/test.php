<?php
//Appel du fichier de la classe Database.php
//modeles/Database.php
require_once "modeles/Database.php";

//Instance = copie de la classe stockée dans une variable (ici $connexionPDO)

$connexionPDO = new Database();

$connexionPDO->getPDO();

