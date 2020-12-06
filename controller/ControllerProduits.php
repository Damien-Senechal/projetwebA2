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

    public static function afficherPanier(){
        $pagetitle = "Panier";
        $view = "viewPanier";
        self::ajouterObjetPanier($_GET['nom_produit'], $_GET['qa_produit'], $_GET['prix_produit']);
        require File::build_path(array('view','view.php'));
    }


//PANIER PIANO PANIER PIANO PANIER PIANO PANIER PIANO PANIER PIANO PANIER PIANO PANIER PIANO PANIER PIANO PANIER PIANO 
    public static function creerPanier(){
        if (!isset($_SESSION['panier'])){
            $_SESSION['panier']=array();
            $_SESSION['panier']['qaProduit'] = array();
            $_SESSION['panier']['nomProduit'] = array();
            $_SESSION['panier']['prixProduit'] = array();
        }
        return true;
    }

    public static function ajouterObjetPanier($nomProduit,$qaProduit,$prixProduit){
        if (creerPanier())
        {
            $exists = array_search($nomProduit,  $_SESSION['panier']['nomProduit']);

            if ($exists)
                {
                    $_SESSION['panier']['qaProduit'][$exists] += $qaProduit ;
                }
            else
            {
                array_push( $_SESSION['panier']['qaProduit'],$qaProduit);
                array_push( $_SESSION['panier']['nomProduit'],$nomProduit);
                array_push( $_SESSION['panier']['prixProduit'],$prixProduit);
            }
        } else{
            self::error("Y a un problème chef");
        }    
           
    }

    public static function supprimerProduit($nomProduit){
        //Si le panier existe
        if (creationPanier() && !isVerrouille())
        {
          //Nous allons passer par un panier temporaire
          $panierTampon=array();
          $panierTampon['nomProduit'] = array();
          $panierTampon['qaProduit'] = array();
          $panierTampon['prixProduit'] = array();

          for($i = 0; $i < count($_SESSION['panier']['nomProduit']); $i++)
          {
             if ($_SESSION['panier']['nomProduit'][$i] !== $nomProduit)
             {
                array_push( $panierTampon['nomProduit'],$_SESSION['panier']['nomProduit'][$i]);
                array_push( $panierTampon['qaProduit'],$_SESSION['panier']['qaProduit'][$i]);
                array_push( $panierTampon['prixProduit'],$_SESSION['panier']['prixProduit'][$i]);
             }
          }
          //On remplace le panier en session par notre panier temporaire à jour
          $_SESSION['panier'] =  $panierTampon;
          //On efface notre panier temporaire
          unset($panierTampon);
        }
        else {
            self::error("Oh fréro... y a un blème la");
        }
    }

    public static function majQaProduit($nomProduit, $qaProduit){
        if (creationPanier() && !isVerrouille())
        {
            if ($qaProduit > 0)
            {
                $exists = array_search($nomProduit,  $_SESSION['panier']['nomProduit']);

                if ($exists !== false)
                {
                    $_SESSION['panier']['qaProduit'][$exists] = $qaProduit ;
                }
            }
            else{
                supprimerProduit($nomProduit);
            }
        } else{
            self::error("Ca commence a faire beaucoup, calme toi un peu et respire lentement.");
        }
    }

    public static function prixtotalPrix(){
        $totalPrix=0;
        for($i = 0; $i < count($_SESSION['panier']['nomProduit']); $i++)
        {
            $totalPrix += $_SESSION['panier']['qaProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
        }
        return $totalPrix;
    }

    public static function nbrProduit(){
        if (isset($_SESSION['panier']))
        return count($_SESSION['panier']['nomProduit']);
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