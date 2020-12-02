<?php
require_once File::build_path(array('model','Model.php'));

class ModelVoiture extends Model{
   
  private $marque;
  private $couleur;
  private $immatriculation;
  private $debug = true;
  protected static $object = "voiture";
  protected static $primary = "immatriculation";


    public function __construct($data = array())  {
        foreach ($data as $key => $value){
            if($key != 'action') {
                $this->$key = $value;
            }
        }

    }

  // getters
  public function get($attribut){
      return $this->$attribut;
  }

  //setters
  public function set($attribut,$valeur){
        $this->$attribut = $valeur;
  }
}
?>