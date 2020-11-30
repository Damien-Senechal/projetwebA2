<?php
class Conf {
   
  private static $debug = true;

  static private $databases = array(
        // Le nom d'hote est webinfo a l'IUT
        // ou localhost sur votre machine
        'hostname' => 'localhost',
        // A l'IUT, vous avez une BDD nommee comme votre login
        // Sur votre machine, vous devrez creer une BDD
        'database' => 'td2',
        // A l'IUT, c'est votre login
        // Sur votre machine, vous avez surement un compte 'root'
        'login' => 'Td2',
        // A l'IUT, c'est votre mdp (INE par defaut)
        // Sur votre machine personelle, vous avez creez ce mdp a l'installation
        'password' => '9mOrBmdVioRje8Q4'
      );
   
  static public function getGen($var) {
    //en PHP l'indice d'un tableau n'est pas forcement un chiffre.
    return self::$databases[$var];
  }

  static public function getDebug() {
      return self::$debug;
    }
}
?>

