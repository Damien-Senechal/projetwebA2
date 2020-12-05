<?php
require_once File::build_path(array('lib', 'Security.php'));
require_once File::build_path(array('lib', 'Session.php'));
require_once File::build_path(array('model', 'Model.php'));

class ModelUtilisateurs extends Model {
   
  private $id_utilisateur;
  private $nom_utilisateur;
  private $prenom_utilisateur;
  private $mail_utilisateur;
  private $mdp_utilisateur;
  private $adresse_utilisateur;
  private $ddn_utilisateur;
  private $admin_utilisateur;
  private $histoire_utilisateur;
  private $nonce_utilisateur;
  protected static $object = "utilisateur";
  
  // un constructeur
  public function __construct($id = NULL, $nom = NULL, $pre = NULL, $mail = NULL, $mdp = NULL, $adr = NULL, $ddn = NULL, $admin = NULL, $histoire = NULL, $nonce = NULL) {
    if (!is_null($id) && !is_null($nom) && !is_null($pre) && !is_null($mail) && !is_null($mdp) && !is_null($adr) && !is_null($ddn) && !is_null($admin) && !is_null($histoire) && !is_null($nonce)) {
      $this->id_utilisateur = $id;
      $this->nom_utilisateur = $nom;
      $this->prenom_utilisateur = $pre;
      $this->mail_utilisateur = $mail;
      $this->mdp_utilisateur = $mdp;
      $this->adresse_utilisateur = $adr;
      $this->ddn_utilisateur = $ddn;
      $this->admin_utilisateur = $admin;
      $this->histoire_utilisateur = $histoire;
      $this->nonce_utilisateur = $nonce;
    }
  }
   
  public function get($nom_attribut) {
      if (property_exists($this, $nom_attribut))
          return $this->$nom_attribut;
      return false;
  }
 
  public function setId($id2) {
	    if (strlen($id2) > 10) {
	      echo "Identifiant non valide (taille > 10)\n";
	    }
	    else {
	      $this->id_utilisateur = $id2;
	    }
  }
  public function setNom($nom2)  {
	    if (strlen($nom2) > 25) {
	      echo "Nom non valide (taille > 25)\n";
	    }
	    else {
	      $this->nom_utilisateur = $nom2;
	    }
  }
  public function setPrenom($prenom2)  {
	    if (strlen($prenom2) > 25) {
	      echo "Prenom non valide (taille > 25)\n";
	    }
	    else {
	      $this->prenom_utilisateur = $prenom2;
	    }
  }
  public function setMail($mail2)  {
	    if (strlen($mail2) > 64) {
	      echo "Mail non valide (taille > 64)\n";
	    }
	    else {
	      $this->mail_utilisateur = $mail2;
	    }
  }
  public function setMdp($mdp2)  {
	    if (strlen($mdp2) > 10) {
	      echo "Mdp non valide (taille > 10)\n";
	    }
	    else {
	      $this->mdp_utilisateur = $mdp2;
	    }
  }
  public function setAdresse($adresse2)  {
	    if (strlen($adresse2) > 64) {
	      echo "Adresse non valide (taille > 64)\n";
	    }
	    else {
	      $this->adresse_utilisateur = $adresse2;
	    }
  }
  public function setDdn($Ddn2)  {
	  	try {
	    	$this->ddn_utilisateur = $Ddn2;
		} 
		catch (PDOException $e) {
	        echo $e->getMessage(); // affiche un message d'erreur
	        die();
	    }
  }
  public function setAdmin($admin2)  {
      if (strlen($admin2) > 1) {
        echo "Admin non valide (taille > 1)\n";
      }
      else {
        $this->admin_utilisateur = $admin2;
      }
  }
  public function setHistoire($histoire2)  {
      if (strlen($histoire2) > 2000) {
        echo "Histoire non valide (taille > 2000)\n";
      }
      else {
        $this->histoire_utilisateur = $histoire2;
      }
  }
  public function setNonce($nonce2)  {
      if (strlen($nonce2) > 2000) {
        echo "Nonce non valide (taille > 32)\n";
      }
      else {
        $this->nonce_utilisateur = $nonce2;
      }
  }

  // une methode d'affichage.
  public function afficher() {
    	echo "L'utilisateur $this->id_utilisateur, $this->nom_utilisateur, $this->prenom_utilisateur, adresse mail : $this->mail_utilisateur, mot de passe : $this->mdp_utilisateur, adresse $this->adresse_utilisateur, date de naissance : $this->ddn_utilisateur, admin : $this->admin_utilisateur";
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

	      $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateurs');
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
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateurs');
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
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateurs');
      $tab_uti = $req_prep->fetchAll();
      // Attention, si il n'y a pas de résultats, on renvoie false
      if (empty($tab_uti)) return false;
      return $tab_uti[0];
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

  public static function checkPassword($mail,$mot_de_passe_hache){
        $mot_de_passe_hache = Security::hacher($mot_de_passe_hache);
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

