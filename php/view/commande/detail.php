<?php
    $htmlspecial_id_commande = htmlspecialchars("{$v->get('id_commande')}");
    $htmlspecial_id_client = htmlspecialchars("{$v->get('id_client')}");
    $htmlspecial_id_produit = htmlspecialchars("{$v->get('id_produit')}");
    $htmlspecial_p_quantite_produits = htmlspecialchars("{$v->get('p_quantite_produits')}");
    $htmlspecial_p_prix_commande = htmlspecialchars("{$v->get('p_prix_commande')}");
    echo "<div class='listeDiv'><div class='detailDiv'>
    		id_commande: $htmlspecial_id_commande,
    		id_client: $htmlspecial_id_client,
    		id_produit: $htmlspecial_id_produit, 
    		p_quantite_produits: $htmlspecial_p_quantite_produits,
    		p_prix_commande: $htmlspecial_p_prix_commande
    		</div><a class='supprButton'href='index.php?action=delete&id_commande=$htmlspecial_id_commande'>SUPPRIMER</a><a class='updateButton' href='index.php?action=update&id_commande=$htmlspecial_id_commande&controller=ControllerCommande'>MODIFIER</a></div>";
?>




