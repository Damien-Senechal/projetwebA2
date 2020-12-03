<?php

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
      
  // un constructeur
  public function __construct($id = NULL, $nom = NULL, $pre = NULL, $mail = NULL, $mdp = NULL, $adr = NULL, $ddn = NULL, $admin = NULL, $histoire = NULL) {
    if (!is_null($id) && !is_null($nom) && !is_null($pre) && !is_null($mail) && !is_null($mdp) && !is_null($adr) && !is_null($ddn) && !is_null($admin) && !is_null($histoire)) {
      $this->id_utilisateur = $id;
      $this->nom_utilisateur = $nom;
      $this->prenom_utilisateur = $pre;
      $this->mail_utilisateur = $mail;
      $this->mdp_utilisateur = $mdp;
      $this->adresse_utilisateur = $adr;
      $this->ddn_utilisateur = $ddn;
      $this->admin_utilisateur = $admin;
      $this->histoire_utilisateur = $histoire;
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
  public function setADmin($admin2)  {
      if (strlen($admin2) > 1) {
        echo "Admin non valide (taille > 1)\n";
      }
      else {
        $this->admin_utilisateur = $admin2;
      }
  }
  public function setADmin($histoire2)  {
      if (strlen($histoire2) > 2000) {
        echo "Histoire non valide (taille > 2000)\n";
      }
      else {
        $this->histoire_utilisateur = $histoire2;
      }
  }

  // une methode d'affichage.
  public function afficher() {
    	echo "L'utilisateur $this->id_utilisateur, $this->nom_utilisateur, $this->prenom_utilisateur, adresse mail : $this->mail_utilisateur, mot de passe : $this->mdp_utilisateur, adresse $this->adresse_utilisateur, date de naissance : $this->ddn_utilisateur, admin : $this->admin_utilisateur";
  }

  public function save() {
    Model::$pdo->query("INSERT INTO p_utilisateurs VALUES ('$this->id_utilisateur', '$this->nom_utilisateur', '$this->prenom_utilisateur', '$this->mail_utilisateur', '$this->mdp_utilisateur', '$this->adresse_utilisateur', '$this->ddn_utilisateur'), '$this->histoire_utilisateur', '$this->admin_utilisateur')");
  }


  public static function getAllUtilisateur() {
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

