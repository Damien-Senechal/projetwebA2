<?php
    class Conf {
      static private $debug = True; 

      static private $databases = array(
        'hostname' => 'localhost',
        'database' => 'ecommerce',
        'login' => 'coockieMan',
        'password' => '9mOrBmdVioRje8Q4'
      );

      static public function getGen($var) {
        return self::$databases[$var];
      }

      static public function getDebug() {
          return self::$debug;
      }
    }
?>

