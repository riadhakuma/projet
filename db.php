<?php
$serveur = "localhost";
$user = "root";
$mdp = "";
$base = "boutique_db";

// Creation de la connexion
$conn = mysqli_connect($serveur, $user, $mdp, $base,3307);

if (!$conn) {
    die("La connexion a échoué : " . mysqli_connect_error());
}
?>