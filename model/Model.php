<?php
    require_once File::build_path(array('config', 'Conf.php'));

    class Model{
        public static $pdo;

        public static function Init() {
            $hostname = Conf::getHostname();
            $database_name = Conf::getDatabase();
            $login = Conf::getLogin();
            $password = Conf::getPassword();

            try{
                // Connexion à la base de données
                // Le dernier argument sert à ce que toutes les chaines de caractères
                // en entrée et sortie de MySql soit dans le codage UTF-8
                self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

                // On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            } catch (PDOException $e) {
                if (Conf::getDebug()) {
                    echo $e->getMessage(); // affiche un message d'erreur
                } 
                else {
                    echo 'Une erreur est survenue <a href="index.php"> retour a la page d\'accueil </a>';
                }
                die();
            }
        }

        public static function save($data)
	    {
	        try {
	            $table_name = static::$object;
	            $sql = "INSERT INTO p_$table_name"."s ";
	            $sql_values = "VALUES(";
	            $pdo = Model::$pdo;
	            foreach ($data as $key => $valeur) {
	                $sql_values = $sql_values . ":$key,";
	            }
	            $sql_values = rtrim($sql_values,",");
	            $sql = $sql . $sql_values . ")";
	            $req = $pdo->prepare($sql);
	            $req->execute($data);
	        }catch(PDOException $e){
	            if ($e->getCode() == '23000'){
	                return false;
	            }
	        }
	        return true;
	    }

        public static function selectAll()
		{
		    $table_name = static::$object;
		    $class_name = 'Model' . ucfirst($table_name);
		    try {
		        $rep = Model::$pdo -> query("SELECT * FROM $table_name");
		        $rep->setFetchMode(PDO::FETCH_CLASS, "$class_name");
		        $tab_obj = $rep->fetchAll();
		        return $tab_obj;
		    } catch (PDOException $e) {
		        if (Conf::getDebug()) {
		          	echo $e->getMessage(); // affiche un message d'erreur
		        } else {
		          	echo 'Une erreur est survenue <a href="index.php"> retour a la page d\'accueil </a>';
		        }
		        die();
		    }
		}

		public static function select($primary_value)
	  	{
		    $table_name = static::$object;
		    $class_name = 'Model' . ucfirst($table_name);
		    $primary_key = static::$primary;

		    try {
		        $sql="SELECT * from $table_name WHERE $primary_key=:nom_tag";
		        // Préparation de la requête
		        $req_prep = Model::$pdo->prepare($sql);
		        $values = array("nom_tag"=>$primary_value,
		        );
		        // On donne les valeurs et on exécute la requête
		        $req_prep->execute($values);
		        // On récupère les résultats comme précédemment
		        $req_prep->setFetchMode(PDO::FETCH_CLASS, "$class_name");
		        $tab_voit=$req_prep->fetchAll();
		        // Attention, si il n'y a pas de résultats, on renvoie false
		        if(empty($tab_voit))return false;
		        	return$tab_voit[0];
		    } catch (PDOException $e) {
		        if (Conf::getDebug()) {
		          	echo $e->getMessage(); // affiche un message d'erreur
		        } else {
		          	echo 'Une erreur est survenue <a href="index.php"> retour a la page d\'accueil </a>';
		        }
		        die();
		    }
	  	}

        public static function deleteGen()
  		{
	     	$table_name = static::$object;
	      	$class_name = 'Model' . ucfirst($table_name);
	      	$primary_key = static::$primary;
	      	$primary_key_value = $_GET["$primary_key"];
	      	try {
	        	$sql = "DELETE FROM p_$table_name"."s WHERE $primary_key= :value;";
	        	$req_prep = Model::$pdo->prepare($sql);
	        	$values = array(
	          	"value"=>$primary_key_value,
	        	);
	        	$req_prep->execute($values);
	      	} catch (PDOException $e) {
		        if (Conf::getDebug()) {
		          	echo $e->getMessage(); // affiche un message d'erreur
		        } else {
		          	echo 'Une erreur est survenue <a href="index.php"> retour a la page d\'accueil </a>';
		        }
	        	die();
      		}

		}

	  	public static function updateGen($data)
	  	{
		    $table_name = static::$object;
		    $class_name = 'Model' . ucfirst($table_name);
		    $primary_key = static::$primary;
		    $string = '';
		    try {
		        foreach ($data as $key => $value) {$string =  $string . $key . '="' . $value . '",';}
		        $string = rtrim($string,",");
		        $sql = "UPDATE p_$table_name"."s SET $string WHERE $primary_key= :primary_key;";
		        $req_prep = Model::$pdo->prepare($sql);
		        $values = array(
		          	"primary_key"=>$data[$primary_key],
		        );
		        $req_prep->execute($values);
		    } catch (PDOException $e) {
		        if (Conf::getDebug()) {
		          	echo $e->getMessage(); // affiche un message d'erreur
		        } else {
		          	echo 'Une erreur est survenue <a href="index.php"> retour a la page d\'accueil </a>';
		        }
		        die();
		    }
	    }
	}
    Model::Init();
?>