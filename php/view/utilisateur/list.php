<?php
    foreach ($tab_u as $u){
        $id_utilisateur = htmlspecialchars($u->get("id_utilisateur"));
        $id_utilisateurURL = rawurlencode($u->get("id_utilisateur"));
        echo "<div class='listeDiv'><a class='immatListe' href='index.php?action=read&id_utilisateur=$id_utilisateurURL&controller=utilisateur'> id_utilisateur: $id_utilisateur</a> <br> 
        <a class='supprButton' href='index.php?action=delete&id_utilisateur=$id_utilisateurURL&controller=utilisateur'>SUPPRIMER</a>
         <br> 
         <a class='updateButton' href='index.php?action=update&id_utilisateur=$id_utilisateurURL&controller=utilisateur'>MODIFIER</a>
          <br> </div>";
    }