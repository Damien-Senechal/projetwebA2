<?php
foreach ($tab_v as $v){

    $vImmatHTML = $v->getImmatriculation();

    echo '<p> Voiture d\'immatriculation <a href="index.php?action=read&immatriculation='. rawurlencode($vImmatHTML) . '">' . htmlspecialchars($vImmatHTML) . '</a></br>';
    echo "<a href='index.php?action=delete&immatriculation=" . rawurlencode($vImmatHTML) . "'>Supprimer le véhicule</a></br>";
    echo "<a href='index.php?action=update&immatriculation=" . rawurlencode($vImmatHTML) . "'>Modifier le véhicule</a></p>";

}
?>