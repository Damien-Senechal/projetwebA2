<?php

require_once 'Model.php';
require_once '../config/Conf.php';

class ModelProduit {
   
  private $id_produit;
  private $nom_produit;
  private $desc_produit;
  private $prix_produit;
  private $stock_produit;
      
  // un constructeur
  public function __construct($id_produit = NULL, $nom_produit = NULL, $desc_produit = NULL, $prix_produit = NULL, $stock_produit = NULL) {
    if (!is_null($id_produit) && !is_null($nom_produit) && !is_null($desc_produit) && !is_null($prix_produit) && !is_null($stock_produit)) {
      $this->id_produit = $id_produit;
      $this->nom_produit = $nom_produit;
      $this->desc_produit = $desc_produit;
      $this->prix_produit = $prix_produit;
      $this->stock_produit = $stock_produit;
    }
  }
   
  public function getIdProduit() {
    return $this->id_produit;  
  }
  public function getNomProduit()  {
    return $this->nom_produit;
  }
  public function getDescProduit()  {
    return $this->desc_produit;
  }
  public function getPrixProduit() {
    return $this->prix_produit;  
  }
  public function getStockProduit()  {
    return $this->stock_produit;
  }


  public function setIdProduit($id)  {
    if (strlen($id) > 10) {
      echo "Id non valide (taille > 10)\n";
    }
    else {
      $this->id_produit = $id_produit;
    }
  }

  public function setNomProduit($nom)  {
    if (strlen($nom) > 25) {
      echo "Nom non valide (taille > 25)\n";
    }
    else {
      $this->nom_produit = $nom_produit;
    }
  }

  public function setDescProduit($desc)  {
    if (strlen($desc) > 25) {
      echo "Description non valide (taille > 2000)\n";
    }
    else {
      $this->desc_produit = $desc_produit;
    }
  }

  public function setPrixProduit($prix)  {
    $this->prix_produit = $prix_produit;
  }

  public function setStockProduit($stock)  {
    if (strlen($stock) > 10) {
      echo "Description non valide (taille > 10)\n";
    }
    else {
      $this->stock_produit = $stock_produit;
    }
  }

  // une methode d'affichage.
  /*public function afficher() {
    echo "Voiture $this->immatriculation de marque $this->marque (couleur $this->couleur)";
  }*/

  public function save() {
    Model::$pdo->query("INSERT INTO p_produits (id_produit, nom_produit, desc_produit, prix_produit, stock_produit) VALUES ('$this->id_produit', '$this->nom_produit', '$this->desc_produit', '$this->prix_produit', '$this->stock_produit')");
  }


  public static function getAllProduits() {

    try {
      $rep = Model::$pdo->query('SELECT * FROM p_produits');

      $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
      $tab_prod = $rep->fetchAll();

      return $tab_prod;

    } catch (PDOException $e) {
                if (Conf::getDebug()) {
                    echo $e->getMessage(); // affiche un message d'erreur
                } 
                else {
                    echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                }
                die();
            }
  }

    public static function getProduitByID($id) {
      $sql = "SELECT * from p_produits WHERE id_produit=:nom_tag";
      // Préparation de la requête
      $req_prep = Model::$pdo->prepare($sql);

      $values = array(
          "nom_tag" => $id,
          //nomdutag => valeur, ...
      );
      // On donne les valeurs et on exécute la requête   
      $req_prep->execute($values);

      // On récupère les résultats comme précédemment
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
      $tab_prod = $req_prep->fetchAll();
      // Attention, si il n'y a pas de résultats, on renvoie false
      if (empty($tab_prod)) return false;
      return $tab_prod[0];
  }

}

?>