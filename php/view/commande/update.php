<?php
    if ($_GET['action'] == "create"){
        $vue = "created";
        $etat = "require";
        $valeur = "";
    }else{
        $vue = "updated";
        $etat = "readonly";
        $valeur = $_GET["id_commande"];
    }
?>

<form method="get" action="index.php">
    <fieldset>
        <legend>Mon formulaire :</legend>
        <p>
            <label for="id_commande">id_commande</label>
            <?php
            echo "<input type='text' placeholder='Ex : 1' name='id_commande' $etat id='id_commande' value='$valeur'/>"
            ?>
            <label for="id_client">id_client</label>
            <input type="text" name="id_client" id="id_client" required/>
            <label for="id_produit">id_produit</label>
            <input type="text" name="id_produit" id="id_produit" required/>
            <label for="p_quantite_produits">p_quantite_produits</label>
            <input type="text" name="p_quantite_produits" id="p_quantite_produits" required/>
            <label for="p_prix_commande">p_prix_commande</label>
            <input type="text" name="p_prix_commande" id="p_prix_commande" required/>
            <?php
                echo "<input type='hidden' name='action' value=$vue>";
            ?>

            <input type='hidden' name="controller" value="ControllerCommande">
        </p>
        <p>
            <input type="submit" value="Envoyer"/>
        </p>
    </fieldset>
</form>