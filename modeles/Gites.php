<?php
//Appel de la classe mere Database.php
//pour acceder a la methode getPDO()
require_once "modeles/Database.php";
//Ici Gites herite de la classe mere Database
//De tous ses prorpiétés (variables) et de toutes ses methodes (fonctions) son accessibles depuis la Classe Gites
class Gites extends Database {

    private $id_gite;
    private $nom_gite;
    
    //Cette methode est destinée a recupérer tous les gites de la table phpMyADmin
    public function getGites(){
        //Appel de la methode getPDO de la classe MERE Database.php
        //La connexion a PDO est stocké dans une variable
        $db = $this->getPDO();
        //la requètes SQL
        $sql = "SELECT * FROM `gites` 
                INNER JOIN categories ON gites.gite_categorie = categories.id_categorie 
                INNER JOIN regions ON gites.zone_geo = regions.id_region";
        //On stock le resultats dans une variables $gites
        $gites = $db->query($sql);
        //la fonction getGites() retourne un tableau associatif contenant toutes les données de la table gites phpMyAdmin
        //Ici $gites sera utilisé dans la vue accueil.php
        return $gites;

    }

    //Afficher les gites par ID
    //recup la connexion depusi methode getPDO de la classe
    public function getGiteById(){
        //Appel de la methode getPDO de la classe MERE Database.php
        //La connexion a PDO est stocké dans une variable
        $db = $this->getPDO();
        //Requète SQL filtrer par id_gite
        $sql = "SELECT * FROM gites 
                                    INNER JOIN categories ON gites.gite_categorie = categories.id_categorie
                                    INNER JOIN  regions ON gites.zone_geo = regions.id_region          
                                    INNER JOIN commentaires ON gites.commentaire_id = commentaires.id_commentaire
                                    WHERE gites.id_gite = ?";
        //Requète preparée lutte contre les injections SQL methode prepare de la classe PDO + (requète SQL en paramètre)
        $request = $db->prepare($sql);
        //Recup de l'id du gite passée dans l'url de la page administration via <a href="<?= details_gite&id=<?= $row['id_gite']" ? > ></a>
        //A l'aide de la variable super globale $_GET['']
        $id = $_GET['id_gite'];
        //On lie ID recuperer a la  requète SQL
        $request->bindParam(1, $id);
        //On execute la requète
        $request->execute();
        //fetch =  Récupère la ligne suivante d'un jeu de résultats PDO execute() et on stock dans une variable
        $details = $request->fetch();
        //La fonction retourne un resultat (un gite) par id
        return $details;
    }

    public function setGites(){
        if(isset($_POST["nom_gite"]) && !empty($_POST["nom_gite"])){
            $this->nom_gite = trim(htmlspecialchars($_POST['nom_gite']));
        }else{
            echo "Merci de remplir le champ";
        }

        //Uploade de photo

        $sql = "INSERT INTO `gites`(`id_gite`, `nom_gite`, `description_gite`, `img_gite`, `prix_gite`, `nbr_chambre`, `nbr_sdb`, `disponible`, `zone_geo`, `date_arrivee`, `date_depart`, `gite_categorie`, `commentaire_id`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13])";

        //requète préparée

        //Le bind de paramètres

        //execution de la requète

        //redirection page accueil
    }
}




