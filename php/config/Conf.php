<?php
    class Conf {
      static private $debug = True; 

      static private $databases = array(
        'hostname' => 'https://webinfo.iutmontp.univ-montp2.fr/',
        'database' => 'garcial',
        'login' => 'garcial',
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

