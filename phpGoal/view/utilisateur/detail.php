<?php
    
    $vLogin = $u->get('login');
    $vPrenom = $u->get('prenom');
    $vNom = $u->get('nom');
        
    echo '<p> Utilisateur de login : ' . htmlspecialchars($vLogin) . ' de nom ' . htmlspecialchars($vNom) . ' et de prenom ' . htmlspecialchars($vPrenom) . '</p>';
?>
