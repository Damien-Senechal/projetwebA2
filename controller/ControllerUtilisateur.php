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

    public static function listeUtilisateur(){
        $pagetitle = "Liste utilisateurs";
        $view = "viewListeUtil";
        require File::build_path(array('view','view.php'));
    }

    public static function supprimerUtilisateur(){
        if(!empty(ModelUtilisateurs::getUtilisateurById(htmlspecialchars($_GET['id_utilisateur'])))) {
            $utilisateur = ModelUtilisateurs::getUtilisateurById(htmlspecialchars($_GET['id_utilisateur']));
            $urlImage_utilisateur = $utilisateur->get("urlImage_utilisateur");
            unlink ($urlImage_utilisateur);
            $utilisateur->deleteGen();
            $pagetitle = "Liste utilisateurs";
            $view = "viewListeUtil";
            require File::build_path(array('view', 'view.php'));
        }
        else
            self::error("Utilisateur inconnu", "listeUtilisateur", self::$object);
        
    }

    public static function seConnecter() {
        $pagetitle = "Se connecter";
        $view = "viewConnecter";
        require File::build_path(array('view','view.php'));
    }

    public static function connected(){
        $pagetitle = "Cookie paradise";
        $view = 'viewAccueil';
        $_SESSION['formMail'] = htmlspecialchars($_GET["mail_utilisateur"]);
        $_SESSION['formMdp'] = htmlspecialchars($_GET["mdp_utilisateur"]);

        $mdp_utilisateur = htmlspecialchars($_GET["mdp_utilisateur"]);
        $mail_utilisateur = htmlspecialchars($_GET["mail_utilisateur"]);

        if (ModelUtilisateurs::checkPassword($mail_utilisateur, $mdp_utilisateur)) {
                if((ModelUtilisateurs::getUtilisateurByMail($mail_utilisateur)->get('nonce_utilisateur'))==NULL){
                        $id = ModelUtilisateurs::getUtilisateurByMail($mail_utilisateur)->get('id_utilisateur');
                        $_SESSION['id_utilisateur'] = ModelUtilisateurs::getUtilisateurById($id)->get('id_utilisateur');
                        $_SESSION['admin_utilisateur'] = ModelUtilisateurs::getUtilisateurById($id)->get('admin_utilisateur');
                    }
                }
        
        else {
            $pagetitle = "Identifiants de connexion incorrects";
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
        $utilisateur = new ModelUtilisateurs();

        $htmlSpecialNom = htmlspecialchars($_POST['nom_utilisateur']);
        $htmlSpecialPrenom = htmlspecialchars($_POST['prenom_utilisateur']);
        $htmlSpecialMail = htmlspecialchars($_POST['mail_utilisateur']);
        $htmlSpecialAdresse = htmlspecialchars($_POST['adresse_utilisateur']);
        $htmlSpecialHistoire = htmlspecialchars($_POST['histoire_utilisateur']);
        $htmlSpecialDDN = htmlspecialchars($_POST['ddn_utilisateur']);
        $htmlSpecialmdp1 = htmlspecialchars($_POST['mdp_utilisateur']);
        $htmlSpecialmdp2 = htmlspecialchars($_POST['mdp_utilisateur2']);
        $mdp_utilisateurhache = Security::hacher(htmlspecialchars($_POST["mdp_utilisateur"]));
        $nonce = Security::generateRandomHex();

        $randomText = Security::generateRandomHex();

        if(!empty($_FILES["photo_utilisateur"])) {
            if (move_uploaded_file($_FILES["photo_utilisateur"]["tmp_name"], "template/img/imagesUtilisateurs/". $randomText . ".png")) {
                $urlImage = "template/img/imagesUtilisateurs/". $randomText . ".png";
            } else {
                $urlImage = $utilisateur->get("urlImage_utilisateur");
            }
        }
        else {
            $urlImage = $utilisateur->get("urlImage_utilisateur");
        } 

        if(ModelUtilisateurs::verifieMailUtilisateur($htmlSpecialMail) < 1) {
            if(!empty($_POST['admin_utilisateur']) && $_POST['admin_utilisateur']=="on"){
                $isadmin_utilisateur = 1;
            }
            else{
                $isadmin_utilisateur = 0;
            }
            if(!filter_var($htmlSpecialMail, FILTER_VALIDATE_EMAIL)){
                self::error("email pas bon <br>");
            }
            else if($htmlSpecialmdp1!=$htmlSpecialmdp2){
                self::error('Les mots de passe ne correspondent pas !  <a href="index.php">RETOUR A L\'ACCEUIL</a>');
            }
            else if ($utilisateur->save(array("id_utilisateur" => NULL,
                                              "nom_utilisateur" => $htmlSpecialNom,
                                              "prenom_utilisateur" => $htmlSpecialPrenom,
                                              "mail_utilisateur" => $htmlSpecialMail,
                                              "mdp_utilisateur" => $mdp_utilisateurhache,
                                              "adresse_utilisateur" => $htmlSpecialAdresse,
                                              "admin_utilisateur" => $isadmin_utilisateur,
                                              "histoire_utilisateur" => $htmlSpecialHistoire,
                                              "nonce_utilisateur" => $nonce,
                                              "ddn_utilisateur" => $htmlSpecialDDN,
                                              "urlImage_utilisateur" => $urlImage)) == false) {
                self::error("utilisateur déjà créé");
            }
            else {
                $pagetitle = "Cookie paradise";
                $view = 'viewAccueil';
                require File::build_path(array('view','view.php'));
            } 
        }
        else
            self::error("Adresse mail déja utilisée", "enregistrer", self::$object);
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
            echo "erreur";
        }
    }

    public static function updated(){
        $id = ModelUtilisateurs::getUtilisateurByMail($_SESSION['ancienMail'])->get('id_utilisateur');
        $utilisateur = ModelUtilisateurs::getUtilisateurByMail($_SESSION['ancienMail']);

        $htmlSpecialNom = htmlspecialchars($_POST['nom_utilisateur']);
        $htmlSpecialPrenom = htmlspecialchars($_POST['prenom_utilisateur']);
        $htmlSpecialMail = htmlspecialchars($_POST['mail_utilisateur']);
        $htmlSpecialAdresse = htmlspecialchars($_POST['adresse_utilisateur']);
        $htmlSpecialHistoire = htmlspecialchars($_POST['histoire_utilisateur']);
        $htmlSpecialDDN = htmlspecialchars($_POST['ddn_utilisateur']);
        $htmlSpecialmdp1 = htmlspecialchars($_POST['mdp_utilisateur']);
        $htmlSpecialmdp2 = htmlspecialchars($_POST['mdp_utilisateur2']);

        $randomText = Security::generateRandomHex();

        if(!empty($_FILES["photo_utilisateur"])) {
            if (move_uploaded_file($_FILES["photo_utilisateur"]["tmp_name"], "template/img/imagesUtilisateurs/". $randomText . ".png")) {
                $urlImage = "template/img/imagesUtilisateurs/". $randomText . ".png";
            } else {
                $urlImage = $utilisateur->get("urlImage_utilisateur");
            }
        }
        else {
            $urlImage = $utilisateur->get("urlImage_utilisateur");
        } 

        if (empty($htmlSpecialmdp1) && empty($htmlSpecialmdp2)) {
            $htmlSpecialMdp = $utilisateur->get('mdp_utilisateur');
        }
        else {
            $htmlSpecialMdp = Security::hacher(htmlspecialchars($_POST['mdp_utilisateur']));
        }


        if(!filter_var($_POST['mail_utilisateur'], FILTER_VALIDATE_EMAIL)){
            echo 'Mail incorrect <br>!  <a href="index.php">RETOUR A L\'ACCEUIL</a>';
        }
        else if (!Session::is_admin() && Security::hacher(htmlspecialchars($_POST['ancien_mdp_utilisateur'])) != $utilisateur->get('mdp_utilisateur')) {
            echo 'Mot de passe incorrect <br>  <a href="index.php">RETOUR A L\'ACCEUIL</a>';
        }
        else{
            if($id==$_SESSION['id_utilisateur'] | Session::is_admin()){
                if(isset($_POST['admin_utilisateur'])){
                    if(htmlspecialchars($_POST['admin_utilisateur'])=="on"){
                        $isadmin = 1;
                    }
                }
                else{
                    $isadmin = 0;
                }
                if($htmlSpecialmdp1==$htmlSpecialmdp2 | empty($htmlSpecialmdp1) && empty($htmlSpecialmdp2)) {
                    $utilisateur->updateGen(array("id_utilisateur" => $id,
                                             "nom_utilisateur" => $htmlSpecialNom,
                                             "prenom_utilisateur" => $htmlSpecialPrenom,
                                             "mail_utilisateur" => $htmlSpecialMail,
                                             "mdp_utilisateur" => $htmlSpecialMdp,
                                             "adresse_utilisateur" => $htmlSpecialAdresse,
                                             "admin_utilisateur" => $isadmin,
                                             "histoire_utilisateur" => $htmlSpecialHistoire,
                                             "nonce_utilisateur" => NULL,
                                             "ddn_utilisateur" => $htmlSpecialDDN,
                                             "urlImage_utilisateur" => $urlImage));
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
                echo 'Arrete de hacker notre site stp  <a href="index.php">RETOUR A L\'ACCEUIL</a>';
            }
        }
    }



    public static function error($message, $action, $controller){
        $pagetitle = "Delete Utilisateur";
        $view = 'error';
        require File::build_path(array('view','view.php'));
    }
}