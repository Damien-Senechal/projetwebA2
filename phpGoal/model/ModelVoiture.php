<?php
require_once File::build_path(array('model', 'Model.php'));

class ModelVoiture extends Model{
   
  private $marque;
  private $couleur;
  private $immatriculation;

  protected static $object = 'voiture';
  protected static $primary = 'immatriculation';


      
  // un getter      
  public function getMarque() {
       return $this->marque;  
  }

  public function getCouleur()
  {
  	return $this->couleur;
  }

  public function getImmatriculation()
  {
  	return $this->immatriculation;
  }
     
  // un setter 
  public function setMarque($marque2) {
       $this->marque = $marque2;
  }

  public function setImmatriculation($immatriculation2) {
  	if (strlen($immatriculation2) == 8)
       $this->immatriculation = $immatriculation2;
    else {
      	return "erreur le nombre de caractère n'est pas le bon !";
      }  
  }

  public function setCouleur($couleur2) {
       $this->couleur = $couleur2;
  }
      
  // un constructeur
  /*public function __construct($m, $c, $i)  {
   $this->marque = $m;
   $this->couleur = $c;
   $this->immatriculation = $i;
  } */
  public function __construct($i = NULL, $m = NULL, $c = NULL) {
  if (!is_null($m) && !is_null($c) && !is_null($i)) {
    // Si aucun de $m, $c et $i sont nuls,
    // c'est forcement qu'on les a fournis
    // donc on retombe sur le constructeur à 3 arguments
    $this->marque = $m;
    $this->couleur = $c;
    $this->immatriculation = $i;
  }
}

  public function save()
  {
    try {
        $sql = "INSERT INTO voiture(immatriculation, marque, couleur) VALUES (:tag_immat, :tag_marque, :tag_couleur)";

        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
          "tag_immat"=>$this->immatriculation,
          "tag_marque"=>$this->marque,
          "tag_couleur"=>$this->couleur,);
        $req_prep->execute($values);
      } catch (PDOException $e) {
        if (Conf::getDebug()) {
          echo $e->getMessage(); // affiche un message d'erreur
        } else if ($e->getCode() == 23000){
          echo "Cette voiture est déjà enregistrée dans la base de donnée !";
          return false;
        }
        else {
          echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        }
        die();
      }

  }
}
?>