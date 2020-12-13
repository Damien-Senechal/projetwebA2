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
        input[type=text], input[type=email]{
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
            <!-- zone de connexion rapide-->
            <form  method="post" action="index.php?action=validerPanier&controller=commande&connexionRapide=oui">
                <h1>Connexion rapide</h1>
                <p><i>Veuillez renseigner vos coordonnées de livraison</i></p>
                <label><b>Nom :</b></label>
                <input type="text"  name="nom_utilisateur" 
                required>
                <label><b>Prenom :</b></label>
                <input type="text" name="prenom_utilisateur" 
                required>
                <label><b>Adresse e-mail : </b></label>
                <input type="email" name="mail_utilisateur" 
                required>
                <label><b>Adresse de livraison :</b></label>
                <input type="text" placeholder="rue..., ville..., code postal... " name="adresse_utilisateur" 
                required>

                <input type="submit" value='Valider' >
                <p><a href="index.php?action=validerPanier&controller=commande"> fermer </a></p>
            </form>
        </div>
</body>
</html>