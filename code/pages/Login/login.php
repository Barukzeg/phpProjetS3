<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <h2>Veuillez vous connecter : </h2>
    <form method="post" action="traitementLogin.php">
        <label for="login">Login : </label>
        <input type="text" name="login" required><br>

        <label for="mdp">Mot de passe : </label>
        <input type="password" name="mdp" required><br>
        <button type="submit">Connexion</button>
    </form>
</body>
</html>
