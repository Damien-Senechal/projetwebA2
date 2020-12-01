<?php
require_once File::build_path(array('model', 'ModelUtilisateur.php'));

class ControllerUtilisateur {

	protected static $object = 'utilisateur';

    public static function readAll() {
        $tab_v = ModelUtilisateur::selectAll();
        $view = 'list';
        require File::build_path(array('view', 'view.php'));
    }

    public static function read($login)
    {
    	$u = ModelUtilisateur::select($login);
    	$view = 'detail';
    	require File::build_path(array('view', 'view.php'));
    }

    public static function delete()
    {
    	ModelUtilisateur::deleteGen();
    	$view = 'deleted';
        require File::build_path(array('view', 'view.php'));
    }

    public static function create()
    {
    	$view = 'update';
        $login = '';
        $prenom = '';
        $nom = '';
        $read = 'required';
        $name = 'created';
        require File::build_path(array('view', 'view.php'));
    }

    public static function created()
    {
		$login = $_GET["login"];
		$prenom = $_GET["prenom"];
		$nom = $_GET["nom"];
		$user = new ModelVoiture($login, $nom, $prenom);
		$user->save();
	    $view = 'created';
	    require File::build_path(array('view', 'view.php'));
    
    }

    public static function update()
    {
        $u = ModelUtilisateur::select($_GET['login']);
        $view = 'update';
        $login = $u->get('login');
        $nom = $u->get('nom');
        $prenom = $u->get('prenom');
        $read = 'readonly';
        $name = 'updated';
        require File::build_path(array('view', 'view.php'));
    }

    public static function updated()
    {
        $u = ModelUtilisateur::select($_GET['login']);
        $data = array(
            'login' => $_GET['login'],
            'nom' => $_GET['nom'],
            'prenom' => $_GET['prenom']);
        $u->update($data);
        $view = 'updated';
        require File::build_path(array('view', 'view.php'));
    }
}
?>