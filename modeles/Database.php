<?php

class Database{

    private $host = "localhost";
    private $dbname = "location_gite";
    private $user = "root";
    private $pass = "";

    public function getPDO(){
        try {

            $db = new PDO('mysql:host='.$this->host.";dbname=".$this->dbname.";charset=UTF8", $this->user, $this->pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Ca marche";

            }catch (PDOException $exception){
                echo "Erreur " .$exception->getMessage();
        }

        return $db;
    }




}