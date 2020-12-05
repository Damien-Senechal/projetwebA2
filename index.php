<?php
	session_start();
	$_SESSION['prixPanier'] = 0;
	require_once 'lib/File.php';
	require_once File::build_path(array('controller', 'routeur.php'));
?>