<?php
$mail= '<html>
<head>
  <title>Mail de fin de validation de compte de Cookie Paradise</title>
</head>
<body>
  <p>Merci de vous être inscrit sur notre site.</p>
  <a href="https://webinfo.iutmontp.univ-montp2.fr/~garcial/eCommerce/index.php?mail_utilisateur='.$htmlSpecialMail.'&nonce_utilisateur='.$nonce.'&action=valider&controller=utilisateur"><i>Cliquez ici pour valider votre compte</i></a>
</body>
</html>';
mail($htmlSpecialMail, "Validation compte", $mail);
echo '<div style = "display : flex; justify-content: center;margin-top : 5%; margin-bottom : 5%">
      <span class="badge badge-pill danger-color" style="font-size : 130%"> Le mail a été envoyé ! </span>
    </div>
    <img style = "display: block; margin : auto" src="template/img/mecContent.png" class="img-fluid" alt="¯\_(ツ)_/¯">
    <center>
    <a style="margin-top : 2%; color : red" class="nav-link border border-light rounded waves-effect" href="index.php?action=accueil&controller=utilisateur">➡ revenir à l\'accueil ⬅</a>
    </center>';
?>