<!DOCTYPE html>
<html>
<head>
  
</head>
<body>
  <!--Main layout-->
  <main>
    <div class="container" style="margin-top: 5%">
      <!--Section: Products v.3-->
      <section class="text-center mb-4">
        <div class="row wow fadeIn">
        <?php 
          $tab_produits = ModelProduits::getAllProduits();
          foreach ($tab_produits as $key => $value) {
            $produit = ModelProduits::getProduitById($value->get('id_produit'));
            $image = $produit->get('urlImage_produit');
            $id = $produit->get('id_produit');
            $stock = $produit->get('stock_produit');
            $nom = $produit->get('nom_produit');
            $prix = $produit->get('prix_produit');
            $categorie = $produit->get('categorie_produit');

            echo '<div class="col-lg-3 col-md-6 mb-4">

              <!--Card-->
              <div class="card">
                <!--Card image-->
                <div class="view overlay">
                  <img src="'.$image.'" class="card-img-top"
                    alt="">
                  <a href="product-page.php?id_produit='.$id.'">
                    <div class="mask rgba-white-slight">Acheter</div>
                  </a>
                </div>
                <!--Card image-->

                <!--Card content-->
                <div class="card-body text-center">
                  <!--Category & Title-->
                  <a href="product-page.php?id_produit='.$id.'" class="grey-text">
                    <h5>Stock : '.$stock.' unités</h5>
                  </a>
                  <h5>
                    <strong>
                      <a href="product-page.php?id_produit='.$id.'" class="dark-grey-text"> ' .$nom. '
                        <span class="badge badge-pill danger-color">'.$categorie.'</span>
                      </a>
                    </strong>
                  </h5>

                  <h4 class="font-weight-bold blue-text">
                    <strong>prix : '.$prix.' €</strong>
                  </h4>

                </div>
                <!--Card content-->

              </div>
              <!--Card-->

            </div>';
          }
        ?>
        </div>

      </section>
      <!--Section: Products v.3-->

            

    </div>
  </main>

  <!--Main layout--> 
  
</body>
</html>