<?php

require_once File::build_path(array('model','ModelUtilisateurs.php'));

class ControllerUtilisateur
{
    protected static $object = "utilisateur";
    public static function accueil(){
        $pagetitle = "Cookie paradise";
        $view = 'viewAccueil';
        require File::build_path(array('view','view.php'));
    }

    public static function create(){
        $pagetitle = "Créer Utilisateur";
        $view = 'update';
        require File::build_path(array('view','view.php'));
    }

    public static function created(){
        $utilisateur = new ModelUtilisateurs($_GET);
        if($_GET["mdp_utilisateur"]!=$_GET["mdp_utilisateur2"]){
            self::error("les mdp sont different");
        }
        else if ($utilisateur->save(array("id_utilisateur" => $utilisateur->get("id_utilisateur"),"nom_utilisateur" => $utilisateur->get("nom_utilisateur"),"prenom_utilisateur" => $utilisateur->get("prenom_utilisateur"),"mail_utilisateur" => $utilisateur->get("mail_utilisateur"), "mdp_utilisateur" => $utilisateur->get("mdp_utilisateur"), "adresse_utilisateur" => $utilisateur->get("adresse_utilisateur"), "ddn_utilisateur" => $utilisateur->get("ddn_utilisateur"), "admin_utilisateur" => $utilisateur->get("admin_utilisateur"))) == false){
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
        if($_GET["mdp_utilisateur"]==$_GET["mdp_utilisateur2"])
        {
        $utilisateur->update(array('id_utilisateur' => $_GET['id_utilisateur'], 'nom_utilisateur' => $htmlSpecialNom, 'prenom_utilisateur' => $_GET['nom_utilisateur'], 'mail_utilisateur' => $_GET['mail_utilisateur'], 'adresse_utilisateur' => $_GET['adresse_utilisateur'], 'ddn_utilisateur' => $_GET['ddn_utilisateur'], 'admin_utilisateur' => $_GET['admin_utilisateur'], 'mdp_utilisateur' => $_GET['mdp_utilisateur']));
        $pagetitle = "Modifier Utilisateur";
        $view = 'updated';
        require File::build_path(array('view','view.php'));
        }
        else{
           self::error("les mdp sont different"); 
        }
    }

    public static function delete(){
        if (isset($_GET["id_utilisateur"])) {
            ModelUtilisateurs::delete($_GET["id_utilisateur"]);
            $pagetitle = "Delete Utilisateur";
            $view = 'deleted';
            require File::build_path(array('view','view.php'));
        }else{
            self::error("Id non défini");
        }
    }

    public static function error($message){
        $pagetitle = "Delete Utilisateur";
        $view = 'error';
        require File::build_path(array('view','view.php'));
    }
}