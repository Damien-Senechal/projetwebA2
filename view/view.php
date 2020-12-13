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
    <header> <!---->
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
            <a class="nav-link waves-effect" href="index.php?action=magasinProduit&controller=produit">Magasin</a>
          </li>
          <?php 
          if (Session::is_admin()) {
            echo '
            <li class="nav-item">
              <a class="nav-link waves-effect" href="index.php?action=listeToutesCommandes&controller=commande">Commandes</a>
            </li>';
          }
          else if (isset($_SESSION['id_utilisateur'])) {
          echo '
          <li class="nav-item">
            <a class="nav-link waves-effect" href="index.php?action=utilisateurDetail&controller=utilisateur&id_utilisateur='.$_SESSION['id_utilisateur'].'">Compte</a>
          </li>';
          }
          if (Session::is_admin()) {
            echo '
            <li class="nav-item">
              <a class="nav-link waves-effect" href="index.php?action=listeUtilisateur&controller=utilisateur">Utilisateurs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link waves-effect" href="https://webinfo.iutmontp.univ-montp2.fr/my/">BDD</a>
            </li>';
          }
          ?>
        </ul>
        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
          <li class="nav-item">
            <a class="nav-link waves-effect" href="index.php?action=afficherPanier&controller=produit">
              <span class="badge red z-depth-1 mr-1"> <?php echo ControllerProduit::nbrProduit() ?> 
              </span>
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
            <a href="index.php?action=enregistrer&controller=utilisateur" class="nav-link border border-light rounded waves-effect">
              <i class=""></i>S\'enregistrer
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?action=seConnecter&controller=utilisateur" class="nav-link border border-light rounded waves-effect">
              <i class=""></i>Se connecter
            </a>
          </li>'; }
          else {
            echo '
            <li class="nav-item">
            <a href="index.php?action=deconnecter&controller=utilisateur" class="nav-link border border-light rounded waves-effect">
              <i class=""></i>Se deconnecter
            </a>
          </li>';
          $u = ModelUtilisateur::getUtilisateurById($_SESSION['id_utilisateur']);
          $id = $u->get('id_utilisateur');
          $prenom_utilisateur = $u->get('prenom_utilisateur');
          $url = $u->get('urlImage_utilisateur');
          echo '<li style = "margin-left : 10px; display: flex;" class="nav-item">
                <a style = "display: flex; align-items: center;">
                Bonjour ' . $prenom_utilisateur. ' 
                <a>
            <a href="index.php?action=utilisateurDetail&controller=utilisateur&id_utilisateur='. $id .'">
            <img style = "margin-left : 10px; width : 40px; height : 40px; align-items : center;" src="'.$url.'" class="card-img-top">
          </a>';
          if (Session::is_admin()) {
            echo '<i style="margin-top : 4%; color : red; margin-left : 10px;"><strong> IS ADMIN </strong></i>';
          }
          '</li>';      
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
      
      <strong> Regalez vous :D </strong>
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