<?php
    foreach ($tab_v as $v){
        $immat = htmlspecialchars($v->get('immatriculation'));
        $immatURL = rawurlencode($v->get("immatriculation"));
        echo "<div class='listeDiv'><a class='immatListe' href='index.php?action=read&immat=$immatURL&controller=voiture'> Immatriculation: $immat</a><a class='supprButton' href='index.php?action=delete&immat=$immatURL&controller=voiture'>SUPPRIMER</a><a class='updateButton' href='index.php?action=update&immat=$immatURL&controller=voiture'>MODIFIER</a></div>";
    }
?>