<?php
    session_start();
    require_once "./identifiants.php";

    if (Identifiants::getId()->verifId($_POST['login'], $_POST['mdp'])) {
        $_SESSION['connected'] = true;
        header('Location: ../index.php'); // Rediriger vers la page d'accueil si l'authentification est réussie
        exit();
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }

?>