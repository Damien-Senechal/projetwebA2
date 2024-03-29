<?php

require_once File::build_path(array('model', 'Model.php'));

class ModelCommande extends Model {

    private $id_commande;
    private $id_client;
    private $prix_commande;
    private $date_commande;
    private $adresse_livraison_commande;
    private $nomClient_NC_commande;
    private $prenomClient_NC_commande;
    private $mailClient_NC_commande;
    protected static $object = "commande";
    protected static $primary = "id_commande";
        
    // un constructeur
    public function __construct($data = array())  {
      foreach ($data as $key => $value){
          if($key != 'action') {
              $this->$key = $value;
          }
      }
    }
     
    public function get($nom_attribut) {
        if (property_exists($this, $nom_attribut))
            return $this->$nom_attribut;
        return false;
    }


    public function set($attribut,$valeur){
        $this->$attribut = $valeur;
    }

    public static function getAllCommandes() {
      try {
        $rep = Model::$pdo->query('SELECT * FROM p_commandes');

        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelCommande');
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

    public static function getIdNouvelleCommande() {
      try {
        $sql = 'SELECT MAX(id_commande) FROM p_commandes';

        $req_prep = Model::$pdo->prepare($sql); 

        $req_prep->execute();
        $tab_uti = $req_prep->fetch();
        return $tab_uti[0];

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

    public static function getDetailsFromCommande($id) {
      try {
        $sql = "SELECT * FROM p_detail_commande dc 
                JOIN p_commandes c ON dc.id_commande = c.id_commande 
                WHERE dc.id_commande = (SELECT id_commande 
                                        FROM p_commandes 
                                        WHERE id_client = :id)";
        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);

        $values = array(
            "id" => $id,
            //nomdutag => valeur, ...
        );
        // On donne les valeurs et on exécute la requête   
        $req_prep->execute($values);

        // On récupère les résultats comme précédemment
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCommande');
        $tab_prod = $req_prep->fetchAll();
        // Attention, si il n'y a pas de résultats, on renvoie false
        if (empty($tab_prod)) return false;
        return $tab_prod[0];
      } catch (PDOException $e) {
            if (Conf::getDebug()) {
              echo $e->getMessage(); // affiche un message d'erreur
            }else {
              echo 'Une erreur est survenue <a href="../index.php"> retour a la page d\'accueil </a>';
            }
            die();
      }
    }

    public static function getCommandeById($id) {
      try {
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
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCommande');
        $tab_prod = $req_prep->fetchAll();
        // Attention, si il n'y a pas de résultats, on renvoie false
        if (empty($tab_prod)) return false;
        return $tab_prod[0];
      } catch (PDOException $e) {
            if (Conf::getDebug()) {
              echo $e->getMessage(); // affiche un message d'erreur
            }else {
              echo 'Une erreur est survenue <a href="../index.php"> retour a la page d\'accueil </a>';
            }
            die();
      }
  }

  public static function getNbrCommandeUtilisateur($id) {
      try {
      $sql = "SELECT COUNT(id_commande) FROM p_commandes c JOIN p_utilisateurs u ON c.id_client = u.id_utilisateur WHERE id_utilisateur = :id_utilisateur;";

      $req_prep = Model::$pdo->prepare($sql); 

      $values = array(
        "id_utilisateur" => $id, 
      );
      $req_prep->execute($values);
      $tab_uti = $req_prep->fetch();
      return $tab_uti[0];

      } catch (PDOException $e) {
            if (Conf::getDebug()) {
              echo $e->getMessage(); // affiche un message d'erreur
            }else {
              echo 'Une erreur est survenue <a href="../index.php"> retour a la page d\'accueil </a>';
            }
            die();
      }
  }

  public static function getListeCommandeUtilisateur($id) {
      try {
      $sql = "SELECT id_commande FROM p_commandes c JOIN p_utilisateurs u ON c.id_client = u.id_utilisateur WHERE id_utilisateur = :id_utilisateur;";

      $req_prep = Model::$pdo->prepare($sql); 

      $values = array(
        "id_utilisateur" => $id, 
      );
      $req_prep->execute($values);
      $tab_uti = $req_prep->fetchAll();
      return $tab_uti;

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