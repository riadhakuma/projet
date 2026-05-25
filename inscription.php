<?php
include('db.php');
if(isset($_POST['inscrire'])) {
    $email = $_POST['email'];
    $mdp = $_POST['password'];

    /*verif si l'email existe dans la base*/
    $verification_sql = "SELECT * FROM utilisateurs WHERE email='$email'";
    $resultat_verification = mysqli_query($conn, $verification_sql);

    /*trouver donc erreur*/
    if (mysqli_num_rows($resultat_verification) > 0) {
        echo "<style>body { background-color: grey; margin: 0; padding: 0; }</style>";
        echo "<div style='color: white; text-align: center; padding: 50px; font-family: Arial;'>";
        echo "<h2 style='color:red;'>Inscription impossible !</h2>";
        echo "<p>L'adresse email <strong>" . htmlspecialchars($email) . "</strong> est déjà associée à un compte.</p>";
        echo "<p><a href='login.php' style='color:cyan;'>Se connecter avec ce compte</a> ou <a href='inscription.php' style='color:lime;'>Réessayer l'inscription</a></p>";
        echo "</div>";
        exit(); /*On stop*/
    } else {
        /*on cree sinon*/
        $sql = "INSERT INTO utilisateurs (email, mot_de_passe, role, solde) VALUES ('$email', '$mdp', 'client', 10000.00)";
        
        if(mysqli_query($conn, $sql)) {
            echo "<style>body { background-color: grey; margin: 0; padding: 0; }</style>";
            echo "<div style='color: white; text-align: center; padding: 50px; font-family: Arial;'>";
            echo "<h2 style='color:lime;'>Compte créé avec succès !</h2>";
            echo "<p>Bienvenue ! Votre compte a été configuré avec un solde initial de 10 000 DA.</p>";
            echo "<p><a href='login.php' style='color:cyan; font-weight:bold; font-size:1.2em;'>Cliquez ici pour vous connecter</a></p>";
            echo "</div>";
            exit(); /*On stop*/
        } else {
            echo "Erreur : " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Créer un compte</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Rejoignez notre Boutique</h1>
    <section>
        <h2>Inscription</h2>
        <form action="inscription.php" method="POST">
            <div>
                <label>Email :</label>
                <input type="email" name="email" required>
            </div>
            <div>
                <label>Mot de passe :</label>
                <input type="password" name="password" required>
            </div>
            <br>
            <input type="submit" name="inscrire" value="Créer mon compte (Bonus 10000 DA)">
        </form>
        <br>
        <a href="login.php">Déjà un compte ? Se connecter</a>
    </section>
</body>
</html>