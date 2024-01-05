<!DOCTYPE html>
<html lang="fr">
    <link rel="stylesheet" type="text/css" href="/phpProjetS3/code/style/style.css"/>
    <link rel="stylesheet" type="text/css" href="/phpProjetS3/code/style/styleLogin.css"/>
    <head>
        <meta charset="UTF-8">
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
