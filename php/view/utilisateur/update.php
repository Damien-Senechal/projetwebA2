<?php
    if ($_GET['action'] == "create"){
        $vue = "created";
        $etat = "require";
        $valeur = "";
    }else{
        $vue = "updated";
        $etat = "readonly";
        $valeur = $_GET["login"];
    }
?>

<form method="get" action="index.php">
    <fieldset>
        <legend>Mon formulaire :</legend>
        <p>
            <label for="login_id">Login</label>
            <?php
            echo "<input type='text' placeholder='Login' name='login' $etat id='login_id' value='$valeur'/>"
            ?>
            <label for="nom_id">Nom</label>
            <input type="text" name="nom" id="nom_id" required/>
            <label for="prenom_id">Prenom</label>
            <input type="text" name="prenom" id="prenom_id" required/>
            <label for="prenom_id">mdp</label>
            <input type="password" name="mdp" id="mdp_id" required/>
            <label for="prenom_id">confirmer mdp</label>
            <input type="password" name="mdp2" id="mdp_id2" required/>
            <?php
                echo "<input type='hidden' name='action' value=$vue>";
            ?>

            <input type='hidden' name="controller" value="utilisateur">
        </p>
        <p>
            <input type="submit" value="Envoyer"/>
        </p>
    </fieldset>
</form>