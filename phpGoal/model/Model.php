<?php
require_once File::build_path(array('config','conf.php'));
class Model{

    public static $pdo;

    public static function Init(){
        $hostname = Conf::getHostname();
        $database_name = Conf::getDatabase();
        $login = Conf::getLogin();
        $password = Conf::getPassword();
        try {
            // Connexion à la base de données
            // Le dernier argument sert à ce que toutes les chaines de caractères
            // en entrée et sortie de MySql soit dans le codage UTF-8
            self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            // On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            if (Conf::getDebug()) {
                echo $e->getMessage();
            }else{
                echo "erreur";
            }
            die();
        }

    }

    public static function select($primary_value) {
        $nom_table = static::$object;
        $class_name = "Model" . ucfirst($nom_table);
        $primary_key = static::$primary;
        $sql = "SELECT * from $nom_table WHERE $primary_key=:nom_tag";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            "nom_tag" => $primary_value,
        );
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        $tab = $req_prep->fetchAll();
        if (empty($tab))
            return false;
        return $tab[0];
    }

    public static function selectAll(){
        $table_name = static::$object;
        $class_name = "Model" . ucfirst($table_name);

        $pdo = Model::$pdo;
        $rep = $pdo->query("SELECT * FROM $table_name");
        $rep->setFetchMode(PDO::FETCH_CLASS,$class_name);
        return $rep->fetchAll();
    }

    public static function delete($primary){
        $nom_table = static::$object;
        $primary_key = static::$primary;

        $sql = "DELETE FROM $nom_table WHERE $primary_key = :pk";
        $pdo = Model::$pdo;
        $req = $pdo->prepare($sql);
        $htmlSpecialPK = htmlspecialchars($primary);
        $values = array('pk' => $htmlSpecialPK);
        $req->execute($values);
    }

    public function update($data){
        $table_name = static::$object;
        $primary_key = static::$primary;
        $pdo = Model::$pdo;
        $sql = "UPDATE $table_name ";
        $sql_set = "SET ";
        $sql_where = " WHERE $primary_key = :$primary_key";
        foreach ($data as $key => $valeur) {
            $sql_set = $sql_set . "$key = :$key,";
        }
        $sql_set = rtrim($sql_set,",");
        $sql = $sql . $sql_set . $sql_where;
        $req = $pdo->prepare($sql);
        $req->execute($data);
    }

    public function save($data)
    {
        try {
            $table_name = static::$object;

            $sql = "INSERT INTO $table_name ";
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
}
Model::Init();