<?php

require_once File::build_path(array('model','ModelProduits.php'));
class ControllerProduits
{
    protected static $object = "produit";
    public static function magasinProduit(){
        $pagetitle = "Magasin";
        $view = "viewMagasin";
        require File::build_path(array('view', 'view.php'));
    }

    public static function produitDetail(){
        $pagetitle = "Achat d'un ".ModelProduits::getProduitById($_GET['id_produit'])->get('nom_produit')." ";
        $view = "viewProduit";
        require File::build_path(array('view', 'view.php'));
    }

    public static function create(){
        $pagetitle = "Créer Produits";
        $view = 'update';
        require File::build_path(array('view','view.php'));
    }


//PANIER PIANO PANIER PIANO PANIER PIANO PANIER PIANO PANIER PIANO PANIER PIANO PANIER PIANO PANIER PIANO PANIER PIANO 
    public static function creerPanier(){
        if (!isset($_SESSION['panier'])){
            $_SESSION['panier'] = array();
        }
        return true;
    }

    public static function afficherPanier() {
        $pagetitle = "Panier";
        $view = "viewPanier";
        require File::build_path(array('view','view.php'));
    }

    public static function ajouterObjetPanier(){
        if (self::creerPanier())
        {  
            $idProduit = $_GET['id_produit'];
            $qaProduit = $_GET['qa_produit'];
            $exists = array_search($idProduit, array_column($_SESSION['panier'], "idProduit"));
            if ($exists !== false)
                {
                    $_SESSION['panier'][$exists]['qaProduit'] += $qaProduit;
                }
            else
            {
                array_push($_SESSION['panier'], array("idProduit" => $idProduit,
                                                       "qaProduit" => $qaProduit));
            }
            self::afficherPanier();
        } else{
            self::error("Y a un problème chef");
        }  
    }

    public static function supprimerProduit(){
        if (self::creerPanier())
        {
            $idProduit = $_GET['id_produit'];
            $panierTampon = array();

            foreach ($_SESSION['panier'] as $key => $value) {
                if ($_SESSION['panier'][$key]['idProduit'] != $idProduit)
                    {
                        array_push($panierTampon, array("idProduit" => $_SESSION['panier'][$key]['idProduit'], "qaProduit" => $_SESSION['panier'][$key]['qaProduit']));
                    }
            }
            $_SESSION['panier'] = $panierTampon;
            unset($panierTampon);
            self::afficherPanier();
        }
        else {
            self::error("Panier inexistant");
        }
    }

    public static function majQaProduit(){
        if (self::creerPanier())
        {
            $idProduit = $_GET['id_produit'];
            $qaProduit = $_GET['qa_produit'];
            if ($qaProduit > 0)
            {
                $exists = array_search($idProduit, array_column($_SESSION['panier'], "idProduit"));

                if ($exists !== false)
                {
                    $_SESSION['panier'][$exists]['qaProduit'] = $qaProduit;
                }
            }
            else{
                supprimerProduit($idProduit);
            }
            self::afficherPanier();
        } else{
            self::error("Ca commence a faire beaucoup, calme toi un peu et respire lentement.");
        }
    }

    public static function totalPrix(){
        $totalPrix=0;
        foreach ($_SESSION['panier'] as $key => $value) {
            $totalPrix += $_SESSION['panier'][$key]['qaProduit'] * ModelProduits::getProduitById($_SESSION['panier'][$key]['idProduit'])->get("prix_produit");
        }
        return $totalPrix;
    }

    public static function nbrProduit(){
        if (!empty($_SESSION['panier']))
            return count($_SESSION['panier']);
        else{
            echo "0";
        }
    }

    public static function supprPanier(){
        unset($_SESSION['panier']);
    }



    public static function update(){
        $pagetitle = "Modifier Produits";
        $view = 'update';
        require File::build_path(array('view','view.php'));
    }

    public static function updated(){

        $Produits = ModelProduits::getProduitById($htmlSpecialid_produit);
        
        $Produits->update(array('id_produit' => $_GET['id_produit'], 'nom_produit' => $_GET['nom_produit'], 'prix_produit' => $_GET['prix_produit'], 'desc_produit' => $_GET['desc_produit'], 'stock_produit' => $_GET['stock_produit']));
        $pagetitle = "Modifier Produits";
        $view = 'updated';
        require File::build_path(array('view','view.php'));
    }

    public static function delete(){
        if (isset($_GET["id_produit"])) {
            ModelProduits::delete($_GET["id_produit"]);
            $pagetitle = "Delete Produits";
            $view = 'deleted';
            require File::build_path(array('view','view.php'));
        }else{
            self::error("id_produit non défini");
        }
    }

    public static function error($message){
        $pagetitle = "Delete Produits";
        $view = 'error';
        require File::build_path(array('view','view.php'));
    }
}