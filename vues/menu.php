<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="accueil">
            <img src="assets/img/logo.png" class="img-fluid" alt="gite mic" title="MIC GITES.COM">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="accueil">ACCUEIL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="rechercher">RECHERCHER</a>
                </li>
                <!--Si un utilisateur est connecter-->
                <li class="nav-item">
                    <?php
                    //On demarre la session

                    //si on est connecter en tant qu'utilisateur = on retourne la page d'accueil + on affiche l'email de l'utilisateur
                    if(isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true){
                        ?>
                        <h4 class="text-danger mt-1"><b style="color: #2c4f56;font-size: 14px">Vous êtes connectez en tant que  :</b> <?= $_SESSION['email_user']  ?></h4>
                        <?php
                    //Sinon si on est connecter en tant qu'adminsitrateur = on affiche un onglet administation + email de l'administrateur dans la navbar
                    }elseif(isset($_SESSION['connecter']) && $_SESSION['connecter'] === true){
                        ?>
                        <div class="d-flex">
                            <a class="nav-link" href="administration">ADMINISTRATION</a>
                            <h4 class="text-danger mt-1">
                                <b style="color: #2c4f56;font-size: 14px">Vous êtes connectez en tant que  :</b> <?= $_SESSION['email_admin']  ?>
                            </h4>
                        </div>
                        <?php
                    }else{
                        ?>
                        <a class="nav-link" href="#"></a>
                        <?php
                    }
                    ?>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <a class="nav-link btn btn-secondary mr-3" href="inscription">INSCRIPTION</a>
                <?php
                //Sin on est connecter en tant qu'utilisateur ou administrateur = le bouton connexion devient deconnexion et reciproquement
                if(isset($_SESSION['connecter']) && $_SESSION['connecter'] === true || isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true){
                    ?>
                    <a class="nav-link btn btn-danger" href="deconnexion">DECONNEXION</a>
                    <?php
                }else{
                    ?>
                    <a class="nav-link btn btn-warning" href="connexion">CONNEXION</a>
                    <?php
                }
                ?>
            </form>
        </div>
    </div>
</nav>
