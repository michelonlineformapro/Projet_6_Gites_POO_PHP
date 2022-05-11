<?php
require_once "modeles/Database.php";

class Commentaires extends Database
{
    //var private de la table commentaires
    private $auteur_comment;
    private $contenu_comment;
    private $gites_id;


    public function getComments(){
        //recup de la connexiona la base de donnée via la classe mere Database
        $db = $this->getPDO();
        //On selectionne les commentaire filtré par la clé primaire du gite recuperer dans URL
        $sql = "SELECT * FROM commentaires WHERE gite_id = ?";
        //Recup de ID dans URL
        $id = $_GET['id_gite'];
        //la requète préparée pour lutter contre les injection SQL
        $req = $db->prepare($sql);
        //On lie ID recup dans URL a gite_id = ? de la requète SQL
        $req->bindParam(1, $id);
        //On execute la requète
        $req->execute();
        //Retourne les commentaires sur lesquels on va boucler
       return $req;

    }


    //Ajouter de commentaires
    public function addComments(){
        //Connexion a la bdd via la methode getPDO de la classe mere Database
        $db = $this->getPDO();
        //On verifie les champs du formulaire (vues/ajouter_commentaire.php)
        if(isset($_POST['auteur_commentaire'])){
            $this->auteur_comment = trim(htmlspecialchars($_POST['auteur_commentaire']));
        }else{
            echo "<div class='text-center'><p>Erreur, merci de rentrer votre nom ou email !</p></div>";
        }

        if(isset($_POST['contenus_commentaire'])){
            $this->contenu_comment = trim(htmlspecialchars($_POST['contenus_commentaire']));
        }else{
            echo "<p class='alert-danger p-2'>Merci de remplir le champ contenu du commentaire</p>";
        }

        //Ce champ dans le formulaire est de type hidden et recup id du gite dans value="$_GET['id']" dans URL
        if(isset($_POST['gites_id']) && !empty($_POST['gites_id'])){
            $this->gites_id = $_POST['gites_id'];
        }else{
            echo "<p class='alert-danger p-2'>Merci de remplir le champs !</p>";
        }

        //la requète d'insertion
        $sql = "INSERT INTO commentaires (`auteur_commentaire`, `contenus_commentaire`, `gite_id`) VALUES (?,?,?)";
        //la requète préparée lutte contre les injections SQL
        $insert = $db->prepare($sql);

        //On lie les champs du formulaire au paramètre de la requète SQL champs = ?,?,?
        $insert->bindParam(1, $this->auteur_comment);
        $insert->bindParam(2, $this->contenu_comment);
        $insert->bindParam(3, $this->gites_id);

        //On execute la requète qui retourne un tableau associatif
        $comment = $insert->execute(array(
            $this->auteur_comment,
            $this->contenu_comment,
            $this->gites_id
        ));

        //pour la redirection : on recup id du gite dans URL :
        $id = $_GET['id_gite'];

        //Si ca marche : on redirige vers la page de details + le commentaire ajouter
        if($comment){
            header("Location: details_gite&id_gite=$id");
        }else{
            //Sinon des erreurs et le debug
            echo "erreur";
            var_dump($this->auteur_comment);
            var_dump($this->contenu_comment);
            var_dump($this->gites_id);
        }

    }
}