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

        input[type=mail], input[type=password] {
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
            
            <form  method="get" action="index.php">
                <h1>Connexion</h1>
                
                <label><b>Adresse e-mail : </b></label>
                <input type="mail" placeholder="Adresse mail..." name="email" id="mail_utilisateur" required>

                <label><b>Mot de passe :</b></label>
                <input type="password" placeholder="Entrer le mot de passe..." name="password" id="mdp_utilisateur" required>

                <input type='hidden' name="controller" value="utilisateur">
                <input type='hidden' name="action" value="connected">

                <input type="submit" id='submit' value='Se connecter' >
            </form>
        </div>
</body>
</html>