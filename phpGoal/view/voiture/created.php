<?php  
		require_once File::build_path(array('model', 'ModelVoiture.php'));      
		echo "<p>La voiture a bien été créée !</p>";
		$tab_v = ModelVoiture::selectAll();
		require File::build_path(array("view", "voiture", "list.php"));
?>