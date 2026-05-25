<?php include('db.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ajouter un article</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section>
        <h2>Ajouter une nouvelle montre</h2>
        <form action="ajouter.php" method="POST" enctype="multipart/form-data">//enctype pour send both data string etc w photo
    <div>
        <label for="mod">Modèle :</label>
        <input type="text" id="mod" name="modele" required>
    </div>
    <div>
        <label for="pr">Prix (DA) :</label>
        <input type="number" id="pr" name="prix" required>
    </div>
    <div>
        <label for="st">Stock :</label>
        <input type="number" id="st" name="stock" required>
    </div>
    <div>
        <label for="img">Choisir l'image :</label>
        <input type="file" id="img" name="image" accept="image/*" required>
    </div>
    <input type="submit" name="valider" value="Ajouter au stock">
</form>

        <?php
if(isset($_POST['valider'])) {
    $m = $_POST['modele'];
    $p = $_POST['prix'];
    $s = $_POST['stock'];

    $nom_image = $_FILES['image']['name']; // Nom fichier
    $destination = "images/" . $nom_image; // Chemin to save yji ki tdir image

    // On deplace le fichier du dossier temporaire vers dossier "images" psk ydir fichier temp apres ybaet l dossier w T/F
    if(move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
        //on enregistre le chemin f bd
        $sql = "INSERT INTO montres (modele, prix, quantite_stock, image_url) 
                VALUES ('$m', '$p', '$s', '$destination')";
        
        if(mysqli_query($conn, $sql)) {
            echo "<p style='color:green;'>Montre ajoutée avec succès ! <a href='admin.php'>Retour</a></p>";
        }
    } else {
        echo "<p style='color:red;'>Erreur lors du téléchargement de l'image.</p>";
    }
}
?>
    </section>
</body>
</html>