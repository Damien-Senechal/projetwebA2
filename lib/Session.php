<?php 
class Session {
    public static function is_user($login) {
        return (!empty($_SESSION['id_utilisateur']) && ($_SESSION['id_utilisateur'] == $login));
    }
    public static function is_admin() {
    	return (!empty($_SESSION['admin_utilisateur']) && $_SESSION['admin_utilisateur']);
    }
}
 ?>