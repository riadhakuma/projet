<?php 
include('db.php'); 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Boutique de Montres</title>
    <link rel="stylesheet" href="style.css">
    <style>
        
        .navbar { 
            background: #222; 
            padding: 15px; /*espace entre cadre et texte*/
            display: flex; /*alligne les enfant dakhel la mere*/
            justify-content: space-between; /*aligne droite gauche au bout plus fragh entre les deux*/
            align-items: center;
            border-bottom: 2px solid black;/*ligne*/
        }
        .navbar a { color: white; margin-left: 15px; text-decoration: none; font-weight: bold; }/*margin ydir vide*/
        .navbar a:hover { color: cyan; }
        .solde { color: lime; font-weight: bold; margin-left: 10px; }
        .admin-link { color: orange !important; border: 1px solid orange; padding: 5px; border-radius: 5px; }
    </style>
</head>
<body>

    <nav class="navbar">
        <div>
            <a href="index.php" style="font-size: 1.2em;"> Ma Boutique</a>//deux fois le pere em
        </div>
        <div>
            <?php if(isset($_SESSION['user_role'])): ?>/* nftho condition hka ida vrai ydir wch moraha sinon ysoti hka bach maytkhltoch les "" etc*/
                <span>Connecté : <?php echo $_SESSION['user_role']; ?></span>
                
                <?php if($_SESSION['user_role'] == 'client'): ?>
                    <?php 
                        $uid = $_SESSION['user_id'];
                        $res_u = mysqli_query($conn, "SELECT solde FROM utilisateurs WHERE id=$uid");
                        $u = mysqli_fetch_assoc($res_u);
                    ?>
                    <span class="solde">| Solde : <?php echo $u['solde']; ?> DA</span>
                <?php endif; ?>

                <?php if($_SESSION['user_role'] == 'admin'): ?>
                    <a href="admin.php" class="admin-link">Espace Admin</a>
                <?php endif; ?>
                
                <a href="logout.php" style="color:red;">Déconnexion</a>
            <?php else: ?>
                <a href="login.php">Se connecter</a>
                <a href="inscription.php">S'inscrire</a>
            <?php endif; ?>
            <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'): ?>
            <a href="admin.php" style="color: orange; font-weight: bold;">[ Accès Admin ]</a>
            <?php endif; ?>
            </div>
            </nav>
    <h1>Nos Montres en Stock</h1>

    <section>
        <?php
        /*Requete des montres*/
        $requete = "SELECT * FROM montres";
        $resultat = mysqli_query($conn, $requete);

        /* Boucle pour afficher chaque montre */
       while ($ligne = mysqli_fetch_assoc($resultat)) {
    echo "<article>";
    echo "<img src='" . $ligne['image_url'] . "' alt='Photo' style='width:150px;'>";
    echo "<h3>" . $ligne['modele'] . "</h3>";
    echo "<p>Prix : " . $ligne['prix'] . " DA</p>";
    echo "<p>Stock : " . $ligne['quantite_stock'] . "</p>";
    
    echo "<form action='traitement_achat.php' method='POST'>";
    echo "<input type='hidden' name='montre_id' value='" . $ligne['id'] . "'>";

    if ($ligne['quantite_stock'] > 0) {
    echo "<button type='submit'>Acheter</button>";
    } else {
    echo "<button disabled style='background:grey; cursor:not-allowed;'>Rupture de stock</button>";
    }
    echo "</form>";
    
    echo "</article>";
    }
        ?>
    </section>
</body>
</html>