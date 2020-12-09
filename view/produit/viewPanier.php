<!DOCTYPE html>

<html lang="fr">
  <body>
    <main class="mt-5 pt-4">
      <div class="container" style="margin-top: 5%">
              <a class="grey-text">
                <h5>Votre panier</h5>
              </a>
              <h5>
                <strong>
                    <?php
                    if (ControllerProduits::creerPanier())
                    { 
                      $nbArticles=count($_SESSION['panier']);
                      if ($nbArticles <= 0)
                        echo "Votre panier est vide ";
                      else
                      {
                      echo '
                        <div class="card" style="margin-top: 5%; align-items : row;">
                          <span class="badge badge-pill danger-color" style="font-size : 130%"> Montant du panier : '.ControllerProduits::totalPrix().'€</span>
                            <div class="card" style="margin-top: 5%">
                      ';
                        for ($i=0 ;$i < $nbArticles ; $i++)
                        {
                            $id_produit = htmlspecialchars($_SESSION['panier'][$i]['idProduit']);
                            $produit = ModelProduits::getProduitById($id_produit);
                            $nom_produit = $produit->get('nom_produit');
                            $image_produit = $produit->get('urlImage_produit');
                            $prix_produit = $produit->get('prix_produit');
                            $prix_total = $_SESSION['panier'][$i]['qaProduit'] * $prix_produit;

                            echo '
                            <div class="col-lg-3 col-md-6 mb-4">
                                <!--Card-->
                                <div class="card">
                                  <!--Card image-->
                                  <div class="card-body text-center">
                                Produit n°'.$i.' : <br><br>
                                '.$nom_produit.' <br>
                                <a href="index?action=produitDetail&controller=produits&id_produit='.$id_produit.'">
                                <img src="'.$image_produit.'" class="img-fluid" alt=""><br></a>';
                                if ($_SESSION['panier'][$i]['qaProduit'] == 1) 
                                  echo '<strong>1 produit acheté <br><br></strong>';
                                else 
                                  echo '<strong>'.$_SESSION['panier'][$i]['qaProduit'].' produits achetés <br></strong>'
                                  . ' Prix produit - '.$prix_produit.'€ ';
                                echo '
                                <div style="color : red;"> Prix total - '.$prix_total.'€ 
                                </div>
                                ';
                                $i = $i + 1;
                                echo ' 
                                </div> 
                                </div> 
                                </div>
                                </div>
                                </div>';
                        } 
                        echo "  
                        </a>
                      </strong>
                    </h5>";
                    }
                  }
                ?>
          </div>
        </div>
    </main>
  </body>
</html>