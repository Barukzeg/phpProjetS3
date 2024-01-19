<?php

    include_once "../../bd/bdd.php";
    class Identifiants {

        private static $instance = null;

        // Constructeur
        private function __construct() {
        }

        // Méthode de création de l'unique instance de la classe
        public static function getId() {
            if (is_null(self::$instance)) {
                self::$instance = new Identifiants();
            }
            return self::$instance;
        }
        
        // Méthode de vérification des identifiants
        public function verifId(string $login, string $mdp) {
            $bd = BDD::getBDD();
            $req = BDD::getBDD()->getConnection()->prepare("SELECT * FROM Identifiants WHERE login = :login AND mdp = :mdp");
            $req->bindParam(':login', $login);
            $req->bindParam(':mdp', $mdp);
            $req->execute();
            $result = $req->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }
?>