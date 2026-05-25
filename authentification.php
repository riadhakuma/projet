<?php
include('db.php');
session_start(); /* Permet de garder l'utilisateur connecté*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {/*hnaya l post bach tvirifyi belik ja b option machi lien*/
    $email = $_POST['email'];
    $mdp = $_POST['password'];

    // on cherche si le mail existe
    $sql = "SELECT * FROM utilisateurs WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    // l'email existe si nb lignes 1
    if (mysqli_num_rows($result) == 1) {
        // data du user
        $user = mysqli_fetch_assoc($result); 
        
        // verifie le mdp
        if ($user['mot_de_passe'] == $mdp) {
            //si true on ouvre session
            $_SESSION['user_id'] = $user['id']; 
            $_SESSION['user_role'] = $user['role']; 
            
            // Redirection role
            if ($user['role'] == 'admin') {
                header("Location: admin.php"); 
            } else {
                header("Location: index.php");
            }
            exit(); // tjr apres redirection 
        } else {
            /*l'email est bon mais le mot de passe nope*/
        echo "<style>body { background-color: grey; margin: 0; padding: 0; }</style>";
        echo "<div style='color: white; text-align: center; padding: 50px; font-family: Arial;'>";
        echo "<h2 style='color:red;'>Mot de passe incorrect !</h2>";
        echo "<p><a href='login.php' style='color:cyan;'>Réessayer</a></p>";
        echo "</div>";
        }
        } else {
        /*email n'existe pas*/
        echo "<style>body { background-color: grey; margin: 0; padding: 0; }</style>";
        echo "<div style='color: white; text-align: center; padding: 50px; font-family: Arial;'>";
        echo "<h2 style='color:red;'>Utilisateur non trouvé !</h2>";
        echo "<p>Cet email n'est associé à aucun compte.</p>";
        echo "<p><a href='login.php' style='color:cyan;'>Réessayer</a> ou <a href='inscription.php' style='color:lime;'>Créer un compte</a></p>";
        echo "</div>";
    }
}
?>