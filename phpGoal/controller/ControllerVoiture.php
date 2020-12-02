<?php
require_once File::build_path(array('model','ModelVoiture.php')); // chargement du modèle
class ControllerVoiture {
    protected static $object = 'voiture';
    public static function readAll() {
        $tab_v = ModelVoiture::selectAll();
        $pagetitle = "Liste des Voitures";
        $view = 'list';
        require File::build_path(array('view','view.php'));
    }

    public static function read(){
        $v = ModelVoiture::select($_GET['immat']);
        $pagetitle = "Détail Voitures";
        if ($v != null){
            $view = 'detail';
        }else{
            $view = 'error';
            $error = "<p>Voiture inexistante</p>";
        }
        require File::build_path(array('view','view.php'));
    }

    public static function create(){
        $pagetitle = "Créer Voitures";
        $view = 'update';
        require File::build_path(array('view','view.php'));
    }

    public static function created(){
        $voiture = new ModelVoiture($_GET);
        if ($voiture->save(array("immatriculation" => $voiture->get("immatriculation"),"marque" => $voiture->get("marque"),"couleur" => $voiture->get("couleur"))) == false){
            self::error("voiture déjà créée");
        }else {
            require File::build_path(array('view','voiture','created.php'));
        }
    }

    public static function update(){
        $pagetitle = "Modifier Voitures";
        $view = 'update';
        require File::build_path(array('view','view.php'));
    }

    public static function updated(){
        $htmlSpecialMarque = htmlspecialchars($_GET['marque']);
        $htmlSpecialCouleur = htmlspecialchars($_GET['couleur']);
        $htmlSpecialImmat = htmlspecialchars($_GET['immatriculation']);
        $voiture = ModelVoiture::select($htmlSpecialImmat);
        $voiture->update(array('immatriculation' => $htmlSpecialImmat, 'marque' => $htmlSpecialMarque, 'couleur' => $htmlSpecialCouleur));
        $pagetitle = "Modifier Voitures";
        $view = 'updated';
        require File::build_path(array('view','view.php'));
    }

    public static function delete(){
        if (isset($_GET["immat"])) {
            ModelVoiture::delete($_GET["immat"]);
            $pagetitle = "Delete Voitures";
            $view = 'deleted';
            require File::build_path(array('view','view.php'));
        }else{
            self::error("immat non définie");
        }
    }

    public static function error($message){
        $pagetitle = "Erreur";
        $view = 'error';
        require File::build_path(array('view','view.php'));
    }
}
