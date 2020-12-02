<?php
    foreach ($tab_t as $t){
        $id = htmlspecialchars($t->get("id"));
        $idURL = rawurlencode($t->get("id"));
        echo "<div class='listeDiv'><a class='immatListe' href='index.php?action=read&id=$idURL&controller=trajet'> ID: $id</a><a class='supprButton' href='index.php?action=delete&id=$idURL&controller=trajet'>SUPPRIMER</a><a class='updateButton' href='index.php?action=update&id=$idURL&controller=trajet'>MODIFIER</a></div>";
    }