<?php
	session_start();
	require_once 'lib/File.php';
	require_once File::build_path(array('controller', 'routeur.php'));
	require_once File::build_path(array('model', 'Model.php'));
	if (!empty($_SESSION['id_utilisateur'])) {
		$utilisateurCourant = ModelUtilisateurs::getUtilisateurById($_SESSION['id_utilisateur']);
		if ($utilisateurCourant->get('admin_utilisateur')==1) {
			$_SESSION['admin_utilisateur'] = 1;
		}
		else {
			$_SESSION['admin_utilisateur'] = 0;
		}
	}
?>