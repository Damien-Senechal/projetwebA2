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
        #container h1, p{
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
            $vue = "senregistrer";
        }else{
            $vue = "updated";
            $mailSession = ModelUtilisateurs::getUtilisateurById($_GET['id_utilisateur'])->get('mail_utilisateur');
            $_SESSION['ancienMail'] = $mailSession;
        }
    ?>
<div id="container">
    <form method="post" <?php  if($_GET['action'] == "enregistrer") {
        echo 'action="index?action=senregistrer&controller=utilisateur"';
    }
    else {
        echo 'action="index?action=updated&controller=utilisateur"';
    }
    ?> enctype="multipart/form-data">

        <fieldset>
            <?php
                if ($_GET['action'] == "enregistrer") {
                    echo '<legend style="text-align : center;">Création de compte :</legend>
                    <p>
                    <label>Nom :</label>
                    <input type="text" required name="nom_utilisateur"'; 
                    if (isset($_SESSION["formNom"])){
                    echo ' value="' . $_SESSION['formNom'];} echo '"/>

                    <label>Prenom :</label>
                    <input type="text" required name="prenom_utilisateur"'; 
                    if (isset($_SESSION['formPrenom'])){
                    echo 'value="' . $_SESSION['formPrenom'];} echo '"/>

                    <label>Email :</label>
                    <input type="email" required name="mail_utilisateur"'; 
                    if (isset($_SESSION['formMail'])){
                    echo 'value="' . $_SESSION['formMail'];} echo '"/>

                    <label>Adresse :</label>
                    <input type="text" required name="adresse_utilisateur"'; 
                    if (isset($_SESSION['formAdresse'])){
                    echo 'value="' . $_SESSION['formAdresse'];} echo '"/>

                    <label>Date de naissance :</label>
                    <input type="date" required name="ddn_utilisateur"'; 
                    if (isset($_SESSION['formDDN'])){
                    echo 'value="' . $_SESSION['formDDN'];} echo '"/>

                    <label>Histoire :</label>
                    <input type="text" name="histoire_utilisateur"'; 
                    if (isset($_SESSION['formHistoire'])){
                    echo 'value="' . $_SESSION['formHistoire'];} echo '"/>

                    <label>Photo de profil</label>
                    <input type="file" name="photo_utilisateur" accept=".png, .jpeg, .jpg"/>

                    <label>Mot de passe :</label>
                    <input type="password" name="mdp_utilisateur" minlength="8" required '; 
                    if (isset($_SESSION['formMdp1'])){
                    echo 'value="' . $_SESSION['formMdp1'];} echo '"/>

                    <label>Confirmer le mot de passe :</label>
                    <input type="password" name="mdp_utilisateur2" minlength="8" required'; 
                    if (isset($_SESSION['formMdp2'])){
                    echo 'value="' . $_SESSION['formMdp2'];} echo '"/>';

                    if(!empty($_SESSION['admin_utilisateur']) && $_SESSION['admin_utilisateur'])
                    {
                        echo '<label>setAdmin</label>
                                  <input type="checkbox" name="admin_utilisateur" id="admin_utilisateur"/>';
                    }

                    echo '</p>
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
                    <input type="text" name="nom_utilisateur" value="'. $nom_utilisateur.'"/>
                    <label>Prenom :</label>
                    <input type="text" name="prenom_utilisateur" value="'. $prenom_utilisateur.'"/>
                    <label>Email :</label>
                    <input type="email" name="mail_utilisateur" value="'. $mail_utilisateur.'"/>
                    <label>Adresse :</label>
                    <input type="text" name="adresse_utilisateur" value="'. $adresse_utilisateur.'"/>
                    <label>Date de naissance :</label>
                    <input type="date" name="ddn_utilisateur" value="'. $ddn_utilisateur.'" />
                    <label>Histoire :</label>
                    <input type="text" name="histoire_utilisateur" value="'. $histoire_utilisateur.'"/>
                    <label>Photo de profil</label>
                    <input type="file" name="photo_utilisateur" accept=".png, .jpeg, .jpg"/>
                    <label style = "color : red";>Ancien mot de passe :</label>
                    <input type="password" name="ancien_mdp_utilisateur" id="ancien_mdp_utilisateur" '; if(!Session::is_admin()) { echo 'required';} echo '/>
                    <label>Nouveau mot de passe :</label>
                    <input type="password" name="mdp_utilisateur" id="mdp_utilisateur"/>
                    <label>Confirmer le mot de passe :</label>
                    <input type="password" name="mdp_utilisateur2" id="mdp_utilisateur2"/>';
                    if(!empty($_SESSION['admin_utilisateur']) && $_SESSION['admin_utilisateur'])
                    {
                        echo '<label>setAdmin</label>
                                  <input type="checkbox" name="admin_utilisateur" ';
                                  if ($admin_utilisateur == 1) {
                                    echo 'checked/>';
                                    }
                                    else {
                                        echo '/>';
                                    }
                    }
                    echo '</p>
                    <p>
                        <input type="submit" value="Envoyer"/>
                    </p>';
                }
            ?>
            <p><a href="<?php echo 'index.php';  ?>"> fermer </a></p>
        </fieldset>
    </form>
</div>
</body>
</html>