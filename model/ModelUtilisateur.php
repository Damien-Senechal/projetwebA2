<?php
require_once File::build_path(array('lib', 'Security.php'));
require_once File::build_path(array('lib', 'Session.php'));
require_once File::build_path(array('model', 'Model.php'));

class ModelUtilisateur extends Model {
   
  private $id_utilisateur;
  private $nom_utilisateur;
  private $prenom_utilisateur;
  private $mail_utilisateur;
  private $adresse_utilisateur;
  private $ddn_utilisateur;
  private $histoire_utilisateur;
  private $mdp_utilisateur;
  private $admin_utilisateur;
  private $nonce_utilisateur;
  private $urlImage_utilisateur;
  protected static $object = "utilisateur";
  protected static $primary = "id_utilisateur";
  
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

  public static function age($date) { 
         $age = date("Y") - date('Y', strtotime($date)); 
        if (date('md') < date('md', strtotime($date))) { 
            return $age - 1; 
        } 
        return $age; 
    }

  public static function getAllUtilisateurs() {
    try {
        $rep = Model::$pdo->query('SELECT * FROM p_utilisateurs');

        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
        $tab_uti = $rep->fetchAll();

        return $tab_uti;

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

    public static function setNonceNull($id) {
      {
        try {
            $sql = "UPDATE p_utilisateurs SET nonce_utilisateur = NULL WHERE id_utilisateur = :id_utilisateur ";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
              "id_utilisateur"=>$id,
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

    public static function getUtilisateurById($id) {
      $sql = "SELECT * from p_utilisateurs WHERE id_utilisateur=:nom_tag";
      // Préparation de la requête
      $req_prep = Model::$pdo->prepare($sql);

      $values = array(
          "nom_tag" => $id,
          //nomdutag => valeur, ...
      );
      // On donne les valeurs et on exécute la requête   
      $req_prep->execute($values);

      // On récupère les résultats comme précédemment
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
      $tab_uti = $req_prep->fetchAll();
      // Attention, si il n'y a pas de résultats, on renvoie false
      if (empty($tab_uti)) return false;
      return $tab_uti[0];
    }

  public static function getUtilisateurByMail($id) {
      $sql = "SELECT * from p_utilisateurs WHERE mail_utilisateur=:nom_tag";
      // Préparation de la requête
      $req_prep = Model::$pdo->prepare($sql);

      $values = array(
          "nom_tag" => $id,
          //nomdutag => valeur, ...
      );
      // On donne les valeurs et on exécute la requête   
      $req_prep->execute($values);

      // On récupère les résultats comme précédemment
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
      $tab_uti = $req_prep->fetchAll();
      // Attention, si il n'y a pas de résultats, on renvoie false
      if (empty($tab_uti)) return false;
      return $tab_uti[0];
  }

  public static function verifieMailUtilisateur($mail) {
    try {
        $sql = "SELECT COUNT(id_utilisateur) FROM p_utilisateurs WHERE mail_utilisateur=:adresse_mail";

        $req_prep = Model::$pdo->prepare($sql); 

      $values = array(
        "adresse_mail" => $mail, 
      );
      $req_prep->execute($values);
      $tab_uti = $req_prep->fetch();
      return $tab_uti[0];

     }catch (PDOException $e) {
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

       }catch (PDOException $e) {
            if (Conf::getDebug()) {
              echo $e->getMessage(); // affiche un message d'erreur
            }else {
              echo 'Une erreur est survenue <a href="../index.php"> retour a la page d\'accueil </a>';
            }
            die();
          }
  }

  public static function checkPassword($mail,$mot_de_passe_non_hache){
        $mot_de_passe_hache = Security::hacher($mot_de_passe_non_hache);
        try
        {
            $sql = "SELECT COUNT(*) FROM p_utilisateurs WHERE mdp_utilisateur = :mdp AND mail_utilisateur = :mail";
            $req_prep = Model::$pdo->prepare($sql); 

            $values = array(
            "mail" => $mail, 
            "mdp" => $mot_de_passe_hache,
            );
             $req_prep->execute($values);
            $tab_uti = $req_prep->fetch();
            if ($tab_uti[0] == 1) {
                return true;
            }
            else {
                return false;
            }

       }catch (PDOException $e) {
            if (Conf::getDebug()) {
              echo $e->getMessage(); // affiche un message d'erreur
            }else {
              echo 'Une erreur est survenue <a href="../index.php"> retour a la page daccueil </a>';
            }
            die();
          }
        }

  public function delete()
    {
        try {
            $sql = "DELETE FROM p_utilisateurs WHERE id_utilisateur = :id_utilisateur;";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
              "id_utilisateur"=>$this->id_utilisateur,
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