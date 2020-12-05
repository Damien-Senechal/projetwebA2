<!DOCTYPE html>
<html lang="en">

<head>
  
</head>

<body>
  <!--Main layout-->
  <main class="mt-5 pt-4">
  <?php
  foreach ($listeCommandes as $key => $value) {
    echo var_dump($listeCommandes);
    $commande = ModelCommandes::getCommandeById($value);
    $id = $commande->get('id_commande');
    $id_client = $commande->get('id_client');
    $date = $commande->get('date_commande');
    $prix = $commande->get('prix_commande');
      $utilisateur = ModelUtilisateurs::getUtilisateurById($id_client);
        $nom = $utilisateur->get('nom_utilisateur');
        $prenom = $utilisateur->get('prenom_utilisateur');
        $image = $utilisateur->get('image_utilisateur');
    $liste_detail = ModelDetail::getListeDetailCommande($id);

    echo '<div class="col-lg-3 col-md-6 mb-4">
              <!--Card-->
              <div class="card">
                <!--Card image-->
                <div class="view overlay">
                  <img src="'.$image.'" class="card-img-top"
                    alt="">
                  </a>
                </div>
                <!--Card image-->

                <!--Card content-->
                <div class="card-body text-center">
                  <!--Category & Title-->
                  <a href="index?action=produitDetail&controller=produits&id_produit='.$id.'" class="grey-text">
                    <h5>Commande numéro '.$id.'</h5>
                  </a>
                  <h5>
                    <strong>
                      <a href="index?action=produitDetail&controller=produits&id_produit='.$id.'" class="dark-grey-text"> ' .$nom. '
                        <span class="badge badge-pill danger-color"> Prix total de la commande - '.$prix.'€</span>
                        '; 
                        foreach ($liste_detail as $key => $value) {
                          $detail = ModelDetail::getDetailById($value);
                            $id_detail = $detail->get("id_detail");
                            $id_produit = $detail->get("id_produit");
                            $quantite_produit_detail = $detail->get("quantite_produit_detail");
                            $prix_detail = $detail->get("prix_detail");
                            echo '<div class="col-lg-3 col-md-6 mb-4">
                            <div class="card">
                            Detail commande id - '.$id_detail.' <br>
                            Produit acheté - '.$id_produit.' <br>
                            Quantite produit - '.$quantite_produit_detail.' <br>
                            Prix produit  - '.$prix_detail.' <br> 
                            </div>
                            </div>';
                            } 
                            
                      echo' 
                      </a>
                    </strong>
                  </h5>

                  <h4 class="font-weight-bold blue-text">
                    <strong>Date commande - '.$date.' </strong>
                  </h4>

                </div>
                <!--Card content-->

              </div>
              <!--Card-->

            </div>';
    }
  ?>
  
  </main>
  <!--Main layout-->
</body>

</html>