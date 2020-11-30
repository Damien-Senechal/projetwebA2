<?php
require_once ('../model/ModelProduit.php');
$tab_v = ModelVoiture::getAllVoitures();
require ('../view/voiture/list.php');
?>