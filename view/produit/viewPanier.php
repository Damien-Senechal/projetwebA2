<!DOCTYPE html>

<html lang="fr">
  <body>
    <form method="post" action="panier.php">
        <?php
          if (creationPanier())
          { 
              $nbArticles=count($_SESSION['panier']['nomProduit']);
              if ($nbArticles <= 0)
              echo "<tr><td>Votre panier est vide </ td></tr>";
              else
              {
                  for ($i=0 ;$i < $nbArticles ; $i++)
                  {
                      echo "<tr>";
                      echo "<td>".htmlspecialchars($_SESSION['panier']['nomProduit'][$i])."</ td>";
                      echo "<td><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['qaProduit'][$i])."\"/></td>";
                      echo "<td>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])."</td>";
                      echo "<td><a href=\"".htmlspecialchars("panier.php?action=suppression&l=".rawurlencode($_SESSION['panier']['nomProduit'][$i]))."\">XX</a></td>";
                      echo "</tr>";
                  }

                  echo "<tr><td colspan=\"2\"> </td>";
                  echo "<td colspan=\"2\">";
                  echo "Total : ".MontantGlobal();
                  echo "</td></tr>";

                  echo "<tr><td colspan=\"4\">";
                  echo "<input type=\"submit\" value=\"Rafraichir\"/>";
                  echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";

                  echo "</td></tr>";
              }
          }
        ?>
    </form>
  </body>
</html>