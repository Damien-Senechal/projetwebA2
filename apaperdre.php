<!DOCTYPE html>
<html lang="en">

<head>
  
</head>

<body>
  <!--Main layout-->
  <?php
    $id_produit = $_GET['id_produit'];
    $produit = ModelProduit::getProduitById($id_produit);
    $image = $produit->get('urlImage_produit');
    $nom_produit = $produit->get('nom_produit');
    $categorie_produit = $produit->get('categorie_produit');
    $prix_produit = $produit->get('prix_produit');
    $description_produit = $produit->get('desc_produit');
    $stock_produit = $produit->get('stock_produit');
  ?>
  <main class="mt-5 pt-4">
  <script>
   function displayPrice(){
       var nbProduit = document.getElementById("nombre").value;
       var prix = <?php echo $prix_produit ?>;
       var nom = "<?php echo $nom_produit ?>";
       var total = 0;
       var total = nbProduit * prix;
       var tot = total.toFixed(2);
       document.getElementById("total_prix").innerHTML = " Total : " + tot + " € ";
       document.getElementById('tamponNom').innerHTML = nom;
       document.getElementById('tamponPrix').innerHTML = prix;
       document.getElementById('tamponProduit').innerHTML = nbProduit;
       document.write('<form method="get" class="d-flex justify-content-left" action="index.php">'+
                      '<button class="btn btn-primary btn-md my-0 p" type="submit">'+
                      '<i style = "font-size: 20px" id="total_prix" class="fas fa-shopping-cart ml-1">'+
                      <?php echo  'Total : '.$prix_produit.' €'; ?> +
                      '</i>'+'<br>'+'Ajouter Panier'+ '</button>');
       document.write('<input type="hidden" name="action" value="afficherPanier">'+
                      '<input type="hidden" name="controller" value="produits">'+
                      '<input type="hidden" name="nom_produit" value="'+nom+'">'+
                      '<input type="hidden" name="prix_produit" value="'+prix+'">'+
                      '<input type="hidden" name="qaProduit" value="'+nbProduit+'">');
       document.write('</form>')

       // <?php 
       //      $nom = "<div id='tamponNom'></div>";
       //      strip_tags($nom);
       //      $prix = "<div id='tamponPrix'></div>";
       //      strip_tags($prix);
       //      $qqt = "<div id='tamponProduit'></div>";
       //      strip_tags($qqt);
       //  ?>f
     }

   </script>
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
            <h4 class="my-4 h4"><?php echo $nom_produit ?></h4>

            <div class="mb-3">
              <a>
                <span class="badge purple mr-1"><?php echo $categorie_produit ?></span>
              </a>
              <a>
                <span class="badge orange mr-1"> -25% </span>
              </a>
            </div>
            <p class="lead">
              <span class="mr-1">
                <del><?php echo $prix_produit * 1.5 . '€' ?></del>
              </span>
              <span><?php echo $prix_produit . '€' ?> </span>
            </p>

            <p class="lead font-weight-bold">Description</p>

              <?php
              echo '
              <input type="number" for="nombre" id="nombre" value="1" aria-label="Search" class="form-control" onchange="displayPrice()" style="width: 100px" min="1" max="'. $stock_produit.'">';
              ?>

            <!-- <form method="get" class="d-flex justify-content-left" action="index.php">
              <button class="btn btn-primary btn-md my-0 p" type="submit">
                <i style = "font-size: 20px" id="total_prix" class="fas fa-shopping-cart ml-1"> <?php //echo  'Total : '.$prix_produit.' €'; ?></i>

                <br>
                 Ajouter au panier 
                
              </button> -->
            <!-- action=afficherPanier&controller=produit&nom_produit=CookieOGalak&prix_produit=4.5&qaProduit=2 -->
            <?php
              //echo $qqt ;
              //var_dump($qqt);
              //echo '<input type="hidden" name="action" value="afficherPanier">';
              //echo '<input type="hidden" name="controller" value="produits">';
              //echo '<input type="hidden" name="nom_produit" value="'.$nom.'">';
              //echo '<input type="hidden" name="prix_produit" value="'.$prix.'">';
              //echo '<input type="hidden" name="qaProduit" value="'.$qqt.'">';

              ?>
            <!-- </form> -->

          </div>
          <!--Content-->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <hr> 
      <!--c kwa?-->
      <!-- Aucunes idées mais on le laisse pour le lore -->

      <!--Grid row-->
      <div class="row d-flex justify-content-center wow fadeIn">

        <?php 
          $tab_produits = ModelProduit::getAllProduits();
          $tailleTab = sizeof($tab_produits);

          $premierCookie = rand(0, $tailleTab-1);
          while ($tab_produits[$premierCookie ]->get('id_produit') == $id_produit) {
            $premierCookie = rand(0, $tailleTab-1);
          }
          $deuxiemeCookie = rand(0, $tailleTab-1);
          while ($premierCookie == $deuxiemeCookie | $tab_produits[$deuxiemeCookie ]->get('id_produit') == $id_produit) {
            $deuxiemeCookie = rand(0, $tailleTab-1);
          }

          $troisiemeCookie = rand(0, $tailleTab-1);
          while ($premierCookie == $troisiemeCookie | $deuxiemeCookie == $troisiemeCookie | $tab_produits[$troisiemeCookie ]->get('id_produit') == $id_produit) {
            $troisiemeCookie = rand(0, $tailleTab-1);
          }

          $image1 = $tab_produits[$premierCookie]->get('urlImage_produit');
          $image2 = $tab_produits[$deuxiemeCookie]->get('urlImage_produit');
          $image3 = $tab_produits[$troisiemeCookie]->get('urlImage_produit');
          $id1 = $tab_produits[$premierCookie]->get('id_produit');
          $id2 = $tab_produits[$deuxiemeCookie]->get('id_produit');
          $id3 = $tab_produits[$troisiemeCookie]->get('id_produit');

         
          echo '
        <!--Grid column-->
        <div class="col-md-6 text-center">

          <h4 class="my-4 h4">Tas capté?</h4>

          <p>
          T\'AS CAPTÉ QUE C\'EST QUE DE LA QUALITÉ FRÉROT ! <br>
          Les cookies, ils viennent des meilleures régions de France, et tmtc que nos régions ont du talent takapté

          </p>

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-lg-4 col-md-12 mb-4">
          <h4 class="my-4 h4"><center>'.$tab_produits[$premierCookie]->get('nom_produit').'</center></h4>
          <a href="index?action=produitDetail&controller=produit&id_produit='.$id1.'"> <img src= '.$image1.' class="img-fluid"> </a>
          <h4 class="my-4 h4"><center>'.$tab_produits[$premierCookie]->get('prix_produit').' €</center></h4>

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-4 col-md-6 mb-4">
          <h4 class="my-4 h4"><center>'.$tab_produits[$deuxiemeCookie]->get('nom_produit').'</center></h4>
          <a href="index?action=produitDetail&controller=produit&id_produit='.$id2.'"> <img src= '.$image2.' class="img-fluid"> </a>
          <h4 class="my-4 h4"><center>'.$tab_produits[$deuxiemeCookie]->get('prix_produit').' €</center></h4>

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-4 col-md-6 mb-4">
          <h4 class="my-4 h4"><center>'.$tab_produits[$troisiemeCookie]->get('nom_produit').'</center></h4>
          <a href="index?action=produitDetail&controller=produit&id_produit='.$id3.'"> <img src= '.$image3.' class="img-fluid"> </a>
          <h4 class="my-4 h4"><center>'.$tab_produits[$troisiemeCookie]->get('prix_produit').' €</center></h4>

        </div>
        <!--Grid column-->'
        ?>
      </div>
      <!--Grid row-->

    </div>
  </main>
  <!--Main layout-->
