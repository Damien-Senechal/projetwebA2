<?php

require_once File::build_path(array('model','Model.php'));
class ModelTrajet extends Model
{
    private $id;
    private $depart;
    private $arrivee;
    private $dateTrajet;
    private $nbPlaces;
    private $prix;
    private $conducteur_login;
    protected static $object = "trajet";
    protected static $primary = "id";

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