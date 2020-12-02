<!DOCTYPE html>
<html>
<head>
  <?php
    require_once '../php/lib/File.php';
    require_once File::build_path(array("model","ModelProduits.php"));
  ?>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Magasin</title>
  <link rel="icon" href="img/cookie.ico" />

  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.min.css" rel="stylesheet">
  <style type="text/css">
    html,
    body,
    header,
    .carousel {
      height: 60vh;
    }

    @media (max-width: 740px) {

      html,
      body,
      header,
      .carousel {
        height: 100vh;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {

      html,
      body,
      header,
      .carousel {
        height: 100vh;
      }
    }

  </style>
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
  <script type="text/javascript" src="template/js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="template/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="template/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="template/js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();

  </script>
</body>
</html>