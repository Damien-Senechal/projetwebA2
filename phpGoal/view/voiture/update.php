<?php
    if ($_GET['action'] == "create"){
        $vue = "created";
        $etat = "require";
        $valeur = "";
    }else{
        $vue = "updated";
        $etat = "readonly";
        $valeur = $_GET["immat"];
    }
?>

<form method="get" action="index.php">
    <fieldset>
        <legend>Mon formulaire :</legend>
        <p>
            <label for="immat_id">Immatriculation</label>
            <?php
            echo "<input type='text' placeholder='Ex : 256AB34' name='immatriculation' $etat id='immat_id' value='$valeur'/>"
            ?>
            <label for="marque_id">Marque</label>
            <input type="text" name="marque" id="marque_id" required/>
            <label for="couleur_id">Couleur</label>
            <input type="text" name="couleur" id="couleur_id" required/>
            <?php
                echo "<input type='hidden' name='action' value=$vue>";
            ?>

            <input type='hidden' name="controller" value="voiture">
        </p>
        <p>
            <input type="submit" value="Envoyer"/>
        </p>
    </fieldset>
</form>