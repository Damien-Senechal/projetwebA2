<?php

require_once File::build_path(array('model','ModelProduit.php'));
class ControllerProduit
{
    protected static $object = "produit";
    public static function magasinProduit(){
        $pagetitle = "Magasin";
        $view = "viewMagasin";
        require File::build_path(array('view', 'view.php'));
    }

    public static function produitDetail(){
        setcookie("dureeDeViePanier", "OK", time() + 600);
        $pagetitle = "Achat d'un ". ModelProduit::getProduitById($_GET['id_produit'])->get('nom_produit')." ";
        $view = "viewProduit";
        require File::build_path(array('view', 'view.php'));
    }

    public static function supprimerCookie(){
        $produit = ModelProduit::getProduitById(htmlspecialchars($_GET['id_produit']));
        $urlImage_produit = $produit->get("urlImage_produit");
        if($urlImage_produit != NULL) {
                unlink($urlImage_produit);
            }
        $produit->deleteGen();
        $pagetitle = "Magasin";
        $view = "viewMagasin";
        require File::build_path(array('view', 'view.php'));
    }

    public static function creerCookie(){
        $pagetitle = "Création produit";
        $view = 'viewEditProduit';
        require File::build_path(array('view','view.php'));
    }

    public static function creationCookie(){
        $produit = new ModelProduit();

        $htmlSpecialId = htmlspecialchars($_POST['id_produit']);
        $htmlSpecialNom = htmlspecialchars($_POST['nom_produit']);
        $htmlSpecialDesc = htmlspecialchars($_POST['desc_produit']);
        $htmlSpecialPrix = htmlspecialchars($_POST['prix_produit']);
        $htmlSpecialStock = htmlspecialchars($_POST['stock_produit']);
        $htmlSpecialCategorie = htmlspecialchars($_POST['categorie_produit']);

        $randomText = Security::generateRandomHex();

        if(!empty($_FILES["photo_produit"])) {
            if (move_uploaded_file($_FILES["photo_produit"]["tmp_name"], "template/img/cookiesMagasin/". $randomText . ".png")) {
                $urlImage = "template/img/cookiesMagasin/". $randomText . ".png";
            } else {
                $urlImage = $produit->get("urlImage_produit");
            }
        }
        else {
            $urlImage = $produit->get("urlImage_produit");
        } 

        if ($produit->save(array("id_produit" => $htmlSpecialId,
                                      "nom_produit" => $htmlSpecialNom,
                                      "desc_produit" => $htmlSpecialDesc,
                                      "prix_produit" => $htmlSpecialPrix,
                                      "stock_produit" => $htmlSpecialStock,
                                      "urlImage_produit" => $urlImage,
                                      "categorie_produit" => $htmlSpecialCategorie)) == false) {
            self::error("Produit déjà créé", "creerCookie", self::$object);
        }
        else {
            $pagetitle = "Magasin";
            $view = 'viewMagasin';
            require File::build_path(array('view','view.php'));
        } 
    }

        public static function modifCookie(){
        if(Session::is_admin()){
            $pagetitle = "Modifier compte";
            $view = 'viewEditProduit';
            require File::build_path(array('view','view.php'));
        }
        else
        {
            echo "erreur";
        }
    }

    public static function modificationCoockie(){
        $produit = ModelProduit::getProduitById(htmlspecialchars($_POST['id_produit']));

        $htmlSpecialNom = htmlspecialchars($_POST['nom_produit']);
        $htmlSpecialDesc = htmlspecialchars($_POST['desc_produit']);
        $htmlSpecialPrix = htmlspecialchars($_POST['prix_produit']);
        $htmlSpecialStock = htmlspecialchars($_POST['stock_produit']);
        $htmlSpecialCategorie = htmlspecialchars($_POST['categorie_produit']);

        $randomText = Security::generateRandomHex();

        if(!empty($_FILES["photo_produit"])) {
            if (move_uploaded_file($_FILES["photo_produit"]["tmp_name"], "template/img/cookiesMagasin/". $randomText . ".png")) {
                $urlImage = "template/img/cookiesMagasin/". $randomText . ".png";
            } else {
                $urlImage = $produit->get("urlImage_produit");
            }
        }
        else {
            $urlImage = $produit->get("urlImage_produit");
        }  

        $produit->updateGen(array("id_produit" => $_POST['id_produit'],
                                 "nom_produit" => $htmlSpecialNom,
                                 "desc_produit" => $htmlSpecialDesc,
                                 "prix_produit" => $htmlSpecialPrix,
                                 "stock_produit" => $htmlSpecialStock,
                                 "urlImage_produit" => $urlImage,
                                 "categorie_produit" => $htmlSpecialCategorie));
        $pagetitle = "Magasin";
        $view = 'viewMagasin';
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
        setcookie("dureeDeViePanier", "OK", time()+600);
        $pagetitle = "Panier";
        $view = "viewPanier";
        require File::build_path(array('view','view.php'));
    }

    public static function ajouterObjetPanier(){
        setcookie("dureeDeViePanier", "OK", time()+600);
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
            self::error("Erreur lors de la création du panier !", "magasinProduit", self::$object);
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
            self::error("Panier inexistant !", "magasinProduit", self::$object);
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
            self::error("Erreur lors de la modification des quantitées !", "magasinProduit", self::$object);
        }
    }

    public static function totalPrix(){
        $totalPrix=0;
        foreach ($_SESSION['panier'] as $key => $value) {
            $totalPrix += $_SESSION['panier'][$key]['qaProduit'] * ModelProduit::getProduitById($_SESSION['panier'][$key]['idProduit'])->get("prix_produit");
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
        $pagetitle = "Panier";
        $view = "viewPanier";
        require File::build_path(array('view','view.php'));
    }



    public static function update(){
        $pagetitle = "Modifier Produits";
        $view = 'update';
        require File::build_path(array('view','view.php'));
    }

    public static function updated(){

        $Produits = ModelProduit::getProduitById($htmlSpecialid_produit);
        
        $Produits->update(array('id_produit' => $_GET['id_produit'], 'nom_produit' => $_GET['nom_produit'], 'prix_produit' => $_GET['prix_produit'], 'desc_produit' => $_GET['desc_produit'], 'stock_produit' => $_GET['stock_produit']));
        $pagetitle = "Modifier Produits";
        $view = 'updated';
        require File::build_path(array('view','view.php'));
    }

    public static function delete(){
        if (isset($_GET["id_produit"])) {
            ModelProduit::delete($_GET["id_produit"]);
            $pagetitle = "Delete Produits";
            $view = 'deleted';
            require File::build_path(array('view','view.php'));
        }else{
            self::error("id_produit non défini");
        }
    }

    public static function error($message, $action, $controller){
        $pagetitle = "Erreur Produits";
        $view = 'error';
        require File::build_path(array('view','view.php'));
    }
}