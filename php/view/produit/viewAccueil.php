<!DOCTYPE html>
<html lang="en">

<head>
  <?php
    require_once '../php/lib/File.php';
    require_once File::build_path(array("model","ModelProduits.php"));
  ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Material Design Bootstrap</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.min.css" rel="stylesheet">
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container">

      <!-- Brand -->
      <a class="navbar-brand waves-effect" href="../index.php">
        <strong class="blue-text">Cookie Paradise</strong>
      </a>

      <!-- Collapse -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Left -->
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link waves-effect" href="../index.php">Acceuil
              <span class="sr-only"></span>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link waves-effect" href="magasin-page.php">Magasin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="#">Compte</a>
          </li>
        </ul>

        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
          <li class="nav-item">
            <a class="nav-link waves-effect">
              <span class="badge red z-depth-1 mr-1"> ? </span>
              <i class="fas fa-shopping-cart"></i>
              <span class="clearfix d-none d-sm-inline-block"> Panier </span>
            </a>
          </li>
          <li class="nav-item">
            
          </li>
          <li class="nav-item">
            
          </li>
          <li class="nav-item">
            <a href="https://github.com/Damien-Senechal/projetwebA2" class="nav-link border border-light rounded waves-effect"
              target="_blank">
              <i class=""></i>S'enregistrer
            </a>
          </li>
          <li class="nav-item">
            <a href="https://github.com/Damien-Senechal/projetwebA2" class="nav-link border border-light rounded waves-effect"
              target="_blank">
              <i class=""></i>Se connecter
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar -->

  <!--Main layout-->
  <?php
    $id_produit = $_GET['id_produit'];
    $produit = ModelProduits::getProduitById($id_produit);
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
              <button class="btn btn-primary btn-md my-0 p" type="submit">Add to cart
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

          $premierCookie = rand(1, $tailleTab);

          $deuxiemeCoockie = rand(1, $tailleTab);
          while ($premierCookie == $deuxiemeCoockie) {
          	$deuxiemeCoockie = rand(1, $tailleTab);
          }

          $troisiemeCoockie = rand(1, $tailleTab);
          while ($premierCookie == $troisiemeCoockie | $deuxiemeCoockie == $troisiemeCoockie) {
          	$troisiemeCoockie = rand(1, $tailleTab);
          }

          $image1 = $tab_produits[$premierCookie ]->get('urlImage_produit');
          $image2 = $tab_produits[$deuxiemeCoockie ]->get('urlImage_produit');
          $image3 = $tab_produits[$troisiemeCoockie]->get('urlImage_produit');

         
          echo '
        <!--Grid column-->
        <div class="col-md-6 text-center">

          <h4 class="my-4 h4">Tas capté?</h4>

          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus suscipit modi sapiente illo soluta odit
            voluptates,
            quibusdam officia. Neque quibusdam quas a quis porro? Molestias illo neque eum in laborum.</p>

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-lg-4 col-md-12 mb-4">

          <img src= '.$image1.' class="img-fluid" alt="">

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-4 col-md-6 mb-4">

          <img src= '.$image2.' class="img-fluid" alt="">

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-4 col-md-6 mb-4">

          <img src='.$image3.' class="img-fluid" alt="">

        </div>
        <!--Grid column-->'
        ?>
      </div>
      <!--Grid row-->

    </div>
  </main>
  <!--Main layout-->

  <!--Footer-->
  <footer class="page-footer text-center font-small mt-4 wow fadeIn">

    <!--Call to action-->
    <div class="pt-4">
      
      <p><strong> Regalez vous :D </strong></p>
    </div>
    <!--/.Call to action-->

    <hr class="my-4">

    <!-- Social icons -->
    <div class="pb-4">
      <a href="https://fb.watch/256tEI8fKq/" target="_blank">
        <i class="fab fa-facebook-f mr-3"></i>
      </a>

      <a href="https://twitter.com/Granola" target="_blank">
        <i class="fab fa-twitter mr-3"></i>
      </a>

      <a href="https://www.youtube.com/watch?v=awmQrt_AERY" target="_blank">
        <i class="fab fa-youtube mr-3"></i>
      </a>

      <a href="https://www.pinterest.fr/pin/549509592032222133/" target="_blank">
        <i class="fab fa-pinterest mr-3"></i>
      </a>

      <a href="https://github.com/Damien-Senechal/projetwebA2" target="_blank">
        <i class="fab fa-github mr-3"></i>
      </a>
    </div>
    <!-- Social icons -->

    
    <div class="footer-copyright py-3">
      vive les cookies
      <a href="https://m.media-amazon.com/images/I/81tSnVvcnSL._SS500_.jpg" target="_blank"> tiakapté </a>
    </div>
    

  </footer>
  <!--/.Footer-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();

  </script>
</body>

</html>