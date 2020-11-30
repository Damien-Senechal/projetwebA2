
<?php
    
    $vImmat = $v->getImmatriculation();
    $vCouleur = $v->getCouleur();
    $vMarque = $v->getMarque();
        
     echo '<p> Voiture d\'immatriculation ' . htmlspecialchars($vImmat) . ' de couleur ' . htmlspecialchars($vCouleur) . ' et de marque ' . htmlspecialchars($vMarque) . '</p>';
?>
