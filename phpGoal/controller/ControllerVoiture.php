<?php
require_once File::build_path(array('model', 'ModelVoiture.php'));

class ControllerVoiture {

    protected static $object = 'voiture';

    public static function readAll() {
        $tab_v = ModelVoiture::selectAll();
        $view = 'list';
        require File::build_path(array('view', 'view.php'));
    }

    public static function update()
    {
        $v = ModelVoiture::select($_GET['immatriculation']);
        $view = 'update';
        $immatriculation = $v->getImmatriculation();
        $marque = $v->getMarque();
        $couleur = $v->getCouleur();
        $read = 'readonly';
        $name = 'updated';
        require File::build_path(array('view', 'view.php'));
    }

    public static function updated()
    {
        $v = ModelVoiture::select($_GET['immatriculation']);
        $data = array(
            'immatriculation' => $_GET['immatriculation'],
            'couleur' => $_GET['couleur'],
            'marque' => $_GET['marque']);
        ModelVoiture::updateGen($data);
        $view = 'updated';
        require File::build_path(array('view', 'view.php'));
    }
    
    public static function read($immat) {
        $v = ModelVoiture::select($immat);
        if ($v == false)
            $view = 'error';
        else
            $view = "detail";
        require File::build_path(array('view', 'view.php'));
    }

    public static function create()
    {
        $view = 'update';
        $immatriculation = '';
        $marque = '';
        $couleur = '';
        $read = 'required';
        $name = 'created';
        require File::build_path(array('view', 'view.php'));
    }

    public static function created()
    {
    	$marque = $_GET["marque"];
    	$couleur = $_GET["couleur"];
    	$immatriculation = $_GET["immatriculation"];
    	$voiture = new ModelVoiture($immatriculation, $marque, $couleur);
    	$voiture->save();
        $view = 'created';
        require File::build_path(array('view', 'view.php'));
    }

    public static function delete()
    {
    	ModelVoiture::deleteGen();
        $view = 'deleted';
        require File::build_path(array('view', 'view.php'));
    }
}
?>

