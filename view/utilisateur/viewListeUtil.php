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
            $age = ModelUtilisateurs::age($value->get('categorie_produit'));
            
            echo '<div class="col-lg-3 col-md-6 mb-4">
              <!--Card-->
              <div class="card">
                <!--Card image-->
                <div class="view overlay">
                  <img src="'.$image.'" class="card-img-top"
                    alt="">
                  <a href="index?action=produitDetail&controller=produits&id_produit='.$id.'">
                    <div class="mask rgba-white-slight">Acheter</div>
                  </a>
                </div>
                <!--Card image-->

                <!--Card content-->
                <div class="card-body text-center">
                  <!--Category & Title-->
                  <a href="index?action=produitDetail&controller=produits&id_produit='.$id.'" class="grey-text">
                    <h5>Nom '.$nom.' unités</h5>
                    <h5>Nom '.$prenom.' unités</h5>
                  </a>
                  <h5>
                    <strong>
                      <a href="index?action=produitDetail&controller=produits&id_produit='.$id.'" class="dark-grey-text"> ' .$nom;
                      	if ($value->get('admin_utilisateur') == 1) {
			            	echo '<span class="badge badge-pill danger-color"> admin </span> ';
			            }
                        echo '
                      </a>
                    </strong>
                  </h5>

                  <h4 class="font-weight-bold blue-text">
                    <strong>age : '.$age. '</strong>
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
</body>
</html>