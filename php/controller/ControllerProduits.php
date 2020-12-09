<?php

require_once File::build_path(array('model','ModelProduits.php'));
class ControllerProduits
{
    protected static $object = "Produits";
    public static function readAll()
    {
        $tab_u = ModelProduits::getAllProduits();
        $pagetitle = "Liste des Produits";
        $view = 'list';
        require File::build_path(array('view', 'view.php'));
    }

    public static function read(){
        $u = ModelProduits::getProduitById($_GET['id_produit']);
        $pagetitle = "Détail Produits";
        if ($u != null){
            $view = 'detail';
        }else{
            self::error("Produits inexistant");
        }
        require File::build_path(array('view','view.php'));
    }

    public static function create(){
        $pagetitle = "Créer Produits";
        $view = 'update';
        require File::build_path(array('view','view.php'));
    }

    public static function update(){
        $pagetitle = "Modifier Produits";
        $view = 'update';
        require File::build_path(array('view','view.php'));
    }

    public static function updated(){

        $Produits = ModelProduits::getProduitById($htmlSpecialid_produit);
        
        $Produits->update(array('id_produit' => $_GET['id_produit'], 'nom_produit' => $_GET['nom_produit'], 'prix_produit' => $_GET['prix_produit'], 'desc_produit' => $_GET['desc_produit'], 'stock_produit' => $_GET['stock_produit']);
        $pagetitle = "Modifier Produits";
        $view = 'updated';
        require File::build_path(array('view','view.php'));
    }

    public static function delete(){
        if (isset($_GET["id_produit"])) {
            ModelProduits::delete($_GET["id_produit"]);
            $pagetitle = "Delete Produits";
            $view = 'deleted';
            require File::build_path(array('view','view.php'));
        }else{
            self::error("id_produit non défini");
        }
    }

    public static function error($message){
        $pagetitle = "Delete Produits";
        $view = 'error';
        require File::build_path(array('view','view.php'));
    }
}