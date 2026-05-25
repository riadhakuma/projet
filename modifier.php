<?php 
include('db.php'); 
session_start();
//en cas dacces sans etre admin
if($_SESSION['user_role'] != 'admin') { header("Location: login.php"); }

// info dee la montre
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $res = mysqli_query($conn, "SELECT * FROM montres WHERE id=$id");
    $data = mysqli_fetch_assoc($res);
}

// update
if(isset($_POST['update'])) {
    $id_cache = $_POST['id'];
    $mod = $_POST['modele'];
    $pri = $_POST['prix'];
    $sto = $_POST['stock'];

    $sql = "UPDATE montres SET modele='$mod', prix='$pri', quantite_stock='$sto' WHERE id=$id_cache";
    
    if(mysqli_query($conn, $sql)) {
        header("Location: admin.php");/*retour apres modif*/
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Modifier une montre</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Modifier l'article</h1>

    <section>
        <form action="modifier.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

            <div>
                <label for="mod">Modèle :</label>
                <input type="text" id="mod" name="modele" value="<?php echo $data['modele']; ?>" required>
            </div>

            <div>
                <label for="pr">Prix (DA) :</label>
                <input type="number" id="pr" name="prix" value="<?php echo $data['prix']; ?>" required>
            </div>

            <div>
                <label for="st">Stock :</label>
                <input type="number" id="st" name="stock" value="<?php echo $data['quantite_stock']; ?>" required>
            </div>

            <br>
            <input type="submit" name="update" value="Sauvegarder les modifications">
        </form>
        <br>
        <a href="admin.php">Annuler et retourner</a>
    </section>
</body>
</html>