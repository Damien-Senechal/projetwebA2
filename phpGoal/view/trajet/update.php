<?php
    if ($_GET['action'] == "create"){
        $vue = "created";
        $etat = "require";
        $valeur = "";
    }else{
        $vue = "updated";
        $etat = "readonly";
        $valeur = $_GET["id"];
    }
?>

<form method="get" action="index.php">
    <fieldset>
        <legend>Mon formulaire :</legend>
        <p>
            <label for="id_id">ID</label>
            <?php
            echo "<input type='text' placeholder='ID' name='id' $etat id='id_id' value='$valeur'/>"
            ?>
            <label for="depart_id">Depart</label>
            <input type="text" name="depart" id="depart_id" required/>
            <label for="arrivee_id">Arrivee</label>
            <input type="text" name="arrivee" id="arrivee_id" required/>
            <label for="date_id">Date</label>
            <input type="text" name="dateTrajet" id="date_id" required pattern="[0-9]{4}-(01|02|03|04|05|06|07|08|09|10|11|12)-([0,1,2][1-9]|10|20|30|31)"/>
            <label for="places_id">Places</label>
            <input type="text" name="nbPlaces" id="places_id" required/>
            <label for="prix_id">Prix</label>
            <input type="text" name="prix" id="prix_id" required/>
            <label for="conducteur_id">Conducteur</label>
            <input type="text" name="conducteur_login" id="conducteur_id" required/>
            <?php
                echo "<input type='hidden' name='action' value=$vue>";
            ?>

            <input type='hidden' name="controller" value="trajet">
        </p>
        <p>
            <input type="submit" value="Envoyer"/>
        </p>
    </fieldset>
</form>