<?php

require_once File::build_path(array('model','ModelProduits.php'));
class ControllerProduits
{
    protected static $object = "Produits";
    public static function readAll()
    {
        $tab_u = ModelProduits::selectAll();
        $pagetitle = "Liste des Produits";
        $view = 'list';
        require File::build_path(array('view', 'view.php'));
    }

    public static function read(){
        $u = ModelProduits::select($_GET['id_produit']);
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
        $htmlSpecialnom_produit = htmlspecialchars($_GET['nom_produit']);
        $htmlSpecialprix_produit = htmlspecialchars($_GET['prix_produit']);
        $htmlSpecialid_produit = htmlspecialchars($_GET['id_produit']);
        $htmlSpecialstock_produit = htmlspecialchars($_GET['stock_produit']);
        $htmlSpecialdesc_produit = htmlspecialchars($_GET['desc_produit']);
        $Produits = ModelProduits::select($htmlSpecialid_produit);
        if($_GET["mdp"]==$_GET["mdp2"])
        {
        $Produits->update(array('id_produit' => $htmlSpecialid_produit, 'nom_produit' => $htmlSpecialnom_produit, 'prix_produit' => $htmlSpecialprix_produit, 'desc_produit' => $htmlSpecialdesc_produit, 'stock_produit' => $htmlSpecialstock_produit,'mdp' => $_GET['mdp']));
        $pagetitle = "Modifier Produits";
        $view = 'updated';
        require File::build_path(array('view','view.php'));
        }
        else{
           self::error("les mdp sont different"); 
        }
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