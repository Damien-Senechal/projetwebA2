<?php
    require_once File::build_path(array('controller','ControllerProduits.php'));
    require_once File::build_path(array('controller','ControllerUtilisateur.php'));
    require_once File::build_path(array('controller','ControllerCommande.php'));
    if (isset($_GET['action'])) {
        $controller_class = "Controller" . ucfirst($_GET['controller']);
        if (class_exists($controller_class)) {
            if (in_array($_GET['action'],get_class_methods($controller_class))) {
                $action = $_GET['action'];
                $controller_class::$action();

            }else{
                ControllerProduits::error("action non définie");
            }
        }else{
            ControllerProduits::error("class doesn't exist");
        }
    }else{
        ControllerProduits::accueil();
    }
?>
