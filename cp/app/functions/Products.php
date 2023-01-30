<?php

$product = new Products();
class Products extends Controller
{

    public function countProductsInCat($cat_id){
        $SQL = self::db()->prepare("SELECT * FROM `products` WHERE `cat_id` = ?");
        $SQL->execute(array($cat_id));

        return $SQL->rowCount();
    }

    public function getCatDataById($cat_id){
        $SQL = self::db()->prepare("SELECT * FROM `product_categorie` WHERE `id` = ?");
        $SQL->execute(array($cat_id));
        $catData = $SQL -> fetch(PDO::FETCH_ASSOC);

        return $catData;
    }

    public function getDataById($prod_id){
        $SQL = self::db()->prepare("SELECT * FROM `products` WHERE `id` = ?");
        $SQL->execute(array($prod_id));
        $prodData = $SQL -> fetch(PDO::FETCH_ASSOC);

        return $prodData;
    }

    public function getPrice($prod_id){
        $SQL = self::db()->prepare("SELECT * FROM `products` WHERE `id` = ?");
        $SQL->execute(array($prod_id));
        if($SQL->rowCount() == 1){
            $prodData = $SQL -> fetch(PDO::FETCH_ASSOC);
            return $prodData['price'];
        }

        return false;
    }

}