<?php
    $htmlspecialId = htmlspecialchars("{$u->get('id_utilisateur')}");
    $htmlspecialPrenom = htmlspecialchars("{$u->get('prenom_utilisateur')}");
    $htmlspecialNom = htmlspecialchars("{$u->get('nom_utilisateur')}");
    $htmlspecialMail = htmlspecialchars("{$u->get('mail_utilisateur')}");
    $htmlspecialMdp = htmlspecialchars("{$u->get('mdp_utilisateur')}");
    $htmlspecialAdresse = htmlspecialchars("{$u->get('adresse_utilisateur')}");
    $htmlspecialDdn = htmlspecialchars("{$u->get('ddn_utilisateur')}");
    echo "<div class='listeDiv'>
    <div class='detailDiv'>
    Id: $htmlspecialId , 
    Nom: $htmlspecialNom , 
    Prenom: $htmlspecialPrenom,
    Mail : $htmlspecialMail,
    Mdp : $htmlspecialMdp,
    Ddn : $htmlspecialDdn.
    </div><a class='supprButton' href='index.php?action=delete&id_utilisateur=$htmlspecialLogin&controller=utilisateur''>SUPPRIMER</a><a class='updateButton' href='index.php?action=update&id_utilisateur=$htmlspecialLogin&controller=utilisateur'>MODIFIER</a></div>";
?>




