<!DOCTYPE html>
<html>
<head>
	<title>je teste</title>
</head>
<body>
	<h1> test </h1>
	<?php 
		require_once '../php/lib/File.php';
		require_once File::build_path(array("controller","ControllerUtilisateur.php"));
		ControllerUtilisateur::readAll();
	?>
</body>
</html>