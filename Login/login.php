<!DOCTYPE html>
<html lang="fr">
    <link rel="stylesheet" type="text/css" href="../style/style.css"/>
    <link rel="stylesheet" type="text/css" href="../style/styleLogin.css"/>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/png" href="../image/logo.ico"/>
        <title>Connexion</title>
    </head>
    <body>
        <form method="post" action="traitementLogin.php" >
            <h2>Identification : </h2>
            <label for="login">Login : </label>
            <input type="text" name="login" required><br>

            <label for="mdp">Mot de passe : </label>
            <input type="password" name="mdp" required><br>
            <button type="submit">Connexion</button>
        </form>
    </body>
</html>
