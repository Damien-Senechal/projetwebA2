<?php

require_once File::build_path(array('model','ModelCommandes.php'));
require_once File::build_path(array('model','ModelUtilisateurs.php'));
require_once File::build_path(array('model','ModelDetail.php'));

class ControllerCommande
{
    protected static $object = "commande";
    public static function listeCommande() {
        $listeCommandes = ModelCommandes::getListeCommandeUtilisateur($_GET['id_utilisateur']);
        $pagetitle = "Liste commande(s) de " . ModelUtilisateurs::getUtilisateurById($_GET['id_utilisateur'])->get('nom_utilisateur');
        if ($listeCommandes != null){
            $view = 'viewListeCommande';
        } else {
            self::error("Aucune commande !");
        }
        require File::build_path(array('view','view.php'));
    }

    public static function validerPanier(){
    $pagetitle = "Magasin";
    $view = "viewMagasin";
    require File::build_path(array('view', 'view.php'));
    }

    public static function read(){
        $u = ModelCommande::select($_GET['id_commande']);
        $pagetitle = "Détail Commande";
        if ($u != null){
            $view = 'detail';
        }else{
            self::error("Commande inexistante");
        }
        require File::build_path(array('view','view.php'));
    }

    public static function create(){
        $pagetitle = "Créer Commande";
        $view = 'update';
        require File::build_path(array('view','view.php'));
    }

    public static function created(){
        $commande = new ModelCommande($_GET);
        if ($commande->save(array("id_commande" => $commande->get("id_commande"),
                                       "id_client" => $commande->get("id_client"),
                                       "date_commande" => $commande->get("date_commande"),
                                       "prix_commande" => $commande->get("prix_commande"))) == false){
            self::error("utilisateur déjà créé");
        }
        else {
            $pagetitle = "Modifier Commande";
            $view = 'created';
            require File::build_path(array('view','view.php'));
        }
    }

    public static function update(){
        $pagetitle = "Modifier Commande";
        $view = 'update';
        require File::build_path(array('view','view.php'));
    }

    public static function updated(){
        $utilisateur->update(array("id_commande" => $_GET["id_commande"],
                                       "id_client" => $_GET["id_client"],
                                       "date_commande" => $_GET["date_commande"],
                                       "prix_commande" => $_GET["prix_commande"]));
        $pagetitle = "Modifier commande";
        $view = 'updated';
        require File::build_path(array('view','view.php'));
    }

    public static function delete(){
        if (isset($_GET["id_commande"])) {
            ModelCommande::delete($_GET["id_commande"]);
            $pagetitle = "Delete Commande";
            $view = 'deleted';
            require File::build_path(array('view','view.php'));
        }else{
            self::error("id_commande non défini");
        }
    }

    public static function error($message){
        $pagetitle = "Delete Commande";
        $view = 'error';
        require File::build_path(array('view','view.php'));
    }
}