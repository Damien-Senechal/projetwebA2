<!DOCTYPE html>
<html lang="en">

<head>
  
</head>

<body>
  <!--Main layout-->
  <?php
    $utilisateur = ModelUtilisateur::getUtilisateurById($_GET['id_utilisateur']);
    $id = $utilisateur->get('id_utilisateur');
    $admin = $utilisateur->get('admin_utilisateur');
    $nom = $utilisateur->get('nom_utilisateur');
    $prenom = $utilisateur->get('prenom_utilisateur');
    $mail = $utilisateur->get('mail_utilisateur');
    $ddn = $utilisateur->get('ddn_utilisateur');
    $histoire = $utilisateur->get('histoire_utilisateur');
    $url = $utilisateur->get('urlImage_utilisateur');
    $nbrCommandes = $utilisateur->getNbrCommandeUtilisateur($id);
  ?>
  <main class="mt-5 pt-4">
    <div class="container dark-grey-text mt-5">

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <?php  echo '<img src="'.$url.'" class="img-fluid" alt="">'?>

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <!--Content-->
          <div class="p-4">
            <h1 style="color:#007bff;"> nom - <?php echo $nom ?></h1>

            <div class="mb-3">
              <a>
                <h3 class="">Prenom - <?php echo $prenom ?></h3>
              </a>
            </div>

            <p class="lead">
              <span class="mr-1">
                <?php echo "Date de naissance - ".$ddn ?>
              </span>   
              <span class="mr-1">
                <?php echo "<br>Age - ".ModelUtilisateur::age($ddn) . " ans" ?>
              </span>     
            </p>

             <?php if($histoire != NULL) {
              echo '<i> <div class="lead font-weight-bold">Histoire : </i><br> </div> <i>'. $histoire.' </i>';
             }
            ?> 
        
      <?php 
      echo '<p class="lead">
              <span class="mr-1">
                <br> Adresse mail - ' .$mail .'
              </span>       
            </p> ';
            if ((!empty($_SESSION['id_utilisateur'])) && ($_GET['id_utilisateur'] == $_SESSION['id_utilisateur']) || (Session::is_admin())) {
              if ($nbrCommandes > 0) {
                echo '
                <a href="index.php?action=listeCommande&controller=commande&id_utilisateur='.$id.'" class="lead font-weight-bold">Nb commandes : '. $nbrCommandes  . '</a>';
                }
              else {
                echo '<a class="lead font-weight-bold"> Aucune commande </a>';
              }
              echo '
              <div>  
              <br>
              </div>
              <div style = "font-size : 90%; margin-top : 5%">
                    <a href="index.php?action=update&controller=utilisateur&id_utilisateur='.$id.'" class="nav-link border border-light rounded waves-effect" style="background-color : #2196f3; color : white; font-weight : bold; box-shadow: 1px 1px 1px gray; width : 35%; text-align : center">
                    <i class=""></i>Modifier compte
                    </a>
                    <a href="index.php?action=supprimerUtilisateur&controller=utilisateur&id_utilisateur='.$id.'" class="nav-link border border-light rounded waves-effect" style="background-color : red; font-weight : bold; color : white; box-shadow: 1px 1px 1px gray; width : 35%; text-align : center">
                    <i class=""></i>Supprimer compte
                    </a>
              </div>';
            }
            ?>

          </div>
          <!--Content-->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <hr> <!--c kwa?-->


    </div>
  </main>
  <!--Main layout-->
</body>

</html>