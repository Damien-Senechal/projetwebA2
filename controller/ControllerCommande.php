<?php

require_once File::build_path(array('model','ModelCommandes.php'));
class ControllerCommande
{
    protected static $object = "commande";
    public static function readAll()
    {
        $tab_u = ModelCommande::getAllCommandes();
        $pagetitle = "Liste des Commandes";
        $view = 'list';
        require File::build_path(array('view', 'view.php'));
    }

    public static function read(){
        $u = ModelCommande::select($_GET['id_commande']);
        $pagetitle = "Détail Commande";
        if ($u != null){
            $view = 'detail';
        }else{
            self::error("Commande inexistant");
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
                                       "id_produit" => $commande->get("id_produit"),
                                       "p_quantite_produits" => $utilisateur->get("p_quantite_produits"),
                                       "p_prix_commande" => $p_prix_commande->get("p_prix_commande"))) == false){
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
                                       "id_produit" => $_GET["id_produit"],
                                       "p_quantite_produits" => $_GET["id_quantite_produits"],
                                       "p_prix_commande" => $_GET["p_prix_commande"]));
        $pagetitle = "Modifier Utilisateur";
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