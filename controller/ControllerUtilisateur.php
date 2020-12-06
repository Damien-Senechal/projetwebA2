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
        $_SESSION['formMail'] = $_GET["mail_utilisateur"];
        $_SESSION['formMdp'] = $_GET["mdp_utilisateur"];
        if (ModelUtilisateurs::getUtilisateurByMail($_GET['mail_utilisateur'])) {
            if((ModelUtilisateurs::getUtilisateurByMail($_GET['mail_utilisateur'])->get('nonce_utilisateur'))==NULL){
                if (ModelUtilisateurs::checkPassword($_GET["mail_utilisateur"], $_GET["mdp_utilisateur"])){
                    $id = ModelUtilisateurs::getUtilisateurByMail($_GET['mail_utilisateur'])->get('id_utilisateur');
                    $u = ModelUtilisateurs::getUtilisateurByMail($_GET['mail_utilisateur']);

                    $_SESSION['id_utilisateur'] = ModelUtilisateurs::getUtilisateurById($id)->get('id_utilisateur');
                    $_SESSION['admin_utilisateur'] = ModelUtilisateurs::getUtilisateurById($id)->get('admin_utilisateur');
                }
            }
        }
        else {
            $pagetitle = "Identifiant ou mot de passe incorrect";
            $view = 'viewConnecter';
            $_SESSION['msgErreur'] = "Mauvais identifiants de connexion !";
        }
        require File::build_path(array('view','view.php'));
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

        if (self::dateValide($utilisateur->get("ddn_utilisateur"))) {

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
                echo 'Les mots de passe ne correspondent pas !  <a href="index.php">RETOUR A L\'ACCEUIL</a>';
            }
            else if ($utilisateur->save(array("id_utilisateur" => NULL,
                                              "nom_utilisateur" => $utilisateur->get("nom_utilisateur"),
                                              "prenom_utilisateur" => $utilisateur->get("prenom_utilisateur"),
                                              "mail_utilisateur" => $utilisateur->get("mail_utilisateur"),
                                              "mdp_utilisateur" => $mdp_utilisateurhache,
                                              "adresse_utilisateur" => $utilisateur->get("adresse_utilisateur"),
                                              "admin_utilisateur" => $isadmin_utilisateur,
                                              "histoire_utilisateur" => $utilisateur->get("histoire_utilisateur"),
                                              "nonce_utilisateur" => $nonce,
                                              "ddn_utilisateur" => $utilisateur->get("ddn_utilisateur"))) == false) {
                self::error("utilisateur déjà créé");
            }
            else {
                $pagetitle = "Cookie paradise";
                $view = 'viewAccueil';
                require File::build_path(array('view','view.php'));
            } 

        }
        
    }

    private static function dateValide($date){
        $annee = substr($date,0,4);
        $mmjj = substr($date,5);
        if (self::estBissextile($annee)){
            return $mmjj != "02-30" && $mmjj != "02-31" && $mmjj != "04-31" && $mmjj != "06-31" && $mmjj != "09-31" && $mmjj != "11-31";
        }else{
            return $mmjj != "02-29" && $mmjj != "02-30" && $mmjj != "02-31" && $mmjj != "04-31" && $mmjj != "06-31" && $mmjj != "09-31" && $mmjj != "11-31";
        }

    }

    private static function estBissextile($annee){
        return $annee%4 == 0 && $annee%100 != 0 || $annee%400 == 0;
    }

    public static function update(){
        if($_GET['id_utilisateur']==$_SESSION['id_utilisateur'])
        {
            $pagetitle = "Modifier compte";
            $view = 'viewEnregistrer';
            require File::build_path(array('view','view.php'));
        }
        else if(Session::is_admin()){
            $pagetitle = "Modifier compte";
            $view = 'viewEnregistrer';
            require File::build_path(array('view','view.php'));
        }
        else
        {
            echo "frero t mor";
        }
    }

    public static function updated(){
        $id = ModelUtilisateurs::getUtilisateurByMail($_SESSION['ancienMail'])->get('id_utilisateur');
        $utilisateur = ModelUtilisateurs::getUtilisateurByMail($_SESSION['ancienMail']);

        $htmlSpecialNom = htmlspecialchars($_GET['nom_utilisateur']);
        $htmlSpecialPrenom = htmlspecialchars($_GET['prenom_utilisateur']);
        $htmlSpecialMail = htmlspecialchars($_GET['mail_utilisateur']);
        $htmlSpecialAdresse = htmlspecialchars($_GET['adresse_utilisateur']);
        $htmlSpecialHistoire = htmlspecialchars($_GET['histoire_utilisateur']);
        $htmlSpecialDDN = htmlspecialchars($_GET['ddn_utilisateur']);


        if(!filter_var($_GET['mail_utilisateur'], FILTER_VALIDATE_EMAIL)){
            self::error("Mail incorrect <br>");
        }
        else{
            if($id==$_SESSION['id_utilisateur'] | Session::is_admin()){
                if(isset($_GET['admin_utilisateur'])){
                    if($_GET['admin_utilisateur']=="on"){
                        $isadmin = 1;
                    }
                }
                else{
                    $isadmin = 0;
                }
                if($_GET["mdp_utilisateur"]==$_GET["mdp_utilisateur2"]) {
                    $utilisateur->updateGen(array("id_utilisateur" => $_SESSION['id_utilisateur'],
                                             "nom_utilisateur" => $htmlSpecialNom,
                                             "prenom_utilisateur" => $htmlSpecialPrenom,
                                             "mail_utilisateur" => $htmlSpecialMail,
                                             "mdp_utilisateur" => Security::hacher($_GET['mdp_utilisateur']),
                                             "adresse_utilisateur" => $htmlSpecialAdresse,
                                             "admin_utilisateur" => $isadmin,
                                             "histoire_utilisateur" => $htmlSpecialHistoire,
                                             "nonce_utilisateur" => NULL,
                                             "ddn_utilisateur" => $htmlSpecialDDN));
                    $pagetitle = "Cookie Paradise";
                    $view = 'viewAccueil';
                    require File::build_path(array('view','view.php'));
                }
                else{
                   self::error("Les mots de passe sont different"); 
                }
            }
            else
            {
                echo "Arrete de hacker notre site stp";
            }
        }
    }



    public static function error($message){
        $pagetitle = "Delete Utilisateur";
        $view = 'error';
        require File::build_path(array('view','view.php'));
    }
}