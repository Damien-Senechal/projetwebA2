<!DOCTYPE html>
<html lang="en">

<head>
  <style type="text/css">
    html,
    body,
    .carousel {
      height: 60vh;
    }

    @media (max-width: 740px) {

      html,
      body,
      .carousel {
        height: 100vh;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {

      html,
      body,
      .carousel {
        height: 100vh;
      }
    }

  </style>
</head>

<body>
  
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

              <a href="index?action=magasinProduit&controller=produits" class="btn btn-outline-white btn-lg"> --> Magasin <--
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

              <a href="index?action=magasinProduit&controller=produits" class="btn btn-outline-white btn-lg">--> Magasin <--
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

              <a href="index?action=magasinProduit&controller=produits" class="btn btn-outline-white btn-lg">--> Magasin <--
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
  

  <!--/.Faites  attention a ca-->
    <div class="container" style="margin-top: 5%">
      <!--Section: Products v.3-->
      <h1 class="dark-grey-text"><strong><center> EKIP : </center></strong></h1>
      <section class="text-center mb-4">
        <div class="row wow fadeIn">
          <?php
            $tab_utilisateurs = ModelUtilisateurs::getAllUtilisateurs();
            foreach ($tab_utilisateurs as $key => $value) {
              $utilisateur = ModelUtilisateurs::getUtilisateurById($value->get('id_utilisateur'));
              $admin = $utilisateur->get('admin_utilisateur');
              if ($admin == TRUE) {
                $id = $utilisateur->get('id_utilisateur');
                $nom = $utilisateur->get('nom_utilisateur');
                $prenom = $utilisateur->get('prenom_utilisateur');
                $mail = $utilisateur->get('mail_utilisateur');
                $ddn = $utilisateur->get('ddn_utilisateur');
                $image = $utilisateur->get('pp_utilisateur');
                $age = ModelUtilisateurs::age($ddn); 

                echo '<div class="col-lg-3 col-md-6 mb-4">
                  <div class="card">
                    <div class="view overlay">
                      <img src="'.$image.'" class="card-img-top"
                        alt="">
                      <a href="index?action=utilisateurDetail&controller=utilisateur&id_utilisateur='.$id.'">
                        <div class="mask rgba-white-slight">Présentation</div>
                      </a>
                    </div>
                    <div class="card-body text-center">
                     
                      <a href="index?action=utilisateurDetail&controller=utilisateur&id_utilisateur='.$id.'" class="grey-text">
                        <h5>'.$nom.'</h5>
                      </a>
                      <h5>
                        <strong>
                          <a href="index?action=utilisateurDetail&controller=utilisateur&id_utilisateur='.$id.'" class="dark-grey-text"> ' .$prenom. '
                            <br>
                            <span class="badge badge-pill orange">'.$mail.'</span>
                          </a>
                        </strong>
                      </h5>
                      <h4 class="font-weight-bold blue-text">
                        <strong> '.$age. ' ans </strong>
                      </h4>
                    </div>
                  </div>
                </div>';
            }
          }
        ?>
        </div>
      </section>
      <!--Section: Products v.3-->
    </div>
  <!--/.Faites  attention a ca-->
  </body>
</html>