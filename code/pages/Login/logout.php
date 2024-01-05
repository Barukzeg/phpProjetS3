<?php
    session_start();
    session_destroy();
    header('Location: /phpProjetS3/code/pages/Login/login.php');
    exit();
?>