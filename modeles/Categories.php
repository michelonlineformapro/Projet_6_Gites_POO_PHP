<?php
require_once "modeles/Database.php";
class Categories extends Database
{

    public function getCategories(){
        $db = $this->getPDO();

        $sql = "SELECT * FROM categories";

        $categories = $db->query($sql);
        return $categories;
    }

}