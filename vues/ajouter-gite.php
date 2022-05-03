<?php
require_once "modeles/Categories.php";

$categorieClasse = new Categories();

$categories = $categorieClasse->getCategories();
?>
<div class="container">
    <form method="post">
        <div class="mt-3">
            <label for="categories">Choix catégorie</label>
            <select name="categories">
                <?php
                    foreach ($categories as $category){
                        ?>
                        <option value="<?= $category['id_categorie'] ?>">
                            <?= $category['type_gite'] ?>
                        </option>
                <?php
                    }
                ?>
            </select>
        </div>
    </form>



</div>
