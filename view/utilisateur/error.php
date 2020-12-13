<?php
    echo '
    <span class="badge badge-pill danger-color" style="display: block; margin-left: 20%; margin-right: 20%; font-size : 130%; margin-top : 5%">Erreur : '.$message.'</span>
    <img style = "display: block; margin : auto" src="template/img/erreur.png" class="img-fluid" alt="¯\_(ツ)_/¯">
    <center>
    <a style="margin-top : 2%; color : red" class="nav-link border border-light rounded waves-effect" href="index?action='.$action.'&controller='.$controller.'">➡ revenir en arrière ⬅</a>
    </center>';
?>
