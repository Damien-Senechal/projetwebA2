<?php
foreach ($tab_v as $u){

    $uLogin = $u->get('login');
    echo '<p> Utilisateur de login : <a href="index.php?controller=utilisateur&action=read&login='. rawurlencode($uLogin) . '">' . htmlspecialchars($uLogin) . '</a></br>';
    echo "<a href='index.php?controller=utilisateur&action=delete&login=" . rawurlencode($uLogin) . "'>Supprimer l'utilisateur !</a></br>";
        echo "<a href='index.php?controller=utilisateur&action=update&login=" . rawurlencode($uLogin) . "'>Modifier l'utilisateur !</a></p>";
}
?>