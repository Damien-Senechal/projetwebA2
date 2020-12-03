<?php

require_once File::build_path(array('controller','ControllerProduit.php'));
require_once File::build_path(array('controller','ControllerUtilisateur.php'));
require_once File::build_path(array('controller','ControllerCommandes.php'));
if (isset($_GET['action'])) {
    $controller_class = "Controller" . ucfirst($_GET['controller']);
    if (class_exists($controller_class)) {
        if (in_array($_GET['action'],get_class_methods($controller_class))) {
            $action = $_GET['action'];
            $controller_class::$action();

        }else{
            ControllerVoiture::error("action non définie");
        }
    }else{
        ControllerVoiture::error("class doesn't exist");
    }
}else{
    ControllerVoiture::readAll();
}


