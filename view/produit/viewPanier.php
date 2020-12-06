<!DOCTYPE html>
<html>
<head>
  
</head>
  <body>
    <!--Main layout-->

    <main>

      <div class="container" style="margin-top: 5%">
        <!--Section: Products v.3-->
        <section class="text-center mb-4">
          <div class="row wow fadeIn">
            <?php 
            $id = $_GET['id_client'];  
            $details = ModelCommandes::getDetailsFromCommande($id);      
            ?>
          </div>
        </section>
        <!--Section: Products v.3-->
      </div>

    </main>
    <!--Main layout--> 
  </body>
</html> 