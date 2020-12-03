<!DOCTYPE html>
<html lang="en">

<head>

</head>
<body>
  <?php
    require_once '../lib/File.php';
    require_once File::build_path(array("model","ModelProduits.php"));
    $id_produit = $_GET['id_produit'];
    $produit = ModelProduits::getProduitById($id_produit);
    $nom_produit = $produit->get('nom_produit');

    $image = $produit->get('urlImage_produit');
    $categorie_produit = $produit->get('categorie_produit');
    $description_produit = $produit->get('desc_produit');
    $prix_produit = $produit->get('prix_produit');
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
            <p class="my-4 h4"><?php echo $nom_produit ?></p>
            <div class="mb-3">
              <a>
                <span class="badge red mr-1"><?php echo $categorie_produit ?></span>
              </a>
              <a>
                <span class="badge green mr-1"> -25% </span>
              </a>
            </div>

            <p class="lead">
              <span class="mr-1">
                <del><?php echo $prix_produit * 1.5 . '€' ?></del>
              </span>
              <span><?php echo $prix_produit . '€' ?> </span>
            </p>

            <p class="lead font-weight-bold">Description</p>

            <?php echo '<p>'. $description_produit . '</p>' ?> 

            <form class="d-flex justify-content-left">
              <!-- Default input -->
              <input type="number" value="1" aria-label="Search" class="form-control" style="width: 100px">
              <button class="btn btn-primary btn-md my-0 p" type="submit">Ajouer au panier
                <i class="fas fa-shopping-cart ml-1"></i>
              </button>

            </form>

          </div>
          <!--Content-->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <hr>

      <!--Grid row-->
      <div class="row d-flex justify-content-center wow fadeIn">

      	<?php 
          $tab_produits = ModelProduits::getAllProduits();
          $tailleTab = sizeof($tab_produits);

          $premierCookie = rand(0, $tailleTab-1);

          $deuxiemeCookie = rand(0, $tailleTab-1);
          while ($premierCookie == $deuxiemeCookie) {
          	$deuxiemeCookie = rand(0, $tailleTab-1);
          }

          $troisiemeCookie = rand(0, $tailleTab-1);
          while ($premierCookie == $troisiemeCookie | $deuxiemeCookie == $troisiemeCookie) {
          	$troisiemeCookie = rand(0, $tailleTab-1);
          }

          $image1 = $tab_produits[$premierCookie]->get('urlImage_produit');
          $image2 = $tab_produits[$deuxiemeCookie]->get('urlImage_produit');
          $image3 = $tab_produits[$troisiemeCookie]->get('urlImage_produit');

         
          echo '
        <!--Grid column-->
        <div class="col-md-6 text-center">

          <h4 class="my-4 h4">Découvrez aussi...</h4>

          <p>
            Une gamme de cookie incroyable avec des cookies incroyaux qui mettrons bien ton estomac t\'as capté?
            Genre en gros, t\'as des cookies de fou sur le site, et genre nous on les vends, et c\'est chère en plus ! 
            Après, t\'sais c\'est rien, c\'est les cookies quoi, tu fais ce que tu veux le s tiakapté.  
          </p>

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-lg-4 col-md-12 mb-4">
          <h4 class="my-4 h4"> <center> <strong>'. $tab_produits[$premierCookie ]->get('nom_produit') .'  </center></strong></h4>
          <img src= '.$image1.' class="img-fluid" alt="">
          <p> <center> <strong> Prix : '. $tab_produits[$premierCookie ]->get('prix_produit') .' € </center></strong></p>

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-4 col-md-6 mb-4">

          <h4 class="my-4 h4"> <center> <strong>'. $tab_produits[$deuxiemeCookie ]->get('nom_produit') .'  </center></strong></h4>
          <img src= '.$image2.' class="img-fluid" alt="">
          <p> <center> <strong> Prix : '. $tab_produits[$deuxiemeCookie]->get('prix_produit') .' € </center></strong></p>

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-4 col-md-6 mb-4">

          <h4 class="my-4 h4"> <center> <strong>'. $tab_produits[$troisiemeCookie ]->get('nom_produit') .'  </center></strong></h4>
          <img src='.$image3.' class="img-fluid" alt="">
          <p> <center> <strong> Prix : '. $tab_produits[$troisiemeCookie]->get('prix_produit') .' € </center></strong></p>

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
