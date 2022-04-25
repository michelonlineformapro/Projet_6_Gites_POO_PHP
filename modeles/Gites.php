<?php
//Appel de la classe mere Database.php
//pour acceder a la methode getPDO()
require_once "modeles/Database.php";
//Ici Gites herite de la classe mere Database
//De tous ses prorpiétés (variables) et de toutes ses methodes (fonctions)
class Gites extends Database {

    //Cette methode est destinée a recupérer tous les gites de la table phpMyADmin
    public function getGites(){
        //Appel de la methode getPDO de la classe MERE Database.php
        //La connexion a PDO est stocké dans une variable
        $db = $this->getPDO();
        //la requètes SQL
        $sql = "SELECT * FROM gites";
        //On stock le resultats dans une variables $gites
        $gites = $db->query($sql);
        //la fonction getGites() retourne un tableau associatif contenant toutes les données de la table gites phpMyAdmin
        //Ici $gites sera utilisé dans la vue accueil.php
        return $gites;

    }




}
