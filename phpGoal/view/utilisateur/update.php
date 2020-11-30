<form method="get" action="index.php">
  <fieldset>
    <legend>Mon formulaire :</legend>
    <p>
    <?php $controller = static::$object; ?>
    <input type='hidden' name='action' value='<?php echo $name ?>'>
      <label for="immat_id">Login</label> :
      <input type="text" value ="<?php echo $login ?>" name="immat" id="immat_id" required <?php echo $read ?>/>

      <label for="coul_id">Nom</label> :
      <input type="text" value="<?php echo $nom ?>" name="couleur" id="coul_id" required/>

      <label for="marq_id">Prenom</label> :
      <input type="text" value="<?php echo $prenom ?>" name="marque" id="marq_id" required/>
    </p>
    <p>
      <input type="submit" value="Envoyer" />
    </p>
  </fieldset> 
</form>