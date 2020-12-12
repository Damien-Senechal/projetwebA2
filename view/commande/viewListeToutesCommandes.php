<!DOCTYPE html>
<html lang="en">

<head>
  
</head>
<body>
  <!--Main layout-->
  <main class="mt-5 pt-4">
    <div class="container" style="margin-top: 5%">
    <?php
    foreach ($listeToutesCommandes as $key => $value) {
      $id = $value->get('id_commande');
      $id_client = $value->get('id_client');
      $date = $value->get('date_commande');
      $prix = $value->get('prix_commande');
      if($id_client == NULL) {
        $nom = 'connecté';
        $prenom = 'non ';
      } else {
        $utilisateur = ModelUtilisateur::getUtilisateurById($id_client);
        $nom = $utilisateur->get('nom_utilisateur');
        $prenom = $utilisateur->get('prenom_utilisateur');
      }
      $liste_detail = ModelDetail::getListeDetailCommande($id);
      echo '<!--Card content-->
                  <div class="card" style="margin-top: 5%">
                  <section class="text-center mb-4">
                    <!--Category & Title-->
                    <a class="grey-text">
                      <h5>Commande n°'.$id.'</h5>
                    </a>
                    <h5>
                      <strong>
                        <a href="index?action=utilisateurDetail&controller=utilisateur&id_utilisateur='.$id_client.'" class="dark-grey-text"> Commandé par ' .$prenom . ' ' .$nom  .' <br><br>
                          <span class="badge badge-pill danger-color" style="font-size : 130%"> (Yves) Montant de la commande - '.$prix.'€</span>
                          <div class="container" style="margin-top: 5%">
                          <section class="text-center mb-4">
                            <div class="row wow fadeIn">'; 
                          $i = 1;
                          foreach ((array) $liste_detail as $key => $value) {
                            $detail = ModelDetail::getDetailById($value[0]);
                              $id_detail = $detail->get("id_detail");
                              $id_produit = $detail->get("id_produit");
                              $produit = ModelProduit::getProduitById($id_produit);
                                $nom_produit = $produit->get("nom_produit");
                                $image_produit = $produit->get("urlImage_produit");
                                $prix_produit = $produit->get("prix_produit");
                              $quantite_produit_detail = $detail->get("quantite_produit_detail");
                              $prix_detail = $detail->get("prix_detail");
                              echo '<div class="col-lg-3 col-md-6 mb-4">
                                <!--Card-->
                                <div class="card">
                                  <!--Card image-->
                                  <div class="card-body text-center">
                              Produit n°'.$i.' : <br><br>
                              '.$nom_produit.' <br>
                              <a href="index?action=produitDetail&controller=produit&id_produit='.$id_produit.'">
                              <img src="'.$image_produit.'" class="img-fluid" alt=""><br></a>';
                              if ($quantite_produit_detail == 1) 
                                echo $quantite_produit_detail.' produit acheté <br><br>';
                              else 
                                echo $quantite_produit_detail.' produits achetés <br>'
                                . 'Prix produit - '.$prix_produit.'€ <br> ';
                              echo '
                              Prix total - '.$prix_detail.'€ 
                              </div></div></div>';
                              $i = $i + 1;
                              } 
                              
                        echo'</div>
                          </section>
                        </div> 
                        </a>
                      </strong>
                    </h5>

                    <h4 class="font-weight-bold blue-text">
                      <strong>Commandé le '.$date.' </strong>
                    </h4>
                    </div></section>';
      }
    ?>
  </div>
  </main>
  <!--Main layout-->
</body>

</html>