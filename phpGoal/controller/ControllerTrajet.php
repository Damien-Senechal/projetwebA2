<?php

require_once File::build_path(array('model','ModelTrajet.php'));
require_once File::build_path(array('model','ModelUtilisateur.php'));
class ControllerTrajet
{
    protected static $object = 'trajet';

    public static function readAll() {
        $tab_t = ModelTrajet::selectAll();
        $pagetitle = "Liste des Trajets";
        $view = 'list';
        require File::build_path(array('view','view.php'));
    }

    public static function read(){
        $t = ModelTrajet::select($_GET['id']);
        $pagetitle = "Détail Trajet";
        if ($t != null){
            $view = 'detail';
        }else{
            self::error("trajet Inexistant");
        }
        require File::build_path(array('view','view.php'));
    }

    public static function create(){
        $pagetitle = "Créer Trajet";
        $view = 'update';
        require File::build_path(array('view','view.php'));
    }

    public static function created(){
        $trajet = new ModelTrajet($_GET);
        if (ModelUtilisateur::select($_GET['conducteur_login']) != false) {
            if (self::dateValide($_GET['dateTrajet'])) {
                if ($trajet->save(array("id" => $trajet->get("id"), "depart" => $trajet->get("depart"), "arrivee" => $trajet->get("arrivee"), "dateTrajet" => $trajet->get("dateTrajet"), "nbPlaces" => $trajet->get("nbPlaces"), "prix" => $trajet->get("prix"), "conducteur_login" => $trajet->get("conducteur_login"))) == false) {
                    self::error("Trajet déjà créé");
                } else {
                    require File::build_path(array('view', 'trajet', 'created.php'));
                }
            }else{
                self::error("date invalide");
            }
        }else{
            self::error("conducteur absent dans table utilisateur");
        }
    }

    public static function update(){
        $pagetitle = "Modifier Trajet";
        $view = 'update';
        require File::build_path(array('view','view.php'));
    }

    public static function updated(){
        $htmlSpecialId = htmlspecialchars($_GET['id']);
        $htmlSpecialDepart = htmlspecialchars($_GET['depart']);
        $htmlSpecialArrivee = htmlspecialchars($_GET['arrivee']);
        $htmlSpecialDateTrajet = htmlspecialchars($_GET['dateTrajet']);
        $htmlSpecialNbPlaces = htmlspecialchars($_GET['nbPlaces']);
        $htmlSpecialPrix = htmlspecialchars($_GET['prix']);
        $htmlSpecialConducteur_login = htmlspecialchars($_GET['conducteur_login']);

        $trajet = ModelTrajet::select($htmlSpecialId);
        if (self::dateValide($_GET['dateTrajet'])) {
            $trajet->update(array('id' => $htmlSpecialId, 'depart' => $htmlSpecialDepart, 'arrivee' => $htmlSpecialArrivee, 'dateTrajet' => $htmlSpecialDateTrajet, 'nbPlaces' => $htmlSpecialNbPlaces, 'prix' => $htmlSpecialPrix, 'conducteur_login' => $htmlSpecialConducteur_login));
            $pagetitle = "Modifier Trajet";
            $view = 'updated';
            require File::build_path(array('view','view.php'));
        }else{
            self::error("date invalide");
        }

    }

    public static function delete(){
        if (isset($_GET["id"])) {
            ModelTrajet::delete($_GET["id"]);
            $pagetitle = "Delete Trajet";
            $view = 'deleted';
            require File::build_path(array('view','view.php'));
        }else{
            self::error("id non défini");
        }
    }

    public static function error($message){
        $pagetitle = "Erreur";
        $view = 'error';
        require File::build_path(array('view','view.php'));
    }

    private static function dateValide($date){
        $annee = substr($date,0,4);
        $mmjj = substr($date,5);
        if (self::estBissextile($annee)){
            return $mmjj != "02-30" && $mmjj != "02-31" && $mmjj != "04-31" && $mmjj != "06-31" && $mmjj != "09-31" && $mmjj != "11-31";
        }else{
            return $mmjj != "02-29" && $mmjj != "02-30" && $mmjj != "02-31" && $mmjj != "04-31" && $mmjj != "06-31" && $mmjj != "09-31" && $mmjj != "11-31";
        }

    }

    private static function estBissextile($annee){
        return $annee%4 == 0 && $annee%100 != 0 || $annee%400 == 0;
    }
}