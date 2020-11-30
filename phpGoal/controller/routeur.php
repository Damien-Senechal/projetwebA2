<?php
require_once 'ControllerVoiture.php';
require_once 'ControllerUtilisateur.php';


if (!isset($_GET['controller']))
	$controller = 'voiture';
else
	$controller = $_GET['controller'];

$controller_class = 'Controller'. ucfirst($controller);
if (class_exists($controller_class))
	{
	if(!isset($_GET['action'])){
		$action = 'readAll';
		$controller_class::$action(); 
	} else {
		$action = $_GET['action'];	
		if (in_array($action, get_class_methods($controller_class)))
		{
			if(isset($_GET['immatriculation']))
				ControllerVoiture::$action($_GET['immatriculation']); 
			elseif (isset($_GET['login']))
				$controller_class::$action($_GET['login']);
			else
				$controller_class::$action();
		}else{
			$controller = 'voiture';
	        $view = 'error';
	        require File::build_path(array('view', 'view.php'));
		}
	}
}
?>