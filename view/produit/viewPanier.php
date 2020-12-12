<!DOCTYPE html>
<head>
  <script type="text/javascript">
  </script>
  <style type="text/css">
    span:hover{
      box-shadow: 2px 2px 3px black;
    }
  </style>
</head>
<html lang="fr">
  <body>
    <main class="mt-5 pt-4">
      <div class="container" style="margin-top: 5%">
          <h5>
            <strong>
          
                <?php
                if (ControllerProduit::creerPanier())
                { 
                  $nbArticles=count($_SESSION['panier']);
                  if ($nbArticles <= 0)
                    echo '
                    <div style = "display : flex; justify-content: center; margin-bottom : 5%">
                      <span class="badge badge-pill danger-color" style="font-size : 130%"> Votre panier est vide </span>
                    </div>
                    <img style = "display: block; margin : auto" src="template/img/hrugPapi.png" class="img-fluid" alt="¯\_(ツ)_/¯">
                    <center>
                    <a style="margin-top : 2%; color : red" class="nav-link border border-light rounded waves-effect" href="index?action=accueil&controller=utilisateur">➡ revenir à l\'accueil ⬅</a>
                    </center>';
                  else
                  {
                  echo '
                    <div class="card" style="align-items : row;">
                      <section class="text-center mb-4" style = "margin-top: 1%">
                      <a class="grey-text">
                        <h2>Votre panier</h2>
                      </a>
                      <span class="badge badge-pill danger-color" style="font-size : 130%"> Montant du panier : '. ControllerProduit::totalPrix().' €</span>
                        <div class="container">
                        <section class="text-center mb-4">
                        <div class="row wow fadeIn">';

                        $i = 1;
                        foreach ($_SESSION['panier'] as $key => $value)
                        {
                            $id_produit = htmlspecialchars($_SESSION['panier'][$key]['idProduit']);
                            $produit = ModelProduit::getProduitById($id_produit);
                            $nom_produit = $produit->get('nom_produit');
                            $image_produit = $produit->get('urlImage_produit');
                            $prix_produit = $produit->get('prix_produit');
                            $stock_produit = $produit->get('stock_produit');
                            $prix_total = $_SESSION['panier'][$key]['qaProduit'] * $prix_produit;

                            echo '
                            <div class="col-lg-3 col-md-6 mb-4">
                                <!--Card-->
                                <div class="card">
                                  <!--Card image-->
                                  <div class="card-body text-center">
                                Produit n°'. $i .' :
                                <br>
                                <i> '.$nom_produit.' </i>
                                <a href="index?action=produitDetail&controller=produit&id_produit='.$id_produit.'">
                                <img src="'.$image_produit.'" class="img-fluid" alt="">
                                </a>

                                <!--changé Quantité et suppimer produit :   onchange="displayPrice()"  --!>
                                

                                <form method="get" action="index.php">
                                  <strong>Quantité : 
                                    <input type="number" for="nombre" id="nombre" value="'. $_SESSION['panier'][$key]['qaProduit'].'" aria-label="Search" name="qa_produit" style="width: 70px; margin-bottom : 2%" min="1" max="'. $stock_produit.'">
                                    <div id = "action">
                                      <input type="hidden" name="action" value="majQaProduit">
                                    </div>
                                    <input type="hidden" name="controller" value="Produits">
                                    <input type="hidden" name="id_produit" value="' .$_SESSION['panier'][$key]['idProduit'].'">
                                </strong>';
                                  ?>
                                <?php 
                                echo '
                                
                                Prix produit : '.$prix_produit.'€
                                <div style="color : red; margin-top : 5%"> Prix total : '.$prix_total.'€ 
                                <div style="display : flex; font-size : 73%; margin-top : 5%; justify-content: center;">
                                  <button type="submit" style = "color : #2196f3; border-color : #e0e0e0; background-color : white; outline : none;  border-radius: 0.25rem; background-color:transperant; outline:none; ">
                                      <i class="">Actualiser</i>
                                  </button>';?>
                                  <?php 
                                  echo '
                                  <a href="index?action=supprimerProduit&controller=produit&id_produit='.$_SESSION['panier'][$key]['idProduit'].'" class="nav-link border border-light rounded waves-effect" style="color : red; box-shadow: 1px 1px 1px gray;;"> '?>
                                    <i class=""></i>Supprimer
                                  </a>
                                  </form>
                                  </div>

                                </div>
                                <?php 
                                $i = $i + 1;
                                echo ' 
                                </div> 
                                </div> 
                                </div>
                                ';
                                  } 
                              echo '  
                              </div>
                              <a href="index?action=magasinProduit&controller=produit">
                                <span class="badge badge-pill blue" style="font-size : 130%; margin-right : 5%; border-radius : 0px"> ⬅ Poursuivre les achats</span>
                              </a>
                              <a href="index?action=validerPanier&controller=commande">
                                <span class="badge badge-pill danger-color" style="font-size : 130%; border-radius : 0px;"> Proceder au paiement ➡</span>
                              </a>
                              </section>
                            </div>
                            </a>
                            </strong>
                        </h5>
                        </div>
                        </section>
                    </div>';
                    }
                  }
                ?>

        </div>
    </main>
  </body>
</html>