<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        #container{
            width:400px;
            margin:0 auto;
            margin-top:10%;
            margin-bottom: 10%;
        }

        form {
            width:100%;
            padding: 30px;
            border: 1px solid #f1f1f1;
            background: #fff;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }
        #container h1{
            margin: 0 auto;
            text-align: center;
            padding-bottom: 10px;
        }

        input[type=text], input[type=password], input[type=email], input[type=date], input[type=file] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type=submit] {
            background-color: #2196F3;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: 1px solid #2d2e2c;
            cursor: pointer;
            width: 100%;
        }
        input[type=submit]:hover {
            background-color: #929FBA;
            color: white;
            border: 2px solid #2d2e2c;
        }
        
    </style>
</head>
<body>
    <?php
    if ($_GET['action'] == "enregistrer"){
        $vue = "created";
        $etat = "require";
        $valeur = "";
    }else{
        $vue = "updated";
        $etat = "readonly";
        $valeur = $_GET["id_utilisateur"];
    }
?>
<div id="container">
    <form method="get" action="index.php">

        <fieldset>
            <legend style="text-align : center;">Création de compte :</legend>
            <p>
                <?php if ($_GET['action'] != "enregistrer") {
                    echo '<label for="id_utilisateur_id">id_utilisateur</label>
                    "<input type="text" placeholder="id_utilisateur" name="id_utilisateur" $etat id="id_utilisateur_id" value="$valeur"/>';
                    }
                ?>
                <label>Nom :</label>
                <input type="text" name="nom_utilisateur" id="nom_utilisateur" required/>
                <label>Prenom :</label>
                <input type="text" name="prenom_utilisateur" id="prenom_utilisateur" required/>
                <label>Email :</label>
                <input type="email" name="mail_utilisateur" id="mail_utilisateur" required/>
                <label>Adresse :</label>
                <input type="text" name="adresse_utilisateur" id="adresse_utilisateur" required/>
                <label>Date de naissance :</label>
                <input type="date" name="ddn_utilisateur" id="ddn_utilisateur"/>
                <label>Histoire :</label>
                <input type="text" name="histoire_utilisateur" id="histoire_utilisateur"/>
                <label>Photo de profil :</label>
                <input type="file" name="pp_utilisateur" id="pp_utilisateur"/>

                <label>Mot de passe :</label>
                <input type="password" name="mdp_utilisateur" id="mdp_utilisateur" required/>
                <label>Confirmer le mot de passe :</label>
                <input type="password" name="mdp_utilisateur2" id="mdp_utilisateur2" required/>
                <?php
                    if(isset($_SESSION['admin']))
                    {
                        if($_SESSION['admin'])
                        {
                            echo '<label for="admin">setAdmin</label>
                                  <input type="checkbox" name="admin" id="admin"/>';
                        }
                    }
                    echo "<input type='hidden' name='action' value='senregistrer'>";
                ?>

                <input type='hidden' name="controller" value="utilisateur">
            </p>
            <p>
                <input type="submit" value="Envoyer"/>
            </p>
        </fieldset>
    </form>
</div>
</body>
</html>