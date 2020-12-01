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
        $u = ModelProduits::select($_GET['login']);
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
        $htmlSpecialNom = htmlspecialchars($_GET['nom']);
        $htmlSpecialPrenom = htmlspecialchars($_GET['prenom']);
        $htmlSpecialLogin = htmlspecialchars($_GET['login']);
        $Produits = ModelProduits::select($htmlSpecialLogin);
        if($_GET["mdp"]==$_GET["mdp2"])
        {
        $Produits->update(array('login' => $htmlSpecialLogin, 'nom' => $htmlSpecialNom, 'prenom' => $htmlSpecialPrenom, 'mdp' => $_GET['mdp']));
        $pagetitle = "Modifier Produits";
        $view = 'updated';
        require File::build_path(array('view','view.php'));
        }
        else{
           self::error("les mdp sont different"); 
        }
    }

    public static function delete(){
        if (isset($_GET["login"])) {
            ModelProduits::delete($_GET["login"]);
            $pagetitle = "Delete Produits";
            $view = 'deleted';
            require File::build_path(array('view','view.php'));
        }else{
            self::error("login non défini");
        }
    }

    public static function error($message){
        $pagetitle = "Delete Produits";
        $view = 'error';
        require File::build_path(array('view','view.php'));
    }
}