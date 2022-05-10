<?php
require_once "modeles/Database.php";

class Commentaires extends Database
{
    //var private
    private $auteur_comment;
    private $contenu_comment;


    public function getComments(){
        //recup de la connexiona la base de donnée
        $db = $this->getPDO();
        $sql = "SELECT * FROM commentaires WHERE gite_id = ?";

        $id = $_GET['id_gite'];

        $req = $db->prepare($sql);

        $req->bindParam(1, $id);

        $req->execute();

       return $req;

    }
}