<!DOCTYPE html>
<html lang="en">

<head>
  
</head>

<body>
  <!--Main layout-->
  <?php
    $utilisateur = ModelUtilisateurs::getUtilisateurById($_GET['id_utilisateur']);
    $id = $utilisateur->get('id_utilisateur');
    $admin = $utilisateur->get('admin_utilisateur');
    $nom = $utilisateur->get('nom_utilisateur');
    $prenom = $utilisateur->get('prenom_utilisateur');
    $mail = $utilisateur->get('mail_utilisateur');
    $ddn = $utilisateur->get('ddn_utilisateur');
    $histoire = $utilisateur->get('histoire_utilisateur');
    $nbrCommandes = $utilisateur->getNbrCommandeUtilisateur($id);
  ?>
  <main class="mt-5 pt-4">
    <div class="container dark-grey-text mt-5">

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <?php  echo '<img src="template/img/imagesUtilisateur/'.$prenom.'.png" class="img-fluid" alt="">'?>

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
                <?php echo "<br>Age - ".ModelUtilisateurs::age($ddn) . " ans" ?>
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
            <a href="index?action=listeCommande&controller=commande&id_utilisateur='.$id.'" class="lead font-weight-bold">Nb commandes : '. $nbrCommandes  . '</a>';
            }
            else {
              echo '<a class="lead font-weight-bold"> Aucune commande </a>';
            }
            echo '
            <div>  
            <br>
            </div>';

              echo '<form class="d-flex justify-content-left">
              <a href="index?action=update&controller=utilisateur&id_utilisateur='.$_SESSION['id_utilisateur'].'">
              <!-- Default input -->
              <input class="btn btn-primary btn-md my-0 p" value="Modifier compte" disabled="disabled"> 
                <i class=""></i>
              </input>
              </a>

            </form>';
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