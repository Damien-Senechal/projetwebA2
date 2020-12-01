<?php

require_once File::build_path(array('model','ModelUtilisateurs.php'));

class ControllerUtilisateur
{
    protected static $object = "utilisateur";
    public static function readAll()
    {
        $tab_u = ModelUtilisateur::getAllUtilisateur();
        $pagetitle = "Liste des Utilisateurs";
        $view = 'list';
        require File::build_path(array('view', 'view.php'));
    }

    public static function read(){
        $u = ModelUtilisateur::select($_GET['login']);
        $pagetitle = "Détail Utilisateur";
        if ($u != null){
            $view = 'detail';
        }else{
            self::error("Utilisateur inexistant");
        }
        require File::build_path(array('view','view.php'));
    }

    public static function create(){
        $pagetitle = "Créer Utilisateur";
        $view = 'update';
        require File::build_path(array('view','view.php'));
    }

    public static function created(){
        $utilisateur = new ModelUtilisateur($_GET);
        if ($utilisateur->save(array("login" => $utilisateur->get("login"),"nom" => $utilisateur->get("nom"),"prenom" => $utilisateur->get("prenom"),"mdp" => $utilisateur->get("mdp"))) == false){
            self::error("utilisateur déjà créé");
        }
        else if($_GET["mdp"]!=$_GET["mdp2"]){
            self::error("les mdp sont different");
        }
        else {
            $pagetitle = "Modifier Utilisateur";
            $view = 'created';
            require File::build_path(array('view','view.php'));
        }
    }

    public static function update(){
        $pagetitle = "Modifier Utilisateur";
        $view = 'update';
        require File::build_path(array('view','view.php'));
    }

    public static function updated(){
        $htmlSpecialNom = htmlspecialchars($_GET['nom']);
        $htmlSpecialPrenom = htmlspecialchars($_GET['prenom']);
        $htmlSpecialLogin = htmlspecialchars($_GET['login']);
        $utilisateur = ModelUtilisateur::select($htmlSpecialLogin);
        if($_GET["mdp"]==$_GET["mdp2"])
        {
        $utilisateur->update(array('login' => $htmlSpecialLogin, 'nom' => $htmlSpecialNom, 'prenom' => $htmlSpecialPrenom, 'mdp' => $_GET['mdp']));
        $pagetitle = "Modifier Utilisateur";
        $view = 'updated';
        require File::build_path(array('view','view.php'));
        }
        else{
           self::error("les mdp sont different"); 
        }
    }

    public static function delete(){
        if (isset($_GET["login"])) {
            ModelUtilisateur::delete($_GET["login"]);
            $pagetitle = "Delete Utilisateur";
            $view = 'deleted';
            require File::build_path(array('view','view.php'));
        }else{
            self::error("login non défini");
        }
    }

    public static function error($message){
        $pagetitle = "Delete Utilisateur";
        $view = 'error';
        require File::build_path(array('view','view.php'));
    }
}