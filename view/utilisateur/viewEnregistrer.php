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

        input[type=text], input[type=password], input[type=email], input[type=date], input[type=file], input[type=checkbox]{
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
            $vue = "enregistrer";
        }else{
            $vue = "updated";
            $mailSession = ModelUtilisateurs::getUtilisateurById($_GET['id_utilisateur'])->get('mail_utilisateur');
            $_SESSION['ancienMail'] = $mailSession;
        }
    ?>
<div id="container">
    <form method="get" action="index.php">

        <fieldset>
            <?php
                if ($_GET['action'] == "enregistrer") {
                    echo '<legend style="text-align : center;">Création de compte :</legend>
                    <p>
	                <label>Nom :</label>
	                <input type="text" name="nom_utilisateur" id="nom_utilisateur" required/>
	                <label>Prenom :</label>
	                <input type="text" name="prenom_utilisateur" id="prenom_utilisateur" required/>
	                <label>Email :</label>
	                <input type="email" name="mail_utilisateur" id="mail_utilisateur" required/>
	                <label>Adresse :</label>
	                <input type="text" name="adresse_utilisateur" id="adresse_utilisateur" required/>
	                <label>Date de naissance :</label>
	                <input type="text" pattern="[0-9]{4}-(01|02|03|04|05|06|07|08|09|10|11|12)-([0,1,2][1-9]|10|20|30|31)" name="ddn_utilisateur" id="ddn_utilisateur" placeholder="(aaaa-mm-jj)" />
	                <label>Histoire :</label>
	                <input type="text" name="histoire_utilisateur" id="histoire_utilisateur"/>
	                <label>Mot de passe :</label>
	                <input type="password" name="mdp_utilisateur" id="mdp_utilisateur" required/>
	                <label>Confirmer le mot de passe :</label>
	                <input type="password" name="mdp_utilisateur2" id="mdp_utilisateur2" required/>';
                    if(isset($_SESSION['admin_utilisateur']))
                    {
                        if($_SESSION['admin_utilisateur'])
                        {
                            echo '<label for="admin">setAdmin</label>
                                  <input type="checkbox" name="admin" id="admin"/>';
                        }
                    }
                    echo '<input type="hidden" name="action" value=' .$vue .'>
	                <input type="hidden" name="controller" value="utilisateur">
		            </p>
		            <p>
		                <input type="submit" value="Envoyer"/>
		            </p>';
                } else {
                	if (!empty($_SESSION['id_utilisateur'])) {
                		$utilisateur = ModelUtilisateurs::getUtilisateurById($_GET['id_utilisateur']);
	                		$nom_utilisateur = $utilisateur->get("nom_utilisateur");
		                    $prenom_utilisateur = $utilisateur->get("prenom_utilisateur");
		                    $mail_utilisateur = $utilisateur->get("mail_utilisateur");
		                    $mdp_utilisateur = Security::hacher($utilisateur->get("mdp_utilisateur"));
		                    $adresse_utilisateur = $utilisateur->get("adresse_utilisateur");
		                    $histoire_utilisateur = $utilisateur->get("histoire_utilisateur");
		                    $ddn_utilisateur = $utilisateur->get("ddn_utilisateur");
		                    $admin_utilisateur = $utilisateur->get("admin_utilisateur");
                	}
                    echo '<legend style="text-align : center;">Modification de compte :</legend>
                    <p>
	                <label>Nom :</label>
	                <input type="text" name="nom_utilisateur" id="nom_utilisateur" value="'. $nom_utilisateur.'"/>
	                <label>Prenom :</label>
	                <input type="text" name="prenom_utilisateur" id="prenom_utilisateur" value="'. $prenom_utilisateur.'"/>
	                <label>Email :</label>
	                <input type="email" name="mail_utilisateur" id="mail_utilisateur" value="'. $mail_utilisateur.'"/>
	                <label>Adresse :</label>
	                <input type="text" name="adresse_utilisateur" id="adresse_utilisateur" value="'. $adresse_utilisateur.'"/>
	                <label>Date de naissance :</label>
	                <input type="text" pattern="[0-9]{4}-(01|02|03|04|05|06|07|08|09|10|11|12)-([0,1,2][1-9]|10|20|30|31)" name="ddn_utilisateur" id="ddn_utilisateur" placeholder="(aaaa-mm-jj)" value="'. $ddn_utilisateur.'" />
	                <label>Histoire :</label>
	                <input type="text" name="histoire_utilisateur" id="histoire_utilisateur" value="'. $histoire_utilisateur.'"/>
	                <label style = "color : red";>Ancien mot de passe :</label>
	                <input type="password" name="ancien_mdp_utilisateur" id="ancien_mdp_utilisateur" value="'. $mdp_utilisateur.'"" required/>
	                <label>Confirmer le mot de passe :</label>
	                <input type="password" name="mdp_utilisateur" id="mdp_utilisateur"/>
	                <label>Confirmer le mot de passe :</label>
	                <input type="password" name="mdp_utilisateur2" id="mdp_utilisateur2"/>';
                    if(isset($_SESSION['admin_utilisateur']))
                    {
                        if($_SESSION['admin_utilisateur'])
                        {
                            echo '<label for="admin">setAdmin</label>
                                  <input type="checkbox" name="admin" ';
                                  if ($admin_utilisateur == 1)
                                  	echo 'checked/>';
                        }
                    }
                    echo '<input type="hidden" name="action" value=' .$vue .'>
	                <input type="hidden" name="controller" value="utilisateur">
		            </p>
		            <p>
		                <input type="submit" value="Envoyer"/>
		            </p>';
                }
            ?>
        </fieldset>
    </form>
</div>
</body>
</html>