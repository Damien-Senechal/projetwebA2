<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
    </head>
    <body>
    	<header>
    		<ul>
    			<li><a href="index.php?action=readAll">ReadAll</a></li>
    			<li><a href="index.php?action=readAll&controller=utilisateur">Utilisateurs</a></li>
    			<li><a href="index.php?action=readAll&controller=trajet">Trajets</a></li>
    		</ul>
    	</header>
		<?php
			$filepath = File::build_path(array("view", static::$object, "$view.php"));
			require $filepath;
		?>
		<footer>
			<p style="border: 1px solid black;text-align:right;padding-right:1em;">
			  Site de covoiturage de Loris
			</p>
		</footer>
    </body>
</html>