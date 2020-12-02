<?php
    foreach ($tab_c as $c){
        $id_commande = htmlspecialchars($c->get('id_commande'));
        $id_commandeURL = rawurlencode($c->get("id_commande"));
        echo "<div class='listeDiv'><a class='commandeListe' href='index.php?action=read&id_commande=$id_commandeURL&controller=ControllerCommande'> id_commande: $id_commande</a><a class='supprButton' href='index.php?action=delete&id_commande=$id_commandeURL&controller=ControllerCommande'>SUPPRIMER</a><a class='updateButton' href='index.php?action=update&id_commande=$id_commandeURL&controller=ControllerCommande'>MODIFIER</a></div>";
    }
?>