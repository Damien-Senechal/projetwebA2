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
            var_dump($exists);
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

    public static function supprimerProduit($idProduit){
        if (self::creerPanier())
        {
          $panierTampon=array();
          $panierTampon['idProduit'] = array();
          $panierTampon['qaProduit'] = array();
          $panierTampon['prixProduit'] = array();

          for($i = 0; $i < count($_SESSION['panier']['idProduit']); $i++)
          {
             if ($_SESSION['panier']['idProduit'][$i] !== $idProduit)
             {
                array_push( $panierTampon['idProduit'],$_SESSION['panier']['idProduit'][$i]);
                array_push( $panierTampon['qaProduit'],$_SESSION['panier']['qaProduit'][$i]);
                array_push( $panierTampon['prixProduit'],$_SESSION['panier']['prixProduit'][$i]);
             }
          }
          $_SESSION['panier'] =  $panierTampon;
          unset($panierTampon);
        }
        else {
            self::error("Oh fréro... y a un blème la");
        }
    }

    public static function majQaProduit($idProduit, $qaProduit){
        if (creerPanier() && !isVerrouille())
        {
            if ($qaProduit > 0)
            {
                $exists = array_search($idProduit,  $_SESSION['panier']['idProduit']);

                if ($exists !== false)
                {
                    $_SESSION['panier']['qaProduit'][$exists] = $qaProduit ;
                }
            }
            else{
                supprimerProduit($idProduit);
            }
        } else{
            self::error("Ca commence a faire beaucoup, calme toi un peu et respire lentement.");
        }
    }

    public static function totalPrix(){
        $totalPrix=0;
        for($i = 0; $i < count($_SESSION['panier']); $i++)
        {
            $totalPrix += $_SESSION['panier'][$i]['qaProduit'] * ModelProduits::getProduitById($_SESSION['panier'][$i]['idProduit'])->get("prix_produit");
        }
        return $totalPrix;
    }

    public static function nbrProduit(){
        if (isset($_SESSION['panier']))
        return count($_SESSION['panier']['idProduit']);
        else{
            return 0;
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