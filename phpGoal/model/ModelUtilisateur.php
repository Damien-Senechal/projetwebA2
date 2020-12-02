<?php

require_once File::build_path(array('model','Model.php'));
class ModelUtilisateur extends Model
{
    private $login;
    private $nom;
    private $prenom;
    private $mdp;
    protected static $object = "utilisateur";
    protected static $primary = "login";

    public function __construct($data = array())  {
        foreach ($data as $key => $value){
            if($key != 'action') {
                $this->$key = $value;
            }
        }

    }

    public function get($attribut){
        return $this->$attribut;
    }

    public function set($attribut,$valeur){
        $this->$attribut = $valeur;
    }



}