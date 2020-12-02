<?php
    foreach ($tab_u as $u){
        $login = htmlspecialchars($u->get("login"));
        $loginURL = rawurlencode($u->get("login"));
        echo "<div class='listeDiv'><a class='immatListe' href='index.php?action=read&login=$loginURL&controller=utilisateur'> login: $login</a><a class='supprButton' href='index.php?action=delete&login=$loginURL&controller=utilisateur'>SUPPRIMER</a><a class='updateButton' href='index.php?action=update&login=$loginURL&controller=utilisateur'>MODIFIER</a></div>";
    }