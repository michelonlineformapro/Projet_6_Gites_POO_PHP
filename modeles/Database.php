<?php

class Database
{
    //Declaration de variable (ici la portée est public = accessible a l'interieur et a l'exterieur de la classe)
    public $host = "localhost";
    //Ici Votre base de données PhpMyAdmin
    public $dbname = "location_gite";
    public $user = "root";
    public $pass = "";

    //Cette fonction (methode) est public donc accessible a l'interieur et a l'exterieur de la classe
    public function getPDO(){
        //Essai de connexion sionon erreur
        try {
            //Instance de la classe PDO copiée dans la variable $db
            $db = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname.";charset=UTF8", $this->user, $this->pass);
            //Acces a la methode setAttribute de la classe PDO + options
            //PDO:: represente l'acces a des methode static = sans instance de la classe PDO
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //Si ca marche
            echo "<div class='text-center'>
                    <p class='mt-3 alert alert-success'>Vous êtes connectez a PDO MySQL !</p>
                </div>";
            //Sinon on declenche une erreur = on appel la methode getMessage de la Classe PDOException
        }catch (PDOException $exception){
            echo "<div class='text-center'>
                    <p class='alert alert-danger'>Erreur de connexion PDO MySQL !</p>
                </div>" . $exception->getMessage();
            die();
        }
        //A la fin du bloc try - catch une methode attend un retour
        //Ici on retourne la variable (propriété) $db qui stock la connexion a PDO MySQL
        return $db;
    }

}