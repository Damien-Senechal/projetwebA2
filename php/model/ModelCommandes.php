<?php

require_once File::build_path(array('model', 'Model.php'));

class ModelProduit extends Model {

  private $id_commande;
  private $id_client;
  private $id_produit;
  private $quantite_commande;
  private $prix_commande;
      
  // un constructeur
  public function __construct($id_client = NULL, $id_produit = NULL, $quantite_commande = NULL, $prix_commande = NULL) {
    if (!is_null($id_client) && !is_null($id_produit) && !is_null($quantite_commande) && !is_null($prix_commande)) {
      $this->id_client = $id_client;
      $this->id_produit = $id_produit;
      $this->quantite_commande = $quantite_commande;
      $this->prix_commande = $prix_commande;
    }
  }
   
  public function get($nom_attribut) {
      if (property_exists($this, $nom_attribut))
          return $this->$nom_attribut;
      return false;
  }


  public function setIdCommande($id)  {
    if (strlen($id) > 10) {
      echo "Id non valide (taille > 10)\n";
    }
    else {
      $this->id_commande = $id_commande;
    }
  }

  public function setIdClient($id)  {
    if (strlen($id) > 10) {
      echo "Id non valide (taille > 10)\n";
    }
    else {
      $this->id_client = $id_client;
    }
  }

  public function setIdProduit($id)  {
    if (strlen($id) > 10) {
      echo "Id non valide (taille > 10)\n";
    }
    else {
      $this->id_produit = $id_produit;
    }
  }

  public function setQuantiteCommande($qtt)  {
    if (strlen($qtt) > 25) {
      echo "Quantite non valide (taille > 25)\n";
    }
    else {
      $this->quantite_commande = $quantite_commande;
    }
  }

  public function setPrixCommande($prix)  {
      $this->prix_commande = $prix_commande;
  }

  public function afficher() {
      echo "La commande $this->id_commande, de $this->id_client, du coockie $this->id_produit, en quantite de $this->quantite_commande et au prix de $this->prix_commande";
  }

  public function save() {
    Model::$pdo->query("INSERT INTO p_commandes VALUES ('$this->id_commande', '$this->id_client', '$this->id_produit', '$this->quantite_commande', '$this->prix_commande')");
  }


  public static function getAllCommandes() {

    try {
      $rep = Model::$pdo->query('SELECT * FROM p_commandes');

      $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelCommandes');
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

    public static function getCommandeById($id) {
      $sql = "SELECT * from p_commandes WHERE id_commande=:nom_tag";
      // Préparation de la requête
      $req_prep = Model::$pdo->prepare($sql);

      $values = array(
          "nom_tag" => $id,
          //nomdutag => valeur, ...
      );
      // On donne les valeurs et on exécute la requête   
      $req_prep->execute($values);

      // On récupère les résultats comme précédemment
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCommandes');
      $tab_prod = $req_prep->fetchAll();
      // Attention, si il n'y a pas de résultats, on renvoie false
      if (empty($tab_prod)) return false;
      return $tab_prod[0];
  }

  public function delete()
    {
        try {
            $sql = "DELETE FROM p_commandes WHERE id_commande = :id_commande;";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
              "id_commande"=>$this->id_commande,
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