<?php
$serveur = "localhost";
$user = "root";
$mdp = "";
$base = "boutique_db";
$conn = mysqli_connect($serveur, $user, $mdp, $base,3308);
if (!$conn) {
    die("La connexion a échoué : " . mysqli_connect_error());
}
?>