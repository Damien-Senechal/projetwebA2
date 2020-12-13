<?php

require_once File::build_path(array('model','ModelCommande.php'));
require_once File::build_path(array('model','ModelUtilisateur.php'));
require_once File::build_path(array('model','ModelDetail.php'));

class ControllerCommande
{
    protected static $object = "commande";
    public static function listeCommande() {
        $listeCommandes = ModelCommande::getListeCommandeUtilisateur(htmlspecialchars($_GET['id_utilisateur']));
        $pagetitle = "Liste commande(s) de " . ModelUtilisateur::getUtilisateurById(htmlspecialchars($_GET['id_utilisateur']))->get('nom_utilisateur');
        if ($listeCommandes != null){
            $view = 'viewListeCommande';
        } else {
            self::error("Aucune commande !");
        }
        require File::build_path(array('view','view.php'));
    }

    public static function listeToutesCommandes() {
        $listeToutesCommandes = ModelCommande::getAllCommandes();
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
            $commande = new ModelCommande(); 
            if(!empty($_SESSION['id_utilisateur'])) {
                $id_client = $_SESSION['id_utilisateur'];
                $utilisateur = ModelUtilisateur::getUtilisateurById($id_client);
                $nomClient_NC_commande = NULL;
                $prenomClient_NC_commande = NULL;
                $mailClient_NC_commande = NULL;
                $adresse_livraison_commande = $utilisateur->get("adresse_utilisateur");
            } else if(!isset(htmlspecialchars($_GET['connexionRapide']))) {
                $pagetitle = "Connexion rapide";
                $view = 'viewQuickConnect';
                require File::build_path(array('view','view.php'));
                die();
            } else {
                $id_client = NULL;
                $nomClient_NC_commande = htmlspecialchars($_POST["nom_utilisateur"]);
                $prenomClient_NC_commande = htmlspecialchars($_POST["prenom_utilisateur"]);
                $mailClient_NC_commande = htmlspecialchars($_POST["mail_utilisateur"]);
                $adresse_livraison_commande = htmlspecialchars($_POST["adresse_utilisateur"]);
            }
            $prix_commande = ControllerProduit::totalPrix();
            $date_commande = date('Y-m-d H:i:s', time() + 3600);
            if ($commande->save(array("id_commande" => NULL,
                                          "id_client" => $id_client,
                                          "nomClient_NC_commande" => $nomClient_NC_commande,
                                          "prenomClient_NC_commande" => $prenomClient_NC_commande,
                                          "mailClient_NC_commande" => $mailClient_NC_commande,
                                          "adresse_livraison_commande" => $adresse_livraison_commande,
                                          "prix_commande" => $prix_commande,
                                          "date_commande" => $date_commande)) == false) {
            self::error("Erreur lors de la création de la commande !");
            }
            else {
                foreach ($_SESSION['panier'] as $key => $value) {
                    $detail = new ModelDetail(); 
                    $id_produit = $_SESSION['panier'][$key]['idProduit'];
                    $quantite_produit_detail = $_SESSION['panier'][$key]['qaProduit'];
                    $id_produit = $_SESSION['panier'][$key]['idProduit'];
                        $prix_produit = ModelProduit::getProduitById($id_produit)->get("prix_produit");
                    $prix_detail = $_SESSION['panier'][$key]['qaProduit'] * $prix_produit;

                    if ($detail->save(array("id_detail" => NULL,
                                              "id_commande" => ModelCommande::getIdNouvelleCommande(),
                                              "id_produit" => $id_produit,
                                              "quantite_produit_detail" => $quantite_produit_detail,
                                              "prix_detail" => $prix_detail)) == false) {
                        self::error("Erreur lors de la création du détail n°" . $key ." !");
                    }
                    else {
                        ModelProduit::updateQuantiteProduit($quantite_produit_detail, $id_produit);
                    }            
                }
            unset($_SESSION['panier']);
            echo "je suis le dernier else !!!!";
            $pagetitle = "Paiement accepté !";
            $view = 'viewPaiementAccepter';
            require File::build_path(array('view','view.php'));
            }
        }
    }

    public static function read(){
        $u = ModelCommande::select(htmlspecialchars($_GET['id_commande']));
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
        $commande = new ModelCommande(htmlspecialchars($_GET));
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
        $utilisateur->update(array("id_commande" => htmlspecialchars($_GET["id_commande"]),
                                       "id_client" => htmlspecialchars($_GET["id_client"]),
                                       "date_commande" => htmlspecialchars($_GET["date_commande"]),
                                       "prix_commande" => htmlspecialchars($_GET["prix_commande"])));
        $pagetitle = "Modifier commande";
        $view = 'updated';
        require File::build_path(array('view','view.php'));
    }

    public static function delete(){
        if (isset(htmlspecialchars($_GET["id_commande"]))) {
            ModelCommande::delete(htmlspecialchars($_GET["id_commande"]));
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