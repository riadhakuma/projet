<?php
include('db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $montre_id = $_POST['montre_id'];

    /*prix de la montre et le solde du user*/
    $res_m = mysqli_query($conn, "SELECT prix, modele FROM montres WHERE id=$montre_id");
    $montre = mysqli_fetch_assoc($res_m);
    
    $res_u = mysqli_query($conn, "SELECT solde FROM utilisateurs WHERE id=$user_id");
    $user = mysqli_fetch_assoc($res_u);

    $prix = $montre['prix'];
    $solde_actuel = $user['solde'];

    echo "<div style='background-color: grey; color: white; text-align: center; padding: 50px; font-family: Arial;'>";

    /*Vérifi du solde*/
    if ($solde_actuel >= $prix) {
        /* Calcul du nouveau solde */
        $nouveau_solde = $solde_actuel - $prix;

        /* Maj dans la base de données*/
        mysqli_query($conn, "UPDATE utilisateurs SET solde = $nouveau_solde WHERE id = $user_id");
        mysqli_query($conn, "UPDATE montres SET quantite_stock = quantite_stock - 1 WHERE id = $montre_id");

        echo "<h2 style='color:lime;'>Achat réussi !</h2>";
        echo "<p>Vous avez acheté la montre : " . $montre['modele'] . "</p>";
        echo "<p>Nouveau solde : " . $nouveau_solde . " $</p>";
    } else {
        /*solde est insuffisant */
        echo "<h2 style='color:red;'>Erreur : Solde insuffisant !</h2>";
        echo "<p>Le prix est de $prix $, mais vous n'avez que $solde_actuel $.</p>";
    }

    echo "<p><em>Redirection vers l'accueil...</em></p>";
    echo "</div>";

    header("refresh:1; url=index.php");
} else {
    echo "Veuillez vous connecter pour acheter.";
    header("Location: login.php");
    exit();
}
?>