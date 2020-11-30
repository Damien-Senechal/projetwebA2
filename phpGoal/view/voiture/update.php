<form method="get" action="index.php">
  <fieldset>
    <legend>Mon formulaire :</legend>
    <p>
    <?php $controller = static::$object; ?>
    <input type='hidden' name='action' value='<?php echo $name ?>'>
      <label for="immat_id">Immatriculation</label> :
      <input type="text" value ="<?php echo $immatriculation ?>" name="immatriculation" id="immat_id" required <?php echo $read ?>/>

      <label for="coul_id">Couleur</label> :
      <input type="text" value="<?php echo $couleur ?>" name="couleur" id="coul_id" required/>

      <label for="marq_id">Marque</label> :
      <input type="text" value="<?php echo $marque ?>" name="marque" id="marq_id" required/>
    </p>
    <p>
      <input type="submit" value="Envoyer" />
    </p>
  </fieldset> 
</form>