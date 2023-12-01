<?php

     ///Connexion au serveur MySQL
     $server = "localhost";
     $db="cabinet_medical";
     $login="carnetadresse";
     $mdp="password";
     try {
         $mysqlClient = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
     }
     catch (Exception $e) {
         die('Erreur : ' . $e->getMessage());
     };


?>