</body>

</html>










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







echo '
                                <div class="col-lg-3 col-md-6 mb-4">
                                  <div class="card">
                                    <div class="card-body text-center">
                                    Produit n°'.($i + 1).' : <br><br>
                                    '.$nom_produit.' <br>
                                    <a href="index?action=produitDetail&controller=produit&id_produit='.$id_produit.'">
                                    <img src="'.$image_produit.'" class="img-fluid" alt=""><br></a>'; 
                                    if (htmlspecialchars($_SESSION['panier'][$i]['qaProduit']) == 1) 
                                      echo htmlspecialchars($_SESSION['panier'][$i]['qaProduit']).' produit <br><br>';
                                    else 
                                      echo '<strong> ' .htmlspecialchars($_SESSION['panier'][$i]['qaProduit']).' produits </strong><br>'. 
                                    'Prix produit - '.$prix_produit.'€ <br> ';
                                    echo ' <div style = "color : red;"> Prix total - '.htmlspecialchars($_SESSION['panier'][$i]['qaProduit']) * $prix_produit.'€ 
                                    </div>
                                  </div>
                                </div>
                                ';







<!DOCTYPE html>

<html lang="fr">
  <body>
    <main class="mt-5 pt-4">
      <form method="post" action="panier.php">
        <div class="container" style="margin-top: 5%">
        <!--Card content-->
          <div class="card" style="margin-top: 5%">
            <section class="text-center mb-4">
              
              <!--Category & Title-->
              <a class="grey-text">
                <h5>Votre panier</h5>
              </a>
              <h5>
                <strong>
                  <a class="dark-grey-text">
                    <?php
                    if (ControllerProduit::creerPanier())
                    { 
                      $nbArticles=count($_SESSION['panier']);
                      if ($nbArticles <= 0)
                        echo "Votre panier est vide ";
                      else
                      {
                      echo '
                      <span class="badge badge-pill danger-color" style="font-size : 130%"> Montant du panier : '.ControllerProduit::totalPrix().'€</span>
                      ';
                        for ($i=0 ;$i < $nbArticles ; $i++)
                        {
                          $id_produit = htmlspecialchars($_SESSION['panier'][$i]['idProduit']);
                          $produit = ModelProduit::getProduitById($id_produit);
                            $nom_produit = $produit->get('nom_produit');
                            $image_produit = $produit->get('urlImage_produit');
                            $prix_produit = $produit->get('prix_produit');

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
                        echo "  </section>
                              </div>";
                        //echo "<td>".htmlspecialchars($_SESSION['panier'][$i]['prixProduit'])."</td>";
                        // echo "<td><a href=\"".htmlspecialchars("panier.php?action=suppression&l=".rawurlencode($_SESSION['panier']['id_produit'][$i]))."\">XX</a></td>";
                        // echo "</tr>";
                    }
                  }
                ?>
          </div>
        </div>
      </form>
    </main>
  </body>
</html>











viewListeCommande :
<!DOCTYPE html>
<html lang="en">

<head>
  
</head>

<body>
  <!--Main layout-->
  <main class="mt-5 pt-4">
    <div class="container" style="margin-top: 5%">
    <?php
    foreach ((array) $listeCommandes as $key => $value) {
      $commande = ModelCommande::getCommandeById($value[0]);
      $id = $commande->get('id_commande');
      $id_client = $commande->get('id_client');
      $date = $commande->get('date_commande');
      $prix = $commande->get('prix_commande');
        $utilisateur = ModelUtilisateur::getUtilisateurById($id_client);
          $nom = $utilisateur->get('nom_utilisateur');
          $prenom = $utilisateur->get('prenom_utilisateur');
          $image = $utilisateur->get('image_utilisateur');
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
                        <a class="dark-grey-text"> Commandé par ' .$nom. ' <br><br>
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



//view enregistrer



                    <label>Prenom :</label>
                    <input type="text" required name="prenom_utilisateur"'; 
                    if (isset($_SESSION['formPrenom'])){
                    echo 'value="' . $_SESSION['formPrenom'] . '"/>

                    <label>Email :</label>
                    <input type="email" required name="mail_utilisateur"'; 
                    if (isset($_SESSION['formMail'])){
                    echo 'value="' . $_SESSION['formMail'] . '"/>

                    <label>Adresse :</label>
                    <input type="text" required name="adresse_utilisateur"'; 
                    if (isset($_SESSION['formAdresse'])){
                    echo 'value="' . $_SESSION['formAdresse'] . '"/>

                    <label>Date de naissance :</label>
                    <input type="date" required name="ddn_utilisateur"'; 
                    if (isset($_SESSION['formDDN'])){
                    echo 'value="' . $_SESSION['formDDN'] . '"/>

                    <label>Histoire :</label>
                    <input type="text" name="histoire_utilisateur"'; 
                    if (isset($_SESSION['formHistoire'])){
                    echo 'value="' . $_SESSION['formHistoire'] . '"/>

                    <label>Photo de profil</label>
                    <input type="file" name="photo_utilisateur" accept=".png, .jpeg, .jpg"/>

                    <label>Mot de passe :</label>
                    <input type="password" name="mdp_utilisateur" minlength="8" required '; 
                    if (isset($_SESSION['formMdp1'])){
                    echo 'value="' . $_SESSION['formMdp1'] . '"/>

                    <label>Confirmer le mot de passe :</label>
                    <input type="password" name="mdp_utilisateur2" minlength="8" required'; 
                    if (isset($_SESSION['formMdp2'])){
                    echo 'value="' . $_SESSION['formMdp2'] . '"/>