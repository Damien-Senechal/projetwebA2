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
        input[type=text], input[type=password]{
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
        <div id="container">
            <!-- zone de connexion -->
            
            <form  method="post" action="index.php?action=connected&controller=utilisateur">
                <h1>Connexion</h1>
                <?php if (isset($_SESSION['msgErreur'])){
                    echo '<p style="text-align : center; color : red;">' . $_SESSION['msgErreur'] . '</p>';
                    } ?>
                <label><b>Adresse e-mail : </b></label>
                <input type="text" placeholder="Adresse mail..." name="mail_utilisateur" 
                required 
                <?php if (isset($_SESSION['formMail'])){
                    echo 'value="' . $_SESSION['formMail'] . '"';
                    } else if (isset($_COOKIE['mail_utilisateur'])) {
                        echo 'value="' . $_COOKIE['mail_utilisateur'] . '"';
                    }
                ?>>
                <label><b>Mot de passe :</b></label>
                <input type="password" placeholder="Entrer le mot de passe..." name="mdp_utilisateur" 
                required 
                <?php if (isset($_SESSION['formMdp'])){
                    echo 'value="' . $_SESSION['formMdp'] . '"';
                    } else if (isset($_COOKIE['mdp_utilisateur'])) {
                        echo 'value="' . $_COOKIE['mdp_utilisateur'] . '"';
                    }
                ?>>
                <input type="checkbox" name="souvenir_utilisateur"
                <?php if (isset($_COOKIE['souvenir_utilisateur'])){
                    echo ' checked';
                    }
                ?>>
                <label style="margin-top: 2%"><b>Se souvenir de moi ?</b></label>


                <input type="submit" value='Se connecter' >
                <p><a href="<?php isset($_SESSION['msgErreur']); isset($_SESSION['formMail']); isset($_SESSION['formMdp']); echo "index.php";  ?>"> fermer </a></p>
            </form>
        </div>
</body>
</html>