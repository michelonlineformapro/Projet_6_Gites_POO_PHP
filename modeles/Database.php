<?php

/**
 * Class Database
 */
class Database
{
    /**
     * @var string
     */
    private $host = "localhost";
    /**
     * @var string
     */
    private $dbname = "location_gite";
    /**
     * @var string
     */
    private $user = "root";
    /**
     * @var string
     */
    private $pass = "";

    //Ici une fonction
    //Dans une classe php => une fonction s'appel une methode
    //une methode retourne toujeours une valeurs
    //La portée est publique donc accessible par tous les autres fichier

    /**
     * @return PDO|null
     */

    public function getPDO(){

        try {
            $db = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname.";charset=utf8", $this->user, $this->pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connexion a PDO";
            //Retourne la propriété (variable) $db qui stocke la connexion a la BDD via la classe PDO pour etre utlisé dans autres fichiers
            return $db;

        }catch (PDOException $e){
            echo "erreur de connexion " .$e->getMessage();
        }
        //Si le try catch ne retourne rien la fonction retourne null
        return null;
    }

}