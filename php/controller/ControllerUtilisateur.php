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
        $u = ModelUtilisateur::select($_GET['id_utilisateur']);
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
        if($_GET["mdp_utilisateur"]!=$_GET["mdp_utilisateur2"]){
            self::error("les mdp sont different");
        }
        else if ($utilisateur->save(array("id_utilisateur" => $utilisateur->get("id_utilisateur"),"nom_utilisateur" => $utilisateur->get("nom_utilisateur"),"prenom_utilisateur" => $utilisateur->get("prenom_utilisateur"),"mail_utilisateur" => $utilisateur->get("mail_utilisateur"), "mdp_utilisateur" => $utilisateur->get("mdp_utilisateur"), "adresse_utilisateur" => $utilisateur->get("adresse_utilisateur"), "ddn_utilisateur" => $utilisateur->get("ddn_utilisateur"))) == false){
            self::error("utilisateur déjà créé");
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
        $htmlSpecialId = htmlspecialchars($_GET['id_utilisateur']);
        $htmlSpecialNom = htmlspecialchars($_GET['nom_utilisateur']);
        $htmlSpecialPrenom = htmlspecialchars($_GET['prenom_utilisateur']);
        $htmlSpecialMail = htmlspecialchars($_GET['mail_utilisateur']);
        $htmlSpecialAdresse = htmlspecialchars($_GET['adresse_utilisateur']);
        $htmlSpecialDdn = htmlspecialchars($_GET['ddn_utilisateur']);
        $utilisateur = ModelUtilisateur::select($htmlSpecialId);
        if($_GET["mdp_utilisateur"]==$_GET["mdp_utilisateur2"])
        {
        $utilisateur->update(array('id_utilisateur' => $htmlSpecialId, 'nom_utilisateur' => $htmlSpecialNom, 'prenom_utilisateur' => $htmlSpecialPrenom, 'mail_utilisateur' => $htmlSpecialMail, 'adresse_utilisateur' => $htmlSpecialAdresse, 'ddn_utilisateur' => $htmlSpecialDdn, 'mdp_utilisateur' => $_GET['mdp_utilisateur']));
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