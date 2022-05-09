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
            //Requète de connexion (ici on ne recupère que email de chaque utilisateur)
            $sql = "SELECT * FROM utilisateurs WHERE email = ?";

            //Requète préparée = lutte contre injections SQL
            $stmt = $db->prepare($sql);

            //Bind des paramètre (on lie les champs du formulaire aux paramètres de la requète SQL)
            $stmt->bindParam(1, $this->email_user);
            //Attention ici 1 seul paramètre a liés
            $stmt->execute();

            //parcours de la table Utilisateurs => PhpMyAdmin
            if ($stmt->rowCount() >= 1) {
                //Creer une variable qui liste (recherche) tous les emails
                //Mais retourne un tableau associatif avec 1 seul résultat
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                //Si la prorpriété privée $email_user ($_POST['email_user']) est = a la données email de la table Utilisateurs ET

                //Si la prorpriété privée $password_user ($_POST['password_user'] LE SALT) est = au mot de passe haché dans la table

                //Cette verification s'effectue grace a salt generer lors du hachage du mot de passe

                //RAPPEL : lors de l'inscription on hache le mot de passe
                //$hash_password = password_hash($this->password_user, PASSWORD_DEFAULT);
                //Ici : password_verify est une fonction qui — Vérifie qu'un mot de passe correspond à un hachage et prend 2 paramètres et retourne un booleen
                //password_verify(string $password = entrée utilisateur = salt, string $hash = mot de passe haché sotcké dans la table Utilisateurs (PhpMyAdmin)): bool

                if ($this->email_user === $row['email'] && password_verify($this->password_user, $row['password'])) {
                    //On demarre une session
                    session_start();

                    //On stock dans une variable Super Globale de session :

                    //Booléen pour verifié si on est connecté
                    //Et email de la personne connecter
                    //Ces element sont utilisé dans le routeur + la navbar pour afficher l'utilisateur courant
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


    ///////////////////////INSCRIRE UN UTILISATEUR////////////////////////
    public function inscriptionUtilisateur(){
        //Connexion a la base de données a l'aide de l'instance de la classe mere (database) heritage
        //Et appel de sa methode public getPDO();

        $db = $this->getPDO();

        if(isset($_POST['email_user']) && !empty($_POST['email_user'])){
            /*
            * En français, on pourrait traduire cela par "désinfecter". Quand les utilisateurs peuvent entrer des données
            * comme dans un formulaire de contact, il est important de s'assurer qu'il ne s'agit pas d'une tentative d'attaque (comme par exemple, les injections sql)
            * voire une tentative de piratage. C'est pour cela que nous allons désinfecter TOUTES les données entrées par l'utilisateur AVANT de les manipuler dans notre script.
             * //On assigle les champs du formumaire au propréirées privée de la classe
             *
            */
            $this->email_user = trim(htmlspecialchars($_POST['email_user']));
        }

        if(isset($_POST['password_user']) && !empty($_POST['password_user'])){
            /*
            * En français, on pourrait traduire cela par "désinfecter". Quand les utilisateurs peuvent entrer des données
            * comme dans un formulaire de contact, il est important de s'assurer qu'il ne s'agit pas d'une tentative d'attaque (comme par exemple, les injections sql)
            * voire une tentative de piratage. C'est pour cela que nous allons désinfecter TOUTES les données entrées par l'utilisateur AVANT de les manipuler dans notre script.
             * //On assigle les champs du formumaire au propréirées privée de la classe
             *
            */
            $this->password_user = trim(htmlspecialchars($_POST['password_user']));
        }

        if(isset($_POST['password_repeat']) && !empty($_POST['password_repeat'])){
            /*
            * En français, on pourrait traduire cela par "désinfecter". Quand les utilisateurs peuvent entrer des données
            * comme dans un formulaire de contact, il est important de s'assurer qu'il ne s'agit pas d'une tentative d'attaque (comme par exemple, les injections sql)
            * voire une tentative de piratage. C'est pour cela que nous allons désinfecter TOUTES les données entrées par l'utilisateur AVANT de les manipuler dans notre script.
             * //On assigle les champs du formumaire au propréirées privée de la classe
             *
            */
            $this->repeatPassword = trim(htmlspecialchars($_POST['password_repeat']));
        }

        //Veririfier le mot passe repeter
        if($this->password_user != $this->repeatPassword){
            echo "<p class='alert alert-danger p-3 mt-3'>ATTENTION ! Les 2 mot de passe ne sont pas identique.</p>";
        }

        //la requète d'insertion

        $sql = "INSERT INTO utilisateurs (email, password) VALUE (?,?)";

        //requète préparée
        $insert_user = $db->prepare($sql);

        //On lie les champs du formulaire a ma requète sql
        $insert_user->bindParam(1, $this->email_user);
        $insert_user->bindParam(2, $this->password_user);

        //On hash le mot de passe a l'aide de la fonction : password_hash — Crée une clé de hachage pour un mot de passe
        //Celle ci prend 2 paramètres obligatoire + options
        //password_hash(string $password, string|int|null $algo, array $options = []): string
        //L'entrée de l'utilisateur + l'algo de hashage + option (cost, etc...)
        $hash_password = password_hash($this->password_user, PASSWORD_DEFAULT);

        //Lors de l'execution de la requète, on passe le mot de passe hashé dans dans le tableau de paramètres
        $insert_user->execute(array(
                $this->email_user,
                $hash_password,
        ));

        //Si ca marche
        if($insert_user){
            //On redirige vers la page d'accueil
            ?>
            <p class="alert alert-success p-3 mt-3">Bienvenue : vous êtes desormais inscrit sur notre site.</p>
            <a href="connexion" class="mt-3 btn btn-success">Se connecter à votre espace</a>
            <style>
                /*On cache le formulaire*/
                #form-register-user{
                    display: none;
                }
            </style>
            <?php
        }else{
            //Sinon on affiche une erreur
            echo "<p class='alert-danger p-2'>Une erreur est survenue, merci de verifié et de remplir tous les champs !</p>";
        }
    }
}