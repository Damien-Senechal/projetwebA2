<?php  
		require_once File::build_path(array('model', 'ModelUtilisateur.php'));      
		echo "<p>L'utilisateur a bien été supprimé'!</p>";
		$tab_v = ModelUtilisateur::selectAll();
		require File::build_path(array("view", "utilisateur", "list.php"));
?>