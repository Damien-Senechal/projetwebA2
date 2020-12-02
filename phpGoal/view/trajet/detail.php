<?php
    $htmlSpecialId = htmlspecialchars($t->get("id"));
    $htmlSpecialDepart = htmlspecialchars($t->get("depart"));
    $htmlSpecialArrivee = htmlspecialchars($t->get("arrivee"));
    $htmlSpecialDateTrajet = htmlspecialchars($t->get("dateTrajet"));
    $htmlSpecialNbPlaces = htmlspecialchars($t->get("nbPlaces"));
    $htmlSpecialPrix = htmlspecialchars($t->get("prix"));
    $htmlSpecialConducteur_login = htmlspecialchars($t->get("conducteur_login"));
    echo "<div class='listeDiv'><div class='detailDiv'>ID: $htmlSpecialId, Depart: $htmlSpecialDepart, Arrivée: $htmlSpecialArrivee, Date: $htmlSpecialDateTrajet, Places: $htmlSpecialNbPlaces, Conducteur: $htmlSpecialConducteur_login</div><a class='supprButton' href='index.php?action=delete&id=$htmlSpecialId&controller=trajet''>SUPPRIMER</a><a class='updateButton' href='index.php?action=update&id=$htmlSpecialId&controller=trajet'>MODIFIER</a></div>";
?>




