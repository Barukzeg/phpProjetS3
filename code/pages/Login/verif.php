<?php
    session_start();
    if (!isset($_SESSION['connected']) || $_SESSION['connected'] !== true) {
        header('Location: /phpProjetS3/code/pages/Login/login.php');
        exit();
    }
?>