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
            $nom = $value->get('nom_utilisateur');
            $prenom = $value->get('prenom_utilisateur');
            $mail = $value->get('mail_utilisateur');
            $url = $value->get('urlImage_utilisateur');
            $nbrCommandes = $value->getNbrCommandeUtilisateur($id);
            $age = ModelUtilisateurs::age($value->get('ddn_utilisateur'));
            
            echo '<div class="col-lg-3 col-md-6 mb-4">
              <!--Card-->
              <div class="card">
                <!--Card image-->
                <div class="view overlay">
                  <img src="'.$url.'" class="card-img-top"
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
            if(Session::is_admin()) {
                    echo '
                    <div style = "font-size : 90%; margin-top : 5%">
                      <a href="index?action=update&controller=utilisateur&id_utilisateur='.$id.'" class="nav-link border border-light rounded waves-effect" style="color : #2196f3; box-shadow: 1px 1px 1px gray; width : 49%">
                      <i class=""></i>Modifier
                      </a>
                      <a href="index?action=supprimerUtilisateur&controller=utilisateur&id_utilisateur='.$id.'" class="nav-link border border-light rounded waves-effect" style="color : red; box-shadow: 1px 1px 1px gray; width : 49%">
                      <i class=""></i>Supprimer
                      </a>
                    </div>';
            }
            echo '
                </div>
                <!--Card content-->


              </div>
              <!--Card-->

            </div>';
          }
          //rajouter cookie :
          if(Session::is_admin()) {
          echo '<div class="col-lg-3 col-md-6 mb-4">
              <!--Card-->
              <div class="card">
                <!--Card image-->
                <div class="view overlay">
                <h4 style="padding-top: 70%" class="font-weight-bold blue-text">
                    <strong>Enregistrer utilisateur</strong>
                  </h4>
                  <a href="index?action=enregistrer&controller=utilisateur">
                    <img style="padding-top: 15%; padding-bottom: 80%; padding-right: 30%; padding-left: 30%;"
                    src="template/img/plus-rouge.png" class="card-img-top"
                    alt="">
                    </a>
                  </div>
                </div>
              </div>
            </div>';
          }
        ?>
        </div>

      </section>
      <!--Section: Products v.3-->
</body>
</html>