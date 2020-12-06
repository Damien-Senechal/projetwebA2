<?php
require_once File::build_path(array('model', 'Model.php'));

class ModelProduits extends Model {
   
  private $id_produit;
  private $nom_produit;
  private $desc_produit;
  private $prix_produit;
  private $stock_produit;
  private $urlimage_produit;
  private $categorie_produit;
      
  // un constructeur
  public function __construct($id_produit = NULL, $nom_produit = NULL, $desc_produit = NULL, $prix_produit = NULL, $stock_produit = NULL, $urlimage_produit = NULL, $categorie_produit = NULL) {
    if (!is_null($id_produit) && !is_null($nom_produit) && !is_null($desc_produit) && !is_null($prix_produit) && !is_null($stock_produit) && !is_null($urlimage_produit) && !is_null($categorie_produit)) {
      $this->id_produit = $id_produit;
      $this->nom_produit = $nom_produit;
      $this->desc_produit = $desc_produit;
      $this->prix_produit = $prix_produit;
      $this->stock_produit = $stock_produit;
      $this->urlimage_produit = $urlimage_produit;
      $this->categorie_produit = $categorie_produit;
    }
  }
   
  public function get($nom_attribut) {
      if (property_exists($this, $nom_attribut)) {
        return $this->$nom_attribut;
      }
      return false; 
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
      echo "Stock non valide (taille > 10)\n";
    }
    else {
      $this->stock_produit = $stock_produit;
    }
  }

  public function setUrlProduit($url)  {
    if (strlen($url) > 250) {
      echo "Url non valide (taille > 250)\n";
    }
    else {
      $this->url_produit = $urlimage_produit;
    }
  }

  public function setCategorieProduit($categorie)  {
    if (strlen($categorie) > 25) {
      echo "Catégorie non valide (taille > 25)\n";
    }
    else {
      $this->categorie_produit = $categorie_produit;
    }
  }

  public function afficher() {
      echo "Le cookie n° $this->id_produit, de nom : $this->nom_produit, avec la description $this->desc_produit, qui coûte $this->prix_produit, en quantite de $this->stock_produit, avec l'url : $this->urlimage_produit et de catégorie $this->categorie_produit";
  }

  public static function getAllProduits() {

    try {
      $rep = Model::$pdo->query('SELECT * FROM p_produits');

      $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduits');
      $tab_prod = $rep->fetchAll();

      return $tab_prod;

    } catch (PDOException $e) {
                if (Conf::getDebug()) {
                    echo $e->getMessage(); // affiche un message d'erreur
                } 
                else {
                    echo 'Une erreur est survenue <a href="File::build_path(array())"> retour a la page d\'accueil </a>';
                }
                die();
            }
  }

    public static function getProduitById($id) {
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
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduits');
      $tab_prod = $req_prep->fetchAll();
      // Attention, si il n'y a pas de résultats, on renvoie false
      if (empty($tab_prod)) return false;
      return $tab_prod[0];
  }

    public function delete()
      {
          try {
              $sql = "DELETE FROM p_produits WHERE id_produit = :id_produit;";
              $req_prep = Model::$pdo->prepare($sql);
              $values = array(
                "id_produit"=>$this->id_produit,
              );
              $req_prep->execute($values);
            } catch (PDOException $e) {
              if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
              }else {
                echo 'Une erreur est survenue <a href="../index.php"> retour a la page d\'accueil </a>';
              }
              die();
            }
    }


}

?>