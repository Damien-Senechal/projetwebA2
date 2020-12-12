<?php
class File {
   
  public static function build_path($path_array) {
  	if (!isset($_COOKIE['dureeDeViePanier'])) {
  		unset($_SESSION['panier']);
  	}
    $DS = DIRECTORY_SEPARATOR;
	$ROOT_FOLDER = __DIR__ . $DS . "..";
    return $ROOT_FOLDER. $DS . join($DS, $path_array);
  }
}
?>
