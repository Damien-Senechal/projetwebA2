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

    public static function utilisateurDetail(){
        $pagetitle = "Utilisateur " . ModelUtilisateurs::getUtilisateurById($_GET['id_utilisateur'])->get('nom_utilisateur');
        $view = "viewUtilisateur";
        require File::build_path(array('view','view.php'));
    }

    public static function seConnecter() {
        $pagetitle = "Se connecter";
        $view = "viewConnecter";
        require File::build_path(array('view','view.php'));
    }

    public static function connected(){
        $pagetitle = "Cookie paradise";
        $view = 'viewAccueil';
        $id = ModelUtilisateurs::getUtilisateurByMail($_GET['mail_utilisateur'])->get('id_utilisateur');
    if((ModelUtilisateurs::getUtilisateurByMail($_GET['mail_utilisateur'])->get('nonce_utilisateur'))==NULL){
        if (ModelUtilisateurs::checkPassword($_GET["mail_utilisateur"], $_GET["mdp_utilisateur"])){
            $_SESSION['id_utilisateur'] = ModelUtilisateurs::getUtilisateurById($id)->get('id_utilisateur');
            $_SESSION['admin_utilisateur'] = ModelUtilisateurs::getUtilisateurById($id)->get('admin_utilisateur');
        }
        $u = ModelUtilisateurs::getUtilisateurByMail($_GET['mail_utilisateur']);
        require File::build_path(array('view','view.php'));
        }
    }

    public static function deconnecter(){
        session_unset();     // unset $_SESSION variable for the run-time 
        session_destroy();   // destroy session data in storage
        // Il faut réappeler session_start() pour accéder de nouveau aux variables de session
        setcookie(session_name(),'',time()-1);
        $pagetitle = "Cookie paradise";
        $view = "viewAccueil";
        require File::build_path(array('view','view.php'));
    }

    public static function enregistrer(){
        $pagetitle = "Créer compte";
        $view = 'viewEnregistrer';
        require File::build_path(array('view','view.php'));
    }

    public static function senregistrer(){
        $utilisateur = new ModelUtilisateurs($_GET);
        $mdp_utilisateurhache = Security::hacher($utilisateur->get("mdp_utilisateur"));
        $nonce = Security::generateRandomHex();
        if(isset($_GET['admin_utilisateur'])){
                if($_GET['admin_utilisateur']=="on"){
                    $isadmin_utilisateur = 1;
                }
            }
        else{
            $isadmin_utilisateur = 0;
        }
        if(!filter_var($_GET['mail_utilisateur'], FILTER_VALIDATE_EMAIL)){
            self::error("email pas bon <br>");
        }
        else if($_GET["mdp_utilisateur"]!=$_GET["mdp_utilisateur2"]){
            self::error("les mdp_utilisateur sont different");
        }
        else if ($utilisateur->save(array("nom_utilisateur" => $utilisateur->get("nom_utilisateur"),"prenom" => $utilisateur->get("prenom_utilisateur"), "mail_utilisateur" => $utilisateur->get("mail_utilisateur"), "mdp_utilisateur" => $utilisateur->get("mdp_utilisateur"), "mdp_utilisateur" => $mdp_utilisateurhache, "adresse_utilisateur" => $utilisateur->get("adresse_utilisateur"), "ddn_utilisateur" => $utilisateur->get("ddn_utilisateur"), "pp_utilisateur" => $utilisateur->get("pp_utilisateur"),"admin_utilisateur" => $isadmin_utilisateur, "histoire_utilisateur" => $utilisateur->get("histoire_utilisateur"), "nonce" => $nonce)) == false) {
            self::error("utilisateur déjà créé");
        }
        else {
            $pagetitle = "Creer compte";
            $view = 'viewAccueil';
            require File::build_path(array('view','view.php'));
        }
    }

    public static function update(){
        $pagetitle = "Modifier Utilisateur";
        $view = 'update';
        require File::build_path(array('view','view.php'));
    }

    public static function updated(){
        if($_GET["mdp_utilisateur_utilisateur"]==$_GET["mdp_utilisateur_utilisateur2"])
        {
        $utilisateur->update(array('id_utilisateur' => $_GET['id_utilisateur'], 'nom_utilisateur' => $htmlSpecialNom, 'prenom_utilisateur' => $_GET['nom_utilisateur'], 'mail_utilisateur' => $_GET['mail_utilisateur'], 'adresse_utilisateur' => $_GET['adresse_utilisateur'], 'ddn_utilisateur' => $_GET['ddn_utilisateur'], 'admin_utilisateur' => $_GET['admin_utilisateur'], 'mdp_utilisateur_utilisateur' => $_GET['mdp_utilisateur_utilisateur']));
        $pagetitle = "Modifier Utilisateur";
        $view = 'updated';
        require File::build_path(array('view','view.php'));
        }
        else{
           self::error("les mdp_utilisateur sont different"); 
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