<?php
require_once "modeles/Database.php";
class Gites extends Database {

    private $nom_gite;
    //toutes les données de ta table gites
    public function getGites(){

        //Appel de la methode getPDO de la classe Database.php
        $db = $this->getPDO();
        $sql = "SELECT * FROM gites";

        $gites = $db->query($sql);

        return $gites;

    }




}
