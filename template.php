<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/styles.css">

    <!--Dans le routeur a chaque appel de route on definis la valeur de $title-->
    <title><?= $title ?></title>
</head>
<body>
    <header>
        <?php require_once  "vues/menu.php"?>
    </header>
    <div class="container">
        <!--Ici $content est appelé sont contenu est dans le routeur index.php-->
        <!--Chaque valeur de $content  =  appel d'un fichier php-->
        <?= $content ?>
    </div>

<script src="assets/js/app.js" type="text/javascript"></script>
</body>
</html>
