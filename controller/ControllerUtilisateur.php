<?php

require_once File::build_path(array('model','ModelUtilisateur.php'));

class ControllerUtilisateur
{
    protected static $object = "utilisateur";
    public static function accueil(){
        $pagetitle = "Cookie paradise";
        $view = 'viewAccueil';
        require File::build_path(array('view','view.php'));
    }

    public static function utilisateurDetail(){
        $pagetitle = "Utilisateur " . ModelUtilisateur::getUtilisateurById(htmlspecialchars($_GET['id_utilisateur']))->get('nom_utilisateur');
        $view = "viewUtilisateur";
        require File::build_path(array('view','view.php'));
    }

    public static function listeUtilisateur(){
        $pagetitle = "Liste utilisateurs";
        $view = "viewListeUtil";
        require File::build_path(array('view','view.php'));
    }

    public static function supprimerUtilisateur(){
        if(!empty(ModelUtilisateur::getUtilisateurById(htmlspecialchars($_GET['id_utilisateur'])))) {
            $utilisateur = ModelUtilisateur::getUtilisateurById(htmlspecialchars($_GET['id_utilisateur']));
            $urlImage_utilisateur = $utilisateur->get("urlImage_utilisateur");
            if($urlImage_utilisateur != NULL) {
                unlink ($urlImage_utilisateur);
            }
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
        $_SESSION['formMail'] = htmlspecialchars($_POST["mail_utilisateur"]);
        $_SESSION['formMdp'] = htmlspecialchars($_POST["mdp_utilisateur"]);

        $mdp_utilisateur = htmlspecialchars($_POST["mdp_utilisateur"]);
        $mail_utilisateur = htmlspecialchars($_POST["mail_utilisateur"]);

        if (ModelUtilisateur::checkPassword($mail_utilisateur, $mdp_utilisateur)) {
                if((ModelUtilisateur::getUtilisateurByMail($mail_utilisateur)->get('nonce_utilisateur'))==NULL){
                        $id = ModelUtilisateur::getUtilisateurByMail($mail_utilisateur)->get('id_utilisateur');
                        $_SESSION['id_utilisateur'] = ModelUtilisateur::getUtilisateurById($id)->get('id_utilisateur');
                        $_SESSION['admin_utilisateur'] = ModelUtilisateur::getUtilisateurById($id)->get('admin_utilisateur');
                        if(isset($_POST['souvenir_utilisateur'])) {
                            setcookie('mail_utilisateur',htmlspecialchars($_POST["mail_utilisateur"]),time()+365*24*3600,null,null,false,true);
                            setcookie('mdp_utilisateur',htmlspecialchars($_POST["mdp_utilisateur"]),time()+365*24*3600,null,null,false,true);
                            setcookie('souvenir_utilisateur',htmlspecialchars($_POST["souvenir_utilisateur"]),time()+365*24*3600,null,null,false,true);
                         }
                }
                else {
                    $pagetitle = "Probleme avec le mail";
                    $view = 'viewConnecter';
                    $_SESSION['msgErreur'] = "Vous n'avez pas vérifié votre compte !";
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

    public static function valider()
    {
        if(ModelUtilisateur::getUtilisateurByMail(htmlspecialchars($_GET['mail_utilisateur']))) {
            $utilisateur = ModelUtilisateur::getUtilisateurByMail(htmlspecialchars($_GET['mail_utilisateur']));
            $nonce_utilisateur = $utilisateur->get('nonce_utilisateur');
            if (htmlspecialchars($_GET['nonce_utilisateur']) == $nonce_utilisateur) {
                ModelUtilisateur::setNonceNull($nonce_utilisateur);
            }
        }
    }

    public static function senregistrer(){
        $utilisateur = new ModelUtilisateur();

        $htmlSpecialNom = htmlspecialchars($_POST['nom_utilisateur']);
        $htmlSpecialPrenom = htmlspecialchars($_POST['prenom_utilisateur']);
        $htmlSpecialMail = htmlspecialchars($_POST['mail_utilisateur']);
        $htmlSpecialAdresse = htmlspecialchars($_POST['adresse_utilisateur']);
        $htmlSpecialHistoire = htmlspecialchars($_POST['histoire_utilisateur']);
        $htmlSpecialDDN = htmlspecialchars($_POST['ddn_utilisateur']);
        $htmlSpecialmdp1 = htmlspecialchars($_POST['mdp_utilisateur']);
        $htmlSpecialmdp2 = htmlspecialchars($_POST['mdp_utilisateur2']);
        $mdp_utilisateurhache = Security::hacher(htmlspecialchars($_POST["mdp_utilisateur"]));

        $_SESSION['formNom'] = $htmlSpecialNom;
        $_SESSION['formPrenom'] = $htmlSpecialPrenom;
        $_SESSION['formMail'] = $htmlSpecialMail;
        $_SESSION['formAdresse'] = $htmlSpecialAdresse;
        $_SESSION['formHistoire'] = $htmlSpecialHistoire;
        $_SESSION['formDDN'] = $htmlSpecialDDN;
        $_SESSION['formMdp1'] = $htmlSpecialmdp1;
        $_SESSION['formMdp2'] = $htmlSpecialmdp2;

        $nonce = Security::generateRandomHex();

        $randomText = Security::generateRandomHex();

        if(!empty($_FILES["photo_utilisateur"])) {
            if (move_uploaded_file($_FILES["photo_utilisateur"]["tmp_name"], "template/img/imagesUtilisateurs/". $randomText . ".png")) {
                $urlImage = "template/img/imagesUtilisateurs/". $randomText . ".png";
            } else {
                $urlImage = "template/img/user.png";
            }
        }
        else {
            $urlImage = "template/img/user.png";
        } 

        if(ModelUtilisateur::verifieMailUtilisateur($htmlSpecialMail) < 1) {
            if(!empty($_POST['admin_utilisateur']) && $_POST['admin_utilisateur']=="on"){
                $isadmin_utilisateur = 1;
            }
            else{
                $isadmin_utilisateur = 0;
            }
            if(!filter_var($htmlSpecialMail, FILTER_VALIDATE_EMAIL)){
                self::error("Email non valide", "enregistrer", self::$object);
            }
            else if($htmlSpecialmdp1!=$htmlSpecialmdp2){
                self::error("Les deux mots de passes sont différents", "enregistrer", self::$object);
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
                self::error("Utilisateur déjà créé", "enregistrer", self::$object);
            }
            else {
                unset($_SESSION['formNom']);
                unset($_SESSION['formPrenom']);
                unset($_SESSION['formMail']);
                unset($_SESSION['formAdresse']);
                unset($_SESSION['formHistoire']);
                unset($_SESSION['formDDN']);
                unset($_SESSION['formMdp1']);
                unset($_SESSION['formMdp2']);

                $pagetitle = "Validé utilisateur";
                $view = 'viewValiderEnregistrement';
                require File::build_path(array('view','view.php'));
            } 
        }
        else
            self::error("Adresse mail déja utilisée", "enregistrer", self::$object);
    }

    public static function update(){
        if(htmlspecialchars($_GET['id_utilisateur'])==$_SESSION['id_utilisateur'])
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
            self::error("Problème dans la création de compte", "accueil", "utilisateur"); 
        }
    }

    public static function updated(){
        $id = ModelUtilisateur::getUtilisateurByMail($_SESSION['ancienMail'])->get('id_utilisateur');
        $utilisateur = ModelUtilisateur::getUtilisateurByMail($_SESSION['ancienMail']);

        $htmlSpecialNom = htmlspecialchars($_POST['nom_utilisateur']);
        $htmlSpecialPrenom = htmlspecialchars($_POST['prenom_utilisateur']);
        $htmlSpecialMail = htmlspecialchars($_POST['mail_utilisateur']);
        $htmlSpecialAdresse = htmlspecialchars($_POST['adresse_utilisateur']);
        $htmlSpecialHistoire = htmlspecialchars($_POST['histoire_utilisateur']);
        $htmlSpecialDDN = htmlspecialchars($_POST['ddn_utilisateur']);
        $htmlSpecialmdp1 = htmlspecialchars($_POST['mdp_utilisateur']);
        $htmlSpecialmdp2 = htmlspecialchars($_POST['mdp_utilisateur2']);

        $_SESSION['formNom'] = $htmlSpecialNom;
        $_SESSION['formPrenom'] = $htmlSpecialPrenom;
        $_SESSION['formMail'] = $htmlSpecialMail;
        $_SESSION['formAdresse'] = $htmlSpecialAdresse;
        $_SESSION['formHistoire'] = $htmlSpecialHistoire;
        $_SESSION['formDDN'] = $htmlSpecialDDN;
        $_SESSION['formMdp1'] = $htmlSpecialmdp1;
        $_SESSION['formMdp2'] = $htmlSpecialmdp2;


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


        if(!filter_var(htmlspecialchars($_POST['mail_utilisateur']), FILTER_VALIDATE_EMAIL)){
            self::error("Mail incorrect !", "update", "utilisateur");
        }
        else if (!Session::is_admin() && Security::hacher(htmlspecialchars($_POST['ancien_mdp_utilisateur'])) != $utilisateur->get('mdp_utilisateur')) {
            self::error("Mot de passe incorrect !", "update", "utilisateur");
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
                if($htmlSpecialmdp1==$htmlSpecialmdp2 || empty($htmlSpecialmdp1) && empty($htmlSpecialmdp2)) {
                    $utilisateur->updateGen(array("id_utilisateur" => $id,
                                             "nom_utilisateur" => $htmlSpecialNom,
                                             "prenom_utilisateur" => $htmlSpecialPrenom,
                                             "mail_utilisateur" => $htmlSpecialMail,
                                             "mdp_utilisateur" => $htmlSpecialMdp,
                                             "adresse_utilisateur" => $htmlSpecialAdresse,
                                             "admin_utilisateur" => $isadmin,
                                             "histoire_utilisateur" => $htmlSpecialHistoire,
                                             "nonce_utilisateur" => $utilisateur->get('nonce_utilisateur'),
                                             "ddn_utilisateur" => $htmlSpecialDDN,
                                             "urlImage_utilisateur" => $urlImage));
                    unset($_SESSION['formNom']);
                    unset($_SESSION['formPrenom']);
                    unset($_SESSION['formMail']);
                    unset($_SESSION['formAdresse']);
                    unset($_SESSION['formHistoire']);
                    unset($_SESSION['formDDN']);
                    unset($_SESSION['formMdp1']);
                    unset($_SESSION['formMdp2']);
                    $pagetitle = "Cookie Paradise";
                    $view = 'viewAccueil';
                    require File::build_path(array('view','view.php'));
                }
                else{
                   self::error("Les mots de passe sont different", "update", "utilisateur"); 
                }
            }
            else
            {
                self::error("Arrete de hacker notre site", "update", "utilisateur");
            }
        }
    }



    public static function error($message, $action, $controller){
        $pagetitle = "Erreur Utilisateur";
        $view = 'error';
        require File::build_path(array('view','view.php'));
    }
}