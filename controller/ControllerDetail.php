<?php

require_once File::build_path(array('model','ModelDetail.php'));
class ControllerDetail
{
    protected static $object = "detail";
    public static function listeDetail() {
        $listeDetail = ModelUtilisateurs::getListeCommandeUtilisateur($_GET['id_utilisateur']);
        $pagetitle = "Liste commande(s) de " . ModelUtilisateurs::getUtilisateurById($_GET['id_utilisateur'])->get('nom_utilisateur');
        if ($listeDetail != null){
            $view = 'viewListeCommande';
        } else {
            self::error("Aucune commande !");
        }
    }

    public static function error($message){
        $pagetitle = "Erreur Detail";
        $view = 'error';
        require File::build_path(array('view','view.php'));
    }
}