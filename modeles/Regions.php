<?php
require_once "modeles/Database.php";

class Regions extends Database
{
    public function getRegions(){
        //la connexion
        $db = $this->getPDO();
        $sql = "SELECT * FROM regions";
        $regions = $db->query($sql);
        return $regions;
    }

}



