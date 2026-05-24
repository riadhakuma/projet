<?php
include('db.php');
session_start(); // Permet de garder l'utilisateur connecté

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mdp = $_POST['password'];

    // ÉTAPE 1 : On cherche d'abord si l'email existe dans la base
    $sql = "SELECT * FROM utilisateurs WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    // Si le nombre de lignes est égal à 1, l'email existe
    if (mysqli_num_rows($result) == 1) {
        // On récupère les données de cet utilisateur
        $user = mysqli_fetch_assoc($result); 
        
        // ÉTAPE 2 : On vérifie si le mot de passe saisi correspond à celui de la base
        if ($user['mot_de_passe'] == $mdp) {
            // Si c'est correct, on ouvre la session
            $_SESSION['user_id'] = $user['id']; 
            $_SESSION['user_role'] = $user['role']; 
            
            // Redirection selon le rôle
            if ($user['role'] == 'admin') {
                header("Location: admin.php"); 
            } else {
                header("Location: index.php");
            }
            exit(); // Arrêt sécurisé du script après redirection
        } else {
            // Cas où l'email est bon mais le mot de passe est faux
            echo "<style>body { background-color: grey; margin: 0; padding: 0; }</style>";
        echo "<div style='color: white; text-align: center; padding: 50px; font-family: Arial;'>";
        echo "<h2 style='color:red;'>Mot de passe incorrect !</h2>";
        echo "<p><a href='login.php' style='color:cyan;'>Réessayer</a></p>";
        echo "</div>";
        }
        } else {
        //email n'existe pas
        echo "<style>body { background-color: grey; margin: 0; padding: 0; }</style>";
        echo "<div style='color: white; text-align: center; padding: 50px; font-family: Arial;'>";
        echo "<h2 style='color:red;'>Utilisateur non trouvé !</h2>";
        echo "<p>Cet email n'est associé à aucun compte.</p>";
        echo "<p><a href='login.php' style='color:cyan;'>Réessayer</a> ou <a href='inscription.php' style='color:lime;'>Créer un compte</a></p>";
        echo "</div>";
    }
}
?>

<?php
/*
include('db.php');
session_start(); // Permet de garder l'utilisateur connecté

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mdp = $_POST['password'];

    //cherche l'utilisateur
    $sql = "SELECT * FROM utilisateurs WHERE email='$email' AND mot_de_passe='$mdp'";
    $result = mysqli_query($conn, $sql);

   if (mysqli_num_rows($result) == 1) {
    //les données
    $user = mysqli_fetch_assoc($result); 
    
    //On remplit la session avec les infos
    $_SESSION['user_id'] = $user['id']; 
    $_SESSION['user_role'] = $user['role']; 
    
    //On redirige selon le rôle
    if ($user['role'] == 'admin') {
        header("Location: admin.php"); 
    } else {
        header("Location: index.php");
    }
    exit(); //exit après redirection,pourquoi ?
}
    } else {
        echo "<p style='color:red;'>Email ou mot de passe incorrect !</p>";
        echo "<a href='login.php'>Réessayer</a>";
    }
*/
?>
