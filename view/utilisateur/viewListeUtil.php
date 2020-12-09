<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="container" style="margin-top: 5%">
      <!--Section: Products v.3-->
      <section class="text-center mb-4">
        <div class="row wow fadeIn">

          <?php
            $tab_utilisateur = ModelUtilisateurs::getAllUtilisateurs();
            foreach ($tab_utilisateur as $key => $value) {
            $id = $value->get('id_utilisateur');
            $image = $value->get('urlImage_produit');
            $nom = $value->get('nom_utilisateur');
            $prenom = $value->get('prenom_utilisateur');
            $mail = $value->get('mail_utilisateur');
            $nbrCommandes = $value->getNbrCommandeUtilisateur($id);
            $age = ModelUtilisateurs::age($value->get('ddn_utilisateur'));
            
            echo '<div class="col-lg-3 col-md-6 mb-4">
              <!--Card-->
              <div class="card">
                <!--Card image-->
                <div class="view overlay">
                  <img src="'.$image.'" class="card-img-top"
                    alt="">
                  <a href="index?action=utilisateurDetail&controller=utilisateur&id_utilisateur='.$id.'">
                    <div class="mask rgba-white-slight">Acheter</div>
                  </a>
                </div>
                <!--Card image-->

                <!--Card content-->
                <div class="card-body text-center">
                  <!--Category & Title-->
                  <a href="index?action=utilisateurDetail&controller=utilisateur&id_utilisateur='.$id.'" class="grey-text">
                    <h5>'.$prenom.'</h5>
                    <h5 class ="black-text"><strong>'.$nom.'</strong></h5>
                  </a>
                  <h5>
                    <strong>
                      <a href="index?action=utilisateurDetail&controller=utilisateur&id_utilisateur='.$id.'" class="dark-grey-text">';
                      	if ($value->get('admin_utilisateur') == 1) {
			            	echo '<span class="badge badge-pill danger-color"> admin </span> ';
			            }
                  else{
                    echo '<span class="badge badge-pill blue"> Client </span> ';
                  }
                        echo '
                      </a>
                    </strong>
                  </h5>

                  <h4 class="font-weight-bold blue-text">
                    <strong>'.$age. ' ans</strong>
                  </h4>
              <p class="lead">
              <span class="mr-1" style="font-size:69%";>
              ' .$mail .'
              </span>       
            </p> ';
            if ($nbrCommandes > 0) {
              echo '
            <a href="index?action=listeCommande&controller=commande&id_utilisateur='.$id.'" class="lead font-weight-bold">Nb commandes : '. $nbrCommandes  . '</a>';
            }
            else {
              echo '<a class="lead font-weight-bold"> Aucune commande </a>';
            }
            echo '
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

    <form action="" method="post" id="frmLogin">
  <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>  
  <div class="field-group">
    <div><label for="login">Username</label></div>
    <div><input name="member_name" type="text" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" class="input-field">
  </div>
  <div class="field-group">
    <div><label for="password">Password</label></div>
    <div><input name="member_password" type="password" value="" class="input-field"> 
  </div>
  <div class="field-group">
    <div><input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />
    <label for="remember-me">Remember me</label>
  </div>
  <div class="field-group">
    <div><input type="submit" name="login" value="Login" class="form-submit-button"></span></div>
  </div>       
</form>
</body>
</html>