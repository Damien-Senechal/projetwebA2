<?php

require_once File::build_path(array('model', 'Model.php'));

class ModelDetail extends Model {

  private $id_detail;
  private $id_commande;
  private $id_produit;
  private $quantite_produit_detail;
  private $prix_detail;
      
  // un constructeur
  public function __construct($id_detail = NULL, $id_commande = NULL, $id_produit = NULL, $quantite_produit_detail = NULL, $prix_detail = NULL) {
    if (!is_null($id_detail) && !is_null($id_commande) && !is_null($id_produit) && !is_null($quantite_produit_detail) && !is_null($prix_detail)) {
      $this->id_detail = $id_detail;
      $this->id_commande = $id_commande;
      $this->id_produit = $id_produit;
      $this->quantite_produit_detail = $quantite_produit_detail;
      $this->prix_detail = $prix_detail;
    }
  }
   
  public function get($nom_attribut) {
      if (property_exists($this, $nom_attribut))
          return $this->$nom_attribut;
      return false;
  }

  public function setIdDetail($id)  {
    if (strlen($id) > 10) {
      echo "Id non valide (taille > 11)\n";
    }
    else {
      $this->id_detail = $id_detail;
    }
  }

  public function setIdCommande($id)  {
    if (strlen($id) > 10) {
      echo "Id non valide (taille > 24)\n";
    }
    else {
      $this->id_commande = $id_commande;
    }
  }

  public function setIdProduit($id)  {
    if (strlen($id) > 10) {
      echo "Id non valide (taille > 25)\n";
    }
    else {
      $this->id_produit = $id_produit;
    }
  }

  public function setQuantiteDetail($qtt)  {
    if (strlen($qtt) > 64) {
      echo "Quantite non valide (taille > 64)\n";
    }
    else {
      $this->quantite_produit_detail = $quantite_produit_detail;
    }
  }

  public function setPrixDetail($prix)  {
    if (strlen($prix) > 24) {
      echo "Prix non valide (taille > 24)\n";
    }
    else {
      $this->prix_detail = $prix_detail;
    }
  }

  public function afficher() {
      echo "Le detail $this->id_detail, de la commande $this->id_commande, du produit $this->id_produit, en quantite de $this->quantite_produit_detail et au prix de $this->prix_detail";
  }


  public static function getAllDetails() {

    try {
      $rep = Model::$pdo->query('SELECT * FROM p_detail_commande');

      $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelDetail');
      $tab_cmd = $rep->fetchAll();

      return $tab_cmd;

    } catch (PDOException $e) {
                if (Conf::getDebug()) {
                    echo $e->getMessage(); // affiche un message d'erreur
                } 
                else {
                    echo 'Une erreur est survenue <a href="../index.php"> retour a la page d\'accueil </a>';
                }
                die();
            }
  }

    public static function getDetailById($id) {
      $sql = "SELECT * from p_detail_commande WHERE id_detail=:nom_tag";
      // Préparation de la requête
      $req_prep = Model::$pdo->prepare($sql);

      $values = array(
          "nom_tag" => $id,
          //nomdutag => valeur, ...
      );
      // On donne les valeurs et on exécute la requête   
      $req_prep->execute($values);

      // On récupère les résultats comme précédemment
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelDetail');
      $tab_det = $req_prep->fetchAll();
      // Attention, si il n'y a pas de résultats, on renvoie false
      if (empty($tab_det)) return false;
      return $tab_det[0];
  }

  public static function getListeDetailCommande($id) {
      try {
      $sql = "SELECT id_detail FROM p_detail_commande WHERE id_commande = :id_commande;";

      $req_prep = Model::$pdo->prepare($sql); 

      $values = array(
        "id_commande" => $id, 
      );
      $req_prep->execute($values);
      $tab_det = $req_prep->fetchAll();

      return $tab_det;

       }catch (PDOException $e) {
            if (Conf::getDebug()) {
              echo $e->getMessage(); // affiche un message d'erreur
            }else {
              echo 'Une erreur est survenue <a href="../index.php"> retour a la page d\'accueil </a>';
            }
            die();
          }
  }

  public function delete()
    {
        try {
            $sql = "DELETE FROM p_detail_commande WHERE id_detail = :id_detail;";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
              "id_detail"=>$this->id_detail,
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