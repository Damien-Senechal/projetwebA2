<?php
require_once File::build_path(array('model', 'Model.php'));

class ModelUtilisateur extends Model {

    private $login;
    private $nom;
    private $prenom;

    protected static $object = 'utilisateur';
    protected static $primary = 'login';

    // Getter générique (pas expliqué en TD)
    public function get($nom_attribut) {
        if (property_exists($this, $nom_attribut))
            return $this->$nom_attribut;
        return false;
    }

    // Setter générique (pas expliqué en TD)
    public function set($nom_attribut, $valeur) {
        if (property_exists($this, $nom_attribut))
            $this->$nom_attribut = $valeur;
        return false;
    }

    // un constructeur
    public function __construct($login = NULL, $nom = NULL, $prenom = NULL) {
        if (!is_null($login) && !is_null($nom) && !is_null($prenom)) {
            $this->login = $login;
            $this->nom = $nom;
            $this->prenom = $prenom;
        }
    }

    public function delete()
    {
        try {
            $sql = "DELETE FROM utilisateur WHERE login = :login;";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
              "login"=>$this->login,
            );
            $req_prep->execute($values);
          } catch (PDOException $e) {
            if (Conf::getDebug()) {
              echo $e->getMessage(); // affiche un message d'erreur
            }else {
              echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
          }
    }

    public static function getUtilisateurByLogin($login){
    try {
        $sql="SELECT * from utilisateur WHERE login=:nom_tag";
        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);
        $values = array("nom_tag"=>$login,
              //nomdutag => valeur, ...
        );
        // On donne les valeurs et on exécute la requête
        $req_prep->execute($values);
        // On récupère les résultats comme précédemment
        $req_prep->setFetchMode(PDO::FETCH_CLASS,'ModelUtilisateur');
        $tab_voit=$req_prep->fetchAll();
        // Attention, si il n'y a pas de résultats, on renvoie false
        if(empty($tab_voit))return false;
        return$tab_voit[0];
      } catch (PDOException $e) {
        if (Conf::getDebug()) {
          echo $e->getMessage(); // affiche un message d'erreur
        } else {
          echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        }
        die();
      }
  }

    /*public static function findTrajets($login)
    {
        try {
            $pdo = Model::$pdo;
            $sql = "SELECT * from passager p JOIN trajet t ON p.trajet_id = t.id WHERE p.utilisateur_login = '$login'";
            $rep = $pdo->query($sql);
            $rep->setFetchMode(PDO::FETCH_CLASS, 'Trajet');
            return $rep->fetchAll();
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function findTrajetsConducteur($login)
    {
        try {
            $pdo = Model::$pdo;
            $sql = "SELECT * from trajet WHERE conducteur_login = '$login'";
            $rep = $pdo->query($sql);
            $rep->setFetchMode(PDO::FETCH_CLASS, 'Trajet');
            return $rep->fetchAll();
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }*/

}
?>