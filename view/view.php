<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title><?php echo $pagetitle ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" href="template/img/cookie.ico"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="template/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="template/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="template/css/style.min.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../template/css/materialize.min.css"  media="screen,projection"/>
    
</head>
<body>
    <header>
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
          <li class="nav-item">
            <a class="nav-link waves-effect" href="index.php">Acceuil
              <span class="sr-only"></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="index?action=magasinProduit&controller=produits">Magasin</a>
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
          <?php if(!isset($_SESSION['id_utilisateur'])) {
          echo '
          <li class="nav-item">
            <a href="index?action=enregistrer&controller=utilisateur" class="nav-link border border-light rounded waves-effect">
              <i class=""></i>S\'enregistrer
            </a>
          </li>
          <li class="nav-item">
            <a href="index?action=seConnecter&controller=utilisateur" class="nav-link border border-light rounded waves-effect">
              <i class=""></i>Se connecter
            </a>
          </li>'; }
          else {
            echo '
            <li class="nav-item">
            <a href="index?action=deconnecter&controller=utilisateur" class="nav-link border border-light rounded waves-effect">
              <i class=""></i>Se deconnecter
            </a>
          </li>';
          $prenom_utilisateur = $u->get('prenom_utilisateur');
          $image_utilisateur = $u->get('pp_utilisateur');
          echo '<li style = "margin-left : 10px;" class="nav-item">
                Bonjour ' . $prenom_utilisateur .' ' . 
          '<a href="index?action=utilisateurDetail&controller=utilisateur&id_utilisateur='.$id.'">
          <img style = "width : 40px; height : 40px;" src="'.$image_utilisateur.'" class="card-img-top"
                        alt="imageUtilisateur">
          </a>
          </li>';
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar -->            
    </header>
    <main>
        <?php
            $filepath = File::build_path(array("view", static::$object, "$view.php"));
            require $filepath;
        ?>
    </main>
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