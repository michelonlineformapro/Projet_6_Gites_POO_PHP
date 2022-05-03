<?php
//Appel du fichier de la classe de connexion Database.php
require_once "modeles/Database.php";

//Class Adminstration  herite de la classe Database a l'aide du mot cle extends
//Un classe php n'herite que d'une seule autre classes
//Ici on peu dire que Database est la classe parente et Administration est une classe enfant
//Dans la classe Database si on passe les propriétés de connexion en protected => elles seront accessible dans Administration enfant

class Administration extends Database
{
    //Les propriétées = variables dans une classe
    //POUR LES ADMINS
    /**
     * @var string
     */
    private $email_admin;
    /**
     * @var string
     */
    private $password_admin;

    //Connexion a la base de données a l'aide de l'instance de la classe mere (database)
    //Et appel de sa methode public getPDO() stocké dans la variable $db

    public function connexionAdmin(){
        //Connexion a la base de données a l'aide de l'instance de la classe mere (database)
        //Et appel de sa methode public getPDO() stocké dans la variable $db

        $db = $this->getPDO();

        //Verification des champs du formulaire
        //Si le champ existe et ne sont pas vide => on continue
        //Dans le DOM un utilisateur peut supprimer attribut required des inputs => donc : on check que c pas vide

        if(isset($_POST['email_admin']) && !empty($_POST['email_admin'])){
            //On sanitize = desinfecter les champs
            //trim supprimer les espaces en debut et fin de chaine de caractère
            //htmlspecialchar transforme les caractère spéciaux en chaine de charactères
            //faille xss => ex: <script>js malvaillant</script>


            //Pour acceder a une variable on utilise $this (sort de la methode et accèse a une propriété)
            //Cette methode permet de stcoker la valeur de $_POST dans une propriétée privée pour +  de securité
            $this->email_admin = trim(htmlspecialchars(strip_tags($_POST['email_admin'])));
        }else{
            echo "<p class='alert-danger p-3 mt-3'>Merci remplir le champ Email</p>";
        }
        //Idem pour le mot de passe

        if(isset($_POST['password_admin']) && !empty($_POST['password_admin'])){
            $this->password_admin = trim(htmlspecialchars(strip_tags($_POST['password_admin'])));
        }else{
            echo "<p class='alert-danger p-3 mt-3'>Merci remplir le champ Email</p>";
        }

        //Si les champs ne sont pas vide
        if(!empty($_POST['email_admin']) && !empty($_POST['password_admin'])){
            //Requète de connexion
            $sql = "SELECT * FROM administrateurs WHERE email_admin = ? AND password_admin = ?";

            //Requète préparée
            $stmt = $db->prepare($sql);

            //Bind des paramètres

            $stmt->bindParam(1, $this->email_admin);
            $stmt->bindParam(2, $this->password_admin);
            //Attention ici 2 paramètres a liés
            //On execute la requète et on retourne un tableau associatif
            $stmt->execute();

            //On compte les entrées retorunée par execute(tableau associatif)
            //Si on a au moin un admin
            if($stmt->rowCount() >= 1){
                //Creer une variable qui liste (recherche) tous les elements
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if($this->email_admin === $row['email_admin'] && $this->password_admin === $row['password_admin']){
                    //Demarre la seesion
                    session_start();
                    //Booléen pour verifié si on est connecté
                    $_SESSION['connecter_admin'] = true;
                    $_SESSION['email_admin'] = $this->email_admin;
                    //La redirection
                    header('Location: administration');
                }else{
                    echo "<p class='alert-danger mt-3 p-2'>Erreur de connexion, merci de verifié votre email et mot de passe et recommencer !</p>";
                }
            }else{
                echo "<p class='alert-danger mt-3 p-2'>Erreur de connexion, merci de verifié votre email et mot de passe !</p>";
            }
        }else{
            echo "<p class='alert-danger mt-3 p-2'>Merci de remplir tous les champs</p>";
        }
    }
}