<div class="col-lg-3 col-md-6 mb-4">
                              <!--Card-->
                              <div class="card">
                                <!--Card image-->
                                <div class="card-body text-center">
                            Produit n°'.$i.' : <br><br>
                            '.$nom_produit.' <br>
                            <a href="index?action=produitDetail&controller=produits&id_produit='.$id_produit.'">
                            <img src="'.$image_produit.'" class="img-fluid" alt=""><br></a>';
                            if ($quantite_produit_detail == 1) 
                              echo $quantite_produit_detail.' produit acheté <br>';
                            else 
                              echo $quantite_produit_detail.' produits achetés <br>'
                              . 'Prix produit - '.$prix_produit.'€ <br> 