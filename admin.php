<?php 
session_start();
if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("Location: login.php");
    exit();
}
include('db.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gestion du Stock - Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Tableau de Bord Administrateur</h1>
    
    <section>
        <h2>Liste des Montres en Stock</h2>
        <table border="1" style="width:100%; color:white; border-collapse: collapse;">/*border collapse bach ylsqo les tableau*/
            <tr style="background-color: black;">
                <th>Modèle</th>
                <th>Prix (DA)</th>
                <th>Quantité</th>
                <th>Actions</th>
            </tr>
            <?php
            $res = mysqli_query($conn, "SELECT * FROM montres");
            while($m = mysqli_fetch_assoc($res)) {/*resultat en tant que tab*/
                echo "<tr>";//t row w t data 
                echo "<td>".$m['modele']."</td>";
                echo "<td>".$m['prix']."</td>";
                echo "<td>".$m['quantite_stock']."</td>";
                echo "<td>
                        <a href='modifier.php?id=".$m['id']."' style='color:cyan;'>Modifier</a> | 
                        <a href='supprimer.php?id=".$m['id']."' style='color:red;'>Supprimer</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </table>
        <br>
        <a href="ajouter.php" style="background: green; color: white; padding: 10px; text-decoration: none;">+ Ajouter une montre</a>
    </section>

    <p><a href="index.php">Retour au site</a> | <a href="logout.php">Déconnexion</a></p>
</body>
</html>