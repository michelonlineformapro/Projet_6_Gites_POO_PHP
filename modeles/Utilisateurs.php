<?php
//Appel du fichier Database.php
require_once "modeles/Database.php";

//La classe utilisateur herite de la classe Mere Database
class Utilisateurs extends Database
{
    /**
     * @var string
     */
    private $email_user;
    /**
     * @var string
     */
    private $password_user;
    /**
     * @var string
     */
    private $repeatPassword;

    ////////////////INSCRIRE UN UTILISATEUR POUR RESERVER UN GITE ET ECRIRE UN COMMENTAIRES//////////////
    public function inscriptionUtilisateur()
    {

    }

    //////////////////////CONNECTER UN UTILISTEUR//////////////////////////////////
    public function connexionUtilisateur()
    {
        //Connexion a la base de données a l'aide de l'instance de la classe mere (database) heritage
        //Et appel de sa methode public getPDO()

        $db = $this->getPDO();

        //Verifie si utilisateurs est deja connecté

        if (isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true) {
            //Si oui = message d'accueil + affiche le mail
            ?>
            <h1>Bonjour <?= $_POST['email_user'] ?></h1>
            <?php
        } else {
            //Sinon on redirige vers l'inscription
            echo "<p class='alert-warning mt-2 p-2'>Vous n'ètes âs encore inscrit sur notre site
                    <a href='inscription' class='btn btn-info'>S'incrire</a>
                </p>";
        }

//Verification des champs du formulaire

//Verification des champ du formulaire
//Si le champ existe et n'est pas vide
//Dans le DOM un utilisateur peut supprimer attribut required des inputs => donc on check que c pas vide

        if (isset($_POST['email_user']) && !empty($_POST['email_user'])) {
            //On sanitize = desinfecter les champs
            //trim supprimer les espaces en debut et fin de chaine de caractère
            //htmlspecialchar transforme les caractère spéciaux en chaine de caracteres
            //faille xss => ex: <script>js malvaillant</script>
            $this->email_user = trim(htmlspecialchars($_POST['email_user']));
        } else {
            //Sinon on affiche une erreur
            echo "<p class='alert-danger p-3'>Merci remplir le champ Email</p>";
        }
//Idem pour le mot de passe
        if (isset($_POST['password_user']) && !empty($_POST['password_user'])) {
            $this->password_user = trim(htmlspecialchars($_POST['password_user']));
        } else {
            echo "<p class='alert-danger p-3'>Merci remplir le champ Email</p>";
        }

//Si les 2 champs du formulaire ne sont pas vide
        if (!empty($_POST['email_user']) && !empty($_POST['password_user'])) {
            //Requète de connexion
            $sql = "SELECT * FROM utilisateurs WHERE email = ? AND password = ?";

            //Requète préparée
            $stmt = $db->prepare($sql);

            //Bind des paramètre (on lie les champs du formulaire aux paramètre de la requète SQL)

            $stmt->bindParam(1, $this->email_user);
            $stmt->bindParam(2, $this->password_user);
            //Attention ici 2 paramètres a liés
            $stmt->execute();

            //parcours de la table Utilisateur PhpMyAdmin
            if ($stmt->rowCount() >= 1) {
                //Creer une variable qui liste (recherche) tous les elements
                //Mais retourne un tableau associatif avec 1 seul résultat
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                //Si la prorpriété privée $email_user ($_POST['email_user']) est = a la données email de la table Utilisateurs ET

                //Si la prorpriété privée $password_user ($_POST['password_user']) est = a la données email de la table Utilisateurs

                if ($this->email_user === $row['email'] && $this->password_user === $row['password']) {
                    //On demarre une seesion
                    session_start();

                    //On stock dans une variavle Super Globale de session :

                    //Booléen pour verifié si on est connecté

                    //Et email de la personne connecter
                    //Ses element sont utilisé dans le routeur + la navbar pour afficher l'utilisateur courant
                    $_SESSION['connecter_user'] = true;
                    $_SESSION['email_user'] = $this->email_user;
                    //La redirection = si on est connecter on redirige vers la page d'accueil
                    header("Location: accueil");
                } else {
                    //Si l'egalité en le formaulaire et la table Utilisateur n'est pas strictement parfaite
                    echo "<p class='alert-danger p-2'>erreur email et mot passe ne sont pas correct !</p>";
                }
            } else {
                //Si la table est vide
                echo "<p class='alert-danger mt-3 p-2'>Aucun utilisateur ne possède cet email et mot de passe</p>";
            }
        } else {
            //Un des 2 champs est vide
            echo "<p class='alert-danger p-2'>Merci de remplir tous les champs</p>";
        }
//var_dump($this->email_user);
//var_dump($this->password_user);
    }
}