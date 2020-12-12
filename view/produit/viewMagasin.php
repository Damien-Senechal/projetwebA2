<!DOCTYPE html>
<html>
<head>
  <style type="text/css">
    #modifsupri:hover{
      font-size : 107%;
    }
  </style>
</head>
<body>
  <!--Main layout-->

  <main>

    <div class="container" style="margin-top: 5%">
      <!--Section: Products v.3-->
      <section class="text-center mb-4">
        <div class="row wow fadeIn">

          <?php
            $tab_produits = ModelProduit::getAllProduits();
            foreach ($tab_produits as $key => $value) {
            $produit = ModelProduit::getProduitById($value->get('id_produit'));
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
                  <a href="index?action=produitDetail&controller=produit&id_produit='.$id.'">
                    <div class="mask rgba-white-slight">Acheter</div>
                  </a>
                </div>
                <!--Card image-->

                <!--Card content-->
                <div class="card-body text-center">
                  <!--Category & Title-->';
                  if(Session::is_admin()) {
                    echo '
                  <a href="index?action=produitDetail&controller=produit&id_produit='.$id.'" class="grey-text">
                    <h5>Stock : '.$stock.' unités</h5>
                  </a>';
                  } else if ($stock == 0) {
                    echo '
                  <a href="index?action=produitDetail&controller=produit&id_produit='.$id.'" class="grey-text">
                    <h5 style="color : #d91002;"><i>Épuisé</i></h5>
                  </a>';
                  } else if ($stock <= 5) {
                    echo '
                  <a href="index?action=produitDetail&controller=produit&id_produit='.$id.'" class="grey-text">
                    <h5 style="color : #ed8200;"><i>'.$stock.' restantes !</i></h5>
                  </a>';
                  } else {
                    echo '<a href="index?action=produitDetail&controller=produit&id_produit='.$id.'" class="grey-text">
                    <h5 style="color : grey;"><i>Disponible</i></h5>
                  </a>';
                  }
                  echo '<h5>
                    <strong>
                    <a href="index?action=produitDetail&controller=produit&id_produit='.$id.'" class="dark-grey-text"> ' .$nom . ' ';
                        if($categorie != NULL) {
                          echo '<span class="badge badge-pill danger-color"> '.$categorie.'</span>';
                        } else
                        echo '<br>';

                  echo '</a>';
                    
                  echo '</strong>
                  </h5>

                  <h4 class="font-weight-bold blue-text">
                    <strong>prix : '.$prix.' €</strong>
                  </h4>';

                  if(Session::is_admin()) {
                    echo '
                    <div style = "font-size : 90%; margin-top : 5%">
                      <a id="modifsupri" href="index?action=modifCookie&controller=produit&id_produit='.$id.'" class="nav-link border border-light rounded waves-effect" style="color : #2196f3; box-shadow: 1px 1px 1px gray; width : 49%">
                      <i class="">Modifier</i>
                      </a>
                      <a id="modifsupri" href="index?action=supprimerCookie&controller=produit&id_produit='.$id.'" class="nav-link border border-light rounded waves-effect" style="color : red; box-shadow: 1px 1px 1px gray; width : 49%">
                      <i class="">Supprimer</i>
                      </a>
                    </div>';
                  }
                echo '</div>
                <!--Card content-->

              </div>
              <!--Card-->

            </div>';
          }
          //rajouter cookie :
          if(Session::is_admin()) {
          echo '<div class="col-lg-3 col-md-6 mb-4">
              <!--Card-->
              <div class="card">
                <!--Card image-->
                <div class="view overlay">
                <h4 style="padding-top: 50%" class="font-weight-bold blue-text">
                    <strong>Creer cookie</strong>
                  </h4>
                  <a href="index?action=creerCookie&controller=produit">
                    <img style="padding-top: 10%; padding-bottom: 60%; padding-right: 30%; padding-left: 30%;"
                    src="template/img/plus-rouge.png" class="card-img-top"
                    alt="">
                    </a>
                  </div>
                </div>
              </div>
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