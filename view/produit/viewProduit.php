<!DOCTYPE html>
<html lang="en">

<head>
  
</head>

<body>
  <!--Main layout-->
  <?php
    $id_produit = $_GET['id_produit'];
    $produit = ModelProduits::getProduitById($id_produit);
    $image = $produit->get('urlImage_produit');
    $nom_produit = $produit->get('nom_produit');
    $categorie_produit = $produit->get('categorie_produit');
    $prix_produit = $produit->get('prix_produit');
    $description_produit = $produit->get('desc_produit');
  ?>
  <main class="mt-5 pt-4">
    <div class="container dark-grey-text mt-5">

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <?php  echo '<img src="'.$image.'" class="img-fluid" alt="">'?>

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <!--Content-->
          <div class="p-4">
            <h4 class="my-4 h4"><?php echo $nom_produit ?></h4>

            <div class="mb-3">
              <a>
                <span class="badge purple mr-1"><?php echo $categorie_produit ?></span>
              </a>
              <a>
                <span class="badge orange mr-1"> -25% </span>
              </a>
            </div>

            <p class="lead">
              <span class="mr-1">
                <del><?php echo $prix_produit * 1.5 . '$' ?></del>
              </span>
              <span><?php echo $prix_produit . '$' ?> </span>
            </p>

            <p class="lead font-weight-bold">Description</p>

            <?php echo '<p>'. $description_produit . '</p>' ?> 

            <form class="d-flex justify-content-left">
              <!-- Default input -->
              <input type="number" value="1" aria-label="Search" class="form-control" style="width: 100px">
              <button class="btn btn-primary btn-md my-0 p" type="submit">Ajouter au panier 
                <i class="fas fa-shopping-cart ml-1"></i>
              </button>

            </form>

          </div>
          <!--Content-->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <hr> <!--c kwa?-->

      <!--Grid row-->
      <div class="row d-flex justify-content-center wow fadeIn">

      	<?php 
          $tab_produits = ModelProduits::getAllProduits();
          $tailleTab = sizeof($tab_produits);

          $premierCookie = rand(0, $tailleTab-1);
          while ($tab_produits[$premierCookie ]->get('id_produit') == $id_produit) {
            $premierCookie = rand(0, $tailleTab-1);
          }
          $deuxiemeCookie = rand(0, $tailleTab-1);
          while ($premierCookie == $deuxiemeCookie | $tab_produits[$deuxiemeCookie ]->get('id_produit') == $id_produit) {
          	$deuxiemeCookie = rand(0, $tailleTab-1);
          }

          $troisiemeCookie = rand(0, $tailleTab-1);
          while ($premierCookie == $troisiemeCookie | $deuxiemeCookie == $troisiemeCookie | $tab_produits[$troisiemeCookie ]->get('id_produit') == $id_produit) {
          	$troisiemeCookie = rand(0, $tailleTab-1);
          }

          $image1 = $tab_produits[$premierCookie]->get('urlImage_produit');
          $image2 = $tab_produits[$deuxiemeCookie]->get('urlImage_produit');
          $image3 = $tab_produits[$troisiemeCookie]->get('urlImage_produit');
          $id1 = $tab_produits[$premierCookie]->get('id_produit');
          $id2 = $tab_produits[$deuxiemeCookie]->get('id_produit');
          $id3 = $tab_produits[$troisiemeCookie]->get('id_produit');

         
          echo '
        <!--Grid column-->
        <div class="col-md-6 text-center">

          <h4 class="my-4 h4">Tas capté?</h4>

          <p>
          T\'AS CAPTÉ QUE C\'EST QUE DE LA QUALITÉ FRÉROT ! <br>
          Les cookies, ils viennent des meilleures régions de France, et tmtc que nos régions ont du talent takapté

          </p>

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-lg-4 col-md-12 mb-4">
          <h4 class="my-4 h4"><center>'.$tab_produits[$premierCookie]->get('nom_produit').'</center></h4>
          <a href="index?action=produitDetail&controller=produits&id_produit='.$id1.'"> <img src= '.$image1.' class="img-fluid"> </a>
          <h4 class="my-4 h4"><center>'.$tab_produits[$premierCookie]->get('prix_produit').' €</center></h4>

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-4 col-md-6 mb-4">
          <h4 class="my-4 h4"><center>'.$tab_produits[$deuxiemeCookie]->get('nom_produit').'</center></h4>
          <a href="index?action=produitDetail&controller=produits&id_produit='.$id2.'"> <img src= '.$image2.' class="img-fluid"> </a>
          <h4 class="my-4 h4"><center>'.$tab_produits[$deuxiemeCookie]->get('prix_produit').' €</center></h4>

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-4 col-md-6 mb-4">
          <h4 class="my-4 h4"><center>'.$tab_produits[$troisiemeCookie]->get('nom_produit').'</center></h4>
          <a href="index?action=produitDetail&controller=produits&id_produit='.$id3.'"> <img src= '.$image3.' class="img-fluid"> </a>
          <h4 class="my-4 h4"><center>'.$tab_produits[$troisiemeCookie]->get('prix_produit').' €</center></h4>

        </div>
        <!--Grid column-->'
        ?>
      </div>
      <!--Grid row-->

    </div>
  </main>
  <!--Main layout-->
</body>

</html>
