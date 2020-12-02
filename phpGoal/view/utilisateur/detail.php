<?php
    $htmlspecialLogin = htmlspecialchars("{$u->get('login')}");
    $htmlspecialNom = htmlspecialchars("{$u->get('nom')}");
    $htmlspecialPrenom = htmlspecialchars("{$u->get('prenom')}");
    echo "<div class='listeDiv'><div class='detailDiv'>Login: $htmlspecialLogin , Nom: $htmlspecialNom , Prenom: $htmlspecialPrenom</div><a class='supprButton' href='index.php?action=delete&login=$htmlspecialLogin&controller=utilisateur''>SUPPRIMER</a><a class='updateButton' href='index.php?action=update&login=$htmlspecialLogin&controller=utilisateur'>MODIFIER</a></div>";
?>




