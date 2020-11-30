<?php
reuire_once ('../model/ModelVoiture.php');
$tab_v = ModelVoiture::getAllVoitures();
require ('../view/voiture/list.php');
?>