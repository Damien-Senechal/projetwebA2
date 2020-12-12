<!DOCTYPE html>
<html lang="en">
<head>
  <head>
    <style type="text/css">
        #container{
            width:400px;
            margin:0 auto;
            margin-top:2%;
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
            text-align: left;
        }

        input[type=text], input[type=password], input[type=email], input[type=date], input[type=file], input[type=number]{
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
</head>
<body>
  <!--Main layout-->
  <?php
    if ($_GET['action'] == "creerCookie"){
        $vue = "creationCookie";
    }else{
        $vue = "modificationCoockie";
        $id_produit = $_GET['id_produit'];
        $produit = ModelProduits::getProduitById($id_produit);
        $image = $produit->get('urlImage_produit');
        $nom_produit = $produit->get('nom_produit');
        $categorie_produit = $produit->get('categorie_produit');
        $prix_produit = $produit->get('prix_produit');
        $desc_produit = $produit->get('desc_produit');
        $stock_produit = $produit->get('stock_produit');
    }
  ?>
  <main class="mt-5 pt-4">
    <div id="container">
    <form method="post" <?php  if($_GET['action'] == "creerCookie") {
        echo 'action="index?action=creationCookie&controller=produits"';
    }
    else {
        echo 'action="index?action=modificationCoockie&controller=produits"';
    }
    ?> enctype="multipart/form-data">

        <fieldset>
            <?php
                if ($_GET['action'] == "creerCookie") {
                    echo '<legend style="text-align : center;">Création de compte :</legend>
                    <p>
                    <label>Id produit :</label>
                    <input type="text" name="id_produit" placeholder="00cooAA" required/>
                    <label>Nom produit:</label>
                    <input type="text" name="nom_produit" placeholder="Cookie" required/>
                    <label>Description produit :</label>
                    <input type="text" name="desc_produit" required/>
                    <label>Prix produit :</label>
                    <input type="number" name="prix_produit" required/>
                    <label>Stock produit :</label>
                    <input type="number" name="stock_produit" required/>
                    <label>Photo produit :</label>
                    <input type="file" name="photo_produit" accept=".png, .jpeg, .jpg"/>
                    <label>Categorie produit :</label>
                    <input type="text" name="categorie_produit" />
                    </p>
                    <p>
                        <input type="submit" value="Envoyer"/>
                    </p>';
                } else {
                    $produit = ModelProduits::getProduitById($_GET['id_produit']);
                        $id_produit = $produit->get("id_produit");
                        $nom_produit = $produit->get("nom_produit");
                        $desc_produit = $produit->get("desc_produit");
                        $prix_produit = $produit->get("prix_produit");
                        $stock_produit = $produit->get("stock_produit");
                        $urlImage_produit = $produit->get("urlImage_produit");
                        $categorie_produit = $produit->get("categorie_produit");

                    echo '<legend style="text-align : center;">Modification du cookie '. $nom_produit .':</legend>
                    <p>
                    <label>Id produit :</label>
                    <input style="background-color : lightgray" type="text" name="id_produit" value="'. $id_produit.'" readonly/>
                    <label>Nom produit:</label>
                    <input type="text" name="nom_produit" value="'. $nom_produit.'"/>
                    <label>Description produit :</label>
                    <input type="text" name="desc_produit" value="'. $desc_produit.'"/>
                    <label>Prix produit :</label>
                    <input type="number" name="prix_produit" value="'. $prix_produit.'"/>
                    <label>Stock produit :</label>
                    <input type="number" name="stock_produit" value="'. $stock_produit.'"/>
                    <label>Photo produit :</label><img style ="height: 20%; width: 20%;" src="'. $urlImage_produit.'">
                    <input type="file" name="photo_produit" accept=".png, .jpeg, .jpg" placeholder="'. $urlImage_produit.'" />
                    <label>Categorie produit :</label>
                    <input type="text" name="categorie_produit" id="categorie_produit" value="'. $categorie_produit.'"/>
                    </p>
                    <p>
                        <input type="submit" value="Envoyer"/>
                    </p>';
                }
            ?>
            <p><center><a href="index?action=magasinProduit&controller=produits"> fermer </a></center></p>
        </fieldset>
    </form> 
</div>
  </main>
  <!--Main layout-->
</body>

</html>
