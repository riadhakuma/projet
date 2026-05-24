<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section>
    <h2>Se connecter</h2>
    <form action="authentification.php" method="POST">
        <div>
            <label>Email :</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Mot de passe :</label>
            <input type="password" name="password" required>
        </div>
        <input type="submit" value="Se connecter">
    </form>
    <p style="margin-top:20px;">Nouveau client ? <a href="inscription.php" style="color:cyan;">Créez un compte et recevez 10000da</a></p>
</section>
</body>
</html>