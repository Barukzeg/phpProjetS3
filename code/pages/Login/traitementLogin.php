<?php
    session_start();
    require_once "./identifiants.php";

    if (Identifiants::getId()->verifId($_POST['login'], $_POST['mdp'])) {
        $_SESSION['connected'] = true;
        header('Location: ../index.php'); // Rediriger vers la page d'accueil si l'authentification est réussie
        exit();
    } else {
        echo '
        <html>
            <!DOCTYPE HTML>
            <head>
                <title>Erreur</title>
                <link rel="stylesheet" href="/phpProjetS3/code/style/styleTrans.css">
            </head>
            <body>
                <div class="container">
                    <h2>Nom d\'utilisateur ou mot de passe incorrect.</h2>
                    <div class="bouton">
                        <form action="login.php">
                            <button>Retour à la page de connexion</button>
                        </form>
                    </div>
                </div>
            </body>
        </html>';
    }

?>