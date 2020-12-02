<?php
    $htmlspecialImmat = htmlspecialchars("{$v->get('immatriculation')}");
    $htmlspecialMarque = htmlspecialchars("{$v->get('marque')}");
    $htmlspecialCouleur = htmlspecialchars("{$v->get('couleur')}");
    echo "<div class='listeDiv'><div class='detailDiv'>Immatriculation: $htmlspecialImmat , Marque: $htmlspecialMarque , Couleur: $htmlspecialCouleur</div><a class='supprButton' href='index.php?action=delete&immat=$htmlspecialImmat'>SUPPRIMER</a><a class='updateButton' href='index.php?action=update&immat=$htmlspecialImmat&controller=voiture'>MODIFIER</a></div>";
?>




