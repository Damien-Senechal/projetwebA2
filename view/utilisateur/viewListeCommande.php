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
    $image = $utilisateur->get('pp_utilisateur');
    $histoire = $utilisateur->get('histoire_utilisateur');
    $nbrCommandes = $utilisateur->getNbrCommandeUtilisateur($id);
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
			echo '
            <p class="lead">
              <span class="mr-1">
                <br> Adresse mail - ' .$mail .'
              </span>       
            </p>
            <a href="index?action=listeCommade&controller=commandes&id_utilisateur=' .$id.'"  class="lead font-weight-bold">Nb commandes : '. $nbrCommandes  . '</a>'
            ?>
            <div>  
            <br>
            </div>


            <form class="d-flex justify-content-left">
              <!-- Default input -->
              
              <button class="btn btn-primary btn-md my-0 p" type="submit"> Modifier compte
                <i class=""></i>
              </button>

            </form>

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