<!DOCTYPE html>
<html lang="fr">

<head>
  <!-- <?php
    require_once('php/config/Conf.php');
  ?> -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Cookie Paradise</title>
  <link rel="icon" href="template/img/cookie.ico" />

  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="template/css/materialize.min.css"  media="screen,projection"/>

  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="template/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="template/css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="template/css/style.min.css" rel="stylesheet">
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

  <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="template/js/materialize.min.js"></script>

  <!-- Navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container">

      <!-- Brand -->
      <a class="navbar-brand waves-effect" href="index.php">
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
          <li class="nav-item active">
            <a class="nav-link waves-effect" href="index.php">Acceuil
              <span class="sr-only"></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="template/magasin-page.php">Magasin</a>
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

  <!--Carousel Wrapper-->
  <div id="carousel-example-1z" class="carousel slide carousel-fade pt-4" data-ride="carousel">

    <!--Indicators-->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-1z" data-slide-to="1"></li>
      <li data-target="#carousel-example-1z" data-slide-to="2"></li>
    </ol>
    <!--/.Indicators-->

    <!--Slides-->
    <div class="carousel-inner" role="listbox">

      <!--First slide-->
      <div class="carousel-item active">
        <div class="view" style="background-image: url('template/img/slides/cookies1slide.jpg'); background-repeat: no-repeat; background-size: cover;">

          <!-- Mask & flexbox options-->
          <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

            <!-- Content -->
            <div class="text-center white-text mx-5 wow fadeIn">
              <h1 class="mb-4">
                <strong>Les meilleurs Cookies de votre vie !</strong>
              </h1>

              <p>
                <strong>Recette originale depuis le mardi 7 mai 1985 à 12h15 <strong>heure locale</strong> (après l'apéro avec les collègues).</strong>
              </p>

              <p class="mb-4 d-none d-md-block">
                <strong>N'hésitez pas à vous faire plaisir avec notre selections de cookies originaux !</strong>
              </p>

              <a href="template/magasin-page.php" class="btn btn-outline-white btn-lg"> --> Magasin <--
                <i class=""></i>
              </a>
            </div>
            <!-- Content -->

          </div>
          <!-- Mask & flexbox options-->

        </div>
      </div>
      <!--/First slide-->

      <!--Second slide-->
      <div class="carousel-item">
        <div class="view" style="background-image: url('template/img/slides/cookies2slide.jpg'); background-repeat: no-repeat; background-size: cover;">

          <!-- Mask & flexbox options-->
          <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

            <!-- Content -->
            <div class="text-center white-text mx-5 wow fadeIn">
              <h1 class="mb-4">
                <strong>Les meilleurs Cookies de votre vie !</strong>
              </h1>

              <p>
                <strong>Recette originale depuis le mardi 7 mai 1985 à 12h15 <strong>heure locale</strong> (après l'apéro avec les collègues).</strong>
              </p>

              <p class="mb-4 d-none d-md-block">
                <strong>N'hésitez pas à vous faire plaisir avec notre selections de cookies originaux !</strong>
              </p>

              <a href="template/magasin-page.php" class="btn btn-outline-white btn-lg">--> Magasin <--
                <i class=""></i>
              </a>
            </div>
            <!-- Content -->

          </div>
          <!-- Mask & flexbox options-->

        </div>
      </div>
      <!--/Second slide-->

      <!--Third slide-->
      <div class="carousel-item">
        <div class="view" style="background-image: url('template/img/slides/cookies3slide.jpg'); background-repeat: no-repeat; background-size: cover;">

          <!-- Mask & flexbox options-->
          <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

            <!-- Content -->
            <div class="text-center white-text mx-5 wow fadeIn">
              <h1 class="mb-4">
                <strong>Les meilleurs Cookies de votre vie !</strong>
              </h1>

              <p>
                <strong>Recette originale depuis le mardi 7 mai 1985 à 12h15 <strong>heure locale</strong> (après l'apéro avec les collègues).</strong>
              </p>

              <p class="mb-4 d-none d-md-block">
                <strong>N'hésitez pas à vous faire plaisir avec notre selections de cookies originaux !</strong>
              </p>

              <a href="template/magasin-page.php" class="btn btn-outline-white btn-lg">--> Magasin <--
                <i class=""></i>
              </a>
            </div>
            <!-- Content -->

          </div>
          <!-- Mask & flexbox options-->

        </div>
      </div>
      <!--/Third slide-->

    </div>
    <!--/.Slides-->

    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Précédente</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Suivante</span>
    </a>
    <!--/.Controls-->

  </div>
  

  <!--/.Faites pas attention a ca-->
            <h1><center><strong>Lorem</strong></center></h1>
            <h2><center><strong>Ipsum</strong></center></h2>
            <h3><center><strong>takapté</strong></center></h3>
            <h3><center><strong>takapté</strong></center></h3>
            <h3><center><strong>takapté</strong></center></h3>
            <h3><center><strong>takapté</strong></center></h3>
            <h3><center><strong>takapté</strong></center></h3>
            <h3><center><strong>takapté</strong></center></h3>
            <h3><center><strong>takapté</strong></center></h3>
            <h3><center><strong>takapté</strong></center></h3>
            <h3><center><strong>takapté</strong></center></h3>
            <h3><center><strong>takapté</strong></center></h3>
            <h3><center><strong>takapté</strong></center></h3>
            <h3><center><strong>takapté</strong></center></h3>
  <!--/.Faites pas attention a ca-->

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
