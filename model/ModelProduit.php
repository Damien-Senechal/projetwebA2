<?php
require_once File::build_path(array('model', 'Model.php'));

class ModelProduit extends Model {
   
  private $id_produit;
  private $nom_produit;
  private $desc_produit;
  private $prix_produit;
  private $stock_produit;
  private $urlimage_produit;
  private $categorie_produit;
  protected static $object = "produit";
  protected static $primary = "id_produit";
      
  // un constructeur
  public function __construct($data = array())  {
      foreach ($data as $key => $value){
          if($key != 'action') {
              $this->$key = $value;
          }
      }
  }
   
  public function get($nom_attribut) {
      if (property_exists($this, $nom_attribut)) {
        return $this->$nom_attribut;
      }
      return false; 
  }

  public function set($attribut,$valeur){
        $this->$attribut = $valeur;
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
                    echo 'Une erreur est survenue <a href="index.php"> retour a la page d\'accueil </a>';
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
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
      $tab_prod = $req_prep->fetchAll();
      // Attention, si il n'y a pas de résultats, on renvoie false
      if (empty($tab_prod)) return false;
      return $tab_prod[0];
  }

  public static function updateQuantiteProduit($qqt_produit, $id_produit)
      {
          try {
              $sql = "UPDATE p_produits SET stock_produit = stock_produit-:qqt WHERE id_produit =:id";
              $req_prep = Model::$pdo->prepare($sql);
              $values = array(
                "qqt"=>$qqt_produit,
                "id"=>$id_produit,
              );
              $req_prep->execute($values);
            } catch (PDOException $e) {
              if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
              }else {
                echo 'Une erreur est survenue <a href="index.php"> retour a la page d\'accueil </a>';
              }
              die();
            }
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
                echo 'Une erreur est survenue <a href="index.php"> retour a la page d\'accueil </a>';
              }
              die();
            }
    }


}

?>