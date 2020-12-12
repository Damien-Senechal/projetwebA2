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

    public static function listeToutesCommandes() {
        $listeToutesCommandes = ModelCommandes::getAllCommandes();
        $pagetitle = "Liste toutes les commandes";
        if ($listeToutesCommandes != null){
            $view = 'viewListeToutesCommandes';
        } else {
            self::error("Aucune commande !");
        }
        require File::build_path(array('view','view.php'));
    }

    public static function validerPanier(){
        if(!empty($_SESSION['panier'])) {
            $commande = new ModelCommandes(); 
            if(!empty($_SESSION['id_utilisateur']))
                $id_client = $_SESSION['id_utilisateur'];
            else 
                $id_client = NULL;
            $prix_commande = ControllerProduits::totalPrix();
            $date_commande = date("Y-m-d");
            if ($commande->save(array("id_commande" => NULL,
                                          "id_client" => $id_client,
                                          "prix_commande" => $prix_commande,
                                          "date_commande" => $date_commande)) == false) {
            self::error("Erreur lors de la création de la commande !");
            }
            else {
                foreach ($_SESSION['panier'] as $key => $value) {
                    $detail = new ModelDetail(); 
                    $id_commande = $commande->get("id_commande");
                    $id_produit = $_SESSION['panier'][$key]['idProduit'];
                    $quantite_produit_detail = $_SESSION['panier'][$key]['qaProduit'];
                    $id_produit = $_SESSION['panier'][$key]['idProduit'];
                        $prix_produit = ModelProduits::getProduitById($id_produit)->get("prix_produit");
                    $prix_detail = $_SESSION['panier'][$key]['qaProduit'] * $prix_produit;

                    if ($detail->save(array("id_detail" => NULL,
                                              "id_commande" => ModelCommandes::getIdNouvelleCommande(),
                                              "id_produit" => $id_produit,
                                              "quantite_produit_detail" => $quantite_produit_detail,
                                              "prix_detail" => $prix_detail)) == false) {
                        self::error("Erreur lors de la création du détail n°" . $key ." !");
                    }
                    else {
                        ModelProduits::updateQuantiteProduit($quantite_produit_detail, $id_produit);
                    }            
                }
            }
            unset($_SESSION['panier']);
            $pagetitle = "Paiement accepté !";
            $view = 'viewPaiementAccepter';
            require File::build_path(array('view','view.php'));
        }
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