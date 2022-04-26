<?php
require_once "modeles/Administration.php";
$adminClass = new Administration();

if(isset($_SESSION['connecter']) && $_SESSION['connecter'] === true){
    header("administration");
}else{
    ?>
    <div id="form-admin">
    <?php

    if(isset($_SESSION['connecter']) && $_SESSION['connecter'] === true){
        header("administration");
    }else{
        ?>
        <h2 class="mt-2 text-center text-warning">CONNEXION A VOTRE ESPACE ADMINISTRATION</h2>

        <form method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="email_admin" class="form-control" id="exampleInputEmail1" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password_admin" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe">
            </div>
            <button name="btn_valid_admin" type="submit" class="btn btn-primary">Connexion</button>
        </form>
        <?php

        if(isset($_POST['btn_valid_admin'])){
            $adminClass->connexionAdmin();
        }
    }
    ?>
        <?php


}